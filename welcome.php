<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
  
}

require_once "config.php";


$sql = "SELECT * FROM `numbers` ORDER BY `id`";
$result = mysqli_query($conn, $sql);

$num = mysqli_num_rows($result);



?>


<!doctype html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>PHP login system!</title>
  <link rel="stylesheet" href="welcome.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Contact List page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="addcontact.php">Add Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="searchbox.php">Search Box</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">logout</a>
        </li>
      </ul>

      <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome " . $_SESSION['username'] ?></a>
          </li>
        </ul>
      </div>


    </div>
  </nav>

  <div class="container mt-4">
    <h3 style="margin-left: 140px;"><?php echo "Welcome " . $_SESSION['designation'] ?>! Below you can find the contact list</h3>
    <hr>
  </div>


  <h3 style="margin-left: 600px;"><?php echo $num ?> records found in Database</h3>
  <hr>

  





  <table>
    <tr>
      <th>No</th>
      <th>Name of Person</th>
      <th>Mobile Number</th>
      <th>Operation</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
    <?php

    if ($num > 0) {

      while ($row = mysqli_fetch_assoc($result)) {

    ?>
        <tr>
          <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['nameofperson']; ?></td>
          <td><?php echo $row['mobilenumber']; ?></td>
          <td><a href='delete.php?id="<?php echo $row['id'] ?>"'>Delete</a></td>

        </tr>
    <?php
      }
    }
    ?>
  </table>







</body>

</html>