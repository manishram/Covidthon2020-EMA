<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}

if(!isset($_SESSION['username'])){die(header('location: ../../index.php'));}
else{
	include"../../database/conn.php";

$username=$_SESSION['username'];
$sql = "SELECT * FROM primary_health_care WHERE username='$username'";
$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if($count==1)
{$row=mysqli_fetch_array($query);


$total_case = "SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND (covid_status='POSITIVE' OR covid_status='RECOVERED' OR covid_status='DEATH')";
$query=mysqli_query($conn,$total_case);
$count_total_case=mysqli_num_rows($query);

$active_case = "SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND covid_status='POSITIVE'";
$query=mysqli_query($conn,$active_case);
$count_active_case=mysqli_num_rows($query);

$recovered_case = "SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND covid_status='RECOVERED'";
$query=mysqli_query($conn,$recovered_case);
$count_recovered_case=mysqli_num_rows($query);

$death_case = "SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND covid_status='DEATH'";
$query=mysqli_query($conn,$death_case);
$count_death_case=mysqli_num_rows($query);






$firstrowsql="SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND (covid_status='POSITIVE' OR covid_status='RECOVERED' OR covid_status='DEATH') LIMIT 1";
$query=mysqli_query($conn,$firstrowsql);
$row2=mysqli_fetch_array($query);
$time=$row2['time_created'];


$lastrowsql="SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND (covid_status='POSITIVE' OR covid_status='RECOVERED' OR covid_status='DEATH')order by id DESC LIMIT 1";
$query=mysqli_query($conn,$lastrowsql);
$row4=mysqli_fetch_array($query);
$timelast=$row4['time_created'];

$x=floor(($timelast-$time)/(24*60*60));
$z=0;
$data=array();
$timepast=0;
$time=($time+24*60*60);
$yufgu=0;
while($z<=$x){

$frere="SELECT * FROM patient_record WHERE phc='$row[phc_id]' AND (covid_status='POSITIVE' OR covid_status='RECOVERED' OR covid_status='DEATH') AND time_created<='$time' and time_created>'$timepast'";
$query=mysqli_query($conn,$frere);
$count_data_in_day=mysqli_num_rows($query);

array_push($data,($count_data_in_day));


$timepast=$time;
$time=$time+24*60*60;

$z=$z+1;
}

}
else{
	session_destroy();
	header('location: ../../index.php');
	die();
}

}





?>
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a></div>
                <div class="row">
                    <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>CONFIRMED COVID-19 CASE</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo "$count_total_case";?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-notes-medical fa-2x text-primary"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					 <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>ACTIVE COVID-19 CASE</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo "$count_active_case";?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-procedures fa-2x text-warning"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6 col-lg-3 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>RECOVERED FROM COVID-19</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo "$count_recovered_case";?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-heartbeat fa-2x text-success"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-md-6 col-lg-3 col-xl-3 mb-4">
                        <div class="card shadow border-left-danger py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>Death due to COVID-19</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo "$count_death_case";?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-user-alt-slash fa-2x text-danger"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
				
                  
                    
                    
                </div>
				
  <div class="row">
    <div class="col-sm col-lg-6 col-md-6">
     <div class="card shadow mb-4 d-flex fill-flex">
                            <div class="card-header d-flex align-items-stretchjustify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">COVID-19 Case Distribution</h6>
                               
                            </div>
                            <div class="card-body">
                                <canvas id="doughnut_case_distribution_chart">
								</canvas>
								
                               </div>
                    </div>
    </div>
   
    <div class="col-sm col-lg-6 col-md-6">
      <div class="card shadow mb-4 d-flex fill-flex">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">COVID-19 Active Cases</h6>
                               
                            </div>
                            <div class="card-body  h-100">
                                <canvas id="doughnut_case_distribution_chart_2">
								</canvas>
								
                               </div>
                    </div>
    </div>
  </div>

				
          
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Server migration<span class="float-right">20%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
                            </div>
                            <h4 class="small font-weight-bold">Sales tracking<span class="float-right">40%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                            </div>
                            <h4 class="small font-weight-bold">Customer Database<span class="float-right">60%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60%</span></div>
                            </div>
                            <h4 class="small font-weight-bold">Payout Details<span class="float-right">80%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                            </div>
                            <h4 class="small font-weight-bold">Account setup<span class="float-right">Complete!</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Todo List</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <h6 class="mb-0"><strong>Lunch meeting</strong></h6><span class="text-xs">10:30 AM</span></div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1"></label></div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <h6 class="mb-0"><strong>Lunch meeting</strong></h6><span class="text-xs">11:30 AM</span></div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-2"><label class="custom-control-label" for="formCheck-2"></label></div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <h6 class="mb-0"><strong>Lunch meeting</strong></h6><span class="text-xs">12:30 AM</span></div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-3"><label class="custom-control-label" for="formCheck-3"></label></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <p class="m-0">Primary</p>
                                    <p class="text-white-50 small m-0">#4e73df</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <p class="m-0">Success</p>
                                    <p class="text-white-50 small m-0">#1cc88a</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-info shadow">
                                <div class="card-body">
                                    <p class="m-0">Info</p>
                                    <p class="text-white-50 small m-0">#36b9cc</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-warning shadow">
                                <div class="card-body">
                                    <p class="m-0">Warning</p>
                                    <p class="text-white-50 small m-0">#f6c23e</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-danger shadow">
                                <div class="card-body">
                                    <p class="m-0">Danger</p>
                                    <p class="text-white-50 small m-0">#e74a3b</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card text-white bg-secondary shadow">
                                <div class="card-body">
                                    <p class="m-0">Secondary</p>
                                    <p class="text-white-50 small m-0">#858796</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			    <script src="../../assets/js/bs-init.js"></script>
				<div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Revenue Sources</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in" role="menu">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
								
								</div>
                                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-primary"></i>&nbsp;Direct</span><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Social</span><span class="mr-2"><i class="fas fa-circle text-info"></i>&nbsp;Refferal</span></div>
                        </div>
                    </div>
                </div>
			<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx = document.getElementById('doughnut_case_distribution_chart').getContext('2d');
var doughnut_case_distribution_chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Recovered', 'Death'],
        datasets: [{
            label: 'Cases of COVID-19',
            data: <?php echo "[$count_active_case, $count_recovered_case, $count_death_case]";?>,
            backgroundColor: [
                '#f6c23e',
				'#1cc88a',
				'#e74a3b'
				
            ],
            borderColor: [
            'white',
				'white',
				'white'
            ],
            borderWidth: 1
        }]
    },
     options: {
        legend: {
			position: 'bottom',
			pointStyle:'circle',
            display: true,
            labels: {
             usePointStyle:true,
			
				
            }
			
        }
    }
});




var ctx = document.getElementById('doughnut_case_distribution_chart_2').getContext('2d');
var doughnut_case_distribution_chart_2 = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [0,<?php $i=1; while($i<=count($data)){echo "$i,"; $i=$i+1;} ?>],
        datasets: [{
            label: 'Active Cases of COVID-19',
            data: [0,<?php $i=0; while(($i+1)<=(count($data))){echo "$data[$i],"; $i=$i+1;} ?>0],
            backgroundColor: [
                '#f6c23e6b'
				
            ],
            borderColor: [
            '#f6c23e'
            ],
            borderWidth: 1
        }]
    },
     options: {
        legend: {
			position: 'bottom',
			pointStyle:'circle',
            display: true,
            labels: {
             usePointStyle:true,
			
				
            }
			
        }
    }
});
</script>


    