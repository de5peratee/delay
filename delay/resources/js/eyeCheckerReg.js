document.querySelector('.input-box .i1').addEventListener('click', function () {
    var passwordInput = document.querySelector('#password');
    var eyeIcon = document.querySelector('.input-box .i1');
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.add('active');
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('active');
    }
});

document.querySelector('.input-box .i2').addEventListener('click', function () {
    var passwordConfirmationInput = document.querySelector('#password_confirmation');
    var eyeIcon = document.querySelector('.input-box .i2');
    if (passwordConfirmationInput.type === "password") {
        passwordConfirmationInput.type = "text";
        eyeIcon.classList.add('active');
    } else {
        passwordConfirmationInput.type = "password";
        eyeIcon.classList.remove('active');
    }
});
