<?php
include_once('../header.php');
include_once('config.php');
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
    <title>E-Learning Register</title>
</head>
<body>
    <div class="container">
   <div class="row">
   <?php
if(isset($_POST['register'])){
    extract($_POST);
  
    if(empty($fname)){
        $error[]="Please Enter The value is First name";
    }
    if(strlen($fname)<3){
        $error[]='first name should not be less then 3 charachers';
    }
    if(strlen($fname)>20){
        $error[]="First name Should not be Greater Then 20 Characters";
    }
    if(!preg_match("/^([a-zA-Z' ]+)$/",$fname)){
$error[]='First name is invalid';
    }

if(empty($lname)){
    $error[]='last name is Required';
}
if(strlen($lname)<3){
    $error[]='please Enter Last name using 3 Characters atleast';
}
if(strlen($lname)>20){
    $error[]='Please Enter the last name less then 20 characters atleast';
}
if(!preg_match("/^([a-zA-Z' ]+)$/",$lname)){
    $error[]='Last name is invalid';
        }
        if(strlen($username)<3){
            $error[]='please Enter username using 3 Characters atleast';
        }
        if(strlen($username)>20){
            $error[]='Please Enter the username less then 20 characters atleast';
        }
        if( !preg_match('/^[A-Za-z][A-Za-z0-9]{3,20}$/', $username) ){
            $error[]='Please Enter valid Username';
                }
                if(empty($email)){
                    $error[]='Please Enter the Email';
                }
                if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
                      $error[]='email is Invalid';
                }

                $sql="select * from register where(username='$username' or email='$email')";
                $res=mysqli_query($conn,$sql);
                // print_r($sql);
                // die('getting query');
                                              //check existing record in database
                if(mysqli_num_rows($res)>0){
                    $row=mysqli_fetch_assoc($res);
                    if($username==$row['username']){
                        $error[]='username already exist';
                    }
                    if($email==$row['email']){
                        $error[]='email already exist';
                    }
                }
                //password confirmation and password checking
                if($passwordConfirm==''){
                    $error[]='password confirmation is Required';
                }
                if($passwordConfirm != $password){
             $error[]='password and confirm password is not mached';
                }
                if(strlen($password)<5){
                    $error[]='password must have 5 characters atleast';
                }

                // insert record in database table 
                if(!isset($error)){
                $option=array("cost"=>4);
                $password=password_hash($password,PASSWORD_BCRYPT,$option);
            
                $sqlinsert = "INSERT INTO register (fname, lname, username,email,phone,password)
                VALUES ('$fname', '$lname', '$username','$email','$phone','$password')";
                
                if ($conn->query($sqlinsert) === TRUE) {
                 $done=1;
                } else {
                  $error[]='Opps : something went wrong';
                }
                
                $conn->close();
            }
}
?>
<div class="col-sm-4">
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="errmsg">&#x26A0;'.$error.'</p>';
        }
    }
    ?>
</div>

<div class="col-sm-4">
    <?php if(isset($done)){?>
        <div class="successmsg">
            <span class="spn">&#9989</span><br/><h4>You are Registered successfully</h4> <br/>
            <a href="login.php">Login here...</a>
        </div>
        <?php }else{?>
    <div class="login-form">
<form action="" method="post">
<div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php if(isset($error)){ echo $fname;} ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control" name="lname" value="<?php if(isset($error)){echo $lname;}?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" name="username" value="<?php if(isset($error)){echo $username;}?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control"  name="email" value="<?php if(isset($error)){echo $email;}?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control" name="phone" value="<?php if(isset($error)){echo $phone;}?>" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">confirm Password</label>
    <input type="password" class="form-control" name="passwordConfirm"  placeholder="Enter cnf Password">
  </div>
  <button type="submit" class="form_btn btn btn-primary" name="register">Register</button>
  <?php }?>
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