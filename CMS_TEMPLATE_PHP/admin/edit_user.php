<?php include("includes/header.php");
if (!$session->signed_in()) {
    redirect("login.php");
}

$user = new User();
$user = $user::find_by_id($_GET['id']);
$message= "";
if (isset($_POST['create'])) {

    if ($user) {

        $user->username   = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->password   = $_POST['password'];
        $user->set_file($_FILES['user_image']);

        if($user->update()) {

            $message = "User updated successfully";

        } else {

            $message = join("<br>", $user->errors);

        }

    }

}


?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php
    include("includes/top_nav.php")
    ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php
    include("includes/side_nav.php")
    ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add User
                </h1>
                <h1>
                    <?php echo $message ?>
                </h1>

                <div class="col-md-1">
                    <img src="<?php echo $user->user_image() ?>" alt="" width="200" height="100">
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="caption">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Profile Picture</label>
                            <input type="file" name="user_image" class="form-control">
                        </div>
                        <div>
                            <input type="submit" name="create" class="btn btn-primary pull-right">
                        </div>
                        <div>
                            <a href="http://localhost/gallery/CMS_TEMPLATE_PHP/admin/delete.php?action=delete&id=<?php echo $user->id ?>"><button type="button" id="elidon" class="btn btn-primary" style="margin: auto;background-color: red">Delete</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
