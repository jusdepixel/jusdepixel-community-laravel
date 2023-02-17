import React, {useState} from "react"
import {useLocation} from "react-router-dom";
import axios from "axios";

type errorType = {
    result?: any
    code?: number
    status?: string
    message?: string|null
    more?: string
    profile?: any
}

export default function Error({setProfile, notFound} : {setProfile: any, notFound: boolean}) {
    const [isLoading, setLoading] = useState(true)
    const [error, setError] = useState<errorType>({})
    const {state} = useLocation()
    let result: errorType = state;

    React.useEffect(() => {
        if (isLoading) {
            if (notFound) {
                setError({
                    code: 404,
                    status: "File not found",
                    message: "REQUEST FAILED WITH STATUS CODE 404",
                    more: "Page non trouvée...",
                    profile: {},
                })
                setLoading(false)

            } else {
                setError(result)

                if (error) {
                    console.log(error)

                    if (error.code === 400) {
                        axios.get('/api/logout').then(r => {
                            setError({
                                status: "Bad Request",
                                message: "Session Instagram expirée, veuillez vous connecter.",
                            })
                            setProfile({isAuthenticated: false})
                            setLoading(false)
                        })

                    } else {
                        setLoading(false)
                    }
                } else {
                    setLoading(false)
                }
            }
        }
    })

    return (
        (!isLoading && error) ?
            <>
                <h3><i className="bi bi-bug"></i> Erreur {error.code}: {error.status}</h3>
                <h6 className="text-secondary">{error.message}</h6>
                {error.more && <p className={"more"}>{error.more}</p>}
            </>
        :
            <></>
    )
}
