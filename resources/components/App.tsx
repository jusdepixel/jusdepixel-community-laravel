import React, {useEffect, useState} from "react"
import axios from "axios";
import "../scss/app.scss"

import Background from "./Backgound"
import Header from "./Header"
import Home from "../pages/Home";

export interface PropsApp {}

const App: React.FC<PropsApp> = (props) => {
    const [loading, setLoading] = useState<string>('loading')
    const [authorizeUrl, setAuthorizeUrl] = useState<string>('')

    const fetchAuthorizeUrl = () => {
        axios
            .get('/api/init/url')
            .then((response) => {
                setAuthorizeUrl(response.data.authorizeUrl)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchAuthorizeUrl()
    }, [])

    return (
        <div>
            <Background/>
            <>
                <Header setLoading={setLoading} authorizeUrl={authorizeUrl}  />

                <main className={`container mt-5 mb-5 ${loading}`}>

                    <Home setLoading={setLoading} />

                </main>
            </>
        </div>
    )
}

export default App
