<?php
require 'includes/header.php';

if($session->signed_in()){

    redirect('index.php');

}

if(isset($_POST['register'])){
    header("Location: register.php");
    exit();
}


if(isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database user

    $user_found = User::verify_user($username,$password);

    if($user_found){

        $session->login($user_found);
        redirect("index.php");

    } else {

        $message = "Your pass or username is incorrect";

    }
} else {

    $message = '';
    $username = '';
    $password = '';

}

?>


<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $message; ?></h4>

<form id="login-id" action="" method="post">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>">

    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">

    </div>


    <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>

    <div class="form-group">
        <input type="submit" name="register" value="register" class="btn btn-primary">

    </div>


</form>


</div>
