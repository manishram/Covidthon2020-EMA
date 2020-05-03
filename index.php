<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Effort Management System</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-color: rgb(241,247,252);">
    <div class="login-clean">
        <form method="post" id="login-form">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"></div>
            <div class="form-group"><input required class="form-control" type="text" id="username" name="username" placeholder="Username"></div>
            <div class="form-group"><input required class="form-control" type="password" name="password" id='password' placeholder="Password"></div><select required class="form-control" id="level"><optgroup label="Select Level"><option value="state" selected="">State</option><option value="district">District</option><option value="community_health_center">Community Health Center</option><option value="primary_health_care">Primary Health Care</option><option value="mo">Medical Officer</option><option value="admin">Admin</option></optgroup></select>
            <div
                class="form-group"><button class="btn btn-primary btn-block" type='submit' id='login-btn' style="background-color: #0cc2aa;">Log In</button></div><a class="forgot">Forgot your username or password?</a></form>
    </div>
	
	
	
	
	
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>

 $('#login-form').submit(function(){ return false; });
 
$('#login-btn').click(function(){
	
	$.post('auth/index.php',{username:$('#username').val(), password:$('#password').val(),level:$('#level').val()},function(output)
	{
		var level=$('#level').val();
		if(output==1){
			if(level=="community_health_center"){level="chc";}
			if(level=="primary_health_care"){level="phc";}
			$(window).attr('location', "user/"+level);}
		else{alert('wrong username or password');
	}
	});
});

</script>
</html>