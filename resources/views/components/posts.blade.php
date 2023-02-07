<div class="row mt-5 mb-3">
    @foreach($posts as $post)
        <div class="col-xl-3 col-lg-4 col-sm-6 text-break mb-4">
            <div class="posts">
                <picture class="mb-3">
                    <img src="{{ $post->media_url }}" alt="{{ $post->username }}" width="100%">
                </picture>
                <span class="username">{{ $post->username }}</span>
                <span class="timestamp">{{ date("d/m/y H:i", strtotime($post->timestamp)) }}</span>
                @if($page == 'me')
                    <form action="">
                        <button class="btn btn-info mt-3 btn-sm">
                            <i class="bi bi-share me-2"></i>Partager
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>

