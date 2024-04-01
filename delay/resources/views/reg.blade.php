<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/reg.css'])
    @vite(['resources/js/regValidation.js'])
</head>
<body>
<div class="containerReg">
    <div class="reg">
        Регистрация
    </div>

    <div class="input-box">
        <input type="text" id="login" placeholder="Логин" title="Логин - это уникальное имя, от которого публикуются ваши треки" required>
        <span class="error" id="loginError"></span>
    </div>

    <div class="input-box">
        <input type="password" id="password" placeholder="Пароль" required>
        <span class="error" id="passwordError"></span>
    </div>

    <div class="input-box">
        <input type="password" id="confirmPassword" placeholder="Повторите пароль" required>
        <span class="error" id="confirmPasswordError"></span>
    </div>

    <div class="button">
        <input type="submit" value="Зарегистрироваться">
    </div>

    <div class="text">
        <h3><a href="/login">Уже есть аккаунт</a></h3>
    </div>

</div>

</div>
<div class="logo">
    delay
</div>
</body>
</html>
