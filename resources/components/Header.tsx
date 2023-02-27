import React from "react"
import { Link } from "react-router-dom"

interface PropsHeader {
    authorizeUrl: string
    profile: any
}

const Header: React.FC<PropsHeader> = (props) => {

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
                        {props.profile.isAuthenticated ? (
                            <>
                                <li className="nav-item">
                                    <Link to="/profile" className="nav-link">
                                        <i className="bi bi-person-fill me-1"></i>
                                        {props.profile.userName}
                                    </Link>
                                </li>
                                <li className="nav-item">
                                    <Link to="/me" className="btn btn-sm btn-info">
                                        <i className="bi bi-instagram"></i> My posts
                                    </Link>
                                </li>
                                <li className="nav-item me-0">
                                    <Link to="/logout" className="btn btn-sm btn-secondary">
                                        <i className="bi bi-door-closed"></i> Logout
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
