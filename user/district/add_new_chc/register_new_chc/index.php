<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username']) || !isset($_POST['name']) || !isset($_POST['email_1']) || !isset($_POST['email_2']) || !isset($_POST['contact']) || !isset($_POST['addrs']) || !isset($_POST['pin']) ){die(header('location: ../../../index.php'));}

if(($_POST['email_1']!=$_POST['email_2']) || $_POST['name']=="" || $_POST['email_1']=="" || $_POST['contact']=="" || $_POST['addrs']=="" || $_POST['pin']=="" || $_POST['email_2']==""){echo"0";die();}

else{
	$name_of_chc= htmlentities(stripslashes(trim($_POST['name'])));
	$email= htmlentities(stripslashes(trim($_POST['email_1'])));
	$email_2= htmlentities(stripslashes(trim($_POST['email_2'])));
	$contact= htmlentities(stripslashes(trim($_POST['contact'])));
	$address= htmlentities(stripslashes(trim($_POST['addrs'])));
	$pin= htmlentities(stripslashes(trim($_POST['pin'])));
	include"../../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM district WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
$district=$row['district'];
$state=$row['state'];
if($count==1)
{
	
	do{
	$chc_id="CHC_".strtoupper($district).'_'.rand(100000,99999999).time();
	$sql = "SELECT * FROM community_health_center WHERE chc_id='$chc_id'";
    $query=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($query);
	}while($count!=0);
	
	$chc_username=$chc_id;
	
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

$chc_pass=random_str();
$time_created=time();	
$hashed_pass=md5($chc_pass);	
	
	$sql = "INSERT INTO community_health_center (chc,chc_id,district,state,username,password,email,created) VALUES ('$name_of_chc','$chc_id','$district','$state','$chc_username','$hashed_pass','$email','$time_created')";
$query=mysqli_query($conn,$sql);
if($query)
{
 //send email to chc to provide their username and password
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