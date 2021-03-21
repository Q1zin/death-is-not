<?php

    require 'config.php';
    require 'login_chack/login_chack.php';


    if ($login_chack->login_in != true){
    header("Location: $homepage");
    exit;
    } 

    $name = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_GET['name']))));
    $last_name = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_GET['last-name']))));
    $region = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_GET['region']))));
    $city = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_GET['city']))));
    $login_hash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['loginHash']))));
    $user_hash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userHash']))));
    $user_id = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userId']))));

    if ($region == ''){
        $region = NULL;
    }
    if ($city == ''){
        $city = NULL;
    }

    $sqlQuery = "UPDATE `user_log` SET `name` = '$name', `lastName` = '$last_name', `region` = '$region', `city` = '$city' WHERE `loginHash` = '$login_hash' AND `id` = '$user_id' AND `userHash` = '$user_hash'";

    if ($sqlResult = mysqli_query($connection, $sqlQuery)){
        echo 'good';
    } else {
        echo 'bad';
    }