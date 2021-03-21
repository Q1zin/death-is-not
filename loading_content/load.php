<?php

require_once '../config.php';
// require_once '../login_chack/login_chack.php';

// if ($login_chack->login_in != true){
//     header("Location: $homepage");
//     exit;
// } 



$num = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_GET['num']))));

$query2 = mysqli_query($connection, "SELECT * FROM `vidos` ORDER BY `views` DESC LIMIT $num, 6");
$block = array();
while ($row = mysqli_fetch_array($query2)){
  $block[] = $row;
}

echo json_encode($block);