<?php

require 'config.php';
require 'login_chack/login_chack.php';

if ($login_chack->login_in){
    header("Location: $homepage");
    exit;
}

class Register{
    private $login;
    private $err_login;
    private $password;
    private $name;
    private $last_name;
    private $userId;
    private $userHash;
    private $loginHash;
    public $registred;

    public function __construct($connection, $name, $last_name, $login, $password){
        $this->login = mysqli_real_escape_string($connection,$login);
        $this->password = password_hash(mysqli_real_escape_string($connection,$password), PASSWORD_BCRYPT);
        $this->name = mysqli_real_escape_string($connection,$name);
        $this->last_name = mysqli_real_escape_string($connection,$last_name);

        if ($this->login != '' && $this->password != '' && $this->name != '' && $this->last_name != ''){
            $sqlQuery2 = "SELECT `login` FROM `user_log` WHERE `login` = \"$this->login\"";

            if ($sqlResult2 = mysqli_query($connection, $sqlQuery2)){
                if (mysqli_num_rows($sqlResult2) != 0){
                    $this->err_login = 1;
                }
            }
            
            if ($this->err_login == 0){
                $this->loginHash = md5($this->login . random_int(1, 10000000));
                $this->userHash = md5(random_int(1, 10000000));
                $sqlQuery = "INSERT INTO `user_log`(`name`,`lastName`,`login`,`loginHash`,`password`,`userHash`) VALUES(\"$this->name\",\"$this->last_name\", \"$this->login\", \"$this->loginHash\", \"$this->password\", \"$this->userHash\")";

                if ($sqlResult = mysqli_query($connection, $sqlQuery)){
                    $sqlQuery2 = "SELECT `id` FROM `user_log` WHERE `login` = \"$this->login\" AND `loginHash` = \"$this->loginHash\" AND `userHash` = \"$this->userHash\"";
                    if ($sqlResult = mysqli_query($connection, $sqlQuery2)){
                        $result = mysqli_fetch_array($sqlResult);
                        $this->userId = $result['id'];
                        setcookie("userId", $this->userId, time() + 2592000);
                        setcookie("userHash", $this->userHash, time() + 2592000);
                        setcookie("loginHash", $this->loginHash, time() + 2592000);
                        $this->registred = 1;
                        mysqli_close($connection);
                    }
                } else {mysqli_close($connection);}
            } else {mysqli_close($connection);}
        } else {
            $this->registred = 0;
            mysqli_close($connection);
        }
    }
}

$register = new Register($connection, $_POST['name'], $_POST['last_name'], $_POST['login'], $_POST['password']);

echo json_encode($register);