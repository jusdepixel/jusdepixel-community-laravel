@extends('layout')

@section('title', 'Jusdepixel Community - Accueil')

@section('content')
    <h3><i class="bi bi-share-fill"></i> Community</h3>

    @if(count($posts) > 0)
        <h6 class="text-secondary">Les derniers partages de la communauté !</h6>
        @php $page = 'home' @endphp
        @include("components/posts")
    @else
        <h6>Aucun post Instagram partagé par la communauté...</h6>
    @endif
@endsection
