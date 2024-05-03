const selectors = {
    tracks: '.track',
    player: '#player',
    playPauseButton: '#playPause',
    nextButton: '#next',
    prevButton: '#prev',
    shuffleIcon: '#shuffleIcon',
    repeatIcon: '#repeatIcon',
    timeSlider: '#timeSlider',
    currentTimeDisplay: '#currentTimeDisplay',
    totalTimeDisplay: '#totalTimeDisplay',
    volumeSlider: '#volumeSlider',
    volumeIcon: '#volumeIcon'
};

let state = {
    tracks: Array.from(document.querySelectorAll(selectors.tracks)),
    player: document.querySelector(selectors.player),
    currentTrackIndex: 0,
    shuffle: false,
    repeat: false,
    shuffleOrder: [],
    currentShuffleIndex: 0,
    playedTracks: []
};

function formatTime(time) {
    let minutes = Math.floor(time / 60);
    let seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

async function playTrack(index) {
    state.tracks[state.currentTrackIndex].style.background = "";
    if (state.currentTrackIndex !== null) {
        state.tracks[state.currentTrackIndex].classList.remove('playing');
    }
    let trackUrl = state.tracks[index].querySelector('.track-source').textContent;
    let response = await fetch(trackUrl);
    let blob = await response.blob();
    state.player.src = URL.createObjectURL(blob);
    await state.player.play();
    state.tracks[index].style.background = "linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/back2.gif') no-repeat center center fixed";
    state.tracks[index].style.backgroundSize = "cover";
    state.tracks[index].classList.add('playing');
    state.currentTrackIndex = index;

    document.querySelector(selectors.playPauseButton).innerHTML = '<i class="fa-solid fa-pause"></i>';

    let trackIcon = state.tracks[index].querySelector('img').src;
    let trackName = state.tracks[index].querySelector('.trackName').textContent;
    let trackMusician = state.tracks[index].querySelector('.trackMusician').textContent;

    document.querySelector('.player .track-icon').src = trackIcon;
    document.querySelector('.player .track-name').textContent = trackName;
    document.querySelector('.player .track-musician').textContent = trackMusician;
    document.querySelector('.player').style.display = 'flex';

    let trackId = state.tracks[index].querySelector('.track-id').textContent;
    response = await fetch('/increase-listenings/' + trackId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    if (response.ok) {
        console.log('Счетчик прослушиваний увеличен');
    } else {
        console.error('Ошибка при увеличении счетчика прослушиваний');
    }
}

function nextTrack() {
    state.tracks[state.currentTrackIndex].style.background = "";
    document.querySelector(selectors.timeSlider).value = document.querySelector(selectors.timeSlider).min;
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
    if (!state.repeat) {
        var index;
        if (state.shuffle) {
            if (state.currentShuffleIndex === state.shuffleOrder.length - 1) {
                state.currentShuffleIndex = 0;
            } else {
                state.currentShuffleIndex++;
            }
            index = state.shuffleOrder[state.currentShuffleIndex];
        } else {
            index = (state.currentTrackIndex + 1) % state.tracks.length;
        }
        state.tracks[state.currentTrackIndex].style.background = "";
        playTrack(index);
    } else {
        state.tracks[state.currentTrackIndex].style.background = "";
        playTrack(state.currentTrackIndex);
    }
}

function prevTrack() {
    state.tracks[state.currentTrackIndex].style.background = "";
    document.querySelector(selectors.timeSlider).value = document.querySelector(selectors.timeSlider).min;
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
    var index;
    if (state.shuffle) {
        state.tracks[state.currentTrackIndex].style.background = "";
        if (state.currentShuffleIndex === 0) {
            state.currentShuffleIndex = state.shuffleOrder.length - 1;
        } else {
            state.currentShuffleIndex--;
        }
        index = state.shuffleOrder[state.currentShuffleIndex];
    } else {
        index = (state.currentTrackIndex - 1 + state.tracks.length) % state.tracks.length;
    }
    state.tracks[state.currentTrackIndex].style.background = "";
    playTrack(index);
}

function togglePlayPause() {
    if (state.player.paused) {
        state.tracks[state.currentTrackIndex].style.background = "url('/back2.gif') no-repeat center center fixed";
        state.tracks[state.currentTrackIndex].style.backgroundSize = "cover";
        state.player.play();
        document.querySelector(selectors.playPauseButton).innerHTML = '<i class="fa-solid fa-pause"></i>';
    } else {
        state.player.pause();
        state.tracks[state.currentTrackIndex].style.background = "url('/back3.gif') no-repeat center center fixed";
        state.tracks[state.currentTrackIndex].style.backgroundSize = "cover";
        document.querySelector(selectors.playPauseButton).innerHTML = '<i class="fa-solid fa-play"></i>';
    }
}

document.querySelector(selectors.shuffleIcon).addEventListener('click', function() {
    state.shuffle = !state.shuffle;
    document.querySelector(selectors.shuffleIcon).style.color = state.shuffle ? '#ffffff' : '#a3a3a3';
    if (state.shuffle) {
        for (let i = 0; i < state.tracks.length; i++) {
            state.shuffleOrder[i] = i;
        }
        state.shuffleOrder.sort(() => Math.random() - 0.5);
        state.currentShuffleIndex = state.shuffleOrder.indexOf(state.currentTrackIndex);
    }
});

document.querySelector(selectors.playPauseButton).addEventListener('click', togglePlayPause);
document.querySelector(selectors.nextButton).addEventListener('click', nextTrack);
document.querySelector(selectors.prevButton).addEventListener('click', prevTrack);

document.querySelector(selectors.volumeSlider).addEventListener('input', function() {
    state.player.volume = document.querySelector(selectors.volumeSlider).value;
    if (state.player.volume === 0) {
        document.querySelector(selectors.volumeIcon).className = 'fa-solid fa-volume-xmark';
    } else if (state.player.volume < 0.5) {
        document.querySelector(selectors.volumeIcon).className = 'fa-solid fa-volume-low';
    } else {
        document.querySelector(selectors.volumeIcon).className = 'fa-solid fa-volume-high';
    }
});

document.querySelector(selectors.timeSlider).addEventListener('input', function() {
    state.player.currentTime = document.querySelector(selectors.timeSlider).value;
});

state.player.addEventListener('ended', nextTrack);

state.player.addEventListener('timeupdate', function() {
    var percentage = state.player.currentTime / state.player.duration;
    var colorValue = Math.floor(percentage * 255);
    document.querySelector(selectors.timeSlider).style.backgroundColor = 'rgb(' + colorValue + ', 0, ' + colorValue + ')';
    var value = (document.querySelector(selectors.timeSlider).value - document.querySelector(selectors.timeSlider).min) / (document.querySelector(selectors.timeSlider).max - document.querySelector(selectors.timeSlider).min);
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, rgb(' + Math.floor(value * 255) + ', 0, ' + Math.floor(value * 255) + ') 0%, #000 ' + value * 100 + '%, #000)';
});

document.querySelector(selectors.timeSlider).addEventListener('input', function() {
    var value = (document.querySelector(selectors.timeSlider).value - document.querySelector(selectors.timeSlider).min) / (document.querySelector(selectors.timeSlider).max - document.querySelector(selectors.timeSlider).min);
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, rgb(' + Math.floor(value * 255) + ', 0, ' + Math.floor(value * 255) + ') 0%, #000 ' + value * 100 + '%, #000)';
});

state.player.addEventListener('ended', function() {
    document.querySelector(selectors.timeSlider).value = document.querySelector(selectors.timeSlider).min;
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, #000 0%, #000 100%, #000)';
    document.querySelector(selectors.timeSlider).style.backgroundImage = 'linear-gradient(to right, rgb(' + Math.floor(value * 255) + ', 0, ' + Math.floor(value * 255) + ') 0%, #000 ' + value * 100 + '%, #000)';
});

document.querySelector(selectors.repeatIcon).addEventListener('click', function() {
    state.repeat = !state.repeat;
    document.querySelector(selectors.repeatIcon).style.color = state.repeat ? '#ffffff' : '#a3a3a3';
});

document.querySelector('.scroll-menu').addEventListener('click', function(e) {
    if (e.target.closest('.track')) {
        var index = Array.from(document.querySelectorAll('.track')).indexOf(e.target.closest('.track'));
        playTrack(index);
    }
});

state.player.addEventListener('loadedmetadata', function() {
    document.querySelector(selectors.totalTimeDisplay).textContent = formatTime(state.player.duration);
    document.querySelector(selectors.totalTimeDisplay).style.fontSize = '12px';
    document.querySelector(selectors.totalTimeDisplay).style.fontFamily = 'Montserrat';
    document.querySelector(selectors.totalTimeDisplay).style.color = 'white';
    document.querySelector(selectors.totalTimeDisplay).style.fontWeight = 'normal';
});

state.player.addEventListener('timeupdate', function() {
    document.querySelector(selectors.timeSlider).max = state.player.duration;
    document.querySelector(selectors.timeSlider).value = state.player.currentTime;
    document.querySelector(selectors.currentTimeDisplay).textContent = formatTime(state.player.currentTime);
    document.querySelector(selectors.currentTimeDisplay).style.fontSize = '12px';
    document.querySelector(selectors.currentTimeDisplay).style.fontFamily = 'Montserrat';
    document.querySelector(selectors.currentTimeDisplay).style.color = 'white';
    document.querySelector(selectors.currentTimeDisplay).style.fontWeight = 'normal';
});

