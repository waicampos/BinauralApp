import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import wave from "../../../public/wav/zenmix-delta.wav";
import mp3 from "../../../public/wav/whistler.mp3";



export default function Binaural() {

  // basicamente, ele não está me deixando rodar dois áudios ao mesmo tempo
  const binaural = new Audio("/wav/zenmix-delta.wav");
  const jethro = new Audio(mp3);
  function toogleBinaural() {
    binaural.paused ? binaural.play() : binaural.pause();
    jethro.paused ? jethro.play() : jethro.pause();
  }

  return (
    <>
        <div>
          <button className="btn btn-danger" onClick={ () => {toogleBinaural()} }>Play Binaural & Song</button>
        </div>
        
    </>   

  );
}

//export default App;

if (document.getElementById('binaural')) {
    ReactDOM.render(<Binaural />, document.getElementById('binaural'));
}