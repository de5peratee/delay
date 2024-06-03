<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Исполнитель</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/track.css'])
    @vite(['resources/css/player.css'])
    @vite(['resources/css/show_musician.css'])
    @vite(['resources/js/player.js'])
    @vite(['resources/js/addToCollection.js'])
    @vite(['resources/js/lazyLoad.js'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@include('duplicate/navigation')

<div class="button-box">
    <a id="back-button" href="javascript:history.back()"> <span style="cursor: pointer;">< Вернуться</span> </a>
</div>

<div class="content-wrapper">
    <div class="musician-info">
        <div class="musician-icon">
            <img src="/storage/{{ $musician->Musician_icon }}" alt="{{ $musician->Musician_name }} icon">
        </div>

        <div class="musician-text">
            <div class="musician-name">{{ $musician->Musician_name }}</div>
            <div class="musician-description">{{ $musician->Musician_description }}</div>
        </div>
    </div>
</div>

<script>
    var userIsLoggedIn = @json(auth()->check());
    var csrfToken = @json(csrf_token());
</script>

<div class="scroll-menu" style="margin-top: 260px; margin-left: 0;">
    @foreach($tracks as $track)
        @if($track->musician->Musician_name == $musician->Musician_name)
            @include('duplicate/scrollmenu')
        @endif
    @endforeach
</div>

@include('duplicate/player')

</body>
</html>
