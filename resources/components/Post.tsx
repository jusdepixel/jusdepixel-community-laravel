import React from "react";
import Moment from "moment/moment";

export interface PropsPost {
    post: any
}

const Post: React.FC<PropsPost> = (props) => {
    const post = props.post

    return (
        <div className="col-xl-3 col-lg-4 col-sm-6 text-break mb-4">
            <div id={"post-" + post.id} className="post">
                <div className={"post-front"}>
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
                                {Moment(post.created_at).format('DD/MM/YYYY hh:mm')}
                            </span>

                        <span className="username"></span>

                        {post.caption && <span className="caption">{post.caption}</span>}

                        {post.permalink &&
                            <a target={"_blank"} href={post.permalink} className="permalink">
                                <i
                                    className="bi bi-box-arrow-up-right"></i></a>
                        }
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Post
