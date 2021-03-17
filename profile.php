<?php

require 'config.php';
require 'login_chack/login_chack.php';

if (!$login_chack->login_in){
    header("Location: $homepage");
    exit;
}

class Profile {
    public $userId;

    public function logout($connection){
        $this->userId = $_COOKIE['userId'];

        $sqlQuery = "UPDATE `user_log` SET `userHash` = NULL WHERE `id` = \"$this->userId\"";

        setcookie("userId", '', time() - 300);
        setcookie("userHash", '', time() - 300);
        setcookie("loginHash", '', time() - 300);
        mysqli_close($connection);
        header("Refresh: 0");
        exit;
    }
}

$profile = new Profile;

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
    <link rel="stylesheet" href="css/index-style.css">
</head>

<body>
    <?php

if ($login_chack->login_in){
    echo "loginHash - " . $login_chack->loginHash . "<br />";
    echo "userId - " . $login_chack->userId . "<br />";
    echo "userHash - " . $login_chack->userHash . "<br />";
    echo "privilege - " . $login_chack->privilege . "<br />";
    echo "user_name - " . $login_chack->user_name . "<br />";
    echo "cookie - " . $login_chack->cookie . "<br />";
    echo "login_in - " . $login_chack->login_in . "<br />";
} else {
    header("Location: $homepage");
    exit;
}

?>
    <form action="" method="post">
        <input type="submit" value="Выйти" name="exit">
    </form>
</body>

</html>