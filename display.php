<?php

include 'connect.php';

// First insert images in database and then display
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['file'];

    // Get image details
    $imagefilename = $image['name'];
    $imagfiletemp = $image['tmp_name'];

    // Extract file extension
    $filename_separate = explode('.', $imagefilename);
    $file_extension = strtolower($filename_separate[1]);
    $file_name = strtolower($filename_separate[0]);

    // Allowed file extensions
    $extension = array('jpeg', 'jpg', 'png');

    if (in_array($file_extension, $extension)) {
        // Upload path
        $upload_image = 'images/' . $imagefilename;

        // Move file to the designated directory
        if (move_uploaded_file($imagfiletemp, $upload_image)) {
            try {
                // Insert data into database using PDO
                $sql = $conn->prepare("INSERT INTO `registration` (name, mobile, image) VALUES (?, ?, ?)");
                $sql->bindParam(1, $username, PDO::PARAM_STR);
                $sql->bindParam(2, $mobile, PDO::PARAM_INT);
                $sql->bindParam(3, $upload_image, PDO::PARAM_STR);

                if ($sql->execute()) {
                    echo '<div class="alert alert-success" role="alert">
                            <strong>Success!</strong> Data successfully inserted.
                          </div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            <strong>Error!</strong> There was a problem inserting the data.
                          </div>';
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> There was a problem uploading the image.
                  </div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
                <strong>Error!</strong> Invalid file extension. Please upload a valid image file (jpg, jpeg, or png).
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displaying Images</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center my-4">User Data</h1>
    <div class="container mt-5 d-flex justify-content-center">
        <table class="table table-bordered w-50">
            <thead class="table-dark">
                <tr>
                    <th scope="col">S.no.</th>
                    <th scope="col">Username</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the registration table using PDO
                try {
                    $sql = $conn->prepare("SELECT * FROM `registration`");
                    $sql->execute();
                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $image = $row['image'];

                        echo '<tr>
                                <td>' . $id . '</td>
                                <td>' . $name . '</td>
                                <td><img src="' . $image . '" width="100" height="100"></td>
                              </tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="3">Error fetching data: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
