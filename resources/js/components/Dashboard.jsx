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


  function chooseTrack(track) {
    setPlaylist(playlist => [...playlist, track])
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
    <div className="flex-grow-1 my-2">
      {playlist.map(track => (
          <Track
            track={track}
          />
        ))}
    </div>
    {/* Botão de Salvar a playlist para fazer requisição ao php, que irá criar a playlist, incluir a lista de músicas e salvar o a uri da playlist associada ao usuário */}
    </Container>
  )
}


if (document.getElementById('dashboard')) {
  ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
}