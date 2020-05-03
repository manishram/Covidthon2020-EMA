  
                <h3 class="text-dark mb-4">COVID-19 VICTIMS REPORT</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">COVID-19 Affected Victims</p><hr><br>
						<div class="row">
						<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="checkup_request" value="checkup_request" checked>
  <label class="form-check-label" for="checkup_request">
    Checkup Request
  </label>
</div>
<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="covid_positive" value="positive">
  <label class="form-check-label" for="covid_positive">
    COVID +Ve
  </label>
</div>
<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="codiv_negative" value="negative">
  <label class="form-check-label" for="codiv_negative">
    COVID -Ve
  </label>
</div>
            </div></div>
                    <div class="card-body">
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
                                <tbody class="covid_data_tbody">
                                   
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
                    </div>
                </div>

        <script>
		$(document).ready(function(){
			if($("#checkup_request").prop("checked")) {
			$.get('victim_report_data/',{},function(output){
				$('.covid_data_tbody').empty();
				$('.covid_data_tbody').append(output);
			});
			}
			
			
		});
		
		$('body').delegate('#checkup_request','click',function(){
			if($("#checkup_request").prop("checked")) {
			$.get('victim_report_data/',{},function(output){
				$('.covid_data_tbody').empty();
				$('.covid_data_tbody').append(output);
			});	
		}
		});
		
		
		$('body').delegate('#codiv_negative','click',function(){
			if($("#codiv_negative").prop("checked")) {
			$.get('covid_negative_data/',{},function(output){
				$('.covid_data_tbody').empty();
				$('.covid_data_tbody').append(output);
			});	
		}
		});
		
			
		</script>