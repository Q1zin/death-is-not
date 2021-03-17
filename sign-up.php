<?php

require 'config.php';
require 'login_chack/login_chack.php';

if ($login_chack->login_in){
    header("Location: $homepage");
    exit;
}

class Register{
    public $login;
    public $err_login;
    public $password;
    public $name;
    // public $err_name;
    public $last_name;
    public $userId;
    public $userHash;
    public $loginHash;
    public $registred;

    public function __construct($connection, $name, $last_name, $login, $password){
        $this->login = strip_tags(trim($login));
        $this->password = password_hash(strip_tags(trim($password)), PASSWORD_BCRYPT);
        $this->name = strip_tags(trim($name));
        $this->last_name = strip_tags(trim($last_name));

        if ($this->login != '' && $this->password != '' && $this->name != '' && $this->last_name != ''){
            // $sqlQuery = "SELECT `name` FROM `user_log` WHERE `name` = \"$this->name\"";
            $sqlQuery2 = "SELECT `login` FROM `user_log` WHERE `login` = \"$this->login\"";

            // if ($sqlResult = mysqli_query($connection, $sqlQuery)){
            //     if (mysqli_num_rows($sqlResult) != 0){
            //         $this->err_name = 1;
            //     }
            // }
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
                        // header("Refresh: 0");
                        // exit;
                    }
                } else {mysqli_close($connection);}
            } else {mysqli_close($connection);}
        } else {
            $this->registred = 0;
            mysqli_close($connection);
        }

        
    }
}

$register = new Register($connection,$_POST['name'],$_POST['last_name'],$_POST['login'],$_POST['password']);
// $register = new Register($connection,34245,23542,34536261,3453724636);

echo json_encode($register);

// echo "login - " . $register->login . "<br />";
// echo "err_login - " . $register->err_login . "<br />";
// echo "password - " . $register->password . "<br />";
// echo "name - " . $register->name . "<br />";
// echo "last_name - " . $register->last_name . "<br />";
// // echo "err_name - " . $register->err_name . "<br />";
// echo "userId - " . $register->userId . "<br />";
// echo "userHash - " . $register->userHash . "<br />";
// echo "loginHash - " . $register->loginHash . "<br />";
// echo "registred - " . $register->registred . "<br />";