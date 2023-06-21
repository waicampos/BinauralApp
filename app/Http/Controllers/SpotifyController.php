<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SpotifyWebAPI;


class SpotifyController extends Controller
{

    private $CLIENT_ID = '2ddc65eaba3a4e2d8f474afbab907516';
    private $CLIENT_SECRET = '691e57f638f14d43b8a1c70fe58ea9c7';
    private $CALLBACK_URL = 'http://localhost:8000/spotify/callback';


    public function login()
    {
        $session = new SpotifyWebAPI\Session(
            $this->CLIENT_ID,
            $this->CLIENT_SECRET,
            $this->CALLBACK_URL
        );
        
        $state = $session->generateState();

        // Armazenar o $state em algum lugar, como a sessão:
        session(['SpotifyAuthState' => $state]);
        //$getSesstion = session('SpotifyAuthState');
        //exit('State Stored: ' . $getSesstion);

        $options = [
            'scope' => [
                'playlist-read-private',
                'playlist-modify-public', 
                'playlist-modify-private',
                'user-read-private',
                'user-read-email',
                'streaming'
            ],
            'state' => $state,
        ];
        
        header('Location: ' . $session->getAuthorizeUrl($options));
        die();
    }


    public function callback ()
    {

        $session = new SpotifyWebAPI\Session(
            $this->CLIENT_ID,
            $this->CLIENT_SECRET,
            $this->CALLBACK_URL
        );
        
        //$state = $_GET['state'];
        
        // Fetch the stored state value from somewhere. A session for example
        $storedState = session('SpotifyAuthState');

        //if ($state !== $storedState) {
            // The state returned isn't the same as the one we've stored, we shouldn't continue
            //die('State mismatch');
        //}
        
        // Request a access token using the code from Spotify
        $session->requestAccessToken($_GET['code']);
        
        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();
        
        // Store the access and refresh tokens somewhere. In a session for example
        session(['SpotifyAcessToken' => $accessToken]);
        session(['SpotifyRefreshToken' => $refreshToken]);
        
        // Send the user along and fetch some data!
        //header('Location: app.php');
        //die();
        return redirect('/');
    }

    public function transfer_playback($token, $device_id) 
    {

        //$device = $device_id; 
        //$token = session('SpotifyAcessToken');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/me/player');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"device_ids": [$device_id]}');

        $headers = array();
        $headers[] = 'Authorization: Bearer ' . $token;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }


    public function token ()
    {
        // Retrieve accessToken from storage
        $accessToken = session('SpotifyAcessToken');

        // Retorna json para o React
        return response()->json(['acessToken' => $accessToken]);
    }


    public function me ()
    {



        $api = new SpotifyWebAPI\SpotifyWebAPI();

        // Fetch the saved access token from somewhere. A session for example.
        $accessToken = session('SpotifyAcessToken');

        $api->setAccessToken($accessToken);

        // It's now possible to request data about the currently authenticated user
        print_r(
            $api->me()
        );

        // Getting Spotify catalog data is of course also possible
        print_r(
            $api->getTrack('7EjyzZcbLxW7PaaLua9Ksb')
        );

        return view('me', ['api' => $api]);
    }


    public function play($device_id)
    {

        $session = new SpotifyWebAPI\Session(
            $this->CLIENT_ID,
            $this->CLIENT_SECRET,
            $this->CALLBACK_URL
        );

        $options = [
            'auto_refresh' => true,
        ];       
        
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $accessToken = session('SpotifyAcessToken');

        $api->setAccessToken($accessToken);
        //$deviceId = "15693b4dc7241ccba67eb82fbf58fd82bc0f7e0e";

        $tranfer_response = $this->transfer_playback($accessToken, $device_id);
        
        $api->play($device_id, [
            'uris' => ['spotify:track:14SO7JAN6L7Mk1ZUmabJaI'],
        ]);
    }
   
    // spotify:album:77ye4kGcWBmzcLWFiSCljE



public function buscar2 (Request $request)
{
    $session = new SpotifyWebAPI\Session(
        $this->CLIENT_ID,
        $this->CLIENT_SECRET,
        $this->CALLBACK_URL
    );

    $options = [
        'auto_refresh' => true,
    ];
    
    // Use previously requested tokens fetched from somewhere. A database for example.
    $accessToken = session('SpotifyAcessToken');
    $refreshToken = session('SpotifyRefreshToken');

    if ($accessToken) {
        $session->setAccessToken($accessToken);
        $session->setRefreshToken($refreshToken);
    } else {
        // Or request a new access token
        $session->refreshAccessToken($refreshToken);
    }

    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);    
    //$api = new SpotifyWebAPI\SpotifyWebAPI();
    //$accessToken = session('SpotifyAcessToken');

    //$api->setAccessToken($accessToken);
    //$deviceId = "15693b4dc7241ccba67eb82fbf58fd82bc0f7e0e";

    $query = $request->busca;

    $searchResult = $api->search($query, 'track');

