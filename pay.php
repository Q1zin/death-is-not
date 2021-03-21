<?php
    require 'config.php';
    require 'login_chack/login_chack.php';

    $m = 286526; // id магазина
    $oa = mysqli_real_escape_string($connection, $_GET['oa']); // сумма платежа
    $secret_word = '9npvtcpv'; // секретное слово

    if ($login_chack->login_in){
        $em = $login_chack->get_login();
        $o = $login_chack->get_login();
    } else {
        $em = mysqli_real_escape_string($connection, $_GET['o']);
        $o = mysqli_real_escape_string($connection, $_GET['o']);
        
    }
    
    $s = md5($m.':'.$oa.':'.$secret_word.':'.$o);
    
    echo "https://www.free-kassa.ru/merchant/cash.php?m=$m&oa=$oa&o=$o&s=$s&em=$em";
    
    
    