<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
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


// add contact section

$nameofperson = $mobilenumber = "";
$nameofperson_err = $mobilenumber_err =  "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if name is empty
    if(empty(trim($_POST["nameofperson"]))){
        $nameofperson_err = "Name cannot be blank";
    }
    else{
        $sql = "SELECT id FROM numbers WHERE nameofperson = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_nameofperson);

            // Set the value of param name
            $param_nameofperson = trim($_POST['nameofperson']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $nameofperson_err = "This name is already taken. Add extra words to diffrenciate both numbers"; 
                }
                else{
                    $nameofperson = trim($_POST['nameofperson']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['mobilenumber']))){
    $mobilenumber_err = "mobile number cannot be blank";
}
else{
    $mobilenumber = trim($_POST['mobilenumber']);
}


// If there were no errors, go ahead and insert into the database
if(empty($nameofperson_err) && empty($mobienumber_err))
{
    $sql = "INSERT INTO numbers (nameofperson, mobilenumber) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_nameofperson, $param_mobilenumber);

        // Set these parameters
        $param_nameofperson = $nameofperson;
        $param_mobilenumber = $mobilenumber;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            // header("location: welcome.php");
            echo "Contact details added successfully";
            

        } else{
            echo "Something went wrong... could not add the contact details!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP login system!</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Add Contact Page</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="welcome.php">Contact List</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="searchbox.php">Search Box</a>
        </li>
    </ul>

  <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"></a>
      </li>
  </ul>
  </div>


  </div>
</nav>

<div class="container mt-4">
    <h3><?php echo "Welcome " . $_SESSION['designation'] ?>! Below you can add a contact list</h3>
    <hr>
  </div>

<!-- form -->

<div class="container mt-4">
<h3>Please add contact Here:</h3>
<hr>

<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Name (for example: Ali)</label>
    <input type="text" name="nameofperson" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mobile Number (for example: 03xxxxxxxxx)</label>
    <input type="number" name="mobilenumber" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile Number">
  </div>
  
  <button type="submit" class="btn btn-primary">Add</button>
</form>

</div>

  </body>
</html>