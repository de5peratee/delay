document.getElementById('track_icon').addEventListener('change', function() {
    var file = this.files[0];
    var uploadTextIcon = document.getElementById('upload-text-icon-track');
    var iconElement = document.getElementById('track_icon');
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
