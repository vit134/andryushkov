<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no" />
    <script>if ($(window).width() > 600) { $('meta[name=viewport]').attr('content','initial-scale=no, user-scalable = yes'); }</script>
    <title>Gustavs</title>
    <link href="assets/css/select.css" rel="stylesheet" />
    <link href="assets/css/popover.css" rel="stylesheet" />
    <link href="assets/css/scroll.css" rel="stylesheet" />
    <link href="assets/css/remodal.css" rel="stylesheet" />
    <link href="assets/css/remodal-default-theme.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/favicon.png" />
</head>
<body class="page-registration">
<div class="remodal-bg">
<div class="container">
    <div class="header clear">
        <a href="index.php" class="pull-left"><img src="assets/img/logo.svg" alt="" /></a>
        <a href="#login" class="pull-right button light-blue solid popover-login" data-placement="bottom-left">Вход</a>
        <div class="phone pull-right">+7 (495) <span>800-06-06</span></div>
    </div>
    <div class="banner">
        <h1>Стань частью команды <span class="marker">Gustavs</span><i></i></h1>
    </div>
    <div class="reg-form">
        <div class="row clear big-form">
            <div class="col-6">
                <div class="field field-input">
                    <input type="text" required="" />
                    <label>Имя</label>
                </div>
                <div class="field field-input">
                    <input type="text" required="" />
                    <label>Фамилия</label>
                </div>
                <div class="field field-input">
                    <input type="text" required="" />
                    <label>Отчество</label>
                </div>
                <div class="line"></div>
                <div class="field field-input error">
                    <input type="text" required="" />
                    <label>E-mail</label>
                    <div class="error red"><p>Введите настоящий e-mail</p></div>
                </div>
                <div class="field field-input">
                    <input type="text" id="phone-2" required="" />
                    <label>Номер телефона</label>
                    <div class="error"><p>Введите номер телефона, на который будет выслан код подтверждения.</p></div>
                </div>
            </div>
            <div class="col-6">
                <div class="field field-select">
                    <select>
                        <option>Физическое лицо</option>
                        <option>Юридическое лицо</option>
                        <option>ИП</option>
                    </select>
                    <label>Форма организации</label>
                </div>
                <div class="field-group">
                    <p class="label">Ваш профиль:</p>
                    <div class="clear">
                        <div class="field field-checkbox">
                            <input type="checkbox" id="radio-1" checked />
                            <label for="radio-1">Бригадир</label>
                        </div>
                        <div class="field field-checkbox">
                            <input type="checkbox" id="radio-2" />
                            <label for="radio-2">Мастер</label>
                        </div>
                    </div>
                </div>
                <a href="#works" class="works">Выберите виды работ,<br />которые вы можете выполнять</a>
                <div class="field field-file">
                    <div class="img"><img src="assets/img/default-photo.png" alt="" /></div>
                    <div class="text">Фотоснимок должен быть достаточно четким, чтобы хорошо было видно ваше лицо. Фотографию будет проверять наш менеджер. </div>
                    <a href="#">Загрузить</a>
                </div>
                <div class="buttons">
                    <a href="reg-2.php" class="button big border arrow">Далее</a>
                </div>
            </div>
        </div>
        <div class="progress step-1">
            <div class="item-1 active"><span>1</span></div>
            <div class="item-2"><span>2</span></div>
            <div class="item-3"><span>3</span></div>
        </div>
    </div>
    <div class="footer clear">
        <a href="index.php" class="logo pull-left">Gustavs.ru</a>
        <div class="rights pull-left">Все права защищены</div>
        <a href="#login" class="login pull-right popover-login" data-placement="top-left">Вход</a>
        <div class="phone pull-right">+7 (495) <span>800-06-06</span></div>
    </div>
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

