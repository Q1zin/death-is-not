<?php

class Login_chack{
    private $loginHash;
    private $userId;
    private $userHash;
    private $privilege;
    public $user_name;
    public $login_in;
    private $login;

    function __construct($connection){
        if (isset($_COOKIE['userId']) && isset($_COOKIE['userHash']) && isset($_COOKIE['loginHash'])) {

            $settype = settype($_COOKIE['userId'], 'integer');
            $is_int = is_int($_COOKIE['userId']);

            if ($is_int && $settype && 1){                
                $user_id = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userId']))));
                $user_hash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['userHash']))));
                $login_hash = mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($_COOKIE['loginHash']))));
                $sqlQuery = "SELECT `name`, `privilege`, `login` FROM `user_log` WHERE `loginHash` = '$login_hash' AND `userHash` = '$user_hash' AND `id` = '$user_id' LIMIT 1";

            if ($sqlResult = mysqli_query($connection, $sqlQuery)){
                if (mysqli_num_rows($sqlResult) > 0) {
                    $result = mysqli_fetch_array($sqlResult);
                    $this->user_name = $result['name'];
                    $this->privilege = $result['privilege'];
                    $this->login = $result['login'];
                    $this->login_in = true;
                } else {
                    $this->login_in = false;
                    setcookie("userId", '', time() - 300);
                    setcookie("userHash", '', time() - 300);
                    setcookie("loginHash", '', time() - 300);
                }
            } else {
                $this->login_in = false;
                setcookie("userId", '', time() - 300);
                setcookie("userHash", '', time() - 300);
                setcookie("loginHash", '', time() - 300);
            }
            } else {
                $this->login_in = false;
                setcookie("userId", '', time() - 300);
                setcookie("userHash", '', time() - 300);
                setcookie("loginHash", '', time() - 300);
            }
        } else {
            $this->login_in = false;
            setcookie("userId", '', time() - 300);
            setcookie("userHash", '', time() - 300);
            setcookie("loginHash", '', time() - 300);
        }
    }



    public function get_privilege()
    {
        return $this->privilege;
    }

    public function get_login()
    {
        return $this->login;
    }

}

$login_chack = new Login_chack($connection);