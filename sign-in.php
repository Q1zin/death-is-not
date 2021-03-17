<?php

require 'config.php';
require 'login_chack/login_chack.php';

if ($login_chack->login_in){
    header("Location: $homepage");
    exit;
}

class Login{
    public $login;
    public $err_login;
    public $password;
    public $err_password;
    public $userId;
    public $userHash;
    public $loginHash;

    public function __construct($connection, $login, $password){
        $this->login = strip_tags(trim($login));
        $this->password = strip_tags(trim($password));

        $sqlQuery = "SELECT `id`, `password`, `loginHash` FROM `user_log` WHERE `login` = \"$this->login\" LIMIT 1";

        if ($sqlResult = mysqli_query($connection, $sqlQuery)){
            if (mysqli_num_rows($sqlResult) > 0){
                $this->err_login = false;
                $result = mysqli_fetch_array($sqlResult);
                $received_password = $result['password'];
                $this->err_password = !password_verify($this->password, $received_password);
                if (!$this->err_password){
                    $this->userId = $result['id'];
                    $this->userHash = md5(random_int(1, 10000000));;
                    $this->loginHash = $result['loginHash'];

                    $sqlQuery2 = "UPDATE `user_log` SET `userHash`=\"$this->userHash\" WHERE id = \"$this->userId\"";

                    if ($sqlResult2 = mysqli_query($connection, $sqlQuery2)){
                        setcookie("userId", $this->userId, time() + 2592000);
                        setcookie("userHash", $this->userHash, time() + 2592000);
                        setcookie("loginHash", $this->loginHash, time() + 2592000);
                        mysqli_close($connection);
                        // header("Refresh: 0");
                        // exit;
                    }
                }
            } else {
                $this->err_login = 1;
            }
        }
    }
}

$login = new Login($connection, $_POST['login'], $_POST['password']);

echo json_encode($login);