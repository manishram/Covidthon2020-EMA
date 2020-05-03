<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../../index.php'));}
else{
	
	include"../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM community_health_center WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if($count==1)
{
echo"<div class='d-sm-flex justify-content-between align-items-center mb-4'>
                    <h3 class='text-dark mb-0'>Add new Primary Health Care (PHC)</h3></div>
					<center><div class='card shadow col-md-12 col-lg-6'>
                    <div class='card-header py-3'>
                        <p class='text-primary m-0 font-weight-bold'>Add New PHC</p>
					</div><div class='col-md-12 col-lg-12'>
					<form id='add_new_phc_form' class='bootstrap-form-with-validation ' style='padding:10px;'>
    <div class='form-group'><label for='name_of_phc'>Name of Primary Health Care (Under same CHC)</label><input class='form-control' type='text' id='name_of_phc'  required/></div>
	 <div class='form-group'><label for='email_of_phc'>Email of PHC ( To send generated username and password )</label><input class='form-control' type='email' id='email_of_phc' required/></div>
	 <div class='form-group'><label for='re_enter_email_of_phc'>Re-enter email of PHC</label><input class='form-control' type='email' id='re_enter_email_of_phc' required/></div>
	
	<div class='form-group'><label for='contact_of_phc'>Contact Number</label><input class='form-control' type='text' id='contact_of_phc' required /></div>
	<div class='form-group'><label for='addrs_of_phc'>Address of PHC</label><input class='form-control' type='text' id='addrs_of_phc' required /></div>
	<div class='form-group'><label for='pin_of_phc'>PIN Code of PHC</label><input class='form-control' type='text' id='pin_of_phc' required /></div>
	
	<div class='form-group'><button class='btn btn-primary' id='register_phc_btn' type='submit'>Register PHC</button></div>
   
</form> </div>
                </center></div>
					";
}
else{
	session_destroy();
	header('location: ../../../index.php');
	die();
}

}

?>
<script>


$('#register_phc_btn').click(function(){
	$.post('add_new_phc/register_new_phc/',{name:$('#name_of_phc').val(),email_1:$('#email_of_phc').val(),email_2:$('#re_enter_email_of_phc').val(),contact:$('#contact_of_phc').val(),addrs:$('#addrs_of_phc').val(),pin:$('#pin_of_phc').val()},function(output){
		if(output==1){
			alert("Successfully added and Email sent to the PHC!!");
			$('#add_new_phc_form')[0].reset();
		}else{}
	});
});
</script>