<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Examinations</div>
      <div class="panel-body">
      	<?php if(isset($error))
      	{
      	?>
      		<div style="color: red;">
      		<ul>
      			<?php
		      		foreach ($error as $item => $value)
		      			{
		      	?>
							<li>
								<?php echo $item;?>: <?php echo $value;?>
							</li>
				<?php 	} 
				?>
			</ul> 
			</div>
		<?php 			
		}
		else if (isset($upload_data))
      		{?>

      	<ul>
				<?php foreach ($upload_data as $item => $value):?>
				<li><?php echo $item;?>: <?php echo $value;?></li>
				<?php endforeach; 
			}?>
		</ul>
      	<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Exam name</th>
		        <th>Date of Conduct</th>
		        <th class="text-center">Download Question Paper</th>
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
			        <td> 
			        	<div class="col-sm-offset-2 col-sm-10 text-center">
		        			<button class="downloadPaper btn btn-success" value="<?php echo $row->file_name;?>">
		        				<i class="fa fa-download" aria-hidden="true"></i> Download
		        			</button>
		      			</div>
		      		</td>		      	
		      	</tr>
		      	<?php }?>
		    </tbody>
  		</table>
  		<hr>
  		<div class="col-sm-8 col-sm-offset-2 text-center">
  			<button type="button" class="btn btn-primary text-center" data-toggle="modal" data-target="#myModal">Add Exam</button> 		
  		</div>
  		 <!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    <!-- Trigger the modal with a button -->
  			  <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Modal Header</h4>
		        </div>
		        <div class="modal-body">
		         		<form action="<?php echo base_url().'index.php?admin/postAddOfflineExam';?>" method="post" enctype="multipart/form-data" onsubmit="return OfflineExamSubmit()";>
						  <div class="form-group">
						    <label for="name">Exam Name</label>
						    <input type="text" class="form-control" id="name" placeholder="Exam Name" name="name">
						  </div>
						  <div class="form-group">
						    <label for="date">Password</label>
						    <input type="date" class="form-control" id="date" placeholder="Date Of Exam" name="name">
						  </div>
						   <div class="form-group">
						    <input type="file" name="file_upload" class="file">
						    <div class="input-group col-sm-8 col-sm-offset-2">
						      <span class="input-group-addon"><i class="fa fa-upload" aria-hidden="true"></i></span>
						      <input type="text" class="form-control" disabled placeholder="Upload File">
						      <span class="input-group-btn">
						        <button class="browse btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i> Browse</button>
						      </span>
						    </div>
						  </div>
						  <div class="text-center">
						  	<button type="submit" class="btn btn-default">Submit</button>
						  </div>
						  <div style="color: red" id="errDiv" class="text-center"></div>
						</form>				 
				 </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>		      
		    </div>
		  </div>
  		
      </div>
    </div>   
</div>
<style type="text/css">
	.file {
  visibility: hidden;
  
}
</style>
<script type="text/javascript">
	var file = '';

	$(document).on('click', '.browse', function(){
	  file = $(this).parent().parent().parent().find('.file');
	  file.trigger('click');
	});
	$(document).on('change', '.file', function(){
	  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
	});


	function OfflineExamSubmit(){
		console.log('fdghjkl;');
		var examName = $('#name').val();
		var examDate = $('#date').val();
		
		if(examName== '' && examDate== '' &&file=='')
		{
			$('#errDiv').html('All Fields Left Empty');
			return false;
		}
		else if(examName==''||examDate== ''||file=='')
		{
			$('#errDiv').html('Fill all the fields');
			return false;
		}
		return true;
	}
	$('button.downloadPaper').click(function(event) {	
		console.log('fghjkgfdfghjk');
		download_file_name = (this).value;
		$.ajax({
			        url: '<?php echo base_url();?>index.php?admin/download_question_paper',
			        type: 'POST',
			        data: {
			            download_file_name : download_file_name
			        },
			        async: false,
			        success: function(datareturn) {
			            console.log(datareturn);
			            //document.location.href = '<?php echo base_url();?>index.php?admin/examination';
     				},
     				error: function(XMLHttpRequest, textStatus, errorThrown) {
						  alert(errorThrown);
						}
					});
});
	
</script>