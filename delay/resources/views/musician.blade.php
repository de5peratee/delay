<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Исполнители</title>
    <meta charset="UTF-8">
    @vite(['resources/css/musician.css'])
    @vite(['resources/css/burgerMenu.css'])
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

<div class="write">
    delay
</div>

<div class="input-box">
    <input type="text" id="searchMusician" placeholder="Поиск" required>
</div>

<div class="sidebar">
    <ul>
        <li><a href="/new"><span>Новинки</span></a></li>
        <li><a href="/popular"><span>Популярное</span></a></li>
        <li><a class="active" href="/musician">Исполнители</a></li>
        <li><a href="/genres"><span>Жанры</span></a></li>
    </ul>
</div>

<div class="content-wrapper">
    @foreach($musicians as $musician)
        <div class="container musician-card" data-name="{{ $musician->Musician_name }}">
            <a href="/musician/{{ urlencode($musician->Musician_name) }}">
                <div class="musician-block" style="background-image: url('/storage/{{ $musician->Musician_icon }}')"></div>
            </a>
            <div class="musician-name">{{ $musician->Musician_name }}</div>
        </div>
    @endforeach
</div>

<script>
    $(document).ready(function(){
        $("#searchMusician").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".musician-card").filter(function() {
                $(this).toggle($(this).data('name').toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</body>
</html>
