import React from "react";
import Moment from "moment/moment";
import axios from "axios";

export interface PropsPostFront {
    post: any
    back: boolean
}

const PostFront: React.FC<PropsPostFront> = (props) => {
    const post = props.post

    const handleCreate = (e: any) => {
        e.preventDefault()
        const target = e.target
        const id = target.getAttribute('data-post')
        target.setAttribute('disabled','')

        axios.post('/api/me/posts/' + id)
            .then((response) => {
                let divPost = document.getElementById("post-" + id)
                let btnPost = document.getElementById("btn-delete-" + id)
                if (divPost) {
                    if(btnPost) {
                        btnPost.setAttribute('data-post', response.data.post.id)
                        btnPost.removeAttribute('disabled')
                    }
                    divPost.classList.add('return')
                }
            })
            .catch((error) => {
                console.log(error)
            })
    }

    return (
        <div className={"post-front"}>
            <picture>
                {post.media_type === "VIDEO" ?
                    <img src={post.thumbnail_url} alt={post.caption} width="100%"/>
                    :
                    <img src={post.media_url} alt={post.caption} width="100%"/>
                }
            </picture>
            <div>
                <span className="type">
                    {post.media_type === "IMAGE" ?
                        <i className="bi bi-image me-2"></i>
                        :
                        <i className="bi bi-camera-video me-2"></i>
                    }
                    {post.media_type}
                </span>
                <span className="timestamp">
                    {props.back ?
                        Moment(post.timestamp).format('DD/MM/YYYY hh:mm')
                        :
                        Moment(post.created_at).format('DD/MM/YYYY hh:mm')
                    }
                </span>
                {!props.back && <span className="username">{post.author.username}</span>}
                {post.caption && <span className="caption">{post.caption}</span>}
                {post.permalink &&
                    <a target={"_blank"} href={post.permalink} className="permalink">
                        <i
                            className="bi bi-box-arrow-up-right"></i></a>
                }

                {props.back &&
                    <button
                        id={"btn-create-" + post.instagram_id}
                        className="btn btn-info btn-sm"
                        data-post={post.instagram_id}
                        onClick={handleCreate}
                    >
                        <i className="bi bi-share me-2"></i>Share !
                    </button>
                }
            </div>
        </div>
    )
}

export default PostFront
