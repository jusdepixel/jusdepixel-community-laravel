import React, {useState} from "react";
import {Routes, Route, useLocation, Navigate} from 'react-router-dom'
import axios from 'axios';
import '../scss/app.scss'

import Background from "./Backgound"
import Header from "./Header"

import PageHome from "../pages/Home"
import PageAuth from "../pages/Auth"
import PageError from "../pages/Error"
import PageMe from "../pages/Me"
import PageLogout from "../pages/Logout"
import Moment from "moment/moment";

Moment.locale('fr')

type propsProfile = {
    accessToken: string,
    accountType: string,
    isAuthenticated: boolean,
    mediaCount: number,
    igId: number,
    username: string
}

type result = {
    code: number,
    status?: string
    message?: string|null,
    more?: string,
    profile?: any,
}

export default function App() {
    const [isLoading, setLoading] = useState<boolean>(true)
    const [result, setResult] = useState<result>({code: 0, message: 'Not initialized'})
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
                .catch((error) => {
                    setResult({
                        code: error.response.status,
                        message: error.message,
                        status: error.response.statusText,
                        more: error.response.data.message,
                        profile: error.response.data.profile
                    })
                    setLoading(false)
                })
        }
    })

    return (
        <div>
            <Background />

            {!isLoading ?

                (result.code) ?
                    <Navigate to="/error" state={result} />
                :
                    <>
                        <Header profile={profile} authorizeUrl={authorizeUrl} />

                        <main className="container mt-5 mb-5">
                            <Routes>
                                <Route path={"/"} element={<PageHome />} />
                                <Route path={"/auth"} element={<PageAuth setProfile={setProfile} profile={profile} location={location} />} />
                                <Route path={"/me"} element={<PageMe setProfile={setProfile} profile={profile} />} />
                                <Route path={"/logout"} element={<PageLogout setProfile={setProfile} />} />
                                <Route path={"/error"} element={<PageError setProfile={setProfile}  notFound={false} />} />
                                <Route path='*' element={<PageError setProfile={setProfile} notFound={true} />} />
                            </Routes>
                        </main>
                    </>
            :
                <></>
            }
        </div>
    )
}
