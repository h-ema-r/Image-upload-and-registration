<?php
require_once('./operations.php');
include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <h1 class="text-center my-3">Registration Form</h1>
    <div class="container d-flex justify-content-center">
        <form action="display.php" method="POST" class="w-50" enctype="multipart/form-data">
            <!-- <div class="form-group my-4">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="mobile" placeholder="Mobile" required>
            </div> -->

            <?php inputFields("Username", "username", "","text") ?>
            <?php inputFields("Mobile", "mobile", "","text") ?>
            <?php inputFields("", "file", "","file") ?>

            

            <button type="submits" class="btn-dark p-2 " name="submit">Submit</button>
        </form>

    </div>
</body>

</html>