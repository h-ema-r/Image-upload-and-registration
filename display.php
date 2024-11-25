

<?php

include 'connect.php';
// first insert iamges in database than display 

if(isset($_POST['submit'])){
 $username=$_POST['username'];
 $mobile=$_POST['mobile'];
 $image=$_FILES['file'];

//  echo $username;
//  echo '<br>';
//  echo $mobile;
//  echo '<br>';
//  print_r($image);
//  echo '<br>';

 $imagefilename=$image['name'];
//  print_r($imagefilename);
//echo '<br>';

$imagfiletemp=$image['tmp_name'];
// print_r($imagfiletemp);
// echo "<br>";

$filename_separate=explode('.',$imagefilename);
// print_r($filename_separate);
// echo '<br>';
$file_extension = strtolower($filename_separate[1]);
// print_r($file_extension);
// echo '<br>';
$file_name = strtolower($filename_separate[0]);
// print_r($file_name);


#insert data
$extension= array('jpeg','jpg','png');
if(in_array($file_extension, $extension)){
$upload_image = 'images/'.$imagefilename;
move_uploaded_file($imagfiletemp,$upload_image);

$sql ="insert into `registration` (name,mobile,image) values
('$username','$mobile','$upload_image')";

$result = mysqli_query($conn, $sql);

if($result){
    echo '<div class="alert alert-success" role="alt">
    <strong>Success</strong>Data successfully</div>';
}else{
    die(mysqli_error($conn));
}

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
    <h1 class="text-center my-4">User data</h1>
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
  $query = "SELECT * FROM `registration`";
  $result = mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $name = $row['name'];
        $image = $row['image'];
        
        echo '<tr>
      <td>'.$id.'</td>
      <td>'.$name.'</td>
      <td><img src='.$image.'></td>
    </tr>';
    }

?>


  
  </tbody>
</table>


    
</body>
</html>