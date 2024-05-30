<form method="POST" action="/musician/add_music_album" enctype="multipart/form-data">
    @csrf
    <div class="input-box">
        <div class="title-box">
            Альбом
        </div>

        <div class="description-box">
            <span title="Название альбома, который вы выпускаете">Название альбома*</span>
        </div>

        <input type="text" id="album_track" name="album_track" placeholder=" Введите название альбома" required>
        <div class="error" id="album_error"></div>

        <div class="description-box">
            <span title="Поле для загрузки вашей обложки альбома ">Загрузите обложку альбома*</span>
        </div>
        <div class="file-upload-album">
            <input id="image-upload" type="file" name="Track_icon">
            <span id="upload-icon">
                    <i id="icon" class="fa-solid fa-image" style="color: #ffffff;"></i>
                    <span id="upload-text-track">Выберите или перетащите изображение(.png)</span>
                </span>
        </div>
    </div>

<br>

<div id="track-container">
    <br>
</div>

<button id="add-track-btn" class="add-btn" type="button">
    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
    Добавить трек
</button>


<script>
    window.genres = @json(\App\Models\Genre::all());
</script>

<br>

<div class="button-container">
    <input id="submit-btn" type="submit" value="Загрузить" class="submit-btn">
    <input type="reset" value="Очистить форму" class="reset-btn">
</div>
</form>
@vite(['resources/js/add_track_block.js'])
