 <form id="add_new_patient_form">
                <h3 class="text-dark mb-4">Add new Patient to Database</h3>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                           <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4 patient_img_preview" src="../../assets/img/avatars/default.png" width="160" height="155">
                                <div class="">
								<label for="patient_photo" class="btn btn-primary btn-sm custom-file-upload">
    <input type="file"  id="patient_photo" style='display:none;'/>
    Add Photo
</label>
								</div>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Medical Status</h6>
                            </div>
                            <div class="card-body mb-1" style=''>
                                <div class="col">
                                                    <div class="form-group"><label for="blood"><strong>Blood Group</strong></label>
													<select class="form-control patient_blood">
													 <option value="" disabled selected>Select Blood Group</option>
													<option value="O-">O-</option>
													<option value="O+">O+</option>
													<option value="A-">A-</option>
													<option value="A+">A+</option>
													<option value="B-">B-</option>
													<option value="B+">B+</option>
													<option value="AB-">AB-</option>
													<option value="AB+">AB+</option>
													
													
													</select>
													</div>
													 
													  
													<div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
													  <label for="covid_status"><strong>COVID-19 Status</strong></label>
													<select class="form-control patient_covid_status">
													 <option value="" disabled selected>Select COVID Status</option>
													<option value="POSITIVE">POSITIVE</option>
													<option value="NEGATIVE">NEGATIVE</option>
													<option value="QUARANTINE">QUARANTINE</option>
													</select>
													</div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
													  <label for="covid_status"><strong>Allot Medical Ofiicer</strong></label>
													<select class="form-control mo_alloted">
													 <option value="" disabled selected>Select Medical Ofiicer</option>
													<option value="mo1">MO1</option>
													<option value="mo2">MO2</option>
													<option value="mo3">MO3</option>
													</select>
													</div>
                                                </div>
                                            </div>
                                                </div>
												
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                       
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Patient Info.</p>
                                    </div>
                                    <div class="card-body">
                                       
										                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control first_name" type="text" placeholder="John" name="first_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control last_name" type="text" placeholder="Doe" name="last_name"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                
                                                <div class="col">
                                                    <div class="form-group"><label for="gender"><strong>Gender</strong></label>
													<select class="form-control patient_gender">
													 <option value="" disabled selected>Select Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Other">Other</option>
													</select>
													</div>
                                                </div>
												<div class="col">
                                                    <div class="form-group"><label for="age"><strong>Age</strong></label><input class="form-control patient_age" type="number" placeholder="25" name="age"></div>
                                                </div>
                                            </div>

                                            
                                        
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Contact Details</p>
                                    </div>
                                    <div class="card-body">
                                        
                                            <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control patient_addrs" type="text" placeholder="Complete address" name="address"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="uid"><strong>Aadhar number (UID)</strong></label><input class="form-control patient_uid" type="text" placeholder="1234 5678 9101 1231" name="uid"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="contact_no"><strong>Contact Number</strong></label><input class="form-control patient_contact" type="text" placeholder="1234567890" name="contact_no"></div>
                                                </div>
                                            </div>
                                            
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
                    </div>
					
                </div>
                
           <div class="row">
						<div class="col">
						<div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Medical Report (Optional)</p>
                                    </div>
                                    <div class="card-body">
                                        
                                            <div class="form-group"><label for="description"><strong>Description</strong></label><textarea class="form-control patient_description" type="text" placeholder="Symptoms, treatments, etc" name="description"></textarea></div>
                                           
                                            <div class="form-group"><button class="btn btn-primary btn-sm float-right add_patient_btn" type="submit">Add&nbsp;Patient Data </button></div>
                                        
                                    </div>
                                </div>
						</div>
						</div>
						</form>
						
						<script>
						function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.patient_img_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#patient_photo").change(function() {
  readURL(this);
});



			
$('body').on("click", ".add_patient_btn", function(e) {
      e.preventDefault();
      var fileInput = document.getElementById('patient_photo');
      var file = fileInput.files[0];
	  
      var formData = new FormData();
	  
      formData.append('patient_photo', file);
	  formData.append('patient_blood', $('.patient_blood').val());
	  formData.append('patient_covid_status', $('.patient_covid_status').val());
	  formData.append('mo_alloted', $('.mo_alloted').val());
	  formData.append('first_name', $('.first_name').val());
	  formData.append('last_name', $('.last_name').val());
	  formData.append('patient_gender', $('.patient_gender').val());
	  formData.append('patient_age', $('.patient_age').val());
	  formData.append('patient_addrs', $('.patient_addrs').val());
	  formData.append('patient_uid', $('.patient_uid').val());
	  formData.append('patient_contact', $('.patient_contact').val());
	  formData.append('patient_description', $('.patient_description').val());

	  
	  
	  
	  $.ajax({
  xhr: function() {
    var xhr = new window.XMLHttpRequest();

    xhr.upload.addEventListener("progress", function(evt) {
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        percentComplete = parseInt(percentComplete * 100);
        

        if (percentComplete === 100) {

	
        }

      }
    }, false);

    return xhr;
  },
        type: 'POST',               
        processData: false, 
        contentType: false,
        data: formData,
         url: "add_new_patient/add_patient_data.php",
        dataType : 'json',  
       
        success: function(output){
			
          if(output==1){
			  	$('#add_new_patient_form')[0].reset();
				$('.patient_img_preview').attr('src','../../assets/img/avatars/default.png');
			  alert("Successfully added to database");
		  
		  }else{alert("Error uploading data");} 
		}
       
    }); 
	  
	  
	  
     });
 








			</script>
						
						
						
						
						
						