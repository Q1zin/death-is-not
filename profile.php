<?php

require 'config.php';
require 'login_chack/login_chack.php';

if (!$login_chack->login_in){
    header("Location: $homepage");
    exit;
}

class Profile {
    private $userId;
    private $email;
    private $name;
    private $last_name;
    private $region;
    private $city;
    private $userHash;
    private $loginHash;

    public function __construct($connection)
    {
        $this->userId = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userId']))));
        $this->userHash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userHash']))));
        $this->loginHash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['loginHash']))));

        $sqlQuery = "SELECT  `region`, `city`, `name`, `lastName`, `login` FROM `user_log` WHERE `loginHash` = '$this->loginHash' AND `id` = '$this->userId' AND `userHash` = '$this->userHash'";

        if ($sqlResult = mysqli_query($connection, $sqlQuery)){
            $result = mysqli_fetch_array($sqlResult);;
            $this->email = $result['login'];
            $this->last_name = $result['lastName'];
            $this->name = $result['name'];
            $this->region = $result['region'];
            $this->city = $result['city'];
        }
    }

    public function logout($connection){
        $settype = settype($user_id, 'integer');
        $is_int = is_int($user_id);

        if ($is_int && $settype && 1){
            $this->userId = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userId']))));;
            $sqlQuery = "UPDATE `user_log` SET `userHash` = NULL WHERE `id` = \"$this->userId\"";

            setcookie("userId", '', time() - 300);
            setcookie("userHash", '', time() - 300);
            setcookie("loginHash", '', time() - 300);
            mysqli_close($connection);
            
            header("Refresh: 0");
            exit;
        }
    }

    public function getEmail(){
        return $this->email;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function getRegion(){
        return $this->region;
    }

    public function getCity(){
        return $this->city;
    }


    
}

$profile = new Profile($connection);

if (isset($_POST['exit'])){
    $profile->logout($connection);
}

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
    <title>Смерти НЕТ! - Главная</title>
    <link rel="shortcut icon" href="img/favicon.svg">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/profile.css">
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
                } ?>


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

    <section class="profile">
        <div class="profile-wrap">
            <form class="profile__exit" action="" method="post">
                <input class="profile__exit--input" type="submit" value="Выйти" name="exit">
            </form>
            <h1 class="profile__title">Мой профиль</h1>
            <div class="profile__tablet">
                <button
                    class="profile__tablet-item profile__tablet-item-1 profile__tablet-item--active">основное</button>
                <button class="profile__tablet-item profile__tablet-item-2">мои пожертвования</button>
                <button class="profile__tablet-item profile__tablet-item-3">добавленные ДТП</button>
            </div>
            <div class="profile-content">
                <div class="profile__info profile-content--active">
                    <div class="profile__input-wrap" title="Чтобы изменить почту, обратитесь в тех поддержку">
                        <label for="e-mail" class="profile__label">
                            E-mail*
                        </label>
                        <input placeholder="Alex@mail.ru" disabled="disabled" value="<?= $profile->getEmail(); ?>"
                            class="profile__input profile__input--email" id="e-mail" type="text" name="email">
                        <i class="profile__input--email-icon"></i>
                    </div>
                    <div class="profile__input-wrap">
                        <label for="name" class="profile__label">
                            Имя*
                        </label>
                        <input placeholder="Иван" value="<?= $profile->getName(); ?>"
                            class="profile__input profile__input--name" id="name" type="text" name="name">
                    </div>
                    <span class="profile__error profile__error--name"></span>
                    <div class="profile__input-wrap">
                        <label for="last-name" class="profile__label">
                            Фамилия*
                        </label>
                        <input placeholder="Иванович" value="<?= $profile->getLastName(); ?>"
                            class="profile__input profile__input--last-name" id="last-name" type="text"
                            name="last-name">
                    </div>
                    <span class="profile__error profile__error--last-name"></span>
                    <div class="profile__input-wrap">
                        <label for="region" class="profile__label">
                            Регион
                        </label>
                        <input placeholder="Алтайский край" value="<?= $profile->getRegion(); ?>"
                            class="profile__input profile__input--region" id="region" type="text" name="region">
                    </div>
                    <span class="profile__error profile__error--region"></span>
                    <div class="profile__input-wrap">
                        <label for="Город" class="profile__label">
                            Город
                        </label>
                        <input placeholder="Барнаул" value="<?= $profile->getCity(); ?>"
                            class="profile__input profile__input--city" id="Город" type="text" name="city">
                    </div>
                    <span class="profile__error profile__error--city"></span>
                    <div class="profile__info--save">
                        <button class="profile__info--save-btn" type="submit">
                            Сохранить
                        </button>
                        <span class="profile__info--save-text"></span>
                    </div>

                </div>
                <div class="profile__my-donations">
                    <span class="profile__my-donations__info">У вас нет пожертвований</span>
                </div>
                <div class="profile__added-accidents">
                    <span class="profile__added-accidents__info">Вы не добавляли ДТП</span>
                </div>
            </div>
        </div>

    </section>


    <!-- <?php
    if ($login_chack->login_in){
        echo "login - " . $login_chack->get_login() . "<br />";
        echo "privilege - " . $login_chack->get_privilege() . "<br />";
        echo "user_name - " . $login_chack->user_name . "<br />";
        echo "login_in - " . $login_chack->login_in . "<br />";
    } else {
        header("Location: $homepage");
        exit;
    }
?> -->

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

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>