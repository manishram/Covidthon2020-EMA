<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(
!isset($_SESSION['username']) || 
!isset($_FILES['patient_photo'])||
!isset($_POST['patient_blood'])|| $_POST['patient_blood']=="" ||
!isset($_POST['patient_covid_status'])|| $_POST['patient_covid_status']=="" ||
!isset($_POST['mo_alloted'])|| $_POST['mo_alloted']=="" ||
!isset($_POST['first_name'])|| $_POST['first_name']=="" ||
!isset($_POST['last_name'])|| $_POST['last_name']=="" ||
!isset($_POST['patient_gender'])|| $_POST['patient_gender']=="" ||
!isset($_POST['patient_age'])|| $_POST['patient_age']=="" ||
!isset($_POST['patient_addrs'])|| $_POST['patient_addrs']=="" ||
!isset($_POST['patient_uid'])|| $_POST['patient_uid']=="" ||
!isset($_POST['patient_contact'])|| $_POST['patient_contact']=="" ||
!isset($_POST['patient_description'])
){die(header('location: ../../../index.php'));}

else{
	
    $patient_blood=htmlentities(stripslashes(trim($_POST['patient_blood'])));
	$patient_covid_status=htmlentities(stripslashes(trim($_POST['patient_covid_status'])));
	$mo_alloted=htmlentities(stripslashes(trim($_POST['mo_alloted'])));
	$first_name=htmlentities(stripslashes(trim($_POST['first_name'])));
	$last_name=htmlentities(stripslashes(trim($_POST['last_name'])));
	$patient_gender=htmlentities(stripslashes(trim($_POST['patient_gender'])));
	$patient_age=htmlentities(stripslashes(trim($_POST['patient_age'])));
	$patient_addrs=htmlentities(stripslashes(trim($_POST['patient_addrs'])));
	$patient_uid=htmlentities(stripslashes(trim($_POST['patient_uid'])));
	$patient_contact=htmlentities(stripslashes(trim($_POST['patient_contact'])));
	$patient_description=htmlentities(stripslashes(trim($_POST['patient_description'])));
	
	$full_name=$first_name." ".$last_name;
	
	
	
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
	$covid_id="COVID_".strtoupper($district).'_'.rand(100000,99999999).time();
	$sql = "SELECT * FROM patient_record WHERE covid_id='$covid_id'";
    $query=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($query);
	}while($count!=0);
	
	$patient_photo='PATIENT_IMG_'.$covid_id;
	
	
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

$patient_pass=random_str();
$time_created=time();	
$hashed_pass=md5($patient_pass);	
$patient_username=$covid_id;





$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = '../../../uploads/patient_image/'; // upload directory

if(!empty($_FILES['patient_photo']) && ($_FILES['patient_photo']['size']<2097152))
{
$img = $_FILES['patient_photo']['name'];
$tmp = $_FILES['patient_photo']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function

$patient_photo = $patient_photo.'.'.$ext;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.$patient_photo; 
if(move_uploaded_file($tmp,$path)){
		
	$sql = "INSERT INTO patient_record (full_name,age,state,district,chc,phc,full_address,gender,contact,victim_photo,blood_group,medical_report,covid_status,uid,covid_id,mo_alloted,username,password,time_created) VALUES ('$full_name','$patient_age','$state','$district','$chc_id','$phc_id','$patient_addrs','$patient_gender','$patient_contact','$patient_photo','$patient_blood','$patient_description','$patient_covid_status','$patient_uid','$covid_id','$mo_alloted','$patient_username','$hashed_pass','$time_created')";
	
$query=mysqli_query($conn,$sql);
	if($query)
{
   if($patient_covid_status=="QUARANTINE"){ 
   //send otp to patients if patient meddical status marked quarantine...
   }
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