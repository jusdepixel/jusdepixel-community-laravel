import React, {useState} from "react"
import {Navigate} from "react-router-dom"
import axios from "axios"
import Post from "../components/Post"


type Post = {
    id: number,
    media_type: String,
    media_url: String,
    username: String,
    timestamp: String
}

type result = {
    code: number,
    status?: string
    message?: string,
    more?: string,
    profile?: any,
}

export default function Me({profile, setProfile} : {profile: any, setProfile: any}) {
    const [posts, setPosts] = useState([])
    const [isLoading, setLoading] = useState(true)
    const [result, setResult] = useState<result>({code: 0, message: 'Not initialized'})

    React.useEffect(() => {
        if (isLoading) {
            axios.get('/api/me')
                .then((response) => {
                    setPosts(response.data)
                    setResult({code: response.status})
                    setLoading(false)
                })
                .catch((error) => {
                    setResult({
                        code: error.response.status,
                        message: error.message,
                        status: error.response.statusText,
                        more: error.response.data.message,
                        profile: error.response.data.profile
                    })

                    setLoading(false)

                    if (error.response.data.profile) {
                        setProfile(error.response.data.profile)
                    }
                })
        }
    })

    return (
        (!isLoading ?
            (result.code === 200) ?
                <>
                    <h3><i className="bi bi-instagram"></i> {profile.username}</h3>
                    <h6 className="text-secondary">{posts.length} post{posts.length > 1 ? 's' : ''}</h6>
                    <div className="row mt-5 mb-3">
                        {posts.map((post: Post) => <Post key={post.id} post={post} page={"me"} />)}
                    </div>
                </>
            :
                <Navigate to={"/error"} state={{result}} />
        :
            <>
                <h3><i className="bi bi-share"></i> {profile.username}</h3>
                <h6 className="text-secondary">{posts.length} post{posts.length > 1 ? 's' : ''}</h6>
                <p className="loading">Chargement...</p>
            </>
        )
    )
}
