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

@include('duplicate/navigation')

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
            <a href="/musician/show/{{ urlencode($musician->Musician_name) }}">
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
