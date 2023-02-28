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
                <p>Username : <span>{myProfile.username}</span></p>
                <p>Created at : <span>{Moment(myProfile.created_at).format('DD/MM/YYYY hh:mm')}</span></p>
                <p>Community Id : <span>{myProfile.id}</span></p>
                <p>Instagram Id : <span>{myProfile.instagram_id}</span></p>
                <p>Instagram posts : <span>{myProfile.media_count}</span></p>
                <p>Token expires in : <span>{myProfile.expires_in_human}</span></p>
            </div>
        </>
}

export default Me
