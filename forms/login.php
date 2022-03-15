<?php
include_once('../header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>E-Learning Login</title>
</head>
<body>
    <div class="container">
   <div class="row">
<div class="col-sm-4"></div>

<div class="col-sm-4">
    <div class="login-form">
<form action="login_process.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email or Username</label>
    <input type="text" class="form-control" name="login_var"  placeholder="Enter email or username">
 
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Password">
  </div>
 
  <button type="submit" class="form_btn btn btn-primary" name="login">Login</button>
</form>
</div>
</div>

<div class="col-sm-4"></div>
   </div>
   </div>
</body>
<script src="../js/jQuery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</html>