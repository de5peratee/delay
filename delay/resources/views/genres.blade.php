<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Жанры</title>
    <meta charset="UTF-8">
    @vite(['resources/css/genres.css'])
    @vite(['resources/css/burgerMenu.css'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@include('duplicate/navigation')

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
