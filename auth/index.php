<?php
if(!(isset($_POST['username'])) || !(isset($_POST['password'])) || $_POST['username']=='' || $_POST['password']=='' || $_POST['level']==''){header("Location: ../index.php");}
else{
include_once("../database/conn.php");

$username=htmlentities(stripslashes(trim($_POST['username'])));
$password=md5(htmlentities(stripslashes(trim($_POST['password']))));
$level= htmlentities(stripslashes(trim($_POST['level'])));


	
$sql = "SELECT * FROM $level WHERE username='$username' AND password='$password'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if($count==1){

$row=mysqli_fetch_array($query);
    if(isset( $_SESSION['username'])){session_destroy();}
    session_start();
	$_SESSION['username']=$row['username'];
	
	echo'1';
}
else{echo '0';}
}
?>