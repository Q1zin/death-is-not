<?php

require_once '../config.php';
require_once '../login_chack/login_chack.php';

if ($login_chack->login_in != true){
    header("Location: $homepage");
    exit;
} 

$id = mysqli_real_escape_string($connection, $_COOKIE['id']);
$views = mysqli_real_escape_string($connection, $_COOKIE['views']);
$text = mysqli_real_escape_string($connection, $_COOKIE['text']);

$query = mysqli_query($connection, "INSERT INTO `vidos`(`views`, `content`, `link`) VALUES ('$views','$text','$id')");

if ($query){
    echo 'good';
} else {
    echo 'bad';
}