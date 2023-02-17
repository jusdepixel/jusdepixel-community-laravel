import React, {useState} from "react"
import {Navigate} from "react-router-dom"
import axios from "axios"

type result = {
    code: number,
    status?: string
    message?: string|null,
    more?: string,
    profile?: any,
}

export default function Auth({profile, setProfile, location} : {profile: any, setProfile: any, location: any}) {
    const [isLoading, setLoading] = useState(true)
    const [isInit, setIsInit] = useState(true)
    const [result, setResult] = useState<result>({code: 0, message: 'Not initialized'})

    React.useEffect(() => {
        if (isInit && isLoading && result.code === 0) {
            setIsInit(false)
            axios.get('/api/authenticate' + location.search)
                .then((response) => {
                    location.search = null
                    setProfile(response.data)
                    setResult({code: response.status, message: null})
                    setLoading(false)
                })
                .catch((error) => {
                    setResult({
                        code: error.response.status ? error.response.status : error.status,
                        message: error.message,
                        status: error.response.statusText,
                        more: error.response.data.message,
                        profile: error.response.data.profile
                    })

                    setLoading(false)

                    if (error.response.data.profile) {
                        setProfile(error.response.data.profile)
                    }
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
