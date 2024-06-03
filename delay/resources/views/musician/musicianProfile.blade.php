<!DOCTYPE html>
<html lang="RU">
<head>
    <title>Профиль музыканта</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/musicianProfile.css'])
    @vite(['resources/css/burgerMenu.css'])
    @vite(['resources/css/player.css'])

    @vite(['resources/js/updateProfile.js'])
    @vite(['resources/js/updateTrack.js'])
    @vite(['resources/js/deleteTrack.js'])

    @vite(['resources/js/editProfileValidation.js'])
    @vite(['resources/js/editTrackValidation.js'])

    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

@include('duplicate/navigation')

<div class="block">
    <div class="profile-header">
        <button id="editButton" data-musician-name="{{ $musician->Musician_name}}" data-musician-description="{{ $musician->Musician_description }}" data-musician-login="{{ $listener->Login }}">Редактировать</button>
        <img src="storage/{{ $musician->Musician_icon }}" alt="{{ $musician->Musician_name }} Icon">
        <div>
            <h1>{{ $musician->Musician_name }}</h1>
            <p>О себе: {{ $musician->Musician_description }}</p>
            <p>Дата создания аккаунта: {{ $musician->created_at->format('d.m.Y') }}</p>
            <p>Количество треков: {{ $musician->tracks->count() }}</p>
            <p>Логин: {{ $listener->Login }}</p>
            <p>Общее число прослушиваний: {{ $totalListenings }}</p>
        </div>
    </div>
</div>

<div class="container">
    <br><br>
    <h2>Треки</h2>
    <div class="tracks-list">
        <div class="tracks">
            @forelse($musician->tracks as $track)
                <div class="track-item">
                    <img src="storage/{{ $track->Track_icon }}" alt="{{ $track->Track_name }} Icon">
                    <h3>{{ $track->Track_name }}</h3>
                    <p>Дата выхода: {{ $track->created_at->format('d.m.Y') }}</p>
                    <p>Жанр: {{ $track->genre->Genre_name }}</p>
                    <p>Прослушивания: {{ $track->countOfListenings }}</p>
                    <button id="trackEditButton" class="edit-track-btn" data-track-id="{{ $track->ID_tracks }}" data-track-name="{{ $track->Track_name }}" data-track-genre-id="{{ $track->genre->ID_genre }}">Редактировать</button>
                    <button id="deleteButton" class="delete-track-btn" data-track-id="{{ $track->ID_tracks }}" data-track-name="{{ $track->Track_name }}" data-track-icon="storage/{{ $track->Track_icon }}" data-track-release-date="{{ $track->created_at->format('d.m.Y') }}" data-track-genre="{{ $track->genre->Genre_name }}" data-track-listenings="{{ $track->countOfListenings }}">Удалить</button>
                </div>
            @empty
                <p>Треки отсутствуют</p>
            @endforelse
        </div>
    </div>
</div>


<div id="editModal" class="modal">
    <div class="modal-content">
        <i class="fa-solid fa-xmark close"></i>
        <form action="/musicianProfile/edit/" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="names" style="padding-top: 50px; padding-left: 50px;">Аватар</div>
            <div class="file-upload">
                <input type="file" id="musician_icon" name="musician_icon">
                <span id="upload-icon">
                    <i id="icon" class="fa-solid fa-image" style="color: #ffffff;"></i>
                    <span id="upload-text-icon"> Выберите или перетащите изображение</span>
                </span>
            </div>
            <br>
            <div class="form-group">
                <div class="names">Псевдоним:</div>
                <input type="text" id="musician_name" name="musician_name" value="{{ $musician->Musician_name }}">
                <div class="error" id="musician_name_error"></div>
            </div>

            <div class="form-group">
                <div class="names">Описание:</div>
                <textarea id="musician_description" name="musician_description">{{ $musician->Musician_description }}</textarea>
                <div class="error" id="description_error"></div>
            </div>

            <div class="form-group">
                <div class="listener_login">Логин:</div>
                <input type="text" id="listener_login" name="login" value="{{ $listener->Login }}">
                <div class="error" id="login_error"></div>
            </div>
            <div class="save">
                <button type="submit">Сохранить изменения</button>
            </div>
        </form>
    </div>
</div>

<div id="trackEditModal" class="modal">
    <div class="modal-content">
        <i class="fa-solid fa-xmark close"></i>
        <form id="editTrackForm" action="/musicianProfile/updateTrack/{track_id}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="track_id" name="track_id">
            <div class="names" style="padding-top: 50px; padding-left: 50px;">Обложка трека</div>

            <div class="file-upload">
                <input type="file" id="track_icon" name="track_icon">
                <span id="upload-icon">
                        <i id="icon" class="fa-solid fa-image" style="color: #ffffff;"></i>
                        <span id="upload-text-icon-track"> Выберите или перетащите изображение</span>
                </span>
            </div>

            <br>

            <div class="form-group">
                <div class="names">Псевдоним:</div>
                <input type="text" id="track_name" name="track_name">
                <div id="track_name_error" class="error"></div>
            </div>


            <div class="form-group">
                <div class="names">Жанр:</div>
                <select id="track_genre" name="track_genre">
                    @foreach (\App\Models\Genre::all() as $genre)
                        <option value="{{ $genre->ID_genre }}">{{ $genre->Genre_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="save">
                <button type="submit">Сохранить изменения</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <i class="fa-solid fa-xmark close"></i>
        <h2>Вы уверены, что хотите удалить этот трек?</h2>
        @if($musician->tracks->isNotEmpty())
            <form action="/musicianProfile/deleteTrack/{{ $track->ID_tracks }}" method="POST">
                @csrf
                @method('DELETE')
            <div class="track-item">
                <img src="" alt="Track Icon">
                <h3></h3>
                <p class="release-date"></p>
                <p class="genre"></p>
                <p class="listenings"></p>
            </div>
            <div class="centered">
                <button type="submit" id="confirmDelete">Удалить</button>
                <button id="cancelDelete">Отмена</button>
            </div>
            </form>
        @endif
    </div>
</div>


</body>
</html>
