<?php

session_start();

include('../server/connection.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .btn-submit {
      background-color: blueviolet;
      color: #fff;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">Moon Admin</a>
  <ul class="navbar-nav ml-auto">
    <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) { ?> 
      <li class="nav-item">
        <a class="nav-link" href="logout.php?logout=1">Logout</a>
      </li>
     <?php } ?> 
  </ul>
</nav>
