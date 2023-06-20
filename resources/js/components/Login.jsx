import React from 'react';

function Login() {
    console.log("Tentando fazer login");
    return (
        <div className="App">
            <header className="App-header">
                <a className="btn-spotify" href="/spotify/login" >
                    Login with Spotify 
                </a>
            </header>
        </div>
    );
}

export default Login;

