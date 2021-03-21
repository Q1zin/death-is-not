<?php

require 'config.php';
require 'login_chack/login_chack.php';

$query = mysqli_query($connection, "SELECT * FROM `vidos` ORDER BY `views` DESC LIMIT 3");
$query3 = mysqli_query($connection, "SELECT * FROM `vidos` ORDER BY `views` DESC LIMIT 3");
$query2 = mysqli_query($connection, "SELECT `id` FROM `vidos`");

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.svg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Смерти НЕТ! - Главная</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index-style.css">
</head>

<body>
    <div class='hidden' data-num='<?= mysqli_num_rows($query2); ?>'></div>
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
                    <a href="dtp.php" class="header-left__links--item">Все ДТП</a>
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
                <span class="header-center-title"
                    style="z-index:100; <?php if (!$login_chack->login_in) { echo "margin-left: 48px;"; } ?>">Смерти -
                    НЕТ!</span>
                <?php if ($login_chack->login_in)
                { echo "<a href=\"profile.php\" class=\"header-profile\" style=\"z-index:100;\"><img src=\"img/user.svg\" alt=\"icon: user\"></a>";
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

    <section class="information">
        <div class="information-wrap">
            <div class="information-left">
                <h2 class="information-left__title">
                    Василий Орлов, <br /><span class="information-left__title--emphasis">блогер-полицейский</span>
                </h2>
                <div class="information-left__text">
                    <p class="information-left__text--p"><img class="information-left__img" src="img/index-photo.jpg"
                            alt="img: photo of Vasily">Меня зовут Василий Орлов и уже более двух лет я веду ютуб-канал
                        о
                        ПДД и о том, как уменьшить смертность на наших дорогах и как улучшить жизнь водителей и
                        пешеходов.
                        Основные рубрики: “Разбор ПДД”, “Обзор ДТП”, “Закон и автоправо”, “Проектирование дорог и
                        урбанистика”.</p>
                    <p class="information-left__text--p">В 2018 году на российских дорогах погибло 18 тысяч человек. В
                        пересчете на количество машин это в шесть раз больше, чем в Германии и в 4 раза меньше, чем в
                        США. Я
                        считаю, что у нас нет какого-то особого менталитета, который не позволит снизить смертность хотя
                        бы
                        до уровня западных стран. Просто <span class="information-left__text--emphasis">нужно</span>
                        наконец-то <span class="information-left__text--emphasis">начать заниматься проблемой</span>.
                    </p>

                </div>
            </div>
            <div class="information-right">
                <img class="information-right__img" src="img/index-photo.jpg" alt="img: photo of Vasily">
            </div>
        </div>
    </section>

    <section class="content">
        <div class="content-wrap">
            <h3 class="content__title">Популярные видео на канале</h3>
            <div class="content__video">
                <div class="content__video--wrap-video" id="content__video--wrap-video">
                    <?php for ($i=0; $i < 3; $i++) { $content = mysqli_fetch_array($query); ?>
                    <div class="content__card">
                        <img class="content__card--img"
                            src="http://img.youtube.com/vi/<?php echo $content['link'] ?>/mqdefault.jpg"
                            alt="img: превью видео">
                        <span class="content__card--text"><?php echo $content['content'] ?></span>
                        <span class="content__card--more"><a class="content__card--link" target="_blank"
                                href="https://www.youtube.com/watch?v=<?php echo $content['link'] ?>">Подробнее</a></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="content__video--wrap-btn">
                    <button class="content__video--btn" id="content__video--btn">Больше</button>
                </div>
            </div>
        </div>

        <div class="content-wrap-swipe">
            <h3 class="content-wrap-swipe__title">Популярные видео на канале</h3>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php for ($i=0; $i < 3; $i++) { $content = mysqli_fetch_array($query3); ?>
                    <div class="content__card swiper-slide">
                        <img class="content__card--img"
                            src="http://img.youtube.com/vi/<?php echo $content['link'] ?>/mqdefault.jpg"
                            alt="img: превью видео">
                        <span class="content__card--text"><?php echo $content['content'] ?></span>
                        <span class="content__card--more"><a class="content__card--link" target="_blank"
                                href="https://www.youtube.com/watch?v=<?php echo $content['link'] ?>">Подробнее</a></span>
                    </div>
                    <?php } ?>
                    <button class="swiper-slide swiper__more-slide"><img src="img/circle_chevron_right.svg"
                            alt="icon: more content"></button>
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
                    placeholder="Ваш e-mail*" type="email" name="em">
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

    <div class="modal-login">
        <a href="#" class="modal-close__link"><img src="img/close.svg" alt="icon: close modal"></a>
        <span class="modal-login__title">Вход</span>
        <input placeholder="Ваш e-mail*" type="email" class="modal-login__input modal-login__input--log">
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
        <input placeholder="Ваш e-mail*" type="email" class="modal-reg__input modal-reg__input--log">
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
                <a href="#" class="menu__links--item">консультация юриста</a>
            </nav>
        </div>

    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>