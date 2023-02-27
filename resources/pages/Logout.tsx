import React, { Dispatch, SetStateAction, useEffect } from "react"
import { Navigate } from "react-router-dom"
import axios from "axios";

interface PropsLogout {
    setProfile: Dispatch<SetStateAction<any>>
}

const Logout: React.FC<PropsLogout> = (props) => {
    const fetchLogout = () => {
        axios
            .post('/api/auth/logout')
            .then((response) => {
                props.setProfile(response.data.profile)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchLogout()
    }, [])

    return <Navigate replace to="/" />
}

export default Logout
