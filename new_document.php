<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="" id="manage-upload">
                <!-- Hidden ID Field -->
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                <!-- Title Input -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Title</label>
                            <input type="text" class="form-control form-control-sm" name="title" value="<?php echo isset($ftitle) ? $ftitle : '' ?>">
                        </div>
                    </div>
                </div>

                <!-- Names of the Parties -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Plaintiff Name</label>
                            <input type="text" class="form-control form-control-sm" name="plaintiff_name" value="<?php echo isset($plaintiff_name) ? $plaintiff_name : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Defendant Name</label>
                            <input type="text" class="form-control form-control-sm" name="defendant_name" value="<?php echo isset($defendant_name) ? $defendant_name : '' ?>">
                        </div>
                    </div>
                </div>

                <!-- Details of the Parties (ID/Registration Number) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Plaintiff ID/Registration Number</label>
                            <input type="text" class="form-control form-control-sm" name="plaintiff_id" value="<?php echo isset($plaintiff_id) ? $plaintiff_id : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Defendant ID/Registration Number</label>
                            <input type="text" class="form-control form-control-sm" name="defendant_id" value="<?php echo isset($defendant_id) ? $defendant_id : '' ?>">
                        </div>
                    </div>
                </div>

                <!-- Contact Details -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Plaintiff Contact Details</label>
                            <input type="text" class="form-control form-control-sm" name="plaintiff_contact" value="<?php echo isset($plaintiff_contact) ? $plaintiff_contact : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Defendant Contact Details</label>
                            <input type="text" class="form-control form-control-sm" name="defendant_contact" value="<?php echo isset($defendant_contact) ? $defendant_contact : '' ?>">
                        </div>
                    </div>
                </div>

                <!-- Details of the Claim Circumstances -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Plaintiff Claim Circumstances</label>
                            <textarea name="plaintiff_claim_details" id="" cols="30" rows="5" class="form-control">
                                <?php echo isset($plaintiff_claim_details) ? $plaintiff_claim_details : '' ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Defendant Claim Circumstances</label>
                            <textarea name="defendant_claim_details" id="" cols="30" rows="5" class="form-control">
                                <?php echo isset($defendant_claim_details) ? $defendant_claim_details : '' ?>
                            </textarea>
                        </div>
                    </div>
                </div>

                <!-- Amount Claimed -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Plaintiff Amount Claimed</label>
                            <input type="number" class="form-control form-control-sm" name="plaintiff_amount" value="<?php echo isset($plaintiff_amount) ? $plaintiff_amount : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">Defendant Amount Claimed</label>
                            <input type="number" class="form-control form-control-sm" name="defendant_amount" value="<?php echo isset($defendant_amount) ? $defendant_amount : '' ?>">
                        </div>
                    </div>
                </div>

                <!-- Hidden Inputs -->
                <div id="f-inputs" class="d-none"></div>

                <!-- File Upload Section -->
                <div class="callout callout-info">
            <div id="actions" class="row">
              <div class="col-lg-6">
                <div class="btn-group w-100" id="upload_btns">
                  <span class="btn btn-success btn-flat col-sm-4 col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add files</span>
                  </span>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table table-striped files" id="previews">
              <div id="template" class="row mt-2">
                <div class="col-auto">
                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="mb-0">
                      <span class="lead" data-dz-name></span>
                      (<span data-dz-size></span>)
                    </p>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center">
                  <div class="btn-group">
                  	  <button class="btn btn-primary start d-none">
                      <i class="fas fa-upload"></i>
                      <span>Start</span>
                    </button>
                    <button  class="btn btn-danger delete">
                      <i class="fas fa-trash"></i>
                      <span>Delete</span>
                    </button>
                  </div>
                </div>
              </div>
              <div id="default-preview">
          <?php
            if(isset($file_json) && !empty($file_json)):
              foreach(json_decode($file_json) as $k => $v):
                if(is_file('assets/uploads/'.$v)):
                $_f = file_get_contents('assets/uploads/'.$v);
                $dname = explode('_', $v);
           ?>
           <div class="def-item">
            <input type="hidden" class="inp-file" name="fname[]" value="<?php echo $v ?>" data-uuid="<?php echo $k ?>">
                  <div id="" class="row mt-2 dz-processing dz-success dz-complete">
                      <div class="col-auto">
                          <span class="preview"><img src="data:," alt="" data-dz-thumbnail=""></span>
                      </div>
                      <div class="col d-flex align-items-center">
                          <p class="mb-0">
                            <span class="lead"><?php echo $dname[1] ?></span>
                            (<span><strong><?php echo filesize('assets/uploads/'.$v) ?></strong> Bytes</span>)
                          </p>
                          <strong class="error text-danger" data-dz-errormessage=""></strong>
                      </div>
                      <div class="col-4 d-flex align-items-center">
                          <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                          </div>
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-danger delete" type="button" data-uuid="<?php echo $k ?>">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                          </button>
                        </div>
                      </div>
                    </div>
              </div>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
            </div>
            </div>
          </div>
        </form>
    	</div>

        <!-- Footer -->
      <div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat bg-gradient-primary mx-2" form="manage-upload">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
  document.querySelector('.bg-gradient-secondary').addEventListener('click', () => {
    document.getElementById('manage-upload').reset();
});
document.addEventListener('click', (e) => {
    if (e.target.matches('.btn-danger.delete')) {
      var uuid = $(this).attr('data-uuid');
      var _this = $(this)
      start_load()
      if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
          var fname = $('.inp-file[data-uuid="'+uuid+'"]').val()
          $.ajax({
            url:'ajax.php?action=remove_file',
            method:'POST',
            data:{fname:fname},
            success:function(resp){
              if(resp == 1){
                $('.inp-file[data-uuid="'+uuid+'"]').remove()
                _this.closest('.def-item').remove()
                end_load()
                
              }
            }
          })
        }s
    }
});

  // $('#default-preview .delete').click(function(){
  //     var uuid = $(this).attr('data-uuid');
  //     var _this = $(this)
  //     start_load()
  //     if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
  //         var fname = $('.inp-file[data-uuid="'+uuid+'"]').val()
  //         $.ajax({
  //           url:'ajax.php?action=remove_file',
  //           method:'POST',
  //           data:{fname:fname},
  //           success:function(resp){
  //             if(resp == 1){
  //               $('.inp-file[data-uuid="'+uuid+'"]').remove()
  //               _this.closest('.def-item').remove()
  //               end_load()
                
  //             }
  //           }
  //         })
  //       }
  // })
