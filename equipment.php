<?php

  // This acts as our controller

  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'ManCo';
  $db_port = 8889;

  // These values come from the included file above
  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  // Check for POST Request
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process New Equipment
    if(isset($_POST['newSubmit'])){
        $name = $_POST["name"];
        $cost = $_POST["cost"];
        $in_use_checkbox = $_POST["in_use"];

        if($in_use_checkbox == "on"){
          $in_use = 1;
        } else {
          $in_use = 0;
        }
        $install_date = $_POST["install_date"];

        $sql = "INSERT INTO `Assets` (`id`, `name`, `cost`, `in_use`, `install_date`) VALUES (NULL, '$name', '$cost', '$in_use', '$install_date')";

        if ($mysqli->query($sql) === TRUE) {
          $update_message = "New record created successfully";
        } else {
          $update_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Process update
    if(isset($_POST['updateSubmit'])){
      $id = $_POST["equipmentId"];
      $in_use_checkbox = $_POST["in_use"];
      if($in_use_checkbox == "on"){
        $in_use = 1;
      } else {
        $in_use = 0;
      }

      $sql = "UPDATE `Assets` SET `in_use` = '$in_use' WHERE `Assets`.`id` = $id";

      if ($mysqli->query($sql) === TRUE) {
        $update_message = "ID $id successfully updated";
      } else {
        $update_message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    // Process delete
    if(isset($_POST['deleteSubmit'])){
      $id = $_POST["equipmentId"];
      $sql = "DELETE FROM `Assets` WHERE `Assets`.`id` = $id";

      if ($mysqli->query($sql) === TRUE) {
        $update_message = "ID $id successfully deleted";
      } else {
        $update_message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }
      
  }
    
    $result = $mysqli -> query("SELECT * FROM Assets");
    $equipment = array();
    while($row = $result->fetch_assoc()) {
        array_push($equipment, $row);
    }
?>

<!-- 

The HTML can act as our template

-->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>ManCo - Equipment</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ManuCo Equipment</a>
  </div>
</nav>

<main class="container">
  <?php if(isset($update_message)){ echo '<div class="alert alert-success">'. $update_message . '</div>';} ?>

  <div class="row">
    <div class="col-sm">
    <h3>Insert New Equipment</h3>
    <form action="" method="post">
      <label for="name">Equipment Name:</label>
      <input type="text" id="name" name="name"><br>
      <label for="cost">Cost:</label>
      <input type="text" id="cost" name="cost"><br>
      <label for="in_use">In Use?</label>
      <input type="checkbox" id="in_use" name="in_use"><br>
      <label for="install_date">Install date?</label>
      <input type="date" id="install_date" name="install_date"><br>
      <input type="submit" name="newSubmit" value="Insert New Equipment">
    </form>
    </div>
    <div class="col-sm">
    <h3>Update Equipment Status</h3>
    <form action="" method="post">
      <label for="equipmentId">Equipment Id:</label>
      <input type="text" id="equipmentId" name="equipmentId"><br>
      <label for="in_use">In Use?</label>
      <input type="checkbox" id="in_use" name="in_use"><br>
      <input type="submit" name="updateSubmit" value="Update Equipment Status">
    </form>
    </div>
    <div class="col-sm">
    <h3>Delete Equipment</h3>
    <form action="" method="post">
      <label for="equipmentId">Equipment Id:</label>
      <input type="text" id="equipmentId" name="equipmentId"><br>
      <input type="submit" name="deleteSubmit" value="Delete Equipment">
    </form>
    </div>
  </div>

  <table class="table">
      <thead>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Cost</th>
        <th scope="col">In Use?</th>
        <th scope="col">Install Date</th>
      </thead>
      <tbody>
        <?php
          foreach ($equipment as $piece){
            if($piece["in_use"] > 0){
              $in_use_message = "yes";
            } else {
              $in_use_message = "no";
            }

            echo '<tr>
            <td>'.$piece["id"].'</td>
            <td>'.$piece["name"].'</td>
            <td>'.$piece["cost"].'</td>
            <td>'.$in_use_message.'</td>
            <td>'.$piece["install_date"].'</td>
            </tr>';
          }
        ?>
      </tbody>
  </table>
</main>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

      
  </body>
</html>



  <?php
  $mysqli -> close();
  ?>
