import React, { useEffect } from "react"
import { Navigate } from "react-router-dom"
import axios from "axios";

interface PropsAuth {
    profile: any
}

const Auth: React.FC<PropsAuth> = (props) => {
    const fetchAuth = () => {
        axios
            .get('/api/auth/login/' + location.search.replace('?code=', ''))
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchAuth()
    }, [])

    return props.profile.isAuthenticated ?
        <Navigate replace to="/me" /> : <></>
}

export default Auth
