<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Жанр</title>
    <meta charset="UTF-8">
    @vite(['resources/css/show_genres.css'])
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/track.css'])
    @vite(['resources/css/player.css'])
    @vite(['resources/js/player.js'])
    @vite(['resources/js/lazyLoad.js'])
    @vite(['resources/js/addToCollection.js'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
@include('duplicate/navigation')

<div class="button-box">
    <a id="back-button" href="javascript:history.back()"> <span style="cursor: pointer;">< Вернуться</span> </a>
</div>

<div class="content-wrapper">
    <div class="genre-info">
        <div class="genre-icon">
            <img src="/{{ $genre->Genre_icon }}" alt="{{ $genre->Genre_name }} icon">
        </div>

        <div class="genre-text">
            <div class="genre-name">{{ $genre->Genre_name }}</div>
            <div class="genre-description">{{ $genre->Genre_description }}</div>
        </div>
    </div>
</div>

<script>
    var userIsLoggedIn = @json(auth()->check());
    var csrfToken = @json(csrf_token());
</script>

<div class="scroll-menu" style="margin-top: 300px; margin-left: 0;">
    @foreach($tracks as $track)
        @include('duplicate/scrollmenu')
    @endforeach
</div>

@include('duplicate/player')

</body>
</html>