<div class="remodal" data-remodal-id="works">
    <div class="remodal-header">
        <h2>Выберите виды работ, которые вы можете выполнять</h2>
        <button data-remodal-action="close" class="remodal-close"></button>
    </div>
    <div class="remodal-content">
        <div class="scroll">
            <div class="row clear">
                <div class="col-6">
                    <div class="item">
                        <h3>Мелкие бытовые услуги</h3>
                        <a href="#">Мастер на час</a>
                        <a href="#">Установка бытовой техники</a>
                        <a href="#">Уборка помещений, клининг</a>
                        <a href="#">Установка и вскрытие замков</a>
                        <a href="#">Чехлы и покрывала</a>
                        <a href="#">Эмалировка ванн</a>
                    </div>
                    <div class="item">
                        <h3>Комплексные работы</h3>
                        <a href="#">Кладка печей и каминов</a>
                        <a href="#">Ремонт ванной</a>
                        <a href="#">Ремонт квартир и домов</a>
                        <a href="#">Ремонт кухни</a>
                        <a href="#">Строительство бань и саун</a>
                        <a href="#">Строительство бассейнов</a>
                        <a href="#">Строительство гаражей</a>
                        <a href="#">Строительство домов, коттеджей</a>
                        <a href="#">Ремонт офиса</a>
                        <a href="#">Ремонт туалета</a>
                    </div>
                    <div class="item">
                        <h3>Строительно-монтажные работы</h3>
                        <a href="#">Бетонные работы</a>
                        <a href="#">Двери</a>
                        <a href="#">Дорожное строительство</a>
                        <a href="#">Заборы и ограждения</a>
                        <a href="#">Земельные работы</a>
                        <a href="#">Изоляционные работы</a>
                        <a href="#">Кладочные работы</a>
                        <a href="#">Ковка и литье</a>
                        <a href="#">Кровельные работы</a>
                        <a href="#">Лестницы</a>
                        <a href="#">Металлоконструкции</a>
                        <a href="#">Остекление, окна, балконы</a>
                        <a href="#">Рольставни и секционные ворота</a>
                        <a href="#">Сварочные работы</a>
                        <a href="#">Срубы</a>
                        <a href="#">Столярные и плотницкие работы</a>
                        <a href="#">Фасадные работы</a>
                        <a href="#">Фундамент</a>
                        <a href="#">Алмазная резка и сверление</a>
                        <a href="#">Маркизы и навесы</a>
                        <a href="#">Снос и демонтаж</a>
                        <a href="#">Бурение</a>
                    </div>
                    <div class="item">
                        <h3>Отделочные работы</h3>
                        <a href="#">Лепнина</a>
                        <a href="#">Малярные и штукатурные работы</a>
                        <a href="#">Напольные покрытия</a>
                        <a href="#">Потолки</a>
                        <a href="#">Промышленные полы</a>
                        <a href="#">Роспись стен</a>
                        <a href="#">Стеновые панели</a>
                        <a href="#">Стяжка</a>
                        <a href="#">Гипсокартонные работы</a>
                        <a href="#">Обойные работы</a>
                        <a href="#">Плиточные работы</a>
                        <a href="#">Мозаичные работы</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="item">
                        <h3>Благоустройство территории</h3>
                        <a href="#">Искусственные водоемы</a>
                        <a href="#">Ландшафтный дизайн</a>
                        <a href="#">Малые архитектурные формы</a>
                        <a href="#">Уличное освещение</a>
                        <a href="#">Озеленение</a>
                        <a href="#">Фонтаны</a>
                    </div>
                    <div class="item">
                        <h3>Инженерные системы</h3>
                        <a href="#">Альтернативные источники энергии</a>
                        <a href="#">Водоснабжение и канализация</a>
                        <a href="#">Газификация</a>
                        <a href="#">Кондиционирование и вентиляция</a>
                        <a href="#">Лифты и эскалаторы</a>
                        <a href="#">Отопление</a>
                        <a href="#">Охранные системы и контроль доступа</a>
                        <a href="#">Пожарные сигнализации</a>
                        <a href="#">Сантехнические работы</a>
                        <a href="#">Система видеонаблюдения</a>
                        <a href="#">Система пожаротушения</a>
                        <a href="#">Слаботочные системы</a>
                        <a href="#">Теплый пол</a>
                        <a href="#">Трубопроводы</a>
                        <a href="#">Умный дом</a>
                        <a href="#">Электромонтажные работы</a>
                    </div>
                    <div class="item">
                        <h3>Проектирование и дизайн</h3>
                        <a href="#">Геодезические работы</a>
                        <a href="#">Геологические изыскания</a>
                        <a href="#">Дизайн интерьера</a>
                        <a href="#">Инженерное проектирование</a>
                        <a href="#">Межевание и кадастр</a>
                        <a href="#">Проектирование зданий</a>
                        <a href="#">Сметные работы</a>
                        <a href="#">Согласование планировок</a>
                        <a href="#">Технический надзор</a>
                    </div>
                    <div class="item">
                        <h3>Обслуживание объектов</h3>
                        <a href="#">Аренда оборудования</a>
                        <a href="#">Аренда строительной техники</a>
                        <a href="#">Высотные работы</a>
                        <a href="#">Грузоперевозки</a>
                        <a href="#">Уборка территорий</a>
                        <a href="#">Вывоз мусора</a>
                    </div>
                    <div class="item">
                        <h3>Интерьер</h3>
                        <a href="#">Декорирование интерьеров</a>
                        <a href="#">Жалюзи</a>
                        <a href="#">Мебель</a>
                        <a href="#">Офисные перегородки</a>
                        <a href="#">Шторы и карнизы</a>
                        <a href="#">фитодизайн</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="remodal-footer clear">
        <div class="pull-left">Всего 132</div>
        <div class="pull-right">
            <div class="selected">Выбрано <span>12 из 30</span></div>
            <a href="#" class="button border blue big">Готово</a>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popover.min.js"></script>
<script src="assets/js/mask.min.js"></script>
<script src="assets/js/scroll.min.js"></script>
<script src="assets/js/remodal.min.js"></script>
<script src="assets/js/select.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

        //Mask
        $("#phone, #phone-2").mask("+7 (999) 999-9999");

        //Select
        $('select').niceSelect();

        //Popover
        $('.popover-login').webuiPopover({
            animation: 'pop',
            style:'inverse',
            url:'#login',
            width: 340
        });

        //Categories
        $('.scroll a').click(function() {
            $(this).toggleClass('selected');
            return false;
        });

        //Custom scroll
        $('.scroll').perfectScrollbar({
            suppressScrollX: true
        });

    });

</script>

</body>
</html>
