import React, { useEffect, useState } from "react"
import { Navigate } from "react-router-dom"
import axios from "axios";
import Moment from "moment/moment";

interface PropsMe {
    profile: any
}

const Me: React.FC<PropsMe> = (props) => {
    const [myProfile, setMyProfile] = useState<any>([]);
    const error = {
        title: "403 Error",
        description: "Forbidden",
        more: "You don't have permission to access this resource.",
        home: true,
        login: true,
    }

    const fetchProfile = () => {
        axios
            .get('/api/me/profile')
            .then((response) => {
                setMyProfile(response.data)
                console.log(response.data)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchProfile()
    }, [])


    return !props.profile.isAuthenticated ?
        <Navigate replace to="/error" state={error}/> : <>
            <h3><i className="bi bi-instagram"></i> My Community profile</h3>
            <h6 className="text-secondary">
                {props.profile.userName}
                &nbsp;|&nbsp;
                {props.profile.mediaCount} post{props.profile.mediaCount > 1 && 's'}
            </h6>

            <div className="infos-user mt-5">
                <i className="bi bi-info-circle-fill"></i>
                <p>id : <span>{myProfile.id}</span></p>
                <p>created_at : <span>{Moment(myProfile.created_at).format('DD/MM/YYYY hh:mm')}</span></p>
                <p>updated_at : <span>{Moment(myProfile.updated_at).format('DD/MM/YYYY hh:mm')}</span></p>
                <p>instagram_id : <span>{myProfile.instagram_id}</span></p>
                <p>token_type : <span>{myProfile.token_type}</span></p>
                <p>expires_days : <span>{myProfile.expires_days}</span></p>
            </div>
        </>
}

export default Me
