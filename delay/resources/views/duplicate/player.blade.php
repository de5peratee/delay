<div class="player">
    <audio id="player" controls style="display: none;"></audio>
    <button class="player-button" id="prev"><i class="fa-solid fa-backward-step"></i></button>
    <button class="player-button" id="playPause"><i class="fa-solid fa-pause"></i></button>
    <button class="player-button" id="next"><i class="fa-solid fa-forward-step"></i></button>
    <div class="track-info-player">
        <img class="track-icon" src="" alt="Track icon">
        <div>
            <div class="track-name"></div>
            <div class="track-musician"></div>
        </div>
    </div>
    <input id="timeSlider" type="range" min="0" step="1" value="0">
    <div class="time-display">
        <span id="currentTimeDisplay" style="font-size: 12px; width: 15px"></span>
        <span>/</span>
        <span id="totalTimeDisplay" style="font-size: 12px; margin-left: 5px; width: 10px; padding-right: 40px;"></span>
    </div>
    <i id="volumeIcon" class="fa-solid fa-volume-high"></i>
    <input id="volumeSlider" type="range" min="0" max="1" step="0.01" value="1">
    <i id="shuffleIcon" class="fa-solid fa-shuffle"></i>
    <i id="repeatIcon" class="fa-solid fa-repeat"></i>
</div>
