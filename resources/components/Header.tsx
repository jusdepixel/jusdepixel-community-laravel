import React from "react";
import {Link} from "react-router-dom";

export default function Header({profile, authorizeUrl} : {profile: any, authorizeUrl: string}) {
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
                                        <i className="bi bi-instagram"></i> Mes posts
                                    </Link>
                                </li>
                                <li className="nav-item me-0">
                                    <Link to="/logout" className="btn btn-sm btn-secondary">
                                        <i className="bi bi-door-closed"></i> Déconnexion
                                    </Link>
                                </li>
                            </>
                        ) : (
                            <>
                                <li className="nav-item me-0">
                                    <a href={authorizeUrl} className="btn btn-sm btn-info">
                                        <i className="bi bi-instagram"></i> Connexion Instagram
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
