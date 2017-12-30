<section class="content edusec-user-profile" style="min-height: 538px;">
   <?php $val = $this->db->get_where('enroll', array('student_id' => $student_id))->row(); ?>
   <?php $row = $this->db->get_where('student', array('student_id' => $student_id))->row(); ?>
	<div class="col-lg-3 table-responsive edusec-pf-border no-padding edusecArLangCss" style="margin-bottom:15px">
	
		<div class="col-md-12 text-center">
			<img class="img-circle edusec-img-disp" src="<?php echo $this->crud_model->get_image_url('student',$row->student_id); ?>" alt="Image">		
			<div class="photo-edit">
				<a class="photo-edit-icon" href="#" title="Change Profile Picture" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></a>	
			</div>
		</div>
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Profile Picture</h4>
			  </div>
			  <form name="profilefrm" id="profilefrm" action="<?php echo base_url(); ?>index.php?admin/upload_image/<?php echo $student_id ; ?>" method="POST" enctype="multipart/form-data">
			  <div class="modal-body">
				<center><p><img class="img-circle edusec-img-disp" src="<?php echo $this->crud_model->get_image_url('student',$row->student_id); ?>" alt="Image">	</p>
				<h4>Browse a photo</h4>
				<p><input type="file" name="fileupload" id="fileupload" accept="image/gif, image/jpeg, image/png, image/jpg" ></p>
				<p></p>
				<p><input type="submit" name="upload" id="upload" value="Upload Image" class="btn btn-info"></p>
				</center>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
		<table class="table table-striped">
			<tbody><tr>
				<th>Student ID</th>
				<td><?php echo $row->student_id; ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo $row->name; ?></td>
			</tr>
			<tr>
				<th>Class</th>
				<td><?php echo $this->db->get_where('class', array('class_id' => $val->class_id))->row()->name;  ?></td>
			</tr>
			<tr>
				<th>Section</th>
				<td><?php echo $this->db->get_where('section', array('section_id' => $val->section_id))->row()->name;  ?></td>
			</tr>
			<tr>
				<th>Email ID</th>
				<td><?php echo $row->email; ?></td>
			</tr>
			<tr>
				<th>Mobile No</th>
				<td><?php echo $row->phone; ?></td>
			</tr>
			<tr>
				<th>Status</th>
			<td>
			<?php if(isset($row->status) && $row->status!="" && $row->status==1){ ?>
			<span class="label label-success">Active</span>
			<?php }else{ ?>
			<span class="label label-danger">In-Active</span>	
			<?php } ?>
			</td>
			</tr>
		</tbody></table>
	</div>
	

	<div class="col-lg-9 profile-data" >
		<ul class="nav nav-tabs responsive hidden-xs hidden-sm" id="profileTab">
			<li class="active" id="personal-tab"><a href="#personal" data-toggle="tab"><i class="fa fa-user"></i> Personal</a></li>
			<li id="academic-tab"><a href="#academic" data-toggle="tab"><i class="fa fa-book"></i> Academic</a></li>
			<li id="guardians-tab"><a href="#guardians" data-toggle="tab"><i class="fa fa-users" ></i> Guardians</a></li>
			<li id="documents-tab"><a href="#documents" data-toggle="tab"><i class="fa fa-file-text"></i> Documents</a></li>
			<!--li id="address-tab"><a href="#address" data-toggle="tab"><i class="fa fa-home"></i> Address</a></li>			
			<li id="fees-tab"><a href="#fees" data-toggle="tab"><i class="fa fa-inr"></i> Fees</a></li-->
		</ul>
		 <div id="content" class="tab-content responsive hidden-xs hidden-sm edusec-profile">
		 
				<div class="tab-pane active" id="personal">
				         <div class="row">
							   <div class="col-xs-12"> 
									  <h3 class="page-header">
									  <i class="fa fa-info-circle"></i> Personal Details
								<div class="pull-right">
									   <a id="update-data" class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>index.php?admin/personel_details/<?php echo $row->student_id; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
								</div>
								</h3>
							   </div>
						   </div>
						   
						  <div>
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								  <p>Title</p>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-6 newClass2" >
								  <p><?php echo $row->student_title; ?></p>
								</div>
								</div>
															
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Name</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->name; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Gender</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->sex; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Date of Birth</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->birthday; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Nationality</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->nationality; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Admission Category</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->admission_cat; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Admission Date</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->admission_date; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Student Status</p>							
								</div>								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->student_status; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Religion</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->religion; ?></p>							
								</div>
								
								</div>
								
						   	    <div class="col-md-12 col-sm-12 col-xs-12" >								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Bloodgroup</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->blood_group; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Birthplace</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $row->birthplace; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Address</p>							
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 newClass2" >
								 <p><?php echo $row->address; ?></p>							
								</div>
						        </div>
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Languages</p>							
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 newClass2" >
								 <p><?php echo $row->languages; ?></p>							
								</div>
						        </div>
						  </div>
				</div>
				
				<div class="tab-pane" id="academic">
					  <div class="row">
					       <div class="col-xs-12">
							  <h3 class="page-header">
							  <i class="fa fa-info-circle"></i> Academic Details
							<div class="pull-right">
			                 <a id="update-data" class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>index.php?admin/academic_details/<?php echo $row->student_id; ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
						    </div>
							</h3>
						   </div>
						   </div>
						   
						  <div>
							<div class="col-md-12 col-sm-12 col-xs-12" >
							<div class="col-sm-4 newClass" >
							  <p>Class</p>
							</div>
							<div class="col-sm-8 newClass2" >
							  <p><?php echo $this->db->get_where('class', array('class_id' => $val->class_id))->row()->name;  ?></p>
							</div>
							</div>
														
							<div class="col-md-12 col-sm-12 col-xs-12" >
							<div class="col-sm-4 newClass" >
							  <p>Section</p>
							</div>
							<div class="col-sm-8 newClass2" >
							  <p><?php echo $this->db->get_where('section', array('section_id' => $val->section_id))->row()->name;  ?></p>
							</div>
							</div>
														
							<div class="col-md-12 col-sm-12 col-xs-12" >
							<div class="col-sm-4 newClass" >
							  <p>Roll Number</p>
							</div>
							<div class="col-sm-8 newClass2" >
							  <p><?php echo $val->roll;  ?></p>
							</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12" >
							     <div class="col-md-4  newClass" >
								 <p>Active/In-Active</p>							
								</div>
								<div class="col-md-8  newClass2" >
								 <p><?php if(isset($row->status) && $row->status!="" && $row->status==1){ ?><?php echo 'Active'; }else{ echo "In-Active"; } ?></p>							
								</div>
							</div>
					  </div>
				</div>
		<style>	
