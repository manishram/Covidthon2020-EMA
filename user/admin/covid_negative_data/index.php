<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../../index.php'));}
else{
	include"../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM admin WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if($count==1)
{
	$sql = "SELECT* FROM checkup_request WHERE checkup_status='NEGATIVE'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

	while($row=mysqli_fetch_array($query)){
	$time=date('d/m/Y H:i:s', $row['time']);
	
	echo"<tr>
            <td>$row[name]</td>
			<td>$row[gender]</td>
			<td>$row[age]</td>
            <td>$row[victim_contact]</td>
            <td>$row[state]</td>
            <td>$row[district]</td>
            <td>$row[address]</td>
			<td>$time</td>
			<td>$row[reporter_contact]</td>
			<td>$row[description]</td>
			<td> <p class='bg-success text-center text-white'> $row[checkup_status] </p> </td>
            </tr>";
	}
}
else{
	session_destroy();
	header('location: ../../../index.php');
	die();
}

}





?>