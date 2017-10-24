<div class="row">
	<div class="col-md-12 addstudent">
		<div class="panel panel-primary" data-collapsed="0">        	
			<div class="panel-body" id="toscroll">
                <?php echo form_open(base_url() . 'index.php?admin/student/add_guardian/'.$student_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'studentfrm', 'name' => 'studentfrm'));?>
				<div class="alert alert-success alert-dismissable" style="display:none"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Student Details Added Sucessfully. </div>
				
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-6 col-lg-6">	
					<div class="form-group">
						<label for="field-1" class="control-label"><?php echo get_phrase('name');?> <span class="error">*</span></label>
							<input type="text" class="form-control" name="name"  value=""  required>
							<input type="hidden" class="form-control" name="student_id"  value="<?php echo $student_id; ?>"  >
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-lg-6">	
                        <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('relation');?></label>
							<input type="text" class="form-control" name="relation"  value="" >
						</div>
					</div>
					
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-6 col-lg-6">	
						<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('mobile_no');?>  <span class="error">*</span></label>
								<input type="number" class="form-control" name="mobile_no" value="" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('phone_no');?></label>
								<input type="number" class="form-control" name="phone_no"  value=""  >
							</div>
						</div>
					
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-6 col-lg-6">	
						<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('qualification');?></label>
								<textarea name="qualification" id="qualification" class="form-control" ></textarea>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('occupation');?></label>
								<textarea name="occupation" id="occupation" class="form-control" ></textarea>
							</div>
						</div>
					
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-6 col-lg-6">	
						<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('income');?></label>
								<input type="number" class="form-control" name="income"  value=""  >
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('email');?> <span class="error">*</span></label>
								<input type="email" class="form-control" name="email"  value="" required  >
							</div>
						</div>
					
					
					</div>
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
						<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('home_address');?></label>
								<textarea name="home_address" id="home_address" class="form-control" ></textarea>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">
							<label for="field-2" class="control-label"><?php echo get_phrase('office_address');?></label>
								<textarea name="office_address" id="office_address" class="form-control" ></textarea>
							</div>
						</div>					
					</div>
					
					<div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
					<div class="col-xs-12 col-sm-6 col-lg-6">	
							<div class="form-group">							
								<button type="submit" class="btn btn-success">Add Guardian</button>
							</div>
						</div>
					</div>
					
					
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>    
</div>