.bottomcss{
	border-bottom: 1px solid orange;  
}	
/* The switch - the box around the slider */
.switchs {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switchs input {display:none;}

/* The sliders */
.sliders {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.sliders:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .sliders {
  background-color: #2196F3;
}

input:focus + .sliders {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .sliders:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.sliders.round {
  border-radius: 34px;
}

.sliders.round:before {
  border-radius: 50%;
}	
		</style>		
				<div class="tab-pane" id="guardians">
                       <div class="row">
					       <div class="col-xs-12">
							 <h3 class="page-header">
							      <i class="fa fa-info-circle"></i> Guardians Details
							<div class="pull-right">
							       <a id="update-guard-data" class="btn-sm btn btn-primary text-warning pull-right" href="<?php echo base_url(); ?>index.php?admin/guardian_details/<?php echo $row->student_id; ?>" ><i class="fa fa-plus"></i> Add Guardian</a>			                     
						    </div>
							</h3>
						   </div>
						   </div>					   
						     <?php $parents = $this->db->get_where('parent', array('rel_stuid' => $student_id))->result(); if(!empty($parents)){ $i=1; foreach($parents as $par): ?>
							 <div>
							<div class="row">
							 <div class="col-xs-12 col-md-12 col-lg-12" >
								  <h2 class="page-header edusec-border-bottom-warning"><?php echo $i."-"; echo $par->name; ?>
	
								<div class="pull-right" >
								  <a href="#myModal2<?php echo $par->parent_id; ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
								  
<div id="myModal2<?php echo $par->parent_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Guardian : <?php echo $row->name; ?></h4>
      </div>
	  <form name="Guardianfrm" name="Guardianfrm" method="POST" action="<?php echo base_url();?>index.php?admin/update_guardian/<?php echo $par->parent_id; ?>/<?php echo $row->student_id; ?>">
      <div class="modal-body">
        <p class="col-xs-6">
			<label for="Name">Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo $par->name; ?>"  required>
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Relation</label>
			<input type="text" class="form-control" name="relation"  value="<?php echo $par->relation; ?>"  >
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Mobile No</label>
			<input type="text" class="form-control" name="mobile_no" value="<?php echo $par->mobile_no; ?>" required>
			<span style="color: red">* with country code</span>		
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Phone No</label>
			<input type="text" class="form-control" name="phone_no"  value="<?php echo $par->phone; ?>"  >
			<span style="color: red">* with country code</span>
		</p>
		<p class="col-xs-6">
			<label for="qualification"> Qualification</label>
			<textarea name="qualification" id="qualification" class="form-control" ><?php echo $par->qualification; ?></textarea>
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Occupation</label>
			<textarea name="occupation" id="occupation" class="form-control" ><?php echo $par->profession; ?></textarea>
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Income</label>
			<input type="number" class="form-control" name="income"  value="<?php echo $par->income; ?>"  >
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Email</label>
			<input type="email" class="form-control" name="email"  value="<?php echo $par->email; ?>" required  >
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Home Address</label>
			<textarea name="home_address" id="home_address" class="form-control" ><?php echo $par->home_address; ?></textarea>
		</p>
		<p class="col-xs-6">
			<label for="Relation"> Office Address</label>
			<textarea name="office_address" id="office_address" class="form-control" ><?php echo $par->office_address; ?></textarea>
		</p>
		
      </div>  
	  
      <div class="modal-footer" style="border-top: 0px solid #e5e5e5; ">
          <button type="submit" class="btn btn-success pull-left">Update Guardian</button>
      </div>
	  </form>
    </div>

  </div>
</div>								  
								  
								  <a href="<?php echo base_url(); ?>index.php?admin/delete_guardian/<?php echo $par->parent_id; ?>/<?php echo $row->student_id; ?>" onclick="return confirm('Are you sure you want to delete ?');" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a></span>
								</div></h2>
							 </div>
							 </div>
							 <div class="row">
							  <div class="col-xs-12 col-md-12 col-lg-12" >							  
							  <div class="pull-right edusec-stu-emg-gur" >
							   <span class="edusec-emg-ct-label">Is Emergency Contact </span>
							   
							   <?php if(isset($row->emergency_contact) && $row->emergency_contact!=""){ ?>
								 <label class="switchs">
								  <input type="radio" name="switch" id="switch<?php echo $par->parent_id; ?>" value="<?php echo $par->parent_id; ?>" <?php if($row->emergency_contact == $par->parent_id){ ?> checked <?php } ?> >
								  <div class="sliders round"></div>
								</label>
							   <?php }else{ ?>
                                <label class="switchs">
								  <input type="radio" name="switch" id="switch<?php echo $par->parent_id; ?>" value="<?php echo $par->parent_id; ?>" <?php if($i == 1){ ?> checked <?php } ?> >
								  <div class="sliders round"></div>
								</label>
							   <?php } ?>							   
							 </div>
							 
							  
							 
							 <script>
							 $("#switch<?php echo $par->parent_id; ?>").change( function(){ 
								 if (document.getElementById('switch<?php echo $par->parent_id; ?>').checked) 
									  {
										var parent_id = this.value;
										var student_id = "<?php echo $row->student_id; ?>";
										var msg = {
											'parent_id':parent_id,
											'student_id':student_id
										}
										 $.ajax({
											type: "POST",
											url: "<?php echo base_url(); ?>index.php?admin/update_emergency/"+parent_id+"/"+student_id,
											data: msg,
											success: function(result) {
												
											}
										 });
									  } 								 
							 });
							 </script>
							 </div>
							 </div>
							 
							 
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								  <p>Name</p>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-6 newClass2" >
								  <p><?php echo $par->name; ?></p>
								</div>
								</div>
															
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Relation</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->relation; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p> Occupation</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->profession; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Mobile No</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->mobile_no; ?></p>
								<!--  <span style="color: red">* with country code</span> -->							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Phone No</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->phone; ?></p>
								 <!-- <span style="color: red">* with country code</span>	 -->						
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Income</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->income; ?></p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Email</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->email; ?></p>							
								</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-xs-12" >
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p>Qualification</p>							
								</div>								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->qualification; ?></p>							
								</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" >
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								<p> Home Address</p>							
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->home_address; ?></p>							
								</div>
								
								</div>
								
						   	    <div class="col-md-12 col-sm-12 col-xs-12" >
								
								<div class="col-md-3 col-sm-3 col-xs-6 newClass" >
								 <p>Office Address</p>							
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6 newClass2" >
								 <p><?php echo $par->office_address; ?></p>							
								</div>								
								</div>
								
						  </div>
										
							 <?php $i++; endforeach; }else{ echo "<center><b>No Data Available</b></center>"; }?>							
						  					
				</div>
	<style>
.table{
	   margin-bottom: 67px;
}
.danger{
	    background: #cc2424;
    color: white;
    padding: 3px;
}	
.approved{
	background: #008d4c;
    color: white;
    padding: 3px;
}
.pending{
	background: #f39c12;
    color: white;
    padding: 3px;
}
	</style>	
		
				<div class="tab-pane" id="documents">
				         <div class="row">
							   <div class="col-xs-12"> 
									<h3 class="page-header">
									    <i class="fa fa-files-o"></i>  Uploaded Documents									
								   </h3>
							   </div>
						   </div>
						   <div class="table-responsive disp-doc">

								<table class="table table-bordered">
								<tbody><tr>
									<th class="text-center"><label for="studocs-stu_docs_category_id">Category</label></th>
									<th class="text-center"><label for="studocs-stu_docs_details">Document Details</label></th>
									<th class="text-center"><label for="studocs-stu_docs_status">Status</label></th>
									<th class="text-center " style="width: 34%;">Action</th>
								</tr>
								<?php       $this->db->where('mdoc_relid', $student_id );
											$this->db->where('mdoc_usertyp', 'S');
											$this->db->or_where('mdoc_usertyp', 'B');
											$mdocResult = $this->db->get('manage_document')->result();	
                                            foreach($mdocResult as $key => $vals){
													$mdoc_catid[] = $vals->mdoc_catid;
												 }												
								 ?>											
								<?php foreach($mdocResult as $raaw ): ?>			
								<tr>
									<td> <?php echo $raaw->mdoc_catname; ?></td>
									<td> <?php echo $raaw->mdoc_details; ?> </td>
									<td> <?php if($raaw->mdoc_status == 'P'){ echo "<span class='pending'>Pending</span>"; }elseif($raaw->mdoc_status == 'A'){ echo "<span class='approved'>Approved</span>"; }elseif($raaw->mdoc_status == 'D'){ echo "<span class='danger'>Disapproved</span>"; } ?> </td>
									<td> 
									<div class="col-lg-12 no-padding">
										<div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 no-padding">
											<div class="btn-group open">
												<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
													Action <span class="caret"></span>
												</button>
												<ul class="dropdown-menu dropdown-default pull-right" role="menu">  
													<li><a href="<?php echo base_url(); ?>index.php?admin/update_mdoc_status/<?php echo $raaw->mdoc_id; ?>/<?php echo $student_id;?>/A" >Approved </a></li>
													<li class="divider"></li>										
													<li><a href="<?php echo base_url(); ?>index.php?admin/update_mdoc_status/<?php echo $raaw->mdoc_id; ?>/<?php echo $student_id;?>/D" >Disapproved </a></li>
												 </ul>
                                           </div>
										</div>
											<div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 no-padding">
											<?php $ext = pathinfo($raaw->mdoc_file, PATHINFO_EXTENSION);  if($ext == "jpg" ||$ext == "jpeg" ||$ext == "png" |$ext == "gif") { ?>
												<a download="<?php echo "uploads/student_documents/".$raaw->mdoc_file; ?>" href="<?php echo "uploads/student_documents/".$raaw->mdoc_file; ?>" title="ImageName" class="btn-sm btn btn-block btn-primary">
													<i class="fa fa-download" ></i>
											    </a>
											<?php }else{ ?>
											   <a  href="<?php echo "uploads/student_documents/".$raaw->mdoc_file; ?>"  class="btn-sm btn btn-block btn-primary">
													<i class="fa fa-download" ></i>
											    </a>
											<?php } ?>										
											</div>
											<div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 no-padding">
											<a class="btn-sm btn btn-danger btn-block" href="<?php echo base_url(); ?>index.php?admin/delete_mdoc/<?php echo $raaw->mdoc_id; ?>/<?php echo $student_id;?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-trash-o"></i> Delete</a>		</div>
										</div>
										
										
									</td>
								</tr>
                               <?php endforeach; ?> 								
								</tbody></table></div>
						   
						   
						     <div class="row">
								  <div class="col-xs-12">
									<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
									<i class="fa fa-upload"></i> Upload Remaining Documents	     </h4>
								  </div><!-- /.col -->
							  </div>
						   
						   <div>
						   
							 <div class="col-md-12 col-sm-12 col-xs-12" >	
							 <form name="mdocfrm" id="mdocfrm" action="<?php  echo base_url(); ?>index.php?admin/upload_document" method="POST" enctype='multipart/form-data'>
                                     <?php  								 
											$this->db->where('doc_type', 'B');
											$this->db->or_where('doc_type', 'S');
											$raw = $this->db->get('doucment_category')->result();									       
                                           foreach($raw as $res):
                                            if(!in_array($res->doc_id,$mdoc_catid)){
									    ?>
							 
										<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
											<div class="col-xs-12 col-sm-4 col-lg-4">
											<div class="form-group field-studocs-stu_docs_category_id_temp-1">
												<label class="control-label" for="studocs-stu_docs_category_id_temp-1">Category</label>
												<input type="text" id="category" class="form-control" name="category[]" value="<?php echo $res->doc_name; ?>" maxlength="100" readonly=""><div class="help-block"></div>
												<input type="hidden" id="student_id" class="form-control" name="student_id" value="<?php echo $student_id; ?>" >
												<input type="hidden" id="doc_id" class="form-control" name="doc_id[]" value="<?php echo $res->doc_id; ?>" >
												<input type="hidden" id="user_type" class="form-control" name="user_type" value="S" >
												</div>	
											</div>

											<div class="col-xs-12 col-sm-4 col-lg-4">
												<div class="form-group field-studocs-stu_docs_details-1">
												<label class="control-label" for="studocs-stu_docs_details-1">Document Details</label>
												<input type="text" id="doc_details" class="form-control" name="doc_details[]" maxlength="100"><div class="help-block"></div>
												</div>    
											</div>

											<div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
												<div class="col-lg-10 col-sm-6 col-md-10">
												<div class="form-group field-studocs-stu_docs_path-1">
												<label class="control-label" for="studocs-stu_docs_path-1">Document</label>												
												<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 "><span>Browse Document</span>
												<input type="file" name="doc_fileupload[]" ></a>
												<div class="help-block"></div>
												</div>			
												</div>
											</div>
										</div>	
                                    <?php } endforeach; ?>
									<?php $total = count($mdoc_catid); $total2 = count($raw); if($total == $total2){ echo "<center>All Documents Uploaded</center>"; }else{  ?>
									<div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
												<div class="col-lg-10 col-sm-6 col-md-10">
												<div class="form-group field-studocs-stu_docs_path-1">																				
												<button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Upload</button>
												</div>			
												</div>
											</div>
									<?php } ?>
                              </form>									
								</div>
				       </div>  		
        </div>
    </div>	
</section>

<script src="<?php echo base_url(); ?>assets/js/responsive-tabs.js"></script>
<script type="text/javascript">
(function($) {
      fakewaffle.responsiveTabs(['xs', 'sm']);
  })(jQuery);
  
  </script>
	<style>
	.newClass{
		background-color: #F4F4F4;
        padding: 12px;
	}
	.newClass2{
		padding: 12px;
	}
	.col-md-12 col-sm-12 col-xs-12{
		    margin-top: 3px;

	}
	
	
	</style>
	
	