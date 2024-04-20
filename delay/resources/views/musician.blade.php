<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/musician.css'])
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
        <li><a class="active" href="/musician">Исполнители</a></li>
        <li><a href="/genres"><span>Жанры</span></a></li>
    </ul>
</div>


</body>
</html>
