import React, { useEffect, useState } from "react"
import axios from "axios"
import "../scss/app.scss"

import Post from "../components/Post"

interface PropsHome {}

const Home: React.FC<PropsHome> = (props) => {
    const [posts, setPosts] = useState<any>([])

    const fetchPosts = () => {
        axios
            .get('/api/posts')
            .then((response) => {
                setPosts(response.data.posts.data)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchPosts()
    }, [])

    return <>
            <h3><i className="bi bi-share"></i> Community</h3>
            <h6 className="text-secondary">All community shares !</h6>

            <div className="row mt-5">
                {posts.map((post: any) =>
                    <Post key={post.instagram_id} post={post} back={false} />
                )}
            </div>
        </>
}

export default Home
