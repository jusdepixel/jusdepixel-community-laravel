import React, {useState} from "react";
import axios from "axios";
import {Navigate} from "react-router-dom";

export default function Post({post, page} : {post: any, page: string}) {
    const [result, setResult] = useState({code: null})

    const handle = (e: any) => {
        e.preventDefault()

        const target = e.target
        return target.getAttribute('data-post')
    }

    const handleCreate = (e: any) => {
        const id = handle(e)

        axios.get('/api/post/create/' + id)
            .then(() => {
                let divPost = document.getElementById("post-" + id)
                if (divPost) divPost.classList.add('return')
            })
            .catch((error) => {
                setResult({code: error.response.status})
            })

    }

    const handleDelete = (e: any) => {
        const id = handle(e)

        axios.get('/api/post/delete/' + id)
            .then(() => {
                let divPost = document.getElementById("post-" + id)
                if (divPost) divPost.classList.remove('return')
            })

    }

    let classCss = post.isShared ? 'return' : null

    return (
        (result.code) ?
            <Navigate to={"/error"} state={{result}} />
       :

            <div className="col-xl-3 col-lg-4 col-sm-6 text-break mb-4">
                <div id={"post-" + post.id} className={`post  ${classCss}`}>

                    <div className={"post-front"}>
                        <picture>
                            <img src={post.media_url} alt="{post.username}" width="100%" />
                        </picture>
                        <div>
                            <span className="type"><i className="bi bi-image me-2"></i>{post.media_type}</span>
                            <span className="timestamp">{post.timestamp}</span>
                            <span className="username">{post.username}</span>

                            {(page === "me" &&
                                <button
                                    className="btn btn-info btn-sm"
                                    data-post={post.id}
                                    onClick={handleCreate}
                                >
                                    <i className="bi bi-share me-2"></i>Partager
                                </button>
                            )}
                        </div>
                    </div>

                    <div className={"post-back"}>
                        {(page === "me" &&
                            <>
                                <picture>
                                    <img src={post.media_url} alt="{post.username}" width="100%" />
                                </picture>
                                <div>
                                    <span className="type"><i className="bi bi-image me-2"></i>{post.media_type}</span>
                                    <span className="timestamp">{post.timestamp}</span>
                                    <span className="username">{post.username}</span>

                                    <button
                                        className="btn btn-sm bg-danger"
                                        data-post={post.id}
                                        onClick={handleDelete}
                                    >
                                        <i className="bi bi-x-lg me-2"></i>Supprimer le partage
                                    </button>
                                </div>
                            </>
                        )}
                    </div>
                </div>
            </div>
    )
}
