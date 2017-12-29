<div class="row">
	<div class="col-md-12 addstudent">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body" id="toscroll">
                <?php echo form_open(base_url().'index.php?admin/student/do_update/'.$student_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'studentfrm', 'name' => 'studentfrm'));?>
				<div class="alert alert-success alert-dismissable" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Student Details Added Sucessfully. </div>
					<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-info-circle"></i>
					<?php echo get_phrase('personal_details');?>
            	</div>
				<?php $val = $this->db->get_where('enroll', array('student_id' => $student_id))->row(); ?>
                <?php $row = $this->db->get_where('student', array('student_id' => $student_id))->row(); ?>
				</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="ontrol-label"><?php echo get_phrase('student_id');?></label>
                        <?php  ?>
							<input type="text" class="form-control" readonly name="student_logid" id="student_logid"  value="<?php echo $row->student_logid; ?>" autofocus required>						    
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('student_title');?></label>                   
							<select class="form-control selectboxit" name="student_title" required>
						       <option value="Mr." <?php if(isset($row->student_title) && $row->student_title!="" && $row->student_title=="Mr."){ echo "selected"; } ?>>Mr.</option>
						       <option value="Mrs." <?php if(isset($row->student_title) && $row->student_title!="" && $row->student_title=="Mrs."){ echo "selected"; } ?>>Mrs.</option>
						       <option value="Ms." <?php if(isset($row->student_title) && $row->student_title!="" && $row->student_title=="Ms."){ echo "selected"; } ?>>Ms.</option>
							</select>
						</div>
					</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('name');?></label>
							<input type="text" class="form-control" name="name"  value="<?php echo $row->name; ?>"  required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('gender');?></label>
							<select name="sex" class="form-control selectboxit">
                              <option value="" ><?php echo get_phrase('select');?></option>
                              <option value="male"  <?php if(isset($row->sex) && $row->sex!="" && $row->sex=="male"){ echo "selected"; } ?>><?php echo get_phrase('male');?></option>
                              <option value="female"  <?php if(isset($row->sex) && $row->sex!="" && $row->sex=="female"){ echo "selected"; } ?>><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('email');?></label>
							<input type="text" class="form-control" name="email" id="email"  value="<?php echo $row->email; ?>">
							<p id="exist"></p>
						</div>
					</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					
					<div class="col-xs-12 col-sm-4 col-lg-4">	
	                <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('phone');?></label>
							<input type="text" class="form-control" name="phone" value="<?php echo $row->phone; ?>" >
							<span style="color: red">* with country code</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
	                <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('date_of_birth');?></label>
							<input type="text" class="form-control datepicker" name="birthday" value="<?php echo $row->birthday; ?>" >
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Admission_category');?></label>
							<select id="admission_cat" class="form-control selectboxit" name="admission_cat">
							<option value="">---  Select Category ---</option>
							<option value="OPEN" <?php if(isset($row->admission_cat) && $row->admission_cat!="" && $row->admission_cat=="OPEN"){ echo "selected"; } ?>>OPEN</option>
							<option value="ST" <?php if(isset($row->admission_cat) && $row->admission_cat!="" && $row->admission_cat=="ST"){ echo "selected"; } ?>>ST</option>
							<option value="NRI" <?php if(isset($row->admission_cat) && $row->admission_cat!="" && $row->admission_cat=="NRI"){ echo "selected"; } ?>>NRI</option>
							<option value="OBC" <?php if(isset($row->admission_cat) && $row->admission_cat!="" && $row->admission_cat=="OBC"){ echo "selected"; } ?>>OBC</option>
							<option value="NTSF" <?php if(isset($row->admission_cat) && $row->admission_cat!="" && $row->admission_cat=="NTSF"){ echo "selected"; } ?>>NTSF</option>
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
							<option value="Indian" <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Indian"){ echo "selected"; } ?>>Indian</option>
							<option value="Australian" <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Australian"){ echo "selected"; } ?>>Australian</option>
							<option value="American" <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="American"){ echo "selected"; } ?>>American</option>
							<option value="Other" <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Other"){ echo "selected"; } ?>>Other</option>
							</select>
						</div>
					</div> 
					<div class="col-xs-12 col-sm-4 col-lg-4">	
                    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('admission_date');?></label>
							<input type="text" class="form-control datepicker" name="admission_date" value="<?php echo $row->admission_date; ?>" required>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('student_status');?></label>
							<select id="student_status" class="form-control selectboxit" name="student_status">
								<option value="General/Default"  <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="General/Default"){ echo "selected"; } ?>>General/Default</option>
								<option value="Rejoin"  <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Rejoin"){ echo "selected"; } ?>>Rejoin</option>
								<option value="Detain"  <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Detain"){ echo "selected"; } ?>>Detain</option>
								<option value="Pass out"  <?php if(isset($row->nationality) && $row->nationality!="" && $row->nationality=="Pass out"){ echo "selected"; } ?>>Pass out</option>
							</select>
						</div>
					</div> 
					</div>
					
					<!--div class="col-xs-12 col-sm-12 col-lg-12 no-padding">					
					
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('dormitory');?></label>
							<select name="dormitory_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $rows):
	                              ?>
                              		<option <?php if(isset($row->dormitory_id) && $row->dormitory_id!="" && $row->dormitory_id == $rows['dormitory_id']){ echo "selected"; } ?> value="<?php echo $rows['dormitory_id'];?>"><?php echo $rows['name'];?></option>
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
	                              	foreach($transports as $rows):
	                              ?>
                              		<option <?php if(isset($row->transport_id) && $row->transport_id!="" && $row->transport_id == $rows['transport_id']){ echo "selected"; } ?> value="<?php echo $rows['transport_id'];?>"><?php echo $rows['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div>
					</div>
					
					</div-->
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">					
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('birthplace');?></label>
							<input type="text" class="form-control" name="birthplace" value="<?php echo $row->birthplace; ?>" >
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Religion');?></label>
							<input type="text" class="form-control" name="religion" value="<?php echo $row->religion; ?>" >
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-lg-4">	
					<div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('bloodgroup');?></label>
							<!--input type="text" class="form-control" name="blood_group" value="<?php echo $row->blood_group; ?>" -->
							<select id="blood_group" class="form-control" name="blood_group">
								<option value="Unknown" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="Unknown"){ echo "selected"; } ?>>Unknown</option>
								<option value="A+" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="A+"){ echo "selected"; } ?>>A+</option>
								<option value="A-" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="A-"){ echo "selected"; } ?>>A-</option>
								<option value="B+" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="B+"){ echo "selected"; } ?>>B+</option>
								<option value="B-" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="B-"){ echo "selected"; } ?>>B-</option>
								<option value="AB+" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="AB+"){ echo "selected"; } ?>>AB+</option>
								<option value="AB-" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="AB+"){ echo "selected"; } ?>>AB-</option>
								<option value="O+" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="O+"){ echo "selected"; } ?>>O+</option>
								<option value="O-" <?php if(isset($row->blood_group) && $row->blood_group!="" && $row->blood_group=="O-"){ echo "selected"; } ?>>O-</option>
								</select>
						</div>
					</div>
					
					
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">	
						<div class="col-xs-12">	
					    <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('address');?></label>
							<input type="text" class="form-control" name="address" value="<?php echo $row->address; ?>" >
						</div>
					</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">	
						<div class="col-xs-12">	
						<div class="form-group">
							<label for="languages" class="control-label"><?php echo get_phrase('languages');?></label>
								<input type="text" class="form-control" name="language" value="<?php echo $row->languages; ?>" >
							</div>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">										
						<div class="col-xs-12 col-sm-4 col-lg-2">	
						<div class="form-group">
								<button type="submit" class="btn btn-info top"><?php echo get_phrase('update_student');?></button>
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