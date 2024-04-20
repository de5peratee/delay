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
                <i class="fa-solid fa-house" style="color: #000000;"></i>
                <a class="menu__item" href="/new">Главная</a>
            </li>
            <li>
                <i class="fa-solid fa-music" style="color: #000000;"></i>
                <a class="menu__item" href="">Плейлист</a>
            </li>
            <li>
                <i class="fa-solid fa-upload" style="color: #000000;"></i>
                <a class="menu__item" href="/musician/add_music">Добавить музыку</a>
            </li>
            <br><br><br>
            <li>
                <i class="fa-solid fa-circle-info" style="color: #000000;"></i>
                <a class="menu__item" href="">О пользователе</a>
            </li>
            <li>
                <i class="fa-solid fa-arrow-right-from-bracket" style="color: #000000;"></i>
                <a class="menu__item" href="" >Выход</a>
            </li>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
