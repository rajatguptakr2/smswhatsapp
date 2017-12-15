<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Examinations</div>
      <div class="panel-body">
      	<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Exam name</th>
		        <th>Date of Conduct</th>
		        <th>From</th>
		        <th>To</th>
		        <th class="text-center">Actions</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<?php 
        		foreach ($query->result() as $row)
        		{        
         		?>
         		<tr>
		      	<td><?php echo $row->name;?></td>
		        <td><?php echo $row->date;?></td>
		        <td><?php echo $row->from_time;?></td>
		        <td><?php echo $row->to_time;?></td>
		        <td class="text-center">
		        		<a href="<?php echo base_url().'index.php?admin/examinationEdit/'.$row->exam_id;?>" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i> Manage Questions</a>	
		        		<?php echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal'.$row->exam_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';?>
		                <!-- Modal -->
		                <?php echo '<div id="editModal'.$row->exam_id.'" class="modal fade" role="dialog">'; ?>
		                  <div class="modal-dialog">

		                    <!-- Modal content-->
		                    <div class="modal-content">
		                      <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal">&times;</button>
		                        <h5 class="modal-title">Edit This Exam Details</h5>
		                      </div>
		                      <div class="modal-body text-center">		                        
		                        <div>
		                        	<div class="form-horizontal">
									    <div class="form-group">
									      <label class="control-label col-sm-2" for="name">Exam Name</label>
									      <div class="col-sm-10">
									        <input type="text" class="form-control" id="name<?php echo $row->exam_id;?>" placeholder="Enter exam name" name="name" value="<?php echo $row->name;?>" required>
									      </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-2" for="doc">Date Of Conduct</label>
									      <div class="col-sm-10">          
									        <input type="date" class="form-control" id="doc<?php echo $row->exam_id;?>" placeholder="Enter password" name="doc" value="<?php echo $row->date;?>" required>
									      </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-2" for="from">From</label>
									      <div class="col-sm-10">          
									        <input type="time" class="form-control" id="from<?php echo $row->exam_id;?>" placeholder="Enter Start Time" name="from" value="<?php echo $row->from_time?>" required>
									      </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-2" for="to">To</label>
									      <div class="col-sm-10">          
									        <input type="time" class="form-control" id="to<?php echo $row->exam_id;?>" placeholder="Enter End Time" name="to"  value="<?php echo $row->to_time;?>" required>
									      </div>
									    </div>
									    <div class="form-group">        
									      <div class="col-sm-offset-2 col-sm-10">
									        <button type="submit" id="updateExam" class="btn btn-default" value='<?php echo $row->exam_id;?>'>Update</button>
									      </div>
									    </div>
							  		</div>
		                        </div>
		                      </div>
		                      <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                      </div>
		                    </div>
		                  </div>
		        		<?php echo '</div>'?>
		        		<?php echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$row->exam_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>';?>
		                <!-- Modal -->
		                <?php echo '<div id="myModal'.$row->exam_id.'" class="modal fade" role="dialog">'; ?>
		                  <div class="modal-dialog">
		                    <!-- Modal content-->
		                    <div class="modal-content">
		                      <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal">&times;</button>
		                        <h5 class="modal-title">Delete This Exam</h5>
		                      </div>
		                      <div class="modal-body text-center">
		                        Do You Want To Delete This Examination Event?
		                        <br>
		                        <div>
		                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteYes" value='.$row->exam_id.'><i class="fa fa-check" aria-hidden="true"></i> Yes</button>';?>
		                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteNo" value='.$row->exam_id.'><i class="fa fa-times" aria-hidden="true"></i> No</button>' ?>
		                        </div>
		                      </div>
		                      <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                      </div>
		                    </div>
		                  </div>
		                <?php echo '</div>'?>		        		
		      	</td>		      	
		      </tr>
		      	<?php }?>
		    </tbody>
  		</table>
  		<hr>
  		<div class="col-sm-8 col-sm-offset-2 text-center">
   			<a type="button" class="btn btn-primary" href="index.php?admin/getAddExam">Add Exam</a>
   		</div>
      </div>
    </div>   
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('button#deleteYes').click(function(event) {	
			deleteId = (this).value;
			$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/deleteExam',
				        type: 'POST',
				        data: {
				            deleteId : deleteId
				        },
				        async: false,
				        success: function(datareturn) {
				            console.log('deleted');
				            document.location.href = '<?php echo base_url();?>index.php?admin/examination';
        				},
        				error: function(XMLHttpRequest, textStatus, errorThrown) {
   						  alert(errorThrown);
  						}
   					});

		$('#myModal'+this.value).modal('toggle');
		});

		$('button#deleteNo').click(function(event) {		
			$('#myModal'+this.value).modal('toggle');
		});
		$('button#updateExam').click(function(event) {
			updateId = (this).value;
			name = $('input#name'+updateId).val();
			doc = $('input#doc'+updateId).val();
			from = $('input#from'+updateId).val();
			to = $('input#to'+updateId).val();
			console.log(from);
			$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/updateExam',
				        type: 'POST',
				        data: {
				            updateId : updateId,
				            name: name,
				            doc: doc,
				            from: from,
				            to: to,
				        },
				        async: false,
				        success: function(datareturn) {
				            console.log('updated');
				            document.location.href = '<?php echo base_url();?>index.php?admin/examination';
        				},
        				error: function(XMLHttpRequest, textStatus, errorThrown) {
   						  alert(errorThrown);
  						}
   					});
		});
		
	});

</script>