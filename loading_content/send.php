<?php

require_once '../config.php';

$id = $_GET['id'];
$views = $_GET['views'];
$text = $_GET['text'];

$query = mysqli_query($connection, "INSERT INTO `vidos`(`views`, `content`, `link`) VALUES ('$views','$text','$id')");

if ($query){
    echo 'good';
} else {
    echo 'bad';
}