    // Remember to grab the tokens afterwards, they might have been updated
    $newAccessToken = $session->getAccessToken();
    $newRefreshToken = $session->getRefreshToken();
    //Save data in session
    session(['SpotifyAcessToken' => $newAccessToken]);
    session(['SpotifyRefreshToken' => $newRefreshToken]);


    return view('cadastro_participante.playlist', ['searchResult' => $searchResult]);
}



public function buscar ($search)
{
    $session = new SpotifyWebAPI\Session(
        $this->CLIENT_ID,
        $this->CLIENT_SECRET,
        $this->CALLBACK_URL
    );

    $options = [
        'auto_refresh' => true,
    ];
    
    // Use previously requested tokens fetched from somewhere. A database for example.
    $accessToken = session('SpotifyAcessToken');
    $refreshToken = session('SpotifyRefreshToken');

    if ($accessToken) {
        $session->setAccessToken($accessToken);
        $session->setRefreshToken($refreshToken);
    } else {
        // Or request a new access token
        $session->refreshAccessToken($refreshToken);
    }

    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);    
    //$api = new SpotifyWebAPI\SpotifyWebAPI();
    //$accessToken = session('SpotifyAcessToken');

    //$api->setAccessToken($accessToken);
    //$deviceId = "15693b4dc7241ccba67eb82fbf58fd82bc0f7e0e";

    $searchResult = $api->search($search, 'track');

    // Remember to grab the tokens afterwards, they might have been updated
    $newAccessToken = $session->getAccessToken();
    $newRefreshToken = $session->getRefreshToken();
    //Save data in session
    session(['SpotifyAcessToken' => $newAccessToken]);
    session(['SpotifyRefreshToken' => $newRefreshToken]);


    //return view('cadastro_participante.playlist', ['searchResult' => $searchResult]);

    $jsonData = json_encode($searchResult);

    return response()->json(['tracks' => $jsonData]);
}





public function criar (Request $request) 
{
    $session = new SpotifyWebAPI\Session(
        $this->CLIENT_ID,
        $this->CLIENT_SECRET,
        $this->CALLBACK_URL
    );

    $options = [
        'auto_refresh' => true,
        'scope' => [
            'playlist-read-private',
            'playlist-modify-public', 
            'playlist-modify-private'
        ]
    ];
    //$state = $session->generateState();

    // Armazenar o $state em algum lugar, como a sessão:
    //session(['SpotifyAuthState' => $state]);
    //header('Location: ' . $session->getAuthorizeUrl($options));
   //die();
    
    // Use previously requested tokens fetched from somewhere. A database for example.
    $accessToken = session('SpotifyAcessToken');
    $refreshToken = session('SpotifyRefreshToken');

    if ($accessToken) {
        $session->setAccessToken($accessToken);
        $session->setRefreshToken($refreshToken);
    } else {
        // Or request a new access token
        $session->refreshAccessToken($refreshToken);
    }

    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);    


    $playlist_name = $request->playlist_name;
    $track_uri = $request->track;

    $response = $api->createPlaylist([
        'name' => $playlist_name
    ]);

    $playlist_id = $response->id;

    $api->addPlaylistTracks($playlist_id, [
        $track_uri,
    ]);


    // Remember to grab the tokens afterwards, they might have been updated
    $newAccessToken = $session->getAccessToken();
    $newRefreshToken = $session->getRefreshToken();
    //Save data in session
    session(['SpotifyAcessToken' => $newAccessToken]);
    session(['SpotifyRefreshToken' => $newRefreshToken]);


    return view('cadastro_participante.playlist');
}


public function salvar (Request $request) 
{

    $session = new SpotifyWebAPI\Session(
        $this->CLIENT_ID,
        $this->CLIENT_SECRET,
        $this->CALLBACK_URL
    );

    $options = [
        'auto_refresh' => true,
    ];
    
    // Use previously requested tokens fetched from somewhere. A database for example.
    $accessToken = session('SpotifyAcessToken');
    $refreshToken = session('SpotifyRefreshToken');

    if ($accessToken) {
        $session->setAccessToken($accessToken);
        $session->setRefreshToken($refreshToken);
    } else {
        // Or request a new access token
        $session->refreshAccessToken($refreshToken);
    }

    $options = [
        'auto_refresh' => true,
    ];

    $api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);    

    $playlist_name = $request->playlist;
    $track_uri = $request->track;

    $api->createPlaylist([
        'name' => $playlist_name
    ]);


    $api->addPlaylistTracks('PLAYLIST_ID', [
        'TRACK_ID',
        'EPISODE_URI'
    ]);
    



    // Remember to grab the tokens afterwards, they might have been updated
    $newAccessToken = $session->getAccessToken();
    $newRefreshToken = $session->getRefreshToken();
    //Save data in session
    session(['SpotifyAcessToken' => $newAccessToken]);
    session(['SpotifyRefreshToken' => $newRefreshToken]);


    return view('cadastro_participante.playlist', ['searchResult' => $searchResult]);

}


}
