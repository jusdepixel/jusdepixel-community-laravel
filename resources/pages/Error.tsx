import React from "react";
import {Link, useLocation} from "react-router-dom";

interface PropsState {
    title?: string
    description?: string
    more?: string
    home?: boolean
    login?: boolean
}

interface PropsError {
    authorizeUrl?: string
}

const Error: React.FC<PropsError> = (props) => {
    const location = useLocation();
    let { title, description, more, home, login } = location.state ?
        location.state as PropsState
    : {
        title: "404 Error",
        description: "File not found",
        more: "The URL you requested was not found.",
        home: true,
        login: true,
    }

    return (
        <>
            <h3><i className="bi bi-bug"></i> {title}</h3>
            <h6 className="text-secondary">{description}</h6>
            <p className={"more"}>
                {more}
                <br/>
                {home && (
                    <Link to="/" className="btn ps-0 pt-2 text-secondary">
                        <i className="bi bi-backspace-reverse-fill me-1"></i>
                        Go back to home...
                    </Link>
                )}
                {login && (
                    <a href={props.authorizeUrl} className="btn ps-0 pt-2 text-secondary">
                        <i className="bi bi-instagram"></i> Login with Instagram
                    </a>
                )}
            </p>
        </>
    )
}

export default Error

