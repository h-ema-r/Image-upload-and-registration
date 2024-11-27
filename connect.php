<?php

$username = "root";
$password = "admin";

$dsn="mysql:host=localhost;dbname=imageuploadproject";


try {
  // Create connection
$conn = new PDO($dsn, $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //echo "Connection successful!";

} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}