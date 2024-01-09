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

if(!$conn){
    dir("Cannot connect to server");
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Document</title>
  <link rel="stylesheet" href="welcome.css">
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Search Box</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="welcome.php">Contact List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addcontact.php">Add Contact</a>
        </li>
      </ul>



    </div>
  </nav>


  <form action="post" style="margin-top: 60px; margin-bottom: 60px;">
    <div id="input">
      <input type="text" name="search" placeholder="Search table by Name" required>
      <div>
        <button type="submit" name="submit">Search</button>
      </div>
    </div>
  </form>

  <!-- <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name of Person</th>
        <th>Contact Number</th>
      </tr>
    </thead>
    <tbody>
      <?php
      
      if (isset($_GET['search'])) {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM numbers WHERE CONCAT(nameofperson,mobilenumber) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
          foreach ($query_run as $items) {
      ?>
            <tr>
              <td><?= $items['id']; ?></td>
              <td><?= $items['nameofperson']; ?></td>
              <td><?= $items['mobilenumber']; ?></td>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="4">No Record Found</td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table> -->


  <?php

if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `search` WHERE Name = '$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();

	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table>
			<tr>
				<th>Name</th>
				<th>Description</th>
			</tr>
			<tr>
				<td><?php echo $row->Name; ?></td>
				<td><?php echo $row->Description;?></td>
			</tr>

		</table>
  
  ?>

</body>

</html>