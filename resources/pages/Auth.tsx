import React, {useState} from "react"
import {Navigate} from "react-router-dom"
import axios from "axios"

type result = {
    code: number,
    message: string|null
}

export default function Auth({profile, setProfile, location} : {profile: any, setProfile: any, location: any}) {
    const [isLoading, setLoading] = useState(true)
    const [result, setResult] = useState<result>({code: 0, message: 'Not initialized'})

    React.useEffect(() => {
        if (isLoading && !profile.isAuthenticated) {
            axios.get('/api/authenticate' + location.search)
                .then((response) => {
                    setProfile(response.data)
                    setResult({code: response.status, message: null})
                    setLoading(false)
                })
                .catch((error) => {
                    setResult({code: error.code, message: error.message})
                    setLoading(false)
                })
        }
    })

    return (
        (!isLoading ?
            (result.message === null) ?
                <Navigate to="/me"/>
                :
                <Navigate to="/error" state={result} />
            :
                <></>
        )
    )
}
