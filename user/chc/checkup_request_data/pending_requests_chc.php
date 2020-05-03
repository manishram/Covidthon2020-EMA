
                                  
  <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
								</div>
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
                                <tbody class="pending_chc_data">
								

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
						$(document).ready(function(){
			$.post('checkup_request_data/separate_chc_pending_data.php',{},function(output){
				$('.pending_chc_data').empty();
				$('.pending_chc_data').append(output);
			});	
		});
		
		$('#choose_chc').on('change',function(){
			$.post('checkup_request_data/separate_chc_pending_data.php',{},function(output){
				$('.pending_chc_data').empty();
				$('.pending_chc_data').append(output);
		});
		});
		
						</script>