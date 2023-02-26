import React from "react";
import {Link} from "react-router-dom";

export default function Header() {
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

                    </ul>
                </div>
            </nav>
        </header>
    )
}
