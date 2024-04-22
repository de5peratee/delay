<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/genres.css'])
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
                @else
                    <li>
                        <i class="fa-solid fa-guitar" style="color: #ffffff;"></i>
                        <a class="menu__item" href="/become_musician" >Стать музыкантом</a>
                    </li>
                @endif
                <li>
                    <i class="fa-solid fa-circle-info" style="color: #ffffff;"></i>
                    <a class="menu__item" href="">О пользователе</a>
                </li>
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
    <input type="text" id="search" placeholder="Поиск" required>
</div>

<div class="sidebar">
    <ul>
        <li><a href="/new"><span>Новинки</span></a></li>
        <li><a href="/popular"><span>Популярное</span></a></li>
        <li><a href="/musician"><span>Исполнители</span></a></li>
        <li><a class="active" href="/genres">Жанры</a></li>
    </ul>
</div>


<div class="content-wrapper">
    <div id="genres-block">
        {!! $genres !!}
    </div>
    <script>
        $(document).ready(function(){
            $('#search').on('input', function(){
                var query = $(this).val();
                $.ajax({
                    url: "/search",
                    data: {query: query},
                    success: function(data){
                        $('#genres-block').html(data);
                    }
                });
            });
        });
    </script>
</div>
</body>
</html>
