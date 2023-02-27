import React from "react";
import PostFront from "./Post/PostFront";
import PostBack from "./Post/PostBack";

export interface PropsPost {
    post: any
    back: boolean
    shared: boolean
}

const Post: React.FC<PropsPost> = (props) => {
    const post = props.post
    const classCss = props.shared ? 'return' : null

    return (
        <div key={"div-" + post.instagram_id} className="col-xl-3 col-lg-4 col-sm-6 text-break mb-4">
            <div key={"post-" + post.instagram_id} id={"post-" + post.instagram_id} className={`post  ${classCss}`}>
                <PostFront key={"front-" + post.instagram_id} post={post} back={props.back} />
                {props.back && <PostBack key={"back-" + post.instagram_id} post={post} />}
            </div>
        </div>
    )
}

export default Post
