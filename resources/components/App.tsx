import React, { useEffect, useState } from "react"
import { Routes, Route } from 'react-router-dom'
import axios from "axios";
import "../scss/app.scss"

import Background from "./Backgound"
import Header from "./Header"
import Home from "../pages/Home"
import Error from "../pages/Error"
import Me from "../pages/Me"
import Auth from "../pages/Auth"
import Logout from "../pages/Logout"
import Profile from "../pages/Profile";

interface PropsApp {}

const App: React.FC<PropsApp> = (props) => {
    const [authorizeUrl, setAuthorizeUrl] = useState<string>('')
    const [profile, setProfile] = useState<any>([]);

    const fetchProfile = () => {
        axios
            .get('/api/auth/profile')
            .then((response) => {
                setProfile(response.data.profile);
                fetchAuthorizeUrl()
            })
            .catch((error) => {
                console.error(error)
            })
    }

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
        fetchProfile()
    }, [])

    return (
        <>
            <Background />
            <Header
                authorizeUrl={authorizeUrl}
                profile={profile}
            />

            <main className={`container mt-5 mb-5`}>
                <Routes>
                    <Route index element={<Home />} />
                    <Route path="/auth" element={<Auth profile={profile} />} />
                    <Route path="/profile" element={<Profile profile={profile} />} />
                    <Route path="/me" element={<Me profile={profile} />} />
                    <Route path="/logout" element={<Logout setProfile={setProfile} />} />
                    <Route path="/error" element={<Error authorizeUrl={authorizeUrl} />} />
                    <Route path="*" element={<Error authorizeUrl={authorizeUrl} />} />
                </Routes>
            </main>
        </>
    )
}

export default App
