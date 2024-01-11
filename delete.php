<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}


require_once "config.php";


// section for permission

function isSuperAdmin() {
     return isset($_SESSION['designation']) && $_SESSION['designation'] === 'Super Admin';
   }
   
   
   function requireAdmin() {
     if (!isSuperAdmin()) {
       header("location: accessdenied.php");
         exit();
     }
   }
   
   requireAdmin();


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