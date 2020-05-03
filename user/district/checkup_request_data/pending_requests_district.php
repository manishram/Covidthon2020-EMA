
                                  
  <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0 table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
										<th>Age</th>
                                        <th>Contact</th>
                                        <th>State</th>
                                        <th>District</th>
                                        <th>Address</th>
										<th>Request Time</th>
										<th>Reporter's Mob.</th>
										<th>Description</th>
										<th>COVID STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
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
	$sql = "SELECT* FROM checkup_request WHERE district='$row[district]' AND district_confirm_status=0";
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

                                </tbody>
                                <tfoot>
								
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
						<script>
						
						</script>