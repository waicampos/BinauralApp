import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
//import delta from "../../../public/wav/zenmix-delta.wav"
//import "./binaural.js"

const track = {
    name: "",
    album: {
        images: [
            { url: "" }
        ]
    },
    artists: [
        { name: "" }
    ]
}

function WebPlayback(props) {
    console.log("Hiiiii em webplayblac");

    const [is_paused, setPaused] = useState(false);
    const [is_active, setActive] = useState(false);
    const [player, setPlayer] = useState(undefined);
    const [current_track, setTrack] = useState(track);
    const [data, setData] = useState(null);
    const [wavePlayer, setWavePlayer] = useState('paused');
    const [playerId, setPlayerId] = useState(undefined);
    

    //const wave = new Audio(delta)
    const wave = new Audio()
    function toogleWave() {
        if(wavePlayer == 'paused') {
            wave.play();  
            setWavePlayer('playing');
            console.log("wavePlayer set to: " + wavePlayer);
        } 
        // tentar descobrir pq o wave.pause() não funciona!
    }

    function play() {
        async function prepare_player() {
            //await fetch('/spotify/transfer/' + device_id);
            await fetch('/spotify/play/' + playerId);
        }
        prepare_player().
            then(() => {
                try {toogleWave()}
                catch (error) {
                    console.log(error);
                    setWavePlayer('paused');
                    console.log("wavePlayer set to: " + wavePlayer);
                }
            });
    }


    useEffect(() => {

        const script = document.createElement("script");
        script.src = "https://sdk.scdn.co/spotify-player.js";
        script.async = true;

        document.body.appendChild(script);

        window.onSpotifyWebPlaybackSDKReady = () => {

            const player = new window.Spotify.Player({
                name: 'Web Playback SDK',
                getOAuthToken: cb => { cb(props.token); },
                volume: 0.5
            });

            console.log(player);

            setPlayer(player);

            player.addListener('ready', ({ device_id }) => {
                console.log('Ready with Device ID', device_id);
                setPlayerId(device_id);
                
            });

            player.addListener('not_ready', ({ device_id }) => {
                console.log('Device ID has gone offline', device_id);
                setPlayerId(device_id);
            });

            player.addListener('player_state_changed', (state => {

                if (!state) {
                    return;
                }

                setTrack(state.track_window.current_track);
                setPaused(state.paused);

                player.getCurrentState().then(state => {
                    (!state) ? setActive(false) : setActive(true)
                });

            }));

            player.connect();

        };
    }, []);

    const handlePlaylists = async () => {

        try {
            const response = await fetch('http://localhost:3001/playlists', {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                },
            });
            const data = await response.json();
            setData(data)

        } catch (err) {
            console.log(err.message)
        }
    };

    
    // const playbinaural = () => {
    //     //binaural.paused ? binaural.play() : binaural.pause();
    //     //player.togglePlay();
    //     console.log("Que diabos");
    //     binaural.play();
    // }


    function checkResponse(data) {
        console.debug(data)
        if (data) {
            const itens = data.items;
            const listItens = itens.map((d) => <li><img src={d.images[0].url} /> {d.name}: {d.uri}</li>);
            return (
                <ul class="playlists">
                    {listItens}
                </ul>
            );
        } else {
            return null;
        }

    }

    if (!is_active) {
        return (
            <>
                <div className="container">
                    <div className="main-wrapper">
                        <button className="btn btn-primary" onClick={() => { play() }} > Iniciar Player </button>
                    </div>
                </div>
            </>)
    } else {
        return (
            <>
            {/* <img src="/wav/img.png" alt="Imahe" /> */}
            {/* <button onClick={() => { togglePlay() }}>Play/Pause</button> */}
            {/* <button className="btn btn-danger" onClick={ () => {toogleWave()} }>Play Binaural</button> */}

                <div className="container">
                    <div className="main-wrapper">

                        {/* <img src={current_track.album.images[0].url} className="now-playing__cover" alt="" /> */}

                        <div className="now-playing__side">
                            <div className="now-playing__name">{current_track.name}</div>
                            <div className="now-playing__artist">{current_track.artists[0].name}</div>

                            <button className="btn btn-primary" onClick={() => { player.previousTrack() }} >
                                &lt;&lt;
                            </button>
                            {/* Aqui que eu tenho que chamar uma função que dá o togglePlay lá e o togglePlay no binaural */}
                            <button className="btn btn-primary" onClick={() => { 
                                toogleWave();
                                player.togglePlay(); 
                                //binaural.paused ? binaural.play() : binaural.pause(); 
                            }} >
                                {is_paused ? "PLAY" : "PAUSE"}
                            </button>

                            <button className="btn btn-primary" onClick={() => { player.nextTrack() }} >
                                &gt;&gt;
                            </button>

                            <div className="my-3">
                                <a className="btn btn-primary" href='/questionario_final'>Encerrar Player</a>
                            </div>
                            
                        </div>


                    </div>

                </div>
                {/* <div class="container">
                    <div class="playlist main-wrapper">
                        <div>
                            <button onClick={handlePlaylists} >
                                Playlists
                            </button>
                        </div>
                        {checkResponse(data)}
                    </div>

                </div> */}


            </>
        );
    }
}

export default WebPlayback
