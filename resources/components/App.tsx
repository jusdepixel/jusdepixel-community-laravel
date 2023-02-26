import React from "react";
import {Routes, Route} from 'react-router-dom'
import '../scss/app.scss'

import Background from "./Backgound"
import Header from "./Header"

export default function App() {

    React.useEffect(() => {

    })

    return (
        <div>
            <Background />
            <>
                <Header />

                <main className="container mt-5 mb-5">
                    <Routes>
                        <Route path={"/"} />
                    </Routes>
                </main>
            </>
        </div>
    )
}
