// document.addEventListener('DOMContentLoaded', function () {
//     var tracks = Array.from(document.querySelectorAll('.track'));
//     var player = document.getElementById('player');
//     var currentTrackIndex = null;
//
//     tracks.forEach(function (track, index) {
//         track.setAttribute('data-index', index); // добавляем атрибут data-index к каждому треку
//
//         track.addEventListener('click', function () {
//             var trackIndex = parseInt(track.getAttribute('data-index')); // получаем индекс трека из атрибута data-index
//             if (trackIndex === currentTrackIndex) {
//                 if (player.paused) {
//                     player.play();
//                     track.classList.add('playing');
//                 } else {
//                     player.pause();
//                     track.classList.remove('playing');
//                 }
//             } else {
//                 if (currentTrackIndex !== null) {
//                     tracks[currentTrackIndex].classList.remove('playing');
//                 }
//                 player.src = track.querySelector('.track-source').textContent;
//                 player.play();
//                 track.classList.add('playing');
//                 currentTrackIndex = trackIndex;
//             }
//         });
//     });
// });
//
//
//
//
//
