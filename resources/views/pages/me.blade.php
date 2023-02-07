@extends('layout')

@section('title', 'Jusdepixel Community - Mon Instagram')

@section('content')
    <h3><i class="bi bi-instagram"></i> {{ $profile->username }}</h3>

    @if(count($posts) > 0)
        <h6 class="text-secondary">
            {{ $profile->mediaCount }} post{{ $profile->mediaCount > 1 ? 's' : '' }} à partager !
        </h6>
        @php $page = 'me' @endphp
        @include("components/posts")
    @else
        <h6>Aucun post sur votre compte Instagram...</h6>
    @endif
@endsection
