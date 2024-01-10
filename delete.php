<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}


require_once "config.php";


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