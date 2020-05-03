<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../../index.php'));}
else{
	
	include"../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM district WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
if($count==1)
{
echo"<div class='d-sm-flex justify-content-between align-items-center mb-4'>
                    <h3 class='text-dark mb-0'>Add new Community Health Center (CHC)</h3></div>
					<center><div class='card shadow col-md-12 col-lg-6'>
                    <div class='card-header py-3'>
                        <p class='text-primary m-0 font-weight-bold'>Add New CHC</p>
					</div><div class='col-md-12 col-lg-12'>
					<form id='add_new_chc_form' class='bootstrap-form-with-validation ' style='padding:10px;'>
    <div class='form-group'><label for='name_of_chc'>Name of Community Health Center ( In same District)</label><input class='form-control' type='text' id='name_of_chc'  required/></div>
	 <div class='form-group'><label for='email_of_chc'>Email of CHC ( To send generated username and password )</label><input class='form-control' type='email' id='email_of_chc' required/></div>
	 <div class='form-group'><label for='re_enter_email_of_chc'>Re-enter email of CHC</label><input class='form-control' type='email' id='re_enter_email_of_chc' required/></div>
	
	<div class='form-group'><label for='contact_of_chc'>Contact Number</label><input class='form-control' type='text' id='contact_of_chc' required /></div>
	<div class='form-group'><label for='addrs_of_chc'>Address of CHC</label><input class='form-control' type='text' id='addrs_of_chc' required /></div>
	<div class='form-group'><label for='pin_of_chc'>PIN Code of CHC</label><input class='form-control' type='text' id='pin_of_chc' required /></div>
	
	<div class='form-group'><button class='btn btn-primary' id='register_chc_btn' type='submit'>Register CHC</button></div>
   
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


$('#register_chc_btn').click(function(){
	$.post('add_new_chc/register_new_chc/',{name:$('#name_of_chc').val(),email_1:$('#email_of_chc').val(),email_2:$('#re_enter_email_of_chc').val(),contact:$('#contact_of_chc').val(),addrs:$('#addrs_of_chc').val(),pin:$('#pin_of_chc').val()},function(output){
		if(output==1){
			alert("Successfully added and Email sent to the CHC!!");
			$('#add_new_chc_form')[0].reset();
		}else{}
	});
});
</script>