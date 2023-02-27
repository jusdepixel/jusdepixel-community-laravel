import React, {Dispatch, SetStateAction, useEffect, useState} from "react";
import {Link} from "react-router-dom";
import axios from "axios";

export interface PropsHeader {
    setLoading: Dispatch<SetStateAction<string>>
    authorizeUrl: string
}

const Header: React.FC<PropsHeader> = (props) => {
    const [profile, setProfile] = useState<any>([])

    const fetchProfile = () => {
        axios
            .get('/api/auth/profile')
            .then((response) => {
                setProfile(response.data.profile)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchProfile()
    }, [])

    return (
        <header>
            <nav
                id="main-navbar"
                className="navbar navbar-expand-lg navbar-dark bg-primary"
            >
                <div className="container">
                    <Link to="/" className="navbar-brand">
                        <img src="logo.png" alt="Jusdepixel Community" width="300" />
                    </Link>

                    <ul className="navbar-nav d-flex">
                        {profile.isAuthenticated ? (
                            <>
                                <li className="nav-item">
                                    <span className="nav-link">
                                        <i className="bi bi-person-fill me-1"></i>
                                        {profile.username}
                                    </span>
                                </li>
                                <li className="nav-item">
                                    <Link to="/me" className="btn btn-sm btn-info">
                                        <i className="bi bi-instagram"></i> My posts
                                    </Link>
                                </li>
                                <li className="nav-item me-0">
                                    <Link to="/logout" className="btn btn-sm btn-secondary">
                                        <i className="bi bi-door-closed"></i> Login
                                    </Link>
                                </li>
                            </>
                        ) : (
                            <>
                                <li className="nav-item me-0">
                                    <a href={props.authorizeUrl} className="btn btn-sm btn-info">
                                        <i className="bi bi-instagram"></i> Login with Instagram
                                    </a>
                                </li>
                            </>
                        )}
                    </ul>
                </div>
            </nav>
        </header>
    )
}

export default Header
