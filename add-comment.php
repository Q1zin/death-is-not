<?php

require 'config.php';
require 'login_chack/login_chack.php';

if ($login_chack->login_in) {
    $user_id = $login_chack->get_id();
    $comment = $_GET['comment'];
    $article = $_GET['article'];
    date_default_timezone_set('Europe/Moscow');
    $data = date("Y-m-d H:i:s");

    $sqlQuery = "INSERT INTO `comments`(`userId`, `comment`, `article`, `data`) VALUES('$user_id', '$comment', '$article', '$data')";

    if ($sqlResult = mysqli_query($connection, $sqlQuery)) {
        $user_name = $login_chack->user_name;
        $array = ['chack' => 'OK', 'user_id' => $user_id, 'comment' => $comment, 'article' => $article, 'data' => $data, 'user_name' => $user_name];
    } else {
        $array = ['chack' => 'ERROR'];
    }
} else {
    $array = ['chack' => 'login_error'];
}

echo json_encode($array);