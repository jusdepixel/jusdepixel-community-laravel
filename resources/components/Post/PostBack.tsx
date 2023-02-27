import React from "react";
import Moment from "moment/moment";
import axios from "axios";

export interface PropsPostBack {
    post: any
}

const PostBack: React.FC<PropsPostBack> = (props) => {
    const post = props.post

    const handleDelete = (e: any) => {
        e.preventDefault()
        const target = e.target
        const id = target.getAttribute('data-post')
        target.setAttribute('disabled','')

        axios.delete('/api/me/posts/' + id)
            .then((response) => {
                let instagramId = target.id.replace("btn-delete-", "")
                let btnPost = document.getElementById("btn-create-" + instagramId)
                let divPost = document.getElementById("post-" + instagramId)
                if (divPost) {
                    if(btnPost) {
                        btnPost.removeAttribute('disabled')
                    }
                    divPost.classList.remove('return')
                }
            })
    }

    return (
        <div className={"post-back"}>
            <picture>
                {post.media_type === "VIDEO" ?
                    <img src={post.thumbnail_url} alt={post.caption} width="100%" />
                    :
                    <img src={post.media_url} alt={post.caption} width="100%" />
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
                    {Moment(post.timestamp).format('DD/MM/YYYY hh:mm')}
                </span>
                {post.caption && <span className="caption">{post.caption}</span>}
                {post.permalink &&
                    <a target={"_blank"} href={post.permalink} className="permalink">
                        <i className="bi bi-box-arrow-up-right"></i>
                    </a>
                }

                <button
                    id={"btn-delete-" + post.instagram_id}
                    className="btn btn-sm bg-danger"
                    data-post={post.id}
                    onClick={handleDelete}
                >
                    <i className="bi bi-x-lg me-2"></i>Delete share !
                </button>
            </div>
        </div>
    )
}

export default PostBack
