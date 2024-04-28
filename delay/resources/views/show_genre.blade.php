<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Жанр</title>
    <meta charset="UTF-8">
    @vite(['resources/css/show_genres.css'])
    @vite(['resources/css/burgerMenu.css'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
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


</body>
</html>
