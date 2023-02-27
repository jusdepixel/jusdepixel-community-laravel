import React, {Dispatch, SetStateAction, useEffect, useState} from "react"
import axios from "axios"
import "../scss/app.scss"

import Post from "../components/Post";

export interface PropsHome {
    setLoading: Dispatch<SetStateAction<string>>
}

const Home: React.FC<PropsHome> = (props) => {
    const [posts, setPosts] = useState<any>([])

    const fetchPosts = () => {
        axios
            .get('/api/posts')
            .then((response) => {
                setPosts(response.data.posts.data)
                props.setLoading('')
            })
            .catch((error) => {
                console.error(error)
            })
    }

    useEffect(() => {
        fetchPosts()
    }, [])

    return (
        <div className="row">
            {posts.map((post: any) =>
                <Post post={post} key={post.id} />


            )}
        </div>

    )
}

export default Home
