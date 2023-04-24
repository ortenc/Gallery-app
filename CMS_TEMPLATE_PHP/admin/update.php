<?php include("includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php
    include  ("includes/top_nav.php")
    ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php
    include ("includes/side_nav.php")
    ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Update
                    <small>User</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <?php

    if(isset($_POST['submit'])){

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $id = trim($_SESSION['user_id']);

            $user = new User();
            $user->id = $id;
            $user->username = $username;
            $user->password = $password;
            $user->first_name = $first_name;
            $user->last_name = $last_name;

            if($user->update()) {
                $message =  'Update Sucessful';
            } else {
                $message =  'Update Failed';
            }

    } else {

        $message = '';
        $username = '';
        $password = '';
        $first_name = '';
        $last_name = '';

    }

    $user = new User();
    $user = $user::find_by_id($_SESSION['user_id']);
    ?>

</div>
<!-- /#page-wrapper -->
<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $message ?></h4>

    <form id="update-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($user->username); ?>">

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" value="<?php echo htmlentities($user->password); ?>">

        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="first_name" class="form-control" name="first_name" value="<?php echo htmlentities($user->first_name); ?>">

        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="last_name" class="form-control" name="last_name" value="<?php echo htmlentities($user->last_name); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="btn btn-primary">

        </div>


    </form>


</div>
<?php include("includes/footer.php"); ?>