$(function () {

  Dropzone.autoDiscover = false;
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, {
  url: "ajax.php?action=upload_file",
  maxFilesize: 100, // הגבלת גודל קובץ ל-100MB
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  acceptedFiles: 'application/pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  autoQueue: true,
  previewsContainer: "#previews",
  clickable: ".fileinput-button"
});


  myDropzone.on("addedfile", function(file) {
		    document.querySelector("#total-progress .progress-bar").style.width = "0%";
    setTimeout(function(){
    myDropzone.enqueueFile(file);
    },500)
    file.previewElement.querySelector(".delete").onclick = function() { 
		start_load()
    		if($('.inp-file[data-uuid="'+file.upload.uuid+'"]').length > 0){
    			var fname = $('.inp-file[data-uuid="'+file.upload.uuid+'"]').val()
    			$.ajax({
    				url:'ajax.php?action=remove_file',
    				method:'POST',
    				data:{fname:fname},
    				success:function(resp){
    					if(resp == 1){
    						$('.inp-file[data-uuid="'+file.upload.uuid+'"]').remove()
    						end_load()
    						myDropzone.removeFile(file);
    					}
    				}
    			})
    		}
    	 };
    myDropzone.on("error",function(resp){
  })
      myDropzone.on("totaluploadprogress", function(progress) {
  	console.log(progress)
		    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
		  });
  });

 

  myDropzone.on("sending", function(file) {
    document.querySelector("#total-progress").style.opacity = "1";
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    
  });
  myDropzone.on("success",function(file,resp){
  	if(resp){
  		resp = JSON.parse(resp)
  		if(resp.status == 1){
  			var inp = $('<input type="hidden" class="inp-file" name="fname[]" value="'+resp.fname+'" data-uuid="'+file.upload.uuid+'">')
  			$('#f-inputs').append(inp)
  		}
  	}
  })
 
 
  })
  $('#manage-upload').submit(function(e) {
    e.preventDefault(); // Prevent default form submission
    console.log("Form submission started."); // Debug log
    
    start_load(); // Start loading indicator
    console.log("Loading indicator started."); // Debug log

    // Make the AJAX request
    $.ajax({
        url: 'ajax.php?action=save_upload',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            console.log("AJAX request successful. Response:", resp); // Debug log
            
            if (resp == 1) {
                alert_toast('Data successfully saved', "success");
                console.log("Data saved successfully. Redirecting..."); // Debug log
                
                setTimeout(function() {
                    location.href = 'index.php?page=document_list';
                }, 2000);
            } else {
                console.error("Unexpected response:", resp); // Debug log
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed."); // Debug log
            console.error("Status:", status); // Log status
            console.error("Error:", error); // Log error message
            console.error("Response Text:", xhr.responseText); // Log response text
        }
    });

    console.log("AJAX request sent."); // Debug log
});

</script>