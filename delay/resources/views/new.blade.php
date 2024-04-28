<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Новинки</title>
    <meta charset="UTF-8">
    @vite(['resources/css/new.css'])
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/player.css'])
    @vite(['resources/js/new.js'])
    @vite(['resources/js/player.js'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<nav>
    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
            <span></span>
        </label>
        <ul class="menu__box">
            <li>
                <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                <a class="menu__item" href="/new">Главная</a>
            </li>
            @if(Session::has('user'))
                <li>
                    <i class="fa-solid fa-music" style="color: #ffffff;"></i>
                    <a class="menu__item" href="">Плейлист</a>
                </li>
                @if(Session::get('user')->Status == 'musician')
                    <li>
                        <i class="fa-solid fa-upload" style="color: #ffffff;"></i>
                        <a class="menu__item" href="/musician/add_music">Добавить музыку</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-info" style="color: #ffffff;"></i>
                        <a class="menu__item" href="">О пользователе</a>
                    </li>
                @else
                    <li>
                        <i class="fa-solid fa-guitar" style="color: #ffffff;"></i>
                        <a class="menu__item" href="/become_musician" >Стать музыкантом</a>
                    </li>
                @endif
            @endif
            <div style="color:white;" >
                ________________________
            </div>
            <br>
            @if(Session::has('user'))
                <li>
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>
                    <a class="menu__item" href="/logout" >Выход</a>
                </li>
            @else
                <li>
                    <i class="fa-solid fa-sign-in" style="color: #ffffff;"></i>
                    <a class="menu__item" href="/login" >Вход</a>
                </li>
            @endif
        </ul>
    </div>
</nav>


<div class="input-box">
    <input type="text" id="searchNew" placeholder="Поиск" required>
    <div class="filter">
        <span class="button-text">Фильтр</span>
        <i class="fa-solid fa-filter"></i>
    </div>
</div>

<div class="sidebar">
    <ul>
        <li><a class="active" href="/new">Новинки</a></li>
        <li><a href="/popular"><span>Популярное</span></a></li>
        <li><a href="/musician"><span>Исполнители</span></a></li>
        <li><a href="/genres"><span>Жанры</span></a></li>
    </ul>
</div>

<div class="scroll-menu">
    @foreach($tracks as $track)
        <div class="track">
            <img src="{{ asset('/storage/' . $track->Track_icon) }}" alt="Иконка трека">
            <div class="track-info">
                <div class="i1">
                    <i class="plus fa-solid fa-plus"></i>
                </div>
                <div class="trackName">{{ $track->Track_name }}</div>
                <div class="trackMusician">{{ $track->musician->Musician_name }}</div>
                <div class="trackGenre">
                    <a href="/genres/{{ str_replace(' ', '+', $track->genre->Genre_name) }}">{{ $track->genre->Genre_name }}</a>
                </div>

            </div>
            <div class="track-source" hidden>{{ asset('/storage/' . $track->Track_url) }}</div>
        </div>
    @endforeach
</div>

<div class="player" style="display: none; align-items: center;">
    <audio id="player" controls style="display: none;"></audio>
    <button class="player-button" id="prev"><i class="fa-solid fa-backward-step"></i></button>
    <button class="player-button" id="playPause"><i class="fa-solid fa-pause"></i></button>
    <button class="player-button" id="next"><i class="fa-solid fa-forward-step"></i></button>
    <div class="track-info-player">
        <img class="track-icon" src="" alt="Иконка трека">
        <div>
            <div class="track-name"></div>
            <div class="track-musician"></div>
        </div>
    </div>
    <input id="timeSlider" type="range" min="0" step="1" value="0" style="cursor:pointer; width: 700px; color: black !important; background-color: black !important">

    <div style="display: flex; align-items: center; color: gray; font-family: 'Montserrat', sans-serif; font-weight: lighter;">
        <span id="currentTimeDisplay" style="font-size: 12px; width: 15px"></span>
        <span>/</span>
        <span id="totalTimeDisplay" style="font-size: 12px; margin-left: 5px; width: 10px; padding-right: 40px;"></span>
    </div>
    <i id="volumeIcon" class="fa-solid fa-volume-high" style="color: #ffffff; width: 20px; padding-right: 3px"></i>
    <input id="volumeSlider" type="range" min="0" max="1" step="0.01" value="1" style="width: 70px; cursor: pointer;">
    <i id="shuffleIcon" class="fa-solid fa-shuffle" style="color: #a3a3a3; cursor: pointer;  margin-left: 20px"></i>
    <i id="repeatIcon" class="fa-solid fa-repeat" style="color: #a3a3a3; cursor: pointer; margin-left: 20px"></i>

</div>

</body>
</html>
