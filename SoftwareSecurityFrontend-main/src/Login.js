import React, { useState, useEffect } from 'react'
import { useHistory } from 'react-router-dom'

import Header from './Header'

function Login() {
    const [email, setEmail] = useState("")
    const [password, setPassword] = useState("")
    const history = useHistory();

    useEffect(() => {
        if (localStorage.getItem('user-info')) {
            history.push("/OrganizationSearch")
        }
    }, [])
    async function login() {
        console.warn(email, password)
        let item = { email, password };
        let result = await fetch("http://127.0.0.1:8081/api/login", {
            method: 'POST',
            headers: {
                "Content-Type": 'application/json',
                "Accept": 'application/json'
            },
            body: JSON.stringify(item)
        })
        result = await result.json();
        localStorage.setItem("user-info", JSON.stringify(result))
        history.push("/OrganizationSearch")
    }
    return (
        <div>
            <Header />
            <h1>Login Page</h1>
            <div className="">

                <input type="text" value={email} onChange={(e) => setEmail(e.target.value)} className="form-control" placeholder="email" />
                <br />
                <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} className="form-control" placeholder="password" />
                <br />
                <button onClick={login} className="btn">Login</button>

            </div>
        </div>
    )
}

export default Login