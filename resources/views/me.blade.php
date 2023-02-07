<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/lux/bootstrap.min.css">
        <title>Jusdepixel Community</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="{{ route('home@process') }}" class="navbar-brand">
                    <img src="{{ asset('logo.png') }}" alt="Jusdepixel Community" width="300">
                </a>

                <pre class="me-auto">
                    Connected : {{ $profile->isAuthenticated ? "true" : "false" }}
                    Social ID : {{ $profile->socialId ? $profile->socialId : "null" }}
                    Account Type : {{ $profile->accountType ? $profile->accountType : "null" }}
                    Media Count : {{ $profile->mediaCount ? $profile->mediaCount : 0 }}
                    Username : {{ $profile->username }}
                </pre>

                <ul class="navbar-nav d-flex">
                    @if($profile->isAuthenticated)
                        <li class="nav-item">
                            <a href="{{ route('logout@process') }}" class="btn btn-secondary ">
                                <i class="bi bi-door-closed"></i> Disconnect
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ $authorizeUrl }}" class="btn btn-secondary ">
                                <i class="bi bi-instagram"></i> Connect with Instagram
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="container mt-5">
            <h4>Mes posts Instagram</h4>
            <small class="text-muted">Partagez vos meilleurs posts avec la communauté !</small>


            <ul class="list-group mb-5 mt-5">
                @foreach($posts as $post)
                    <li class="list-group-item text-break">
                        <img src="{{ $post->media_url }}" alt="{{ $post->username }}" width="100%" class="mb-3 mt-2">
                        <strong>id: </strong>{{ $post->id }}<br>
                        <strong>media_type: </strong>{{ $post->media_type }}<br>
                        <strong>media_url: </strong>{{ $post->media_url }}<br>
                        <strong>username: </strong>{{ $post->username }}<br>
                        <strong>timestamp: </strong>{{ $post->timestamp }}<br>
                        <form action="" class="text-end">
                            <button class="btn btn-primary mt-2 mb-2 btn-sm">
                                <i class="bi bi-share me-2"></i>Partager
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>


    </body>
</html>
