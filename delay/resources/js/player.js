var tracks = Array.from(document.querySelectorAll('.track'));
var player = document.getElementById('player');
var currentTrackIndex = 0;
var playPauseButton = document.getElementById('playPause');
var nextButton = document.getElementById('next');
var prevButton = document.getElementById('prev');
var shuffle = false;
var shuffleIcon = document.getElementById('shuffleIcon');
var repeat = false;
var repeatIcon = document.getElementById('repeatIcon');
var audio = document.getElementById('player');
document.querySelector('.player').style.display = 'none';
var playedTracks = [];
var timeSlider = document.getElementById('timeSlider');
var currentTimeDisplay = document.getElementById('currentTimeDisplay');
var totalTimeDisplay = document.getElementById('totalTimeDisplay');
var volumeSlider = document.getElementById('volumeSlider');
var volumeIcon = document.getElementById('volumeIcon');

shuffleIcon.addEventListener('click', function() {
    shuffle = !shuffle;
    shuffleIcon.style.color = shuffle ? '#ffffff' : '#a3a3a3';
});
playPauseButton.addEventListener('click', togglePlayPause);
nextButton.addEventListener('click', nextTrack);
prevButton.addEventListener('click', prevTrack);
volumeSlider.addEventListener('input', function() {
    player.volume = volumeSlider.value;
    if (player.volume === 0) {
        volumeIcon.className = 'fa-solid fa-volume-xmark';
    } else if (player.volume < 0.5) {
        volumeIcon.className = 'fa-solid fa-volume-low';
    } else {
        volumeIcon.className = 'fa-solid fa-volume-high';
    }
});
timeSlider.addEventListener('input', function() {
    player.currentTime = timeSlider.value;
});
player.addEventListener('ended', nextTrack);
audio.addEventListener('timeupdate', function() {
    var percentage = audio.currentTime / audio.duration;
    var colorValue = Math.floor(percentage * 255);
    timeSlider.style.backgroundColor = 'rgb(' + colorValue + ', 0, ' + colorValue + ')';
});
timeSlider.addEventListener('input', function() {
    var value = (timeSlider.value - timeSlider.min) / (timeSlider.max - timeSlider.min);
    timeSlider.style.backgroundImage = 'linear-gradient(to right, rgb(' + Math.floor(value * 255) + ', 0, ' + Math.floor(value * 255) + ') 0%, #000 ' + value * 100 + '%, #000)';
});
audio.addEventListener('ended', function() {
    timeSlider.value = timeSlider.min;
    timeSlider.style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
});
repeatIcon.addEventListener('click', function() {
    repeat = !repeat;
    repeatIcon.style.color = repeat ? '#ffffff' : '#a3a3a3';
});
tracks.forEach(function (track, index) {
    track.addEventListener('click', function () {
        playTrack(index);
    });
});
player.addEventListener('loadedmetadata', function() {
    totalTimeDisplay.textContent = formatTime(player.duration);
    totalTimeDisplay.style.fontSize = '12px';
    totalTimeDisplay.style.fontFamily = 'Montserrat';
    totalTimeDisplay.style.color = 'white';
    totalTimeDisplay.style.fontWeight = 'normal';
});
player.addEventListener('timeupdate', function() {
    timeSlider.max = player.duration;
    timeSlider.value = player.currentTime;

    currentTimeDisplay.textContent = formatTime(player.currentTime);
    currentTimeDisplay.style.fontSize = '12px';
    currentTimeDisplay.style.fontFamily = 'Montserrat';
    currentTimeDisplay.style.color = 'white';
    currentTimeDisplay.style.fontWeight = 'normal';
});


async function playTrack(index) {
    if (currentTrackIndex !== null) {
        tracks[currentTrackIndex].style.background = "";
        tracks[currentTrackIndex].classList.remove('playing');
    }
    let trackUrl = tracks[index].querySelector('.track-source').textContent;
    let response = await fetch(trackUrl);
    let blob = await response.blob();
    player.src = URL.createObjectURL(blob);
    player.play();
    timeSlider.style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
    tracks[index].style.background = "linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('back2.gif') no-repeat center center fixed";
    tracks[index].style.backgroundSize = "cover";
    tracks[index].classList.add('playing');
    currentTrackIndex = index;

    playPauseButton.innerHTML = '<i class="fa-solid fa-pause"></i>';

    let trackIcon = tracks[index].querySelector('img').src;
    let trackName = tracks[index].querySelector('.trackName').textContent;
    let trackMusician = tracks[index].querySelector('.trackMusician').textContent;

    document.querySelector('.player .track-icon').src = trackIcon;
    document.querySelector('.player .track-name').textContent = trackName;
    document.querySelector('.player .track-musician').textContent = trackMusician;
    document.querySelector('.player').style.display = 'flex';
}
function nextTrack() {
    if (!repeat) {
        var index;
        if (shuffle) {
            if (playedTracks.length === tracks.length) { // если все треки были воспроизведены
                playedTracks = [];
            }
            do {
                index = Math.floor(Math.random() * tracks.length);
            } while (playedTracks.includes(index));
            playedTracks.push(index);
        } else {
            index = (currentTrackIndex + 1) % tracks.length;
        }
        playTrack(index);
    } else {
        playTrack(currentTrackIndex);
    }
    timeSlider.value = timeSlider.min;
    timeSlider.style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
}
function prevTrack() {
    var index = (currentTrackIndex - 1 + tracks.length) % tracks.length;
    timeSlider.value = timeSlider.min;
    timeSlider.style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
    playTrack(index);
}
function togglePlayPause() {
    if (player.paused) {
        tracks[currentTrackIndex].style.background = "url('back2.gif') no-repeat center center fixed";
        tracks[currentTrackIndex].style.backgroundSize = "cover";
        player.play();
        playPauseButton.innerHTML = '<i class="fa-solid fa-pause"></i>';
    } else {
        player.pause();
        tracks[currentTrackIndex].style.background = "url('back3.gif') no-repeat center center fixed";
        tracks[currentTrackIndex].style.backgroundSize = "cover";
        playPauseButton.innerHTML = '<i class="fa-solid fa-play"></i>';
    }
}
function formatTime(time) {
    var minutes = Math.floor(time / 60);
    var seconds = Math.floor(time % 60);
    return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
}



