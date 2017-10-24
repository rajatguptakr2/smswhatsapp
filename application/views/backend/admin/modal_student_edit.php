<?php 
$edit_data		=	$this->db->get_where('enroll' , array(
	'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body" id="toscroll">
				
                <?php echo form_open(base_url() . 'index.php?admin/student/do_update/'.$row['student_id'].'/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'editstudentfrm', 'name' => 'editstudentfrm'));?>
                
                	
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile"  id="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					
	                <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_title');?></label>
                        
						<div class="col-sm-5">
							<?php $student_title = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->student_title; ?>
                            <select class="form-control" name="student_title" required>
								   <option value="Mr." <?php  if(isset($student_title) && $student_title!="" && $student_title=='Mr.'){ echo "selected"; } ?>>Mr.</option>
								   <option value="Mrs." <?php  if(isset($student_title) && $student_title!="" && $student_title=='Mrs.'){ echo "selected"; } ?>>Mrs.</option>
								   <option value="Ms." <?php  if(isset($student_title) && $student_title!="" && $student_title=='Ms.'){ echo "selected"; } ?>>Ms.</option>
							</select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name"  value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="class" disabled
								value="<?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
                        
						<div class="col-sm-5">
							<select name="section_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select_section');?></option>
                              <?php
                              	$sections = $this->db->get_where('section' , array('class_id' => $row['class_id']))->result_array();
                              	foreach($sections as $row2):
                              ?>
                              <option value="<?php echo $row2['section_id'];?>"
                              	<?php if($row['section_id'] == $row2['section_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('roll');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll"
								value="<?php echo $row['roll'];?>">
						</div>
					</div>
              
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
                        
						<div class="col-sm-5">
							<select name="parent_id" class="form-control select2" >
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$parents = $this->db->get('parent')->result_array();
									$parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
									foreach($parents as $row3):
										?>
                                		<option value="<?php echo $row3['parent_id'];?>"
                                        	<?php if($row3['parent_id'] == $parent_id)echo 'selected';?>>
													<?php echo $row3['name'];?>
                                                </option>
	                                <?php
									endforeach;
								  ?>
                          </select>
						</div> 
					</div>

					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="birthday" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->birthday; ?>" 
									data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
							<?php
								$gender = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->sex;
							?>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($gender == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($gender == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->address; ?>" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" 
								value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone; ?>" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email; ?>">
						<p id="exist"></p>
						</div>
					</div>
                    <div class="form-group">
				       <?php $admission_cat = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->admission_cat; ?>
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Admission_category');?></label>
						<div class="col-sm-5">
							<select id="admission_cat" class="form-control" name="admission_cat">
								<option value="">---  Select Category ---</option>
								<option value="OPEN" <?php if(isset($admission_cat) && $admission_cat!="" && $admission_cat=='OPEN'){ echo "selected"; } ?>>OPEN</option>
								<option value="ST" <?php if(isset($admission_cat) && $admission_cat!="" && $admission_cat=='ST'){ echo "selected"; } ?>>ST</option>
								<option value="NRI" <?php if(isset($admission_cat) && $admission_cat!="" && $admission_cat=='NRI'){ echo "selected"; } ?>>NRI</option>
								<option value="OBC" <?php if(isset($admission_cat) && $admission_cat!="" && $admission_cat=='OBC'){ echo "selected"; } ?>>OBC</option>
								<option value="NTSF" <?php if(isset($admission_cat) && $admission_cat!="" && $admission_cat=='NTSF'){ echo "selected"; } ?>>NTSF</option>
							</select>
						</div>
					</div> 
					<div class="form-group">
					<?php $nationality = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->nationality; ?>
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('nationality');?></label>
						<div class="col-sm-5">
							<select id="nationality" class="form-control" name="nationality">
							<option value="">--- Select Nationality ---</option>
							<option value="Indian" <?php if(isset($nationality) && $nationality!="" && $nationality=='Indian'){ echo "selected"; } ?>>Indian</option>
							<option value="Australian" <?php if(isset($nationality) && $nationality!="" && $nationality=='Australian'){ echo "selected"; } ?>>Australian</option>
							<option value="American" <?php if(isset($nationality) && $nationality!="" && $nationality=='American'){ echo "selected"; } ?>>American</option>
							<option value="Other" <?php if(isset($nationality) && $nationality!="" && $nationality=='Other'){ echo "selected"; } ?>>Other</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					<?php $student_status = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->student_status; ?>
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_status');?></label>
						<div class="col-sm-5">
							<select id="student_status" class="form-control" name="student_status">
								<option value="General/Default" <?php if(isset($student_status) && $student_status!="" && $student_status=='General/Default'){ echo "selected"; } ?>>General/Default</option>
								<option value="Rejoin" <?php if(isset($student_status) && $student_status!="" && $student_status=='Rejoin'){ echo "selected"; } ?>>Rejoin</option>
								<option value="Detain" <?php if(isset($student_status) && $student_status!="" && $student_status=='Detain'){ echo "selected"; } ?>>Detain</option>
								<option value="Pass out" <?php if(isset($student_status) && $student_status!="" && $student_status=='Pass out'){ echo "selected"; } ?>>Pass out</option>
							</select>
						</div>
					</div> 

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-5">
							<select name="dormitory_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$dorm_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->dormitory_id;
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row2):
	                              ?>
                              		<option value="<?php echo $row2['dormitory_id'];?>"
                              			<?php if($dorm_id == $row2['dormitory_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-5">
							<select name="transport_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$trans_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->transport_id; 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row2):
	                              ?>
                              		<option value="<?php echo $row2['transport_id'];?>"
                              			<?php if($trans_id == $row2['transport_id']) echo 'selected';?>><?php echo $row2['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>
					
                   <div class="form-group">
					   <?php $admission_date = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->admission_date; ?>
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('admission_date');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control datepicker" name="admission_date" value="<?php echo $admission_date; ?>" required>
						</div>
					</div>
					 
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
