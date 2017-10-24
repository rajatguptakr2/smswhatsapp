<div class="row">
	<div class="col-md-12 addstudent">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body" id="toscroll">
                <?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'studentfrm', 'name' => 'studentfrm'));?>
				<div class="alert alert-success alert-dismissable" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Student Details Added Sucessfully. </div>
					<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-info-circle"></i>
					<?php echo get_phrase('personal_details');?>
            	</div>
				
				</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('student_id');?></label>
                        <?php $maxid = 0; $row = $this->db->query('SELECT MAX(student_id) AS `maxid` FROM `student`')->row(); ?>
							<input type="text" class="form-control" readonly name="student_logid" id="student_logid"  value="<?php if($row) { echo $maxid = $row->maxid + 1; } ?>" autofocus required>						    
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('title');?></label>                   
							<select class="form-control selectboxit" name="student_title" required>
						       <option value="Mr.">Mr.</option>
						       <option value="Mrs.">Mrs.</option>
						       <option value="Ms.">Ms.</option>
							</select>
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('name');?></label>
							<input type="text" class="form-control" name="name"  value=""  required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('gender');?></label>
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('parent_email');?></label>
							<input type="text" class="form-control" name="email" id="email"  value="">
							<p id="exist"></p>
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<!--div class="col-xs-12 col-sm-4 col-lg-4">	
				   <div class="form-group">
						<label for="field-2" class="control-label"><?php // echo get_phrase('password');?></label>
							<input type="password" class="form-control" name="password" value="" >
						</div>
					</div-->
					<div class="col-xs-12 col-sm-4 col-lg-4">	
	                <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('phone');?></label>
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
	                <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('date_of_birth');?></label>
							<input type="text" class="form-control datepicker" name="birthday" value="" >
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('admission_category');?></label>
							<select id="admission_cat" class="form-control selectboxit" name="admission_cat">
							<option value="">---  Select Category ---</option>
							<option value="OPEN">OPEN</option>
							<option value="ST">ST</option>
							<option value="NRI">NRI</option>
							<option value="OBC">OBC</option>
							<option value="NTSF">NTSF</option>
							</select>
						</div>
					</div> 
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('nationality');?></label>
							<select id="nationality" class="form-control selectboxit" name="nationality">
							<option value="">--- Select Nationality ---</option>
							<option value="Indian">Indian</option>
							<option value="Australian">Australian</option>
							<option value="American">American</option>
							<option value="Other">Other</option>
							</select>
						</div>
					</div> 
					<!--div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('parent');?></label>
							<select name="parent_id" class="form-control selectboxit" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div-->
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-info-circle"></i>
					<?php echo get_phrase('academic_details');?>
            	</div>
				</div>
					<div class="col-xs-12 col-sm-4 col-lg-4"> 	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('class');?></label>
							<select name="class_id" class="form-control selectboxit" data-validate="required" id="class_id" required onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('section');?></label>
		                        <select name="section_id" class="form-control" id="section_selector_holder" required>
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('admission_date');?></label>
							<input type="text" class="form-control datepicker" name="admission_date" value="" required>
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('roll');?></label>
							<input type="text" class="form-control" name="roll" value=""  >
						</div>
					</div>
				<div class="col-xs-12 col-sm-4 col-lg-4">	
				<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('student_status');?></label>
							<select id="student_status" class="form-control selectboxit" name="student_status">
								<option value="General/Default">General/Default</option>
								<option value="Rejoin">Rejoin</option>
								<option value="Detain">Detain</option>
								<option value="Pass out">Pass out</option>
							</select>
						</div>
					</div> 
					<!--div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('address');?></label>
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div-->
					</div>
					<!--div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('dormitory');?></label>
							<select name="dormitory_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row):
	                              ?>
                              		<option value="<?php echo $row['dormitory_id'];?>"><?php echo $row['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('transport_route');?></label>
							<select name="transport_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row):
	                              ?>
                              		<option value="<?php echo $row['transport_id'];?>"><?php echo $row['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>						
					</div-->
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">	
					<div class="col-xs-12 col-sm-4 col-lg-2">	
					<div class="form-group">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;float:left" data-trigger="fileinput">
									 <label for="field-1" class="control-label"><?php echo get_phrase('photo');?></label>
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>										
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" id="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>						
					<div class="col-xs-12 col-sm-4 col-lg-2">	
                    <div class="form-group">
							<button type="submit" class="btn btn-info top"><?php echo get_phrase('add_student');?></button>
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
    <!--div class="col-md-4">
		<blockquote class="blockquote-blue">
			<p>
				<strong>Student Admission Notes</strong>
			</p>
			<p>
				Admitting new students will automatically create an enrollment to the selected class in the running session.
				Please check and recheck the informations you have inserted because once you admit new student, you won't be able
				to edit his/her class,roll,section without promoting to the next session.
			</p>
		</blockquote>
	</div-->

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