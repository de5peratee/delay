<form method="POST" action="/musician/add_music" enctype="multipart/form-data">
    @csrf
    <div class="input-box">
        <div class="title-box">
            Трек
        </div>
        <div class="description-box">
            <span title="Поле для загрузки вашего трека">Трек*</span>
        </div>

        <div class="file-upload">
            <input id="track-upload" type="file" name="Track_url">
            <span id="upload-icon">
                    <i id="track" class="fa-solid fa-file-audio" style="color: #ffffff;"></i>
                    <span id="upload-text-track">Выберите или перетащите ваш трек (.wav)</span>
                </span>
        </div>
    </div>
    <br>

    <div class="input-box">
        <div class="title-box">
            Информация о треке
        </div>

        <div class="description-box">
            <span title="Название трека, который вы выпускаете">Название трека*</span>
        </div>

        <input type="text" id="track_name" name="track_name" placeholder=" Введите название трека" required>
        <div class="error" id="track_name_error"></div>


        <div class="description-box">
            <span title="Выберите жанр вашего трека">Жанр*</span>
        </div>
        <select id="genre" name="genre" required>
            <option value="" selected disabled>Выберите жанр</option>
            @foreach (\App\Models\Genre::all() as $genre)
                <option value="{{ $genre->ID_genre }}">{{ $genre->Genre_name }}</option>
            @endforeach
        </select>

        <div class="error" id="genre_error"></div>
    </div>
    <br>

    <div class="input-box">
        <div class="title-box">
            Обложка
        </div>
        <div class="description-box">
            <span title="Обложка должна быть .png формата и размером 2000x2000 пикселей">Загрузите обложку*</span>
        </div>

        <div class="file-upload">
            <input id="image-upload" type="file" name="Track_icon">
            <span id="upload-icon">
                    <i id="icon" class="fa-solid fa-image" style="color: #ffffff;"></i>
                    <span id="upload-text-icon">Выберите или перетащите изображение (.png)</span>
                </span>
        </div>
    </div>

    <br>
    @vite(['resources/js/add_music_validation.js'])

    <div class="button-container">
        <input id="submit-btn" type="submit" value="Загрузить" class="submit-btn">
        <input type="reset" value="Очистить форму" class="reset-btn">
    </div>
</form>
