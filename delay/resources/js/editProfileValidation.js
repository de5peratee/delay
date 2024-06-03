document.getElementById('musician_icon').addEventListener('change', function() {
    var file = this.files[0];
    var uploadTextIcon = document.getElementById('upload-text-icon');
    var iconElement = document.getElementById('icon');
    var fileUploadElement = this.parentNode;
    if (file) {
        if (file.type !== 'image/png') {
            uploadTextIcon.textContent = ' Файл должен быть в формате .png';
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

document.getElementById('listener_login').addEventListener('input', function() {
    var login = this.value;
    var loginLength = login.length;
    var errorMessage = document.getElementById('login_error');
    if (loginLength === 0) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Логин обязателен';
    } else if (loginLength > 255) {
        this.style.borderColor = 'red';
        errorMessage.textContent = 'Логин не должен превышать 255 символов';
    } else {
        this.style.borderColor = 'green';
        errorMessage.textContent = '';
    }
});

document.querySelector('form').addEventListener('submit', function(event) {
    var isValid = true;
    var file = document.getElementById('musician_icon').files[0];
    var trackName = document.getElementById('musician_name').value;
    var description = document.getElementById('musician_description').value;
    var login = document.getElementById('listener_login').value;
    var errorMessage = document.getElementById('submit_error');

    if (file && file.type !== 'image/png') {
        isValid = false;
    }

    if (trackName.length === 0 || trackName.length > 255) {
        isValid = false;
    }

    if (description.length === 0 || description.length > 255) {
        isValid = false;
    }

    if (login.length === 0 || login.length > 255) {
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});
