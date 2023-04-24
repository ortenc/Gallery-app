<?php

class Session {

    private $signed_in = false;
    public $user_id;
    public $message;

    function __construct(){

        session_start();
        $this->check_login();
        $this->check_message();

    }

    public function signed_in(){

        return $this->signed_in;

    }

    public function message($msg =''){

        if(empty($msg)){

            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);

        } else {

            $this->message = '';

        }

    }

    private function check_message(){

        if(isset($_SESSION['message'])){

            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);

        } else {

            $this->message = '';

        }

    }

    public function login($user){

        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->password = $_SESSION['password'] = $user->password;
            $this->first_name = $_SESSION['first_name'] = $user->first_name;
            $this->last_name = $_SESSION['last_name'] = $user->last_name;
            $this->signed_in = true;

        }

    }

    public function logout(){

        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;

    }

    private function check_login(){

        if(isset($_SESSION['user_id'])){

            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;

        } else {

            unset($this->user_id);
            $this->signed_in = false;

        }


    }

}

$session = new Session();
