<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../../index.php'));}
else{
	include"../../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM primary_health_care WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
$phc=$row['phc_id'];
if($count==1)
{
	$sql = "SELECT* FROM checkup_request WHERE district='$row[district]' AND district_confirm_status='1' AND chc_confirm_status='1' AND phc_alloted='$phc'";
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
			<td>$row[chc_alloted]</td>
			<td> <p class='bg-secondary text-center text-white'> $row[checkup_status] </p> </td>
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