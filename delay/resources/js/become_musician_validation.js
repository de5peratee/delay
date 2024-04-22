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
            uploadTextIcon.textContent = 'Аватар загружен';
            iconElement.className = 'fa-solid fa-check';
            fileUploadElement.style.borderColor = 'green';
        }
    }
});

document.getElementById('musician_name').addEventListener('input', function() {
    var trackName = this.value;
    var trackNameLength = trackName.length;
    var errorMessage = document.getElementById('musician_name_error');
    if (trackNameLength === 0) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Псевдоним обязателен';
    } else if (trackNameLength > 255) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Псевдоним не должен превышать 255 символов';
    } else {
        this.style.borderColor = 'green';
        errorMessage.textContent = '';
    }
});

document.getElementById('musician_description').addEventListener('input', function() {
    var description = this.value;
    var descriptionLength = description.length;
    var errorMessage = document.getElementById('description_error');
    if (descriptionLength === 0) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Описание обязательно';
    } else if (descriptionLength > 255) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Описание не должно превышать 255 символов';
    } else {
        this.style.borderColor = 'green';
        errorMessage.textContent = '';
    }
});


document.querySelector('.reset-btn').addEventListener('click', function() {
    // Сброс цвета рамки и текста сообщений об ошибках
    var fileUploadElements = document.querySelectorAll('.file-upload');
    fileUploadElements.forEach(function(element) {
        element.style.borderColor = '';
    });

    var errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(function(element) {
        element.textContent = '';
    });

    // Сброс иконок и текста загрузки
    var uploadTexts = document.querySelectorAll('[id^="upload-text-"]');
    uploadTexts.forEach(function(element) {
        if (element.id.includes('icon')) {
            element.textContent = 'Выберите или перетащите изображение (.png)';
        } else if (element.id.includes('track')) {
            element.textContent = 'Выберите или перетащите ваш трек (.wav)';
        }
    });

    var icons = document.querySelectorAll('[id^="icon"]');
    icons.forEach(function(element) {
        if (element.id.includes('icon')) {
            element.className = 'fa-solid fa-image';
        } else if (element.id.includes('track')) {
            element.className = 'fa-solid fa-compact-disc';
        }
    });

    // Сброс цвета рамки полей ввода
    var inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(function(input) {
        input.style.borderColor = 'white';
    });
});

