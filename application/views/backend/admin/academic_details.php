<div class="row">
	<div class="col-md-12 addstudent">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body" id="toscroll">
                <?php echo form_open(base_url().'index.php?admin/student/do_academic_update/'.$student_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'studentfrm', 'name' => 'studentfrm'));?>
				<div class="alert alert-success alert-dismissable" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Student Details Added Sucessfully. </div>
					<div class="panel-heading">
						<div class="panel-title" >
							<i class="fa fa-info-circle"></i>
							<?php echo get_phrase('academic_details');?>
						</div>
						<?php $val = $this->db->get_where('enroll', array('student_id' => $student_id))->row(); ?>		
                        <?php $raw = $this->db->get_where('student', array('student_id' => $student_id))->row(); ?>						
				   </div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-4 col-lg-4">	
						<div class="form-group">
						 <label for="field-1" class="ontrol-label"><?php echo get_phrase('class');?></label>
							<select name="class_id" class="form-control selectboxit" data-validate="required" id="class_id" required onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                                <?php $classes = $this->db->get('class')->result_array(); 	foreach($classes as $row):		?>
                            		<option value="<?php echo $row['class_id'];?>" <?php if(isset($val->class_id) && $val->class_id!="" && $val->class_id == $row['class_id']){ echo "selected"; } ?> ><?php echo $row['name'];?></option>
                                <?php endforeach;  ?>
                              </select>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-4 col-lg-4">								
					      <div class="form-group">
						   <label for="field-2" class="control-label"><?php echo get_phrase('section');?></label>
						    <?php $section = $this->db->get_where('section', array('section_id' => $val->section_id))->result_array(); 		?>
		                        <select name="section_id" class="form-control" id="section_selector_holder" required>
								 <option value=""><?php echo get_phrase('select_class_first');?></option>
								  <?php foreach($section as $row):	?>		                           
                                    <option value="<?php echo $row['section_id'];?>" <?php if(isset($val->section_id) && $val->section_id!="" && $val->section_id == $row['section_id']){ echo "selected"; } ?> ><?php echo $row['name'];?></option>
			                       <?php endforeach;  ?>
							   </select>
			                </div>
					    </div>
						<div class="col-xs-12 col-sm-4 col-lg-4">	
						   <div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('roll_number');?></label>
								<input type="text" class="form-control" name="roll_number"  value="<?php echo $val->roll; ?>"  >
							</div>
						</div>
					</div>	
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					  <div class="col-xs-12 col-sm-4 col-lg-4">								
					      <div class="form-group">
						   <label for="field-2" class="control-label"><?php echo get_phrase('Status');?></label>						   
		                        <select name="Status" class="form-control" id="Status" required>
								 <option value="1" <?php if(isset($raw->status) && $raw->status!="" && $raw->status==1){ echo "selected"; }?>>Active</option>
								 <option value="0" <?php if(isset($raw->status) && $raw->status!="" && $raw->status==0){ echo "selected"; }?>>In-Active</option>
							   </select>
			                </div>
					    </div>					
					</div>	
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-4 col-lg-2">	
						<div class="form-group">
								<button type="submit" class="btn btn-info top"><?php echo get_phrase('update_details');?></button>
						</div>
						</div>	
						
						<div class="col-xs-12 col-sm-4 col-lg-2">	
						<div class="form-group" id="loaderimg" style="display:none">
								<img src="<?php base_url() ?>assets/images/loader-1.gif" class="top">
						</div>
						</div>							
					</div>	

					
				</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script>
$(function() { 
  $("form[name='studentfrm']").validate({    
    rules: {      
      name: "required",
      sex: "required",
      email: {
        required: true,      
        email: true
      } 
    },    
    messages: {
      name: "Please enter your full name",
      sex: "Please enter your gender",     
      email: "Please enter a valid email address"
    },    
    submitHandler: function(form) {
       var file_data = $('#userfile').prop('files')[0];
           var form_data = new FormData();
           form_data.append('userfile', file_data);
		   
		    var other_data = $('#studentfrm').serializeArray();
				$.each(other_data,function(key,input){
					form_data.append(input.name,input.value);
				});		   
           $.ajax({
            type: 'post',
            url: '<?php echo base_url() ?>index.php?admin/student/create/',
			dataType: 'text', 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
			beforeSend: function(){
				 $("#loaderimg").css("display","block");
			   },
            success: function (result) { 
			
			 var student_logid = $("#student_logid").val();
			 var stulogid = parseInt(student_logid)+1;			 
			 $("#student_logid").val(stulogid);
			 
			  $("#loaderimg").css("display","none");
              $(".alert").css("display","block");
			  $("#studentfrm")[0].reset();
			    $('html, body').animate({
                scrollTop: $("#toscroll").offset().top
            }, 2000); 
            }
          }); 
    }
  });
});

$("#email").keyup(function(){       
        var email = $('#email').val();
		var msg = {
			"email" : email
			} 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php?admin/checkEmail",          
            data: msg,                     
            success: function(data){
				if(data == 'exist'){
					$('#email').val(" ");
					$("#exist").html("Email you entered already exist. Please enter unique email address.");
					$("#exist").css("color","red");					
				} else{
					$('#exist').html(" ");
				}            
            }
        });
        });
</script>
<script type="text/javascript">

	function get_class_sections(class_id) { 

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            { 
                jQuery('#section_selector_holder').html(response);
            }
        });

    }
	
	
</script>