<?php
include_once('config.php');
if(isset($_POST['login'])){
    $login=$_POST['login_var'];
    $password=$_POST['password'];
$query="select * from register where(username='$login' or email='$login')";
$res=mysqli_query($conn,$query);
$num_rows=mysqli_num_rows($res);
if($num_rows==1){
    $row=mysqli_fetch_assoc($res);
if(password_verify($password,$row['password'])){
    $_SESSION["login_sess"]="1";
    $_SESSION['login_email']=$row['email'];
    header("location:account.php");
}else{
    header("location:login.php?loginerror=".$login);
}
}else{
    header("location:login.php?loginerror=".$login);
}
}
?>