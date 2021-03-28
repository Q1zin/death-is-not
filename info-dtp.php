<?php

require 'config.php';
require 'login_chack/login_chack.php';

class InfoDTP{
    public $article;
    public $data;
    public $category;
    public $harm_to_health;
    public $link_to_video;
    public $preview;
    public $link_to_photo;
    public $name;
    public $description;
    public $number_of_victims;
    public $the_death_toll;
    public $road_accident_participants;
    public $road_condition;
    public $visibility;
    public $weather;
    public $cord_1;
    public $cord_2;
    public $address;
    public $isset;


    public function __construct($connection)
    {
        $this->chack_art();
        if ($this->article != false){
            $sqlQuery = "SELECT * FROM `dtb` WHERE `id` = '$this->article' LIMIT 1";
            if ($sqlResult = mysqli_query($connection, $sqlQuery)){
                if (mysqli_num_rows($sqlResult) > 0){
                    $result = mysqli_fetch_array($sqlResult);
                    $this->data = htmlspecialchars($result['data']);
                    $this->category = htmlspecialchars($result['category']);
                    $this->harm_to_health = htmlspecialchars($result['harm_to_health']);
                    $this->link_to_video = htmlspecialchars($result['link_to_video']);
                    $this->preview = htmlspecialchars($result['preview']);
                    $this->link_to_photo = htmlspecialchars($result['link_to_photo']);
                    $this->name = htmlspecialchars($result['name']);
                    $this->description = htmlspecialchars($result['description']);
                    $this->number_of_victims = htmlspecialchars($result['number_of_victims']);
                    $this->the_death_toll = htmlspecialchars($result['the_death_toll']);
                    $this->road_accident_participants = htmlspecialchars($result['road_accident_participants']);
                    $this->road_condition = htmlspecialchars($result['road_condition']);
                    $this->visibility = htmlspecialchars($result['visibility']);
                    $this->weather = htmlspecialchars($result['weather']);
                    $this->cord_1 = htmlspecialchars($result['cord_1']);
                    $this->cord_2 = htmlspecialchars($result['cord_2']);
                    $this->address = htmlspecialchars($result['address']);
                    $this->isset = true;
                } else {
                    $this->isset = false;
                }
            } else {
                $this->isset = false;
            }
        } else {
            $this->isset = false;
        }
    }

    private function chack_art()
    {
        if (isset($_GET['article'])){
            global $connection;
            $this->article = mysqli_real_escape_string($connection, $_GET['article']);
        } else {
            $this->article = false;
        }
    }

    public function get_comment()
    {
        global $connection;
        $sqlQuery = "SELECT `userId`, `comment`, `article`, `data` FROM `comments` WHERE `article` = '$this->article' ORDER BY `data` DESC";
        $sqlResult = mysqli_query($connection, $sqlQuery);
        if (mysqli_num_rows($sqlResult) > 0) {
            while ($result = mysqli_fetch_array($sqlResult)) { 
                $userId = $result['userId'];

                $nameQuery = mysqli_query($connection, "SELECT `name` FROM `user_log` WHERE `id` = '$userId'");
                $nameResult = mysqli_fetch_array($nameQuery);

                echo "<div class=\"discuss__comment\"><div class=\"discuss__comment--top\"><img class=\"discuss__comment--top--img\" src=\"img/user.svg\" alt=\"icon: user profiles\"><span class=\"discuss__comment--top--name\">" . $nameResult['name'] . "</span><span class=\"discuss__comment--top--data\">" . $result['data'] . "</span></div><div class=\"discuss__comment--down\">" . $result['comment'] . "</div></div>";
            }
        } else {
            echo '<div class="discuss__empty"><span class="discuss__empty--text">Комментариев нет</span></div>';
        }
    }
}

