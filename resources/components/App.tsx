import React, {useState} from "react";
import {Routes, Route, useLocation} from 'react-router-dom'
import axios from 'axios';
import '../scss/app.scss'

import Background from "./Backgound"
import Header from "./Header"

import PageHome from "../pages/Home"
import PageAuth from "../pages/Auth"
import PageError from "../pages/Error"
import PageMe from "../pages/Me"
import PageLogout from "../pages/Logout"

type propsProfile = {
    accessToken: string,
    accountType: string,
    isAuthenticated: boolean,
    mediaCount: number,
    igId: number,
    username: string
}
export default function App() {
    const [isLoading, setLoading] = useState<boolean>(true)
    const [authorizeUrl, setAuthorizeUrl] = useState<string>("")
    const [profile, setProfile] = useState<propsProfile>({
        accessToken: "",
        accountType: "",
        isAuthenticated: false,
        mediaCount: 0,
        igId: 0,
        username: "Anonymous"
    })

    const location = useLocation()

    React.useEffect(() => {
        if (isLoading) {
            if (!profile.isAuthenticated) {
                axios.get('/api/initialize/profile')
                    .then((response) => {
                        setProfile(response.data)

                        if (!profile.isAuthenticated) {
                            axios.get('/api/initialize/url')
                                .then((response) => {
                                    setAuthorizeUrl(response.data)
                                    setLoading(false)
                                })
                        } else {
                            setLoading(false)
                        }
                    })
            } else {
                setLoading(false)
            }
        }
    })

    return (
        <div className={isLoading ? 'loading' : 'loaded'}>
            <Background />

            {!isLoading &&
                <>
                    <Header profile={profile} authorizeUrl={authorizeUrl} />

                    <main className="container mt-5 mb-5">
                        <Routes>
                            <Route path={"/"} element={<PageHome />} />
                            <Route path={"/auth"} element={<PageAuth setProfile={setProfile} location={location} />} />
                            <Route path={"/me"} element={<PageMe profile={profile} />} />
                            <Route path={"/logout"} element={<PageLogout setProfile={setProfile} />} />
                            <Route path={"/error"} element={<PageError setProfile={setProfile}/>} />
                        </Routes>
                    </main>
                </>
             }
        </div>
    )
}
