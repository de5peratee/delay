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
