<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(
!isset($_SESSION['username']) || 
!isset($_FILES['mo_photo'])||
!isset($_POST['mo_degree'])|| $_POST['mo_degree']=="" ||
!isset($_POST['mo_spec'])|| $_POST['mo_spec']=="" ||
!isset($_POST['mo_first_name'])|| $_POST['mo_first_name']=="" ||
!isset($_POST['mo_last_name'])|| $_POST['mo_last_name']=="" ||
!isset($_POST['mo_email_1'])|| $_POST['mo_email_1']=="" ||
!isset($_POST['mo_email_2'])|| $_POST['mo_email_2']=="" ||
!isset($_POST['mo_addrs'])|| $_POST['mo_addrs']=="" ||
!isset($_POST['mo_uid'])|| $_POST['mo_uid']=="" ||
!isset($_POST['mo_contact'])|| $_POST['mo_contact']=="" ||
($_POST['mo_email_1']!=$_POST['mo_email_1'])
){die(header('location: ../../../index.php'));}

else{
	
	$mo_degree=htmlentities(stripslashes(trim($_POST['mo_degree'])));
	$mo_spec=htmlentities(stripslashes(trim($_POST['mo_spec'])));
	$mo_first_name=htmlentities(stripslashes(trim($_POST['mo_first_name'])));
	$mo_last_name=htmlentities(stripslashes(trim($_POST['mo_last_name'])));
	$mo_email_1=htmlentities(stripslashes(trim($_POST['mo_email_1'])));
	$mo_email_2=htmlentities(stripslashes(trim($_POST['mo_email_2'])));
	$mo_addrs=htmlentities(stripslashes(trim($_POST['mo_addrs'])));
	$mo_uid=htmlentities(stripslashes(trim($_POST['mo_uid'])));
	$mo_contact=htmlentities(stripslashes(trim($_POST['mo_contact'])));
	
	$mo_email=htmlentities(stripslashes(trim($_POST['mo_email_1'])));
	$full_name=$mo_first_name." ".$mo_last_name;
	
	
	
	include"../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM primary_health_care WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);

$district=$row['district'];
$state=$row['state'];
$chc_id=$row['chc'];
$phc_id=$row['phc_id'];

if($count==1)
{
	
	do{
	$mo_id="MO_".strtoupper($district).'_'.rand(100000,99999999).time();
	$sql = "SELECT* FROM medical_officer WHERE mo_id='$mo_id'";
    $query=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($query);
	}while($count!=0);
	
	$mo_photo='MO_IMG_'.$mo_id;
	
	
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

$mo_pass=random_str();
$time_created=time();	
$hashed_pass=md5($mo_pass);	
$mo_username=$mo_id;


$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = '../../../uploads/mo_image/'; // upload directory

if(!empty($_FILES['mo_photo']) && ($_FILES['mo_photo']['size']<2097152))
{
$img = $_FILES['mo_photo']['name'];
$tmp = $_FILES['mo_photo']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function

$mo_photo = $mo_photo.'.'.$ext;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.$mo_photo; 
if(move_uploaded_file($tmp,$path)){
		
	$sql = "INSERT INTO medical_officer (mo_id,full_name,username,password,state,district,chc,phc,contact,full_address,uid,created,mo_degree,mo_specialization,email) VALUES ('$mo_id','$full_name','$mo_username','$hashed_pass','$state','$district','$chc_id','$phc_id','$mo_contact','$mo_addrs','$mo_uid','$time_created','$mo_degree','$mo_spec','$mo_email')";
	
$query=mysqli_query($conn,$sql);
	if($query)
{
echo"1"; 
}
else{echo"0";die();}
}else{echo"0";die();}
}else{echo"0";}
}else{echo"0";}

	


	
}
else{
	session_destroy();
	die(header('location: ../../../index.php'));
}

}





?>