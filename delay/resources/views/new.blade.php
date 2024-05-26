<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Новинки</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/player.js'])
    @vite(['resources/js/lazyLoad.js'])
    @vite(['resources/js/addToCollection.js'])
    @vite(['resources/css/new.css'])
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/player.css'])
    @vite(['resources/css/track.css'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@include('duplicate/navigation')

<div class="sidebar" style="margin-top: 110px">
    <ul>
        <li><a class="active" href="/new">Новинки</a></li>
        <li><a href="/popular"><span>Популярное</span></a></li>
        <li><a href="/musician"><span>Исполнители</span></a></li>
        <li><a href="/genres"><span>Жанры</span></a></li>
    </ul>
</div>

<script>
    var userIsLoggedIn = @json(auth()->check());
    var csrfToken = @json(csrf_token());
</script>

<div class="scroll-menu">
    @foreach($tracks as $track)
        @include('duplicate/scrollmenu')
    @endforeach
</div>

@include('duplicate/player')

</body>
</html>
