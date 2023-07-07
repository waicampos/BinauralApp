import React from 'react';

function Login() {
    console.log("Tentando fazer login");
    return (
        <div className="App">
            <header className="App-header">
                <a className="btn btn-primary" href="/spotify/login" >
                    Login with Spotify 
                </a>
            </header>
        </div>
    );
}

export default Login;

