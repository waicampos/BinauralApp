import React from "react";
import ReactDOM from 'react-dom';
import { useState, useEffect } from "react"
//import useAuth from "./useAuth"
//import Player from "./Player"
import TrackSearchResult from "./TrackSearchResult"
import Track from "./Track"
import { Container, Form } from "react-bootstrap"
//import SpotifyWebApi from "spotify-web-api-node"
//import axios from "axios"

// const spotifyApi = new SpotifyWebApi({
//   clientId: "8b945ef10ea24755b83ac50cede405a0",
// })

export default function Dashboard({ code }) {
  //const accessToken = useAuth(code)
  const [search, setSearch] = useState("")
  const [searchResults, setSearchResults] = useState([])
  const [inputValue, setInputValue] = useState('')
  const [timer, setTimer] = useState(null)
  const [playlist, setPlaylist] = useState([])
  //const [lyrics, setLyrics] = useState("")
  const [playlist_uris, setPlaylist_uris] = useState([])


  function chooseTrack(track) {
    setPlaylist(playlist => [...playlist, track])
    setPlaylist_uris(playlist_uris => [...playlist_uris, track.uri])
    console.log(playlist);
    //setSearch("")
    //setLyrics("")
  }

  // Não sei se este código está ótimo, mas foi o melhor que eu encontrei
  // Acho que vou tentar algo diferente depois com mais calma

//   // Get the input box
// let input = document.getElementById('my-input');

// // Init a timeout variable to be used below
// let timeout = null;

// // Listen for keystroke events
// input.addEventListener('keyup', function (e) {
//     // Clear the timeout if it has already been set.
//     // This will prevent the previous task from executing
//     // if it has been less than <MILLISECONDS>
//     clearTimeout(timeout);

//     // Make a new timeout set to go off in 1000ms (1 second)
//     timeout = setTimeout(function () {
//         console.log('Input Value:', textInput.value);
//     }, 1000);
// });

  const inputChanged = e => {
    setInputValue(e.target.value)

    clearTimeout(timer)

    const newTimer = setTimeout(() => {
      setSearch(e.target.value)
    }, 300)

    setTimer(newTimer)
  }


  useEffect(() => {
    if (!search) {
      console.log("!Search: "+search)
      console.log("Search Result: "+searchResults)
      return setSearchResults([])}

    let cancel = false
    
    async function getTracks() {
        const response = await fetch('/spotify/buscar/'+search);
        const json = await response.json();
        //console.log("Response: "+json);
        return json;
    }
      
    getTracks()
      .then(res => {
        if (cancel) return
        //console.log(res);
        let tracks = JSON.parse(res.tracks);
        console.log(tracks);
        setSearchResults(
          tracks.tracks.items.map(track => {
            const smallestAlbumImage = track.album.images.reduce(
              (smallest, image) => {
                if (image.height < smallest.height) return image
                return smallest
              },
              track.album.images[0]
            )

            return {
              artist: track.artists[0].name,
              title: track.name,
              uri: track.uri,
              albumUrl: smallestAlbumImage.url,
            }
          })
        )
      })
  
      return () => (cancel = true)

  }, [search])


  function salvarPlaylist () {
    const playlistUris = []
    playlist.map(track => (
      playlistUris.push(track.uri)
    ))
    let playlist_to_save = {tracks: playlistUris};
    //let json_tracks = JSON.stringify(playlist_to_save);
    //console.log(json_tracks);

    fetch('/playlist', {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/; charset=UTF-8",
        "X-CSRF-Token": csrf_token
      },
      method: "post",
      credentials: "same-origin",
      body: JSON.stringify(playlist_to_save),
    })
       .then(() => {window.location.href = "/";})
       .catch((err) => {
          console.log(err.message);
       });
  }

  // preciso dar um settimeout no setsearch...
  // Lógica
  // Mudou... espera 100 segundos
  // function updateSearch(search) {
  //   setTimeout(() => {
  //     setSearch(search)
  //   }, 1000)
  // }

  // cada vez que o usuário levanta a tecla
  // dá um clear no timeout
  // espera um segundo
  // se chegou ao fim do timeout()
  // executa a função...


  return (
    <Container className="d-flex flex-column py-2">
      <div className="flex-grow-1 my-2">
        <p>Sua Playlist:</p>
        <div className="row justify-content-center">
          {playlist.map(track => (
              <Track
                track={track}
              />
            ))}
          </div>
        <p>Duração Total: </p>
      </div>

      <Form.Control
        type="search"
        placeholder="Search Songs/Artists"
        value={inputValue}
        onChange={inputChanged}
          //updateSearch(e.target.value)}}
      />
      <div className="flex-grow-1 my-2">
        {searchResults.map(track => (
          <TrackSearchResult
            track={track}
            key={track.uri}
            chooseTrack={chooseTrack}
          />
        ))}
        {/* {searchResults.length === 0 && (
          <div className="text-center" style={{ whiteSpace: "pre" }}>
            {lyrics}
          </div>
        )} */}
      </div>
      {/* <div>
        <Player accessToken={accessToken} trackUri={playingTrack?.uri} />
      </div> */}
    
    {/* <form action="/playlist" method="POST"> */}
      
     {/* <input type="hidden" name="X-CSRF-Token" value={csrf_token}/>
     <input type="hidden" name="playlist" value={playlist_uris}/>
     <button className="btn btn-secondary">Salvar Playlist</button>
    </form> */}

    <button className="btn btn-secondary" onClick={() => { salvarPlaylist() }}>Salvar playlist</button>
    {/* Botão de Salvar a playlist para fazer requisição ao php, que irá criar a playlist, incluir a lista de músicas e salvar o a uri da playlist associada ao usuário */}
    </Container>
  )
}

if (document.getElementById('dashboard')) {
  ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
}