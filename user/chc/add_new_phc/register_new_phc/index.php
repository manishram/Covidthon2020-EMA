<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username']) || !isset($_POST['name']) || !isset($_POST['email_1']) || !isset($_POST['email_2']) || !isset($_POST['contact']) || !isset($_POST['addrs']) || !isset($_POST['pin']) ){die(header('location: ../../../index.php'));}

if(($_POST['email_1']!=$_POST['email_2']) || $_POST['name']=="" || $_POST['email_1']=="" || $_POST['contact']=="" || $_POST['addrs']=="" || $_POST['pin']=="" || $_POST['email_2']==""){echo"0";die();}

else{
	$name_of_phc= htmlentities(stripslashes(trim($_POST['name'])));
	$email= htmlentities(stripslashes(trim($_POST['email_1'])));
	$email_2= htmlentities(stripslashes(trim($_POST['email_2'])));
	$contact= htmlentities(stripslashes(trim($_POST['contact'])));
	$address= htmlentities(stripslashes(trim($_POST['addrs'])));
	$pin= htmlentities(stripslashes(trim($_POST['pin'])));
	include"../../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM community_health_center WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
$district=$row['district'];
$state=$row['state'];
$chc_id=$row['chc_id'];
if($count==1)
{
	
	do{
	$phc_id="PHC_".strtoupper($district).'_'.rand(100000,99999999).time();
	$sql = "SELECT * FROM primary_health_care WHERE phc_id='$phc_id'";
    $query=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($query);
	}while($count!=0);
	
	$phc_username=$phc_id;
	
	function random_str(
    $length=25,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
	return $str;
}

$phc_pass=random_str();
$time_created=time();	
$hashed_pass=md5($phc_pass);	
	
	$sql = "INSERT INTO primary_health_care (phc,phc_id,district,state,username,password,email,created,chc) VALUES ('$name_of_phc','$phc_id','$district','$state','$phc_username','$hashed_pass','$email','$time_created','$chc_id')";
$query=mysqli_query($conn,$sql);
if($query)
{
 //send email to phc to provide their username and password
echo"1"; 
}
else{echo"0";die();}
	
}
else{
	session_destroy();
	die(header('location: ../../../index.php'));
}

}





?>