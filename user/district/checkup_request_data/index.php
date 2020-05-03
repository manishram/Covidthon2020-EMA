                 <h3 class="text-dark mb-4">COVID-19 CHECKUP REQUEST</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">COVID-19 Pending Checkup Requests</p><hr><br>
						<div class="row">
						<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="pending_requests_district" value="pending_requests_district" checked>
  <label class="form-check-label" for="pending_requests_district">
    Pending Request (DISTRICT)
  </label>
</div>

<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="pending_requests_chc" value="pending_requests_chc">
  <label class="form-check-label" for="pending_requests_chc">
    Pending Request (CHC)
  </label>
</div>
<div class="form-check col">
  <input class="form-check-input" type="radio" name="exampleRadios" id="pending_requests_phc" value="pending_requests_phc">
  <label class="form-check-label" for="pending_requests_phc">
    Pending Request (PHC)
  </label>
</div>

            </div></div>
                    <div class="card-body checkup_req_data">
                        
                    </div>
                </div>

        <script>
	
		$(document).ready(function(){
			if($("#pending_requests_district").prop("checked")) {
			$.get('checkup_request_data/pending_requests_district.php',{},function(output){
				$('.checkup_req_data').empty();
				$('.checkup_req_data').append(output);
			});	
		}
			
		});	
		
		
		 $('body').delegate('#pending_requests_chc','click',function(){
			 if($("#pending_requests_chc").prop("checked")) {
			 $.get('checkup_request_data/pending_requests_chc.php',{},function(output){
				 $('.checkup_req_data').empty();
				 $('.checkup_req_data').append(output);
			 });	
		 }
		});
		 $('body').delegate('#pending_requests_phc','click',function(){
			 if($("#pending_requests_phc").prop("checked")) {
			 $.get('checkup_request_data/pending_requests_phc.php',{},function(output){
				 $('.checkup_req_data').empty();
				 $('.checkup_req_data').append(output);
			 });	
		 }
		});
		 $('body').delegate('#pending_requests_district','click',function(){
			 if($("#pending_requests_district").prop("checked")) {
			$.get('checkup_request_data/pending_requests_district.php',{},function(output){
				$('.checkup_req_data').empty();
				$('.checkup_req_data').append(output);
			});	
		}
		});
		
		
		
			
		</script>