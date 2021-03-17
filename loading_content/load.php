<?php

require_once '../config.php';

$num = $_GET['num'];

$query2 = mysqli_query($connection, "SELECT * FROM `vidos` ORDER BY `views` DESC LIMIT $num, 3");
$block = array();
while ($row = mysqli_fetch_array($query2)){
  $block[] = $row;
}

echo json_encode($block);