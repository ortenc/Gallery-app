<?php include("includes/header.php");
if(!$session->signed_in()){redirect("login.php");}

$users = User::find_all();
?>

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
                    Photos
                </h1>
                <a href="add_user.php" class="btn btn-primary">Add User</a>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user) :  ?>
                            <tr>
                                <td><?php echo $user->id;  ?></td>
                                <td><img src="<?php echo $user->user_image() ?>" alt="" width="200" height="100"></td>
                                <td><?php echo $user->username;  ?></td>
                                <td><?php echo $user->first_name;  ?></td>
                                <td><?php echo $user->last_name;  ?></td>
                                <td><button class="btn btn-primary" style="margin: auto;background-color: red" onclick="window.location.href='delete.php?action=delete&id=<?php echo $user->id ?>'">Delete
                                    </button>
                                <button class="btn btn-primary" style="margin: auto" onclick="window.location.href='edit_user.php?action=edit&id=<?php echo $user->id ?>'">Update
                                    </button></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
