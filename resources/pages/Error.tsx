import React, {useState} from "react"
import {useLocation} from "react-router-dom";
import axios from "axios";

export default function Error({setProfile} : {setProfile: any}) {
    const [isLoading, setLoading] = useState(true)
    const {state} = useLocation()
    const {result} = state

    if (result.code === 400) {
        if (isLoading) {
            axios.get('/api/logout').then(r => {
                result.status = "Bad Request"
                result.more = "Session Instagram expirée, veuillez vous connecter."
                setProfile({isAuthenticated: false})
                setLoading(false)
            })
        }
    }

    return (
        result !== undefined ? (
                <>
                    <h3><i className="bi bi-bug"></i> Erreur {result.code}: {result.status}</h3>
                    <h6 className="text-secondary">{result.message}</h6>
                    {result.more && <p className={"more"}>{result.more}</p>}
                </>
            )
        :
            <>
                <h3><i className="bi bi-bug"></i> Erreur</h3>
                <h6 className="text-secondary">Erreur inconnue...</h6>
            </>
)
}
