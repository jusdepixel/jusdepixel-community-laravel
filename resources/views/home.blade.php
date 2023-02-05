<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <title>Community</title>
    </head>

    <body>
        <div class="container">
            <pre>
                Connected : {{ $isAuthenticated }}
                Social ID : {{ $socialId }}
            </pre>

            @if($isAuthenticated)
                <a href="{{ route('logout@process') }}" class="btn btn-primary">Disconnect</a>
            @else
                <a href="{{ $authorizeUrl }}" class="btn btn-primary">Connect with Instagram</a>
            @endif

            <ul class="list-group mt-5">
                @foreach($posts as $post)
                    <li class="list-group-item">
                        <strong>id: </strong>{{ $post->id }}<br>
                        <strong>created_at: </strong>{{ $post->created_at }}<br>
                        <strong>updated_at: </strong>{{ $post->updated_at }}<br>
                        <strong>social_id: </strong>{{ $post->social_id }}<br>
                        <strong>media_id: </strong>{{ $post->media_id }}<br>
                        <strong>type: </strong>{{ $post->type }}<br>
                        <strong>url: </strong>{{ $post->url }}<br>
                        <strong>username: </strong>{{ $post->username }}<br>
                        <strong>timestamp: </strong>{{ $post->timestamp }}<br>
                    </li>
                @endforeach
            </ul>
        </div>
        </body>
</html>
