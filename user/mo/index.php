<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../index.php'));}
else{
	include"../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM mo WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if($count==1)
{
	$row=mysqli_fetch_array($query);
	//echo $row['username'];
	//echo"<a href='../../logout.php'>logout</a>";
	
}
else{
	session_destroy();
	header('location: ../../index.php');
	die();
}

}





?>