// if (typeof trackCount === 'undefined') {
//     window.trackCount = 1;
// }
// $(document).on('input', '#album_track', function() {
//     var trackName = this.value;
//     var trackNameLength = trackName.length;
//     var errorMessage = document.getElementById('album_error');
//     if (trackNameLength === 0) {
//         this.style.borderColor = 'red';
//         errorMessage.textContent = 'Введите название альбома';
//     } else if (trackNameLength > 255) {
//         this.style.borderColor = 'red';
//         errorMessage.textContent = 'Название альбома не должно превышать 255 символов';
//     } else {
//         this.style.borderColor = 'green';
//         errorMessage.textContent = '';
//     }
// });
//
// $(document).on('change', '#image-upload', function() {
//     var file = this.files[0];
//     var uploadTextIcon = document.getElementById('upload-text-track');
//     var iconElement = document.getElementById('icon');
//     var fileUploadElement = this.parentNode;
//     if (file) {
//         if (file.type !== 'image/png') {
//             uploadTextIcon.textContent = 'Файл должен быть в формате .png';
//             iconElement.className = 'fa-solid fa-times';
//             fileUploadElement.style.borderColor = 'red';
//             this.value = '';
//         } else {
//             var img = new Image();
//             img.onload = function() {
//                 if (img.width !== 3000 || img.height !== 3000) {
//                     uploadTextIcon.textContent = 'Изображение должно быть размером ровно 3000x3000 пикселей';
//                     iconElement.className = 'fa-solid fa-times';
//                     fileUploadElement.style.borderColor = 'red';
//                     this.value = '';
//                 } else {
//                     uploadTextIcon.textContent = 'Изображение загружено';
//                     iconElement.className = 'fa-solid fa-check';
//                     fileUploadElement.style.borderColor = 'green';
//                 }
//             }.bind(this);
//             img.src = URL.createObjectURL(file);
//         }
//     }
// });
//
// $(document).ready(function() {
//     var currentType = null;
//     var trackCount = 0;
//
//     $(document).on('click', '.types', function() {
//         var id = $(this).find('.typesName').attr('id');
//         if (id !== currentType) {
//             currentType = id;
//             $.ajax({
//                 url: '/musician/' + id,
//                 type: 'get',
//                 success: function(response) {
//                     $('#content').html(response);
//                     document.getElementById('content').scrollIntoView({behavior: "smooth"});
//                 }
//             });
//         }
//     });
//
//     $(document).on('click', '#add-track-btn', function() {
//         var trackContainer = document.getElementById('track-container');
//         var newTrackBox = document.createElement('div');
//         newTrackBox.className = 'input-box';
//         newTrackBox.innerHTML = `
//         <div class="title-box">
//             Трек
//         <button class="delete-track-btn"><i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff;"></i></button>
//         </div>
//         <div class="description-box">
//             <span title="Поле для загрузки вашего релиза">Трек*</span>
//         </div>
//
//         <div class="file-upload-album">
//             <input id="track-upload-${trackCount}" type="file" name="Track_url">
//             <span id="upload-icon">
//                     <i id="track" class="fa-solid fa-file-audio" style="color: #ffffff;"></i>
//                     <span id="upload-text-track">Выберите или перетащите ваш трек (.wav)</span>
//                 </span>
//         </div>
//
//         <div class="description-box">
//             <span title="Название трека, который вы выпускаете">Название трека*</span>
//         </div>
//
//         <input type="text" id="track_name-${trackCount}" name="track_name" placeholder=" Введите название релиза" required>
//         <div class="error" id="track_name_error"></div>
//
//         <div class="description-box">
//             <span title="Выберите жанр вашего релиза">Жанр*</span>
//         </div>
//         <select id="genre-${trackCount}" name="genre" required>
//             <option value="" selected disabled>Выберите жанр</option>
//             ${window.genres.map(genre => `<option value="${genre.ID_genre}">${genre.Genre_name}</option>`).join('')}
//         </select>
//         <div class="error" id="genre_error"></div>
//         <br>
//         `;
//
//         $(newTrackBox).on('click', '.delete-track-btn', function() {
//             trackContainer.removeChild(newTrackBox);
//             trackContainer.removeChild(br);
//             updateTrackNumbers();
//         });
//
//         var newTrackUpload = newTrackBox.querySelector('#track-upload-' + trackCount);
//         var newTrackName = newTrackBox.querySelector('#track_name-' + trackCount);
//
//         $(newTrackUpload).on('change', function() {
//             var file = this.files[0];
//             var uploadTextTrack = this.parentNode.querySelector('#upload-text-track');
//             var trackIconElement = this.parentNode.querySelector('#track');
//             if (file) {
//                 if (file.type !== 'audio/wav') {
//                     uploadTextTrack.textContent = 'Файл должен быть в формате .wav';
//                     trackIconElement.className = 'fa-solid fa-times';
//                     this.parentNode.style.borderColor = 'red';
//                     this.value = '';
//                 } else {
//                     var reader = new FileReader();
//                     reader.onloadend = function(e) {
//                         var audioContext = new (window.AudioContext || window.webkitAudioContext)();
//                         audioContext.decodeAudioData(e.target.result, function(buffer) {
//                             var duration = buffer.duration;
//                             if (duration > 600) {
//                                 uploadTextTrack.textContent = 'Длительность трека не должна превышать 10 минут';
//                                 trackIconElement.className = 'fa-solid fa-times';
//                                 this.parentNode.style.borderColor = 'red';
//                                 this.value = '';
//                             } else {
//                                 uploadTextTrack.textContent = 'Трек загружен';
//                                 trackIconElement.className = 'fa-solid fa-check';
//                                 this.parentNode.style.borderColor = 'green';
//                             }
//                         }.bind(this));
//                     }.bind(this);
//                     reader.readAsArrayBuffer(file);
//                 }
//             }
//         });
//
//         $(newTrackName).on('input', function() {
//             var trackName = this.value;
//             var trackNameLength = trackName.length;
//             var errorMessage = this.parentNode.querySelector('#track_name_error');
//             if (trackNameLength === 0) {
//                 this.style.borderColor = 'red';
//                 errorMessage.textContent = 'Введите название релиза';
//             } else if (trackNameLength > 255) {
//                 this.style.borderColor = 'red';
//                 errorMessage.textContent = 'Название релиза не должно превышать 255 символов';
//             } else {
//                 this.style.borderColor = 'green';
//                 errorMessage.textContent = '';
//             }
//         });
//
//         trackContainer.appendChild(newTrackBox);
//         var br = document.createElement('br');
//         trackContainer.appendChild(br);
//         trackCount++;
//     });
// });
//
//
// function updateTrackNumbers() {
//     var trackBoxes = document.querySelectorAll('.input-box');
//     for (var i = 0; i < trackBoxes.length; i++) {
//         var trackNumberElement = trackBoxes[i].querySelector('.track-number');
//         if (trackNumberElement !== null) {
//             // Обновляем номера треков, начиная с 1
//             trackNumberElement.textContent = i + 1;
//         }
//     }
// }
//
// //ОТПРАВКА ФОРМЫ
// var form = document.querySelector('form');
// var modal = document.getElementById("myModal");
// var modalText = modal.querySelector("p");
// var modalIcon = modal.querySelector("i");
// var hamburgerMenu = document.querySelector(".hamburger-menu");
// $(document).on('submit', 'form', function(event) {
//     event.preventDefault();
//
//     var coverUpload = document.getElementById('image-upload');
//     var trackUploads = document.querySelectorAll('.track-upload');
//     var trackNames = document.querySelectorAll('.track-name');
//
//     var hasError = false;
//
//     if (coverUpload.files.length === 0) {
//         coverUpload.parentNode.style.borderColor = 'red';
//         hasError = true;
//     }
//
//     var tracks = [];
//     trackUploads.forEach(function(trackUpload, index) {
//         if (trackUpload.files.length === 0 || trackNames[index].value.trim() === '') {
//             trackUpload.parentNode.style.borderColor = 'red';
//             hasError = true;
//         } else {
//             tracks.push({
//                 'Track_url': trackUpload.files[0],
//                 'track_name': trackNames[index].value.trim()
//             });
//         }
//     });
//
//     if (hasError) {
//         return;
//     }
//
//     var formData = new FormData(form);
//     tracks.forEach(function(track, index) {
//         formData.append('tracks['+index+'][Track_url]', track.Track_url);
//         formData.append('tracks['+index+'][track_name]', track.track_name);
//     });
//
//     fetch(form.action, {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => response.json())
//         .then(data => {
//             if (data.message === 'Альбом и треки успешно добавлены!') {
//                 modalText.textContent = 'Альбом и треки успешно добавлены!';
//                 modalIcon.className = 'fa-solid fa-check fa-bounce';
//                 setTimeout(function() {
//                     location.reload();
//                 }, 500);
//             }
//         })
//         .catch((error) => {
//             console.error('Ошибка при загрузке: ', error);
//         });
// });
//
