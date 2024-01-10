<?php 

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}

require_once "config.php";

// Search database

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valuetosearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `numbers` WHERE CONCAT(`id`, `nameofperson`, `mobilenumber`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `numbers`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "login");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
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

<!-- navigation -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Search Box Page</a>
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

  <!-- Searchbar -->


  <form action="searchbox.php" method="post" style="margin-top: 60px; margin-bottom: 60px;">
    <div id="input">
      <input type="text" name="valuetosearch" placeholder="Search table by Name or Number" required>
      <div>
        <button type="submit" name="search">Search</button>
      </div>
    </div>


    <table  style="margin-top: 60px;">
                <tr>
                    <th>Id</th>
                    <th>Name of Person</th>
                    <th>Contact Number</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['nameofperson'];?></td>
                    <td><?php echo $row['mobilenumber'];?></td>
                </tr>
                <?php endwhile;?>
            </table>





  </form>

<!-- Table shown -->

  

  
  

</body>

</html>