import React from "react"
import {Navigate} from "react-router-dom";
import axios from "axios"

export default function Error({setProfile} : {setProfile: any}) {

    React.useEffect(() => {
        axios.get('/api/logout')
            .then((response) => {
                if (response.status === 200) {
                    setProfile(response.data)
                }
            })
    })

    return <Navigate to="/" />
}
