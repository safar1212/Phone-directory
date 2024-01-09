<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');


$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
  dir("Cannot connect to server");
}


if (isset($_GET['id'])) {  
   echo $id = $_GET['id'];  
    $query = "DELETE FROM `numbers` WHERE `id` = $id";  
    $run = mysqli_query($conn,$query);  
    if ($run) {  
         header('location:welcome.php');  
    }else{  
         echo "Error: ".mysqli_error($conn);  
    }  
} 

?>