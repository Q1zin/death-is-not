<?php

class Login_chack{
    public $loginHash;
    public $userId;
    public $userHash;
    public $privilege;
    public $user_name;
    public $cookie;
    public $login_in;

    function __construct($connection){

        if (isset($_COOKIE['cookie_agreement'])){
            $this->cookie = 1;
        }

        if (isset($_COOKIE['userId']) && isset($_COOKIE['userHash']) && isset($_COOKIE['loginHash'])) {
            $this->userId = $_COOKIE['userId'];
            $this->userHash = $_COOKIE['userHash'];
            $this->loginHash = $_COOKIE['loginHash'];
            
            $sqlQuery = "SELECT `name`, `privilege`, `cookie` FROM `user_log` WHERE `loginHash` = '$this->loginHash' AND `userHash` = '$this->userHash' AND `id` = '$this->userId' LIMIT 1";
            if ($sqlResult = mysqli_query($connection, $sqlQuery)){
                if (mysqli_num_rows($sqlResult) > 0) {
                    $result = mysqli_fetch_array($sqlResult);
                    $this->user_name = $result['name'];
                    $this->privilege = $result['privilege'];

                    if ($result['cookie']){
                        $this->cookie = $result['cookie'];
                    } else {
                        if ($_COOKIE['cookie_agreement'] == true){
                            $this->cookie = 1;
                            $sqlQuery_2 = "UPDATE `user_log` SET `cookie` = '1' WHERE `id` = '$this->userId'";
                            mysqli_query($connection, $sqlQuery_2);
                        }
                    }
                    $this->login_in = true;
                } else {
                    setcookie("userId", '', time() - 300);
                    setcookie("userHash", '', time() - 300);
                    setcookie("loginHash", '', time() - 300);
                    $this->login_in = false;
                }
            }
        } else {
            $this->login_in = false;
        }
    }
}

$login_chack = new Login_chack($connection);