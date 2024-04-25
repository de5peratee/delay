var tracks = Array.from(document.querySelectorAll('.track'));
var player = document.getElementById('player');
var currentTrackIndex = 0;
var isShuffle = false;
var repeatMode = 0; // 0 - no repeat, 1 - repeat all, 2 - repeat one

document.getElementById('playPause').addEventListener('click', function () {
    if (player.paused) {
        player.play();
    } else {
        player.pause();
    }
});

document.getElementById('next').addEventListener('click', function () {
    nextTrack();
});

document.getElementById('prev').addEventListener('click', function () {
    prevTrack();
});

document.getElementById('shuffle').addEventListener('click', function () {
    isShuffle = !isShuffle;
    this.textContent = isShuffle ? 'Unshuffle' : 'Shuffle';
});

document.getElementById('repeat').addEventListener('click', function () {
    repeatMode = (repeatMode + 1) % 3;
    var modes = ['No Repeat', 'Repeat All', 'Repeat One'];
    this.textContent = modes[repeatMode];
});

player.addEventListener('ended', function () {
    if (repeatMode === 2) { // repeat one
        playTrack(currentTrackIndex);
    } else if (repeatMode === 1 || !isShuffle) { // repeat all or no shuffle
        nextTrack();
    } else { // shuffle
        playTrack(Math.floor(Math.random() * tracks.length));
    }
});

tracks.forEach(function (track, index) {
    track.addEventListener('click', function () {
        playTrack(index);
    });
});

function playTrack(index) {
    if (currentTrackIndex !== null) {
        tracks[currentTrackIndex].style.background = "";
        tracks[currentTrackIndex].classList.remove('playing');
    }

    var mediaSource = new MediaSource();
    player.src = URL.createObjectURL(mediaSource);

    mediaSource.addEventListener('sourceopen', function() {
        var sourceBuffer = mediaSource.addSourceBuffer('audio/mpeg');
        var trackUrl = tracks[index].querySelector('.track-source').textContent;
        var queue = [];

        function processQueue() {
            if (queue.length && !sourceBuffer.updating) {
                sourceBuffer.appendBuffer(queue.shift());
            }
        }

        sourceBuffer.addEventListener('updateend', processQueue);

        fetch(trackUrl).then(function(response) {
            var reader = response.body.getReader();
            function pushData() {
                return reader.read().then(function({done, value}) {
                    if (done) {
                        mediaSource.endOfStream();
                        return;
                    }
                    queue.push(value);
                    processQueue();
                    return pushData();
                });
            }
            return pushData();
        }).then(function() {
            player.play();
        });
    });



    tracks[index].style.background = "linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('back2.gif') no-repeat center center fixed";
    tracks[index].style.backgroundSize = "cover";
    tracks[index].classList.add('playing');
    currentTrackIndex = index;
}



function nextTrack() {
    var index = (currentTrackIndex + 1) % tracks.length;
    playTrack(index);
}

function prevTrack() {
    var index = (currentTrackIndex - 1 + tracks.length) % tracks.length;
    playTrack(index);
}

var progressBar = document.getElementById('progressBar');

player.addEventListener('loadedmetadata', function () {
    progressBar.max = player.duration;
});

player.addEventListener('timeupdate', function () {
    progressBar.value = player.currentTime;
});

progressBar.addEventListener('change', function () {
    player.currentTime = progressBar.value;
});

player.addEventListener('canplaythrough', function () {
    progressBar.max = player.duration;
    progressBar.value = player.currentTime;
});

