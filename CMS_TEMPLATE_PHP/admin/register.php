<?php
require 'includes/header.php';

if($session->signed_in()){

    redirect('index.php');

}

if(isset($_POST['login'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){
//    print_r($_POST);exit;

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    // Method to check database user
//print_r($password);exit();
    $user_found = User::verify_user($username,$password);

    if($user_found){

        $message = "This user exists";

    } else {

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->create();
        $user_found = User::verify_user($username,$password);
        $session->login($user_found);
        redirect("index.php");
        exit;
    }
} else {

    $message = '';
    $username = '';
    $password = '';
    $first_name = '';
    $last_name = '';

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
            <label for="first_name">First Name</label>
            <input type="first_name" class="form-control" name="first_name" value="<?php echo htmlentities($first_name); ?>">

        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="last_name" class="form-control" name="last_name" value="<?php echo htmlentities($last_name); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>

        <div class="form-group">
            <input type="submit" name="login" value="login" class="btn btn-primary">

        </div>


    </form>


</div>
