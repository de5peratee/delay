<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Новинки</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/player.js'])
    @vite(['resources/js/lazyLoad.js'])
    @vite(['resources/js/addToCollection.js'])
    @vite(['resources/css/collection.css'])
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/player.css'])
    @vite(['resources/css/track.css'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@include('duplicate/navigation')

@php
    $currentUsername = session('user') ? session('user')->Login : null;
    $pageUsername = request()->segment(2);
@endphp

<div class="page-name">
    @if($currentUsername == $pageUsername)
        <h1>Моя музыка</h1>
    @else
        <h1>Музыка пользователя {{ $pageUsername }}</h1>
    @endif
</div>


<div class="button-box">
    <a id="back-button" href="javascript:history.back()"> <span style="cursor: pointer;">< Вернуться</span> </a>
</div>

<script>
    var userIsLoggedIn = @json(auth()->check());
    var csrfToken = @json(csrf_token());
</script>

<div class="scroll-menu" style="margin-top: 300px">
    @foreach($tracks as $track)
        @include('duplicate/scrollmenu')
    @endforeach
</div>

@if($tracks->isEmpty())
    <div class="noTrack">Треки отсутствуют</div>
@endif


@include('duplicate/player')

</body>
</html>
