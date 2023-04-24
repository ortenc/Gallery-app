<?php
if(isset($_POST['submit'])){
echo "<pre>";

print_r($_FILES['file_upload']);

echo "</pre>";
}

$temp_name = $_FILES['file_upload']['tmp_name'];
$file = $_FILES['file_upload']['name'];
$directory = 'photos';

if(move_uploaded_file($temp_name,$directory . "/" . $file)){
    echo 'good job';
} else {
    echo 'smth wrong';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <form action="test_upload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="file_upload"><br><br>

        <input type="submit" name="submit">

    </form>

</body>
</html>