$infoDTP = new InfoDTP($connection);

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
    <title>Смерти НЕТ! - Информация о дтп xxxxxxx</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/info-dtp.css">
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

    <section class="info-dtp">
        <?php if ($infoDTP->isset == 1){ ?>

        <div class="info-dtp-wrap">
            <h1 class="info-dtp__title"><?php echo $infoDTP->name; ?></h1>
            <p class="info-dtp__description"><?php echo $infoDTP->description; ?></p>
            <div class="info-dtp__content-wrap">
                <div class="info-dtp__content-wrap--left">
                    <?php if ($infoDTP->link_to_video != ''){ ?>

                    <iframe src="https://www.youtube.com/embed/<?php echo $infoDTP->preview; ?>" allow="fullscreen"
                        referrerpolicy="no-referrer" class="info-dtp__content-map map"></iframe>

                    <?php }; ?>
                    <div class="info-dtp__content-info info">
                        <div class="info__item">
                            <div class="info__item--title">Категория</div>
                            <div class="info__item--content"><?php echo $infoDTP->category; ?></div>
                        </div>
                        <div class="info__item">
                            <div class="info__item--title">Вред здоровью</div>
                            <div class="info__item--content"><?php echo $infoDTP->harm_to_health; ?></div>
                        </div>
                        <div class="info__item">
                            <div class="info__item--title">Количество пострадавших</div>
                            <div class="info__item--content"><?php echo $infoDTP->number_of_victims; ?></div>
                        </div>
                        <div class="info__item">
                            <div class="info__item--title">Количество погибших</div>
                            <div class="info__item--content"><?php echo $infoDTP->the_death_toll; ; ?></div>
                        </div>
                        <?php
                    
                        // if ($infoDTP->link_to_video != ''){
                        // echo "<div class=\"info__item\">
                        //     <div class=\"info__item--title\">Ссылка на видео</div>
                        //     <div class=\"info__item--content\">$infoDTP->link_to_video</div>
                        //     </div>";
                        // }
                        
                        if ($infoDTP->link_to_photo != ''){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Ссылка на фото</div>
                            <div class=\"info__item--content\">$infoDTP->link_to_photo</div>
                            </div>";
                        }

                        if ($infoDTP->road_accident_participants != ''){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Участники ДТП</div>
                            <div class=\"info__item--content\">$infoDTP->road_accident_participants</div>
                            </div>";
                        }

                        if ($infoDTP->road_condition != ''){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Состояние дороги</div>
                            <div class=\"info__item--content\">$infoDTP->road_condition</div>
                            </div>";
                        }

                        if ($infoDTP->visibility != 'Выберите'){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Видимость</div>
                            <div class=\"info__item--content\">$infoDTP->visibility</div>
                            </div>";
                        }

                        if ($infoDTP->weather != ''){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Погода</div>
                            <div class=\"info__item--content\">$infoDTP->weather</div>
                            </div>";
                        }

                        if (($infoDTP->cord_1 != '') || ($infoDTP->cord_2 != '') || ($infoDTP->address != '')){
                        echo "<div class=\"info__item\">
                            <div class=\"info__item--title\">Адрес</div>
                            <div class=\"info__item--content\">$infoDTP->cord_1 , $infoDTP->cord_2 , $infoDTP->address</div>
                            </div>";
                        }
                        
                        ?>
                    </div>
                </div>
                <div class="info-dtp__content-wrap--right">
                    <div class="info-dtp__content-comment comment">
                        <div class="comment__all-data">
                            <span class="comment__all-data--title">Дата</span>
                            <span class="comment__all-data--num"><?php echo $infoDTP->data; ?></span>
                        </div>
                        <h3 class="comment__title">Добавить комментарий</h3>
                        <?php
                        
                        if ($login_chack->login_in){
                            ?>
                        <textarea class="comment__textarea" name="new-comment"
                            placeholder="Введите комментарий"></textarea>
                        <button type="submit" class="comment__btn"
                            data-article="<?php echo $infoDTP->article; ?>">Опубликовать</button>
                        <?php
                        } else {
                            ?>
                        <div class="discuss__empty-user"><span class="discuss__empty-user--text">Комментировать могут
                                только
                                зарегистрированные пользователи</span></div>
                        <?php
                        };
                        
                        
                        ?>


                    </div>
                    <div class="info-dtp__content-discuss discuss">
                        <h3 class="discuss__title">Обсуждение</h3>
                        <div class="discuss__comment-wrap">
                            <?php $infoDTP->get_comment(); ?>
                        </div>


                    </div>
                </div>
            </div>




        </div>







        <?php } else { echo '<div class="info-dtp-wrap"><h1 class="info-dtp__title">Такой страницы нет(((</h1></div>'; } ?>
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
            <!-- не очень хорошее решение, но пока что вот так -->
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

    <script src="js/swiper-bundle.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/info-dtp.js"></script>
    <script src="js/main.js"></script>




</body>

</html>