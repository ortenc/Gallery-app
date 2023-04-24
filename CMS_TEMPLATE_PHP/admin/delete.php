<?php
require 'includes/header.php';

//$user = new User();
//$user->id = $_SESSION['user_id'];
//$user->delete();
//$session->logout();
//redirect("login.php");

if(isset($_GET['action']) == 'delete'){

    if(empty($_GET['id'])){

        redirect("users.php");

    }

    $user = User::find_by_id($_GET['id']);

    if($user) {

        $user->delete();
        redirect("users.php");

    } else {

        redirect("users.php");

    }

}
