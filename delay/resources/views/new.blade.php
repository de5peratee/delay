<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/new.css'])
</head>
<body>
<div class="containerReg">

    <div class="reg">
        Вход
    </div>

    <div class="input-box">
        <input type="text" id="login" placeholder="Логин" title="Логин - это уникальное имя, от которого публикуются ваши треки" required>
        <span class="error" id="loginError"></span>
    </div>

    <div class="input-box">
        <input type="password" id="password" placeholder="Пароль" title="Пароль - секретный набор символов, который защищает вашу учетную запись" required>
        <span class="error" id="passwordError" ></span>
    </div>

    <div class="button">
        <input type="submit" value="Войти">
    </div>

    <div class="text">
        <h3><a href="/registration">Зарегистрироваться</a></h3>
    </div>

</div>

</div>
<div class="logo">
    delay
</div>
</body>
</html>
