import React, { useState, useEffect } from 'react';
import WebPlayback from './WebPlayback'
import Login from './Login'
import './player.css';
import ReactDOM from 'react-dom';


export default function Player() {

  const [token, setToken] = useState('');

  useEffect(() => {

    async function getToken() {
      const response = await fetch('/spotify/token');
      const json = await response.json();
      console.log("Token: "+json.acessToken);
      setToken(json.acessToken);
    }

    getToken();

  }, []);

  return (
    <>
        { (token === '' || token == undefined) ? <Login/> : <WebPlayback token={token} /> }
    </>   

  );
}

//export default App;

if (document.getElementById('player')) {
    ReactDOM.render(<Player />, document.getElementById('player'));
}