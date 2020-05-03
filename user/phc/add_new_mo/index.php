<form id="add_mo_form">
                <h3 class="text-dark mb-4">Add new Medical Officer to PHC</h3>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow "><img class="rounded-circle mb-3 mt-4 mo_img_preview" src="../../assets/img/avatars/default.png" width="160" height="160">
                                <div class="">
								<label for="mo_photo" class="btn btn-primary btn-sm custom-file-upload">
<input type="file"  id="mo_photo" style='display:none;'/>Chnage Photo</label>
								</div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Medical Qualification</h6>
                            </div>
                            <div class="card-body mb-4" style='padding-bottom:30px;'>
                                <div class="col">
                                                    <div class="form-group"><label for="mo_degree"><strong>Medical degree</strong></label><input class="form-control mo_degree" type="text" placeholder="MBBS" name="first_name"></div>
													 <div class="form-group"><label for="specialization"><strong>Specialization</strong></label><input class="form-control mo_spec" type="text" placeholder="Pulmonologist" name="specialization"></div>
                                                </div>
												
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Medical officer Info.</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
										                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control mo_first_name" type="text" placeholder="John" name="first_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control mo_last_name" type="text" placeholder="Doe" name="last_name"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                
                                                <div class="col">
                                                    <div class="form-group"><label for="email_1"><strong>Email Address</strong></label><input class="form-control mo_email_1" type="email" placeholder="user@example.com" name="email_1"></div>
                                                </div>
												<div class="col">
                                                    <div class="form-group"><label for="email_2"><strong>Re-enter Email</strong></label><input class="form-control mo_email_2" type="email" placeholder="user@example.com" name="email_2"></div>
                                                </div>
                                            </div>

                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Contact Details</p>
                                    </div>
                                    <div class="card-body">
                                        
                                            <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control mo_addrs" type="text" placeholder="Complete address" name="address"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="uid"><strong>Aadhar number (UID)</strong></label><input class="form-control mo_uid" type="text" placeholder="1234 5678 9101 1231" name="uid"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="contact_no"><strong>Contact Number</strong></label><input class="form-control mo_contact" type="text" placeholder="1234567890" name="contact_no"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm float-right add_mo_btn" type="submit">Add&nbsp;Medical Officer</button></div>
                                        
                                    </div>
                                </div>
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
      $('.mo_img_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$("#mo_photo").change(function() {
  readURL(this);
});
















$('body').on("click", ".add_mo_btn", function(e) {
      e.preventDefault();
      var fileInput = document.getElementById('mo_photo');
      var file = fileInput.files[0];
	  
      var formData = new FormData();
	  
      formData.append('mo_photo', file);
	  formData.append('mo_degree', $('.mo_degree').val());
formData.append('mo_spec', $('.mo_spec').val());
formData.append('mo_first_name', $('.mo_first_name').val());
formData.append('mo_last_name', $('.mo_last_name').val());
formData.append('mo_email_1', $('.mo_email_1').val());
formData.append('mo_email_2', $('.mo_email_2').val());
formData.append('mo_addrs', $('.mo_addrs').val());
formData.append('mo_uid', $('.mo_uid').val());
formData.append('mo_contact', $('.mo_contact').val());


	  
	  
	  
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
         url: "add_new_mo/add_mo_data.php",
        dataType : 'json',  
       
        success: function(output){
			
          if(output==1){
			  	$('#add_mo_form')[0].reset();
				$('.mo_img_preview').attr('src','../../assets/img/avatars/default.png');
			  alert("Successfully added to database");
		  
		  }else{alert("Error uploading data");} 
		}
       
    }); 
	  
	  
	  
     });
 






		   </script>