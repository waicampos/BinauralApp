import React, { useState, useEffect } from 'react';
import Dashboard from './Dashboard'
import Login from './Login'
import './player.css';
import ReactDOM from 'react-dom';


export default function Playlist() {

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
        { (token === '' || token == undefined) ? <Login/> : <Dashboard /> }
    </>   

  );
}

//export default App;

if (document.getElementById('playlist')) {
    ReactDOM.render(<Playlist />, document.getElementById('playlist'));
}