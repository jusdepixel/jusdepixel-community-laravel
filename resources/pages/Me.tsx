import React, { useEffect, useState } from "react"
import { Navigate } from "react-router-dom"
import axios from "axios";

import Post from "../components/Post";

interface PropsMe {
    profile: any
}

const Me: React.FC<PropsMe> = (props) => {
    const [posts, setPosts] = useState<any>([])
    const [shared, setShared] = useState<any>([])
    const error = {
        title: "403 Error",
        description: "Forbidden",
        more: "You don't have permission to access this resource.",
        home: true,
        login: true,
    }

    const fetchPosts = () => {
        axios
            .get('/api/me/posts')
            .then((response) => {
                setPosts(response.data.posts.data)
                setShared(response.data.shared)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchPosts()
    }, [])


    return !props.profile.isAuthenticated ?
        <Navigate replace to="/error" state={error}/> : <>
            <h3><i className="bi bi-instagram"></i> My Instagram feed</h3>
            <h6 className="text-secondary">
                {props.profile.userName}
                &nbsp;|&nbsp;
                {props.profile.mediaCount} post{props.profile.mediaCount > 1 && 's'}
            </h6>

            <div className="row mt-5">
                {posts.map((post: any) =>
                    <Post
                        key={post.instagram_id}
                        post={post}
                        back={true}
                        shared={post.id}
                    />
                )}
            </div>
        </>
}

export default Me
