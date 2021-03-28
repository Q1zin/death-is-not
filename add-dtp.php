<?php

require 'config.php';
require 'login_chack/login_chack.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Смерти НЕТ! - Добавление ДТП</title>
    <link rel="shortcut icon" href="img/favicon.svg">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/add-dtp.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=01081833-9711-4526-838f-0a34fc3846ef&lang=ru_RU"
        type="text/javascript"></script>
</head>

<body>
    <header class="header">
        <div class="header-wrap">
            <div class="header-left">
                <a href="index.php" class="header-left__img-link">
                    <img class="header-left__img" src="img/img_homepage.svg" alt="img: Главная">
                </a>
                <nav class="header-left__links">
                    <a href="index.php" class="header-left__links--item">о проекте</a>
                    <a href="https://www.youtube.com/channel/UCEdi9MaYP4IEJjOTMOlkpeQ/featured" target="_blank"
                        class="header-left__links--item">новые видео</a>
                    <a href="dtp.php" class="header-left__links--item">все ДТП</a>
                </nav>
            </div>
            <div class="header-right">
                <div class="header-right__donation">
                    <button class="header-right__donation--button">поддержать проект</button>
                </div>

                <?php if ($login_chack->login_in)
                { echo "<div class=\"header-right__user-block\">
                    <a href=\"profile.php\"  class=\"header-right__user-link user-link\">
                        <img src=\"img/user-image.jpg\"  alt=\"img: user-image\" class=\"user-link__image\">
                        <span class=\"user-link__text\">$login_chack->user_name</span>
                    </a>
                    </div>";
                } else {
                    echo "<div class=\"header-right__logining\">
                    <button href=\"sign-in.php\" class=\"header-right__logining--btn\">
                    войти
                    </button>
                    </div>"; } ?>


            </div>
            <div class="header-center">
                <a href="#" class="header-menu">
                    <img src="img/menu.svg" alt="img: menu" class="header-menu-img">
                </a>
                <a href="index.php" class="header-center-title"
                    style="z-index:100; text-decoration: none; <?php if (!$login_chack->login_in) { echo "margin-left: 48px;"; } ?>">Смерти
                    -
                    НЕТ!</a>
                <?php if ($login_chack->login_in)
                { echo "<a href=\"profile.php\" class=\"header-profile\" style=\"z-index:100; width: 14px; display: flex;\"><img style=\"width: 14px;\" src=\"img/user_header.svg\" alt=\"icon: user\"></a>";
                } else {
                    echo "<div class=\"header-right__logining\">
                    <button href=\"sign-in.php\" class=\"header-right__logining--btn\">
                    войти
                    </button>
                    </div>"; } ?>
                </a>
            </div>
        </div>
    </header>







    <section class="add-dtp">
        <div class="add-dtp-wrap">
            <h1 class="add-dtp__title">Добавить ДТП</h1>
            <div class="add-dtp__main-info main-info">
                <h2 class="main-info__title">Основная информация</h2>
                <div class="main-info__wrap-first">
                    <div class="main-info__wrap-data main-info__wrap--item">
                        <label class="main-info__wrap-first--label" for="main-info__wrap-first--data">Дата</label>
                        <input class="main-info__wrap-first--data main-info__wrap-first--input"
                            id="main-info__wrap-first--data" type="date" name="data" required placeholder="дд.мм.гггг">
                    </div>
                    <div class="main-info__wrap-category main-info__wrap--item">
                        <label class="main-info__wrap-first--label"
                            for="main-info__wrap-first--category">Категория</label>
                        <select name="category" class="main-info__wrap-first--category main-info__wrap-first--input"
                            id="main-info__wrap-first--category" required>
                            <option>Выберите категорию</option>
                            <option>Столкновение</option>
                            <option>Опрокидывание</option>
                            <option>Наезд на стоящее транспортное средство</option>
                            <option>Наезд на препятствие</option>
                            <option>Наезд на пешехода</option>
                            <option>Наезд на велосипедиста</option>
                            <option>Наезд на животное</option>
                            <option>Происшествие с переводимым грузом</option>
                            <option>Иные виды ДТП</option>
                        </select>
                    </div>
                    <div class="main-info__wrap-harm_to_health main-info__wrap--item">
                        <label class="main-info__wrap-first--label" for="main-info__wrap-first--harm_to_health">Вред
                            здоровью</label>
                        <select name="harm_to_health"
                            class="main-info__wrap-first--harm_to_health main-info__wrap-first--input"
                            id="main-info__wrap-first--harm_to_health" required>
                            <option>Нет</option>
                            <option>Лёгкий</option>
                            <option>Тяжёлый</option>
                            <option>С погибшими</option>
                        </select>
                    </div>
                    <div class="main-info__wrap-link_to_video main-info__wrap--item">
                        <label class="main-info__wrap-first--label" for="main-info__wrap-first--link_to_video">Ссылка на
                            видео (YouTube)</label>
                        <input class="main-info__wrap-first--link_to_video main-info__wrap-first--input"
                            id="main-info__wrap-first--link_to_video" type="text" name="link_to_video" required
                            placeholder="Введите ссылку на видео">
                    </div>
                </div>
                <div class="main-info__wrap-second">
                    <div class="main-info__wrap-second--left">
                        <div class="main-info__wrap-description main-info__wrap-second--item">
                            <label for="main-info__wrap-second--description"
                                class="main-info__wrap-second--description--label">Описание</label>
                            <textarea
                                class="main-info__wrap-second--description main-info__wrap-second--description--textarea"
                                name="description" id="main-info__wrap-second--description"
                                placeholder="Введите описание"></textarea>
                        </div>
                    </div>
                    <div class="main-info__wrap-second--right main-info__wrap-second--item">
                        <div class="main-info__wrap-link_to_photo">
                            <label class="main-info__wrap-second--label"
                                for="main-info__wrap-second--link_to_photo">Ссылка
                                на фото</label>
                            <input class="main-info__wrap-second--link_to_photo main-info__wrap-second--input"
                                id="main-info__wrap-second--link_to_photo" type="text" name="link_to_photo" required
                                placeholder="Введите ссылку на фото">
                        </div>
                        <div class="main-info__wrap-name">
                            <label class="main-info__wrap-second--label"
                                for="main-info__wrap-second--name">Название</label>
                            <textarea class="main-info__wrap-second--name" name="name" id="main-info__wrap-second--name"
                                placeholder="Введите название"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-dtp__place place">
                <h2 class="place__title">Место ДТП</h2>
                <span class="place__under-text">Если вы знаете где было совершено ДТП, отметьте место на карте</span>
                <div id="map" class="place__map"></div>
            </div>
            <div class="add-dtp__more-atr more-atr">
                <h2 class="more-atr__title">Дополнительные атрибуты</h2>
                <div class="more-atr__content-up">
                    <div class="more-atr__content--number_of_victims">
                        <label for="more-atr__content--number_of_victims"
                            class="more-atr__content--number_of_victims--label">Количество пострадавших </label>
                        <select name="number_of_victims" class="more-atr__content--number_of_victims--select"
                            id="more-atr__content--number_of_victims">
                            <option>Без пострадавших</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3+</option>
                        </select>
                    </div>
                    <div class="more-atr__content--the_death_toll">
                        <label for="more-atr__content--the_death_toll"
                            class="more-atr__content--the_death_toll--label">Количество погибших</label>
                        <select name="the_death_toll" class="more-atr__content--the_death_toll--select"
                            id="more-atr__content--the_death_toll">
                            <option>Без погибших</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3+</option>
                        </select>
                    </div>

                    <div class="more-atr__content--road_accident_participants">
                        <label for="more-atr__content--road_accident_participants"
                            class="more-atr__content--road_accident_participants--label">Участники ДТП</label>
                        <div class="checkselect more-atr__content--road_accident_participants--select">
                            <label><input type="checkbox" name="road_accident_participants" value="1">Пешеходы</label>
                            <label><input type="checkbox" name="road_accident_participants"
                                    value="2">Велосипедисты</label>
                            <label><input type="checkbox" name="road_accident_participants"
                                    value="3">Мотоциклисты</label>
                            <label><input type="checkbox" name="road_accident_participants" value="4">Общественный
                                транспорт</label>
                            <label><input type="checkbox" name="road_accident_participants" value="5">Дети</label>
                        </div>
                    </div>

                    <div class="more-atr__content--road_condition">
                        <label for="more-atr__content--road_condition"
                            class="more-atr__content--road_condition--label">Состояние дороги</label>
                        <div class="checkselect more-atr__content--road_condition--select">
                            <label><input type="checkbox" name="road_condition" value="1">Гололедица</label>
                            <label><input type="checkbox" name="road_condition" value="2">Загрязненное</label>
                            <label><input type="checkbox" name="road_condition" value="3">Мокрое</label>
                            <label><input type="checkbox" name="road_condition" value="4">Сухое</label>
                            <label><input type="checkbox" name="road_condition" value="5">Недостаточное
                                освещение</label>
                            <label><input type="checkbox" name="road_condition" value="6">Неровное покрытие</label>
                            <label><input type="checkbox" name="road_condition" value="7">Отсутствие освещения</label>
                            <label><input type="checkbox" name="road_condition" value="8">Отсутствие разметки</label>
                            <label><input type="checkbox" name="road_condition" value="9">Со снежным накатом</label>
                        </div>
                    </div>
                </div>
                <div class="more-atr__content-down">
                    <div class="more-atr__content--visibility">
                        <label for="more-atr__content--visibility"
                            class="more-atr__content--visibility--label">Видимость</label>
                        <select name="visibility" class="more-atr__content--visibility--select"
                            id="more-atr__content--visibility">
                            <option>Выберите</option>
                            <option>Хорошая</option>
                            <option>Ограниченная</option>
                            <option>Недостаточная</option>

                        </select>
                    </div>
                    <div class="more-atr__content--weather">
                        <label class="more-atr__content--weather--label">Погода</label>
                        <div class="checkselect more-atr__content--weather--select">
                            <label><input type="checkbox" name="weather" value="1">Дождь</label>
                            <label><input type="checkbox" name="weather" value="2">Метель</label>
                            <label><input type="checkbox" name="weather" value="3">Пасмурно</label>
                            <label><input type="checkbox" name="weather" value="4">Снегопад</label>
                            <label><input type="checkbox" name="weather" value="5">Высокая температура</label>
                            <label><input type="checkbox" name="weather" value="6">Низкая температура</label>
                            <label><input type="checkbox" name="weather" value="7">Туман</label>
                            <label><input type="checkbox" name="weather" value="8">Ураганный ветер</label>
                            <label><input type="checkbox" name="weather" value="9">Ясно</label>
                        </div>
                    </div>

                </div>
                <div class="more-atr__content-btn">
                    <button class="more-atr__content-btn--send" type="submit">Опубликовать</button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-don">
        <a href="#" class="modal-close__link modal-close__link-mini">
            <img src="img/close.svg" alt="icon: close modal">
        </a>
        <?php if ($login_chack->login_in) {?>
        <div class="modal-don-big__wrap">
            <span class="modal-don-big__title">Пожертвование на развитие проекта</span>
            <div class="modal-don-big__tablet">
                <div class="num_summ-1">
                    <div class="modal-don-big__item num_summ_1 num_summ--active"><span class="num_summ_text">300
                            ₽</span></div>
                    <div class="modal-don-big__item num_summ_2"><span class="num_summ_text">500 ₽</span></div>
                    <div class="modal-don-big__item num_summ_3"><span class="num_summ_text">1000 ₽</span></div>
                </div>
                <div class="num_summ-2">
                    <div class="modal-don-big__item num_summ_4"><span class="num_summ_text">2000 ₽</span></div>
                    <input class="modal-don-big__item--text num_summ_5" type="text" name="summ"
                        placeholder="другая сумма">
                </div>
            </div>
            <input class="modal-don-big__sub" type="submit" value="Пожервовать проекту">
            <span class="modal-don-big__agreement">Заполняя форму, вы принимаете договор-оферту и соглашаетесь на
                обработку персональных данных.</span>
        </div>

        <?php } else { ?>
        <div class="modal-don-big__wrap">
            <span class="modal-don-big__title">Пожертвование на развитие проекта</span>
            <div class="modal-don-big__tablet">
                <div class="num_summ-1">
                    <div class="modal-don-big__item num_summ_1 num_summ--active"><span class="num_summ_text">300
                            ₽</span></div>
                    <div class="modal-don-big__item num_summ_2"><span class="num_summ_text">500 ₽</span></div>
                    <div class="modal-don-big__item num_summ_3"><span class="num_summ_text">1000 ₽</span></div>
                </div>
                <div class="num_summ-2">
                    <div class="modal-don-big__item num_summ_4"><span class="num_summ_text">2000 ₽</span></div>
                    <input class="modal-don-big__item--text num_summ_5" type="text" name="summ"
                        placeholder="другая сумма">
                </div>
            </div>
            <div class="modal-don-big__information">
                <input class="modal-don-big__information--item modal-don-big__information--item--name"
                    placeholder="Фамилия*" type="text" name="us_last_name">
                <span class="error-support-name"></span>
                <input class="modal-don-big__information--item modal-don-big__information--item--last-name"
                    placeholder="Имя*" type="text" name="us_name">
                <span class="error-support-last-name"></span>
                <input class="modal-don-big__information--item modal-don-big__information--item--email"
                    placeholder="Ваш e-mail*" type="text" name="em">
                <span class="error-support-email"></span>
            </div>
            <input class="modal-don-big__sub-full" type="submit" value="Пожервовать проекту">
            <span class="modal-don-big__agreement">Заполняя форму, вы принимаете договор-оферту и соглашаетесь на
                обработку персональных данных.</span>
        </div>
        <?php } ?>

        <div class="modal-wrap-foot">
            <span class="footer__item">Или можете перевести любую сумму на развитие проекта другими способами:</span>
            <span class="footer__item">На карту Сбербанка: 5469 4000 3754 8877</span>
            <span class="footer__item">Патреон: <a href="https://patreon.com/vasily_orlov" class="footer__item--link"
                    target="_blank">patreon.com/vasily_orlov</a></span>
            <span class="footer__item">На Яндекс.Кошелек с помощью карты любого банка:
                <a href="https://money.yandex.ru/to/410012244292407" class="footer__item--link"
                    target="_blank">money.yandex.ru/to/410012244292407</a></span>
            <span class="footer__item">На PayPal: <a href="https://paypal.me/vasilyorlovdonate"
                    class="footer__item--link" target="_blank">paypal.me/vasilyorlovdonate</a></span>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-wrap">
            <span class="footer__item">Поддержать проект:</span>
            <span class="footer__item">На карту Сбербанка: 5469 4000 3754 8877</span>
            <span class="footer__item">Патреон: <a href="https://patreon.com/vasily_orlov" class="footer__item--link"
                    target="_blank">patreon.com/vasily_orlov</a></span>
            <span class="footer__item">На Яндекс.Кошелек с помощью карты любого банка:
                <a href="https://money.yandex.ru/to/410012244292407" class="footer__item--link"
                    target="_blank">money.yandex.ru/to/410012244292407</a></span>
            <span class="footer__item">На PayPal: <a href="https://paypal.me/vasilyorlovdonate"
                    class="footer__item--link" target="_blank">paypal.me/vasilyorlovdonate</a></span>
            <br />
            <a href="https://www.free-kassa.ru/" target="_blank"><img src="//www.free-kassa.ru/img/fk_btn/15.png"
                    title="Приём оплаты на сайте картами"></a>
        </div>
        <div class="footer-wrap2">
            <a href="index.php" style="text-decoration: none; height: 30px;"><img src="img/img_homepage.svg"
                    class="footer-wrap2--glav" alt=""></a>
            <a class="footer-wrap2-form" href="https://www.free-kassa.ru/" target="_blank"><img
                    src="//www.free-kassa.ru/img/fk_btn/15.png" title="Приём оплаты на сайте картами"></a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span class="footer-wrap2--text">Василий Орлов, 2021</span>

        </div>

    </footer>

    <div class="modal-login">
        <a href="#" class="modal-close__link"><img src="img/close.svg" alt="icon: close modal"></a>
        <span class="modal-login__title">Вход</span>
        <input placeholder="Ваш e-mail*" type="text" class="modal-login__input modal-login__input--log">
        <div class="modal-login__input-pass--wrap">
            <input placeholder="Введите пароль*" type="password" class="modal-login__input modal-login__input-pass">
            <i class="register__glass"></i>
        </div>
        <!-- <span class="error-reg-pass"></span> -->
        <span class="modal-login__error">Введен неправильный логин или пароль</span>
        <input type="submit" class="modal-login__input--sub">
        <a href="#" class="modal-login__btn--reg">Зарегистрироваться</a>
    </div>

    <div class="modal-reg">
        <a href="#" class="modal-close__link"><img src="img/close.svg" alt="icon: close modal"></a>
        <span class="modal-reg__title">Регистрация</span>
        <input placeholder="Фамилия*" type="text" class="modal-reg__input modal-reg__input--name">
        <span class="error-reg-name"></span>
        <input placeholder="Имя*" type="text" class="modal-reg__input modal-reg__input--last-name">
        <span class="error-reg-last-name"></span>
        <input placeholder="Ваш e-mail*" type="text" class="modal-reg__input modal-reg__input--log">
        <span class="error-reg-email"></span>
        <div class="modal-reg__input-pass--wrap">
            <input placeholder="Придумайте пароль*" type="password" class="modal-reg__input modal-reg__input-pass">
            <i class="register__glass2"></i>
        </div>
        <span class="error-reg-pass"></span>
        <span class="modal-reg__error">Пользователь с таким логином существует</span>
        <input type="submit" class="modal-reg__input--sub">
        <a href="#" class="modal-reg__btn--log">Войти</a>
    </div>

    <div class="menu">
        <a href="#" class="menu-close" style="<?php if (!$login_chack->login_in) { echo "top: 16px;"; } ?>">
            <img src="img/menu-close.svg" alt="icon: close">
        </a>
        <div class="menu-wrap">
            <nav class="menu__links">
                <a href="index.php" class="menu__links--item">о проекте</a>
                <a href="https://www.youtube.com/channel/UCEdi9MaYP4IEJjOTMOlkpeQ/featured" target="_blank"
                    class="menu__links--item">новые видео</a>
                <a href="dtp.php" class="menu__links--item">все дтп</a>
            </nav>
        </div>

    </div>

    <div class="cover-up">
        <div class="modal-don-mini">
            <a href="#" class="modal-close__link"><img src="img/close.svg" alt="icon: close modal"
                    class="modal-close__img"></a>
            <span class="modal-don-mini__text">Поддержите проект “Как не попасть в ДТП” - пожертвуйте любую сумму на
                развития канала</span>
            <div class="modal-don-mini__btns">
                <button class="modal-don-mini__btns--sub">Помочь проекту</button>
                <a href="#" class="modal-don-mini__btns--sub-not">Нет, спасибо</a>

            </div>
        </div>
    </div>

    <div class="hidden__geo __geo_longitude"></div>
    <div class="hidden__geo __geo_latitude"></div>
    <div class="hidden__geo __geo_address"></div>
    <div class="hidden" data-road_accident_participants="" data-road_condition="" data-weather=""></div>

    <script src="js/swiper-bundle.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/add-dtp.js"></script>
</body>

</html>