<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no" />
    <script>if ($(window).width() > 600) { $('meta[name=viewport]').attr('content','initial-scale=no, user-scalable = yes'); }</script>
    <title>Gustavs</title>
    <link href="assets/css/select.css" rel="stylesheet" />
    <link href="assets/css/popover.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/favicon.png" />
</head>
<body class="page-registration">
<div class="container">
    <div class="header clear">
        <a href="#" class="pull-left"><img src="assets/img/logo.svg" alt="" /></a>
        <a href="#login" class="pull-right button light-blue solid popover-login" data-placement="bottom-left">Вход</a>
        <div class="phone pull-right">+7 (495) <span>800-06-06</span></div>
    </div>
    <div class="banner">
        <h1>Вы <span class="marker">успешно</span> зарегистрировались<i></i></h1>
        <div class="info">
            <p>В ближайшее время ваш аккаунт проверит наш менеджер. В случае успешной проверки вы получите SMS-уведомление.</p>
        </div>
        <a href="index.php" class="button big border arrow">Продолжить</a>
    </div>
    <div class="footer clear">
        <a href="#" class="logo pull-left">Gustavs.ru</a>
        <div class="rights pull-left">Все права защищены</div>
        <a href="#login" class="login pull-right popover-login" data-placement="top-left">Вход</a>
        <div class="phone pull-right">+7 (495) <span>800-06-06</span></div>
    </div>
</div>

<div id="login" class="popover-content" style="display:none;">
    <div class="form">
        <div class="field">
            <input type="text" required="" id="phone" />
            <label>Телефон</label>
        </div>
        <div class="field">
            <input type="password" required="" />
            <label>Пароль</label>
        </div>
        <div class="error">
            <p>Неверный пароль или телефон</p>
        </div>
        <div class="buttons">
            <a href="#" class="button yellow">Войти</a>
        </div>
        <a href="pass.php">Забыли пароль?</a>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popover.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

        //Popover
        $('.popover-login').webuiPopover({
            animation: 'pop',
            style:'inverse',
            url:'#login',
            width: 340
        });

    });

</script>

</body>
</html>
