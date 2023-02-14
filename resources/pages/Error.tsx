import React from "react"
import {useLocation} from "react-router-dom";

export default function Error() {
    const {state} = useLocation()
    const {result} = state

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
