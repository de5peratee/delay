document.getElementById('image-upload').addEventListener('change', function() {
    var file = this.files[0];
    var uploadTextIcon = document.getElementById('upload-text-icon');
    var iconElement = document.getElementById('icon');
    var fileUploadElement = this.parentNode;
    if (file) {
        if (file.type !== 'image/png') {
            uploadTextIcon.textContent = 'Файл должен быть в формате .png';
            iconElement.className = 'fa-solid fa-times';
            fileUploadElement.style.borderColor = 'red';
            this.value = '';
        } else {
            var img = new Image();
            img.onload = function() {
                if (img.width !== 3000 || img.height !== 3000) {
                    uploadTextIcon.textContent = 'Изображение должно быть размером ровно 3000x3000 пикселей';
                    iconElement.className = 'fa-solid fa-times';
                    fileUploadElement.style.borderColor = 'red';
                    this.value = '';
                } else {
                    uploadTextIcon.textContent = 'Изображение загружено';
                    iconElement.className = 'fa-solid fa-check';
                    fileUploadElement.style.borderColor = 'green';
                }
            }.bind(this);
            img.src = URL.createObjectURL(file);
        }
    }
});

document.getElementById('track-upload').addEventListener('change', function() {
    var file = this.files[0];
    var uploadTextTrack = document.getElementById('upload-text-track');
    var trackIconElement = document.getElementById('track');
    var fileUploadElement = this.parentNode; // получение родительского элемента поля ввода
    if (file) {
        if (file.type !== 'audio/wav') {
            uploadTextTrack.textContent = 'Файл должен быть в формате .wav';
            trackIconElement.className = 'fa-solid fa-times';
            fileUploadElement.style.borderColor = 'red';
            this.value = '';
        } else {
            var reader = new FileReader();
            reader.onloadend = function(e) {
                var audioContext = new (window.AudioContext || window.webkitAudioContext)();
                audioContext.decodeAudioData(e.target.result, function(buffer) {
                    var duration = buffer.duration;
                    if (duration > 600) {
                        uploadTextTrack.textContent = 'Длительность трека не должна превышать 10 минут';
                        trackIconElement.className = 'fa-solid fa-times';
                        fileUploadElement.style.borderColor = 'red';
                        this.value = '';
                    } else {
                        uploadTextTrack.textContent = 'Трек загружен';
                        trackIconElement.className = 'fa-solid fa-check';
                        fileUploadElement.style.borderColor = 'green';
                    }
                }.bind(this));
            }.bind(this);
            reader.readAsArrayBuffer(file);
        }
    }
});


document.getElementById('track_name').addEventListener('input', function() {
    var trackName = this.value;
    var trackNameLength = trackName.length;
    var errorMessage = document.getElementById('track_name_error');
    if (trackNameLength === 0) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Введите название релиза';
    } else if (trackNameLength > 255) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Название релиза не должно превышать 255 символов';
    } else {
        this.style.borderColor = 'green';
        errorMessage.textContent = '';
    }
});

var modal = document.getElementById("myModal");
var modalText = modal.querySelector("p");
var modalIcon = modal.querySelector("i");
var form = document.querySelector("form");
var hamburgerMenu = document.querySelector(".hamburger-menu");

form.onsubmit = function(event) {
    event.preventDefault();

    var coverUpload = document.getElementById('image-upload');
    var audioUpload = document.getElementById('track-upload');
    var trackName = document.getElementById('track_name');

    if (coverUpload.files.length === 0 || audioUpload.files.length === 0 || trackName.value.trim() === '') {
        if (coverUpload.files.length === 0) {
            coverUpload.parentNode.style.borderColor = 'red';
        }
        if (audioUpload.files.length === 0) {
            audioUpload.parentNode.style.borderColor = 'red';
        }
        if (trackName.value.trim() === '') {
            trackName.style.borderColor = 'red';
        }
    } else {
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);


        modal.style.display = "block";
        hamburgerMenu.style.display = "none";
        modalText.textContent = 'Загрузка трека...';

        xhr.onload = function() {
            if (this.status === 200) {
                var response = JSON.parse(this.response);
                if (response.message === 'Трек успешно загружен') {
                    modalText.textContent = 'Трек успешно загружен!';
                    modalIcon.className = 'fa-solid fa-check fa-bounce';
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        };

        xhr.send(formData);
    }
}








