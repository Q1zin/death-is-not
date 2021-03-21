<?php

require 'config.php';
require 'login_chack/login_chack.php';

if ($login_chack->login_in != true){
    header("Location: $homepage");
    exit;
} elseif ($login_chack->get_privilege() != 'admin') {
    echo "<h1>Не достаточно прав!</h1><a href=\"$homepage\">Главная</a>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.svg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Смерти НЕТ! - Добавление видео</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>

<body>
    <div class="admin">
        <div class="admin-wrap">
            <input class="admin__input-id" name="youTubeId" type="text" placeholder="id YouTube video">
            <input class="admin__input-views" name="views" type="text" placeholder="Views video">
            <textarea class="admin__input-text" name="youTubeText" cols="30" rows="10"
                placeholder="Text for video"></textarea>
            <input class="admin__input-btn-chack" type="submit" value="Проверить">
            <input class="admin__input-btn-send" type="submit" value="Отправить">
            <div class="admin-content"></div>
        </div>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/admin.js"></script>

</body>

</html>