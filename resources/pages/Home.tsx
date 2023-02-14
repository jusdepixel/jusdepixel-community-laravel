import React, {useState} from "react"
import axios from "axios";
import {Navigate} from "react-router-dom";
import Post from "../components/Post"

type Post = {
    id: string,
    ig_id: number,
    media_id: number,
    media_type: String,
    media_url: String,
    timestamp: String,
    updated_at: String,
    username: String,
}

type result = {
    code: number,
    message: string|null
}

export default function Home() {
    const [isLoading, setLoading] = useState(true)
    const [posts, setPosts] = useState([])
    const [result, setResult] = useState<result>({code: 0, message: 'Not initialized'})

    React.useEffect(() => {
        if (isLoading) {
            axios.get('/api/home')
                .then((response) => {
                    setPosts(response.data)
                    setResult({code: response.status, message: null})
                    setLoading(false)
                })
                .catch((error) => {
                    setResult({code: error.code, message: error.message})
                    setLoading(false)
                })
        }
    }, [])

    return (
        (!isLoading ?
            (result.message === null) ?
                <>
                    <h3><i className="bi bi-share"></i> Community</h3>
                    <h6 className="text-secondary">Les derniers partages de la communauté !</h6>
                    <div className="row mt-5 mb-3">
                        {posts.map((post: Post) => <Post key={post.id} post={post} page={"home"} />)}
                    </div>
                </>
            :
                <Navigate to="/error" state={result} />
        :
            <>
                <h3><i className="bi bi-share"></i> Community</h3>
                <h6 className="text-secondary">Les derniers partages de la communauté !</h6>
                <p className="loading">Chargement...</p>
            </>
        )
    )
}
