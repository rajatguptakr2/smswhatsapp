<hr>
<div class="row">
		<?php
			if(!empty($this->session->flashdata('Question')))
			{
				echo '<div class="alert alert-success">';
				echo $this->session->flashdata('Question');
				echo '</div>';
	
			}
		?>
	<div class="panel panel-info">
      <div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Questions</div>
      <div class="panel-body">
	      	<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Name</th>
			        <th>From</th>
			        <th>To</th>
			        <th>Date</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach ($query->result() as $row)
		        {?>        
			      <tr>
			        <td><?php echo $row->name;?></td>
			        <td><?php echo $row->from_time;?></td>
			        <td><?php echo $row->to_time;?></td>
			        <td><?php echo $row->date;?></td>
			      </tr>
			  	<?php }?>  
			    </tbody>
		  	</table>
		  	<div class="text-center">
		  		<button class="btn btn-success"  data-toggle="modal" data-target="#addMcq">
			  		<i class="fa fa-plus" aria-hidden="true"></i> Add Single Correct MCQ
			  	</button>
			  	<!-- Modal -->
				<div id="addMcq" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">ADD MCQ</h4>
				       </div>
				      <div class="modal-body">
				      	<div id="mcqQuesDiv" style="cursor: pointer;">
				      		<h4>Your Question</h4> <hr>
				        	<div  id="mcqQuestion">
				        		<textarea name="editor1"  id="mcqQuestionTextbox"></textarea>	
				        	</div>				        	
				    	</div>
				    	<br>
				    	<div class="row">
						  <div class="col-lg-6" id="no_of_options" style="cursor: pointer;" title="No of Options">
						    <div class="input-group">
						      <input type="number" min="2" id="no_of_options_input" class="form-control" placeholder="No Of Options">
						      <span class="input-group-btn">
						        <button type="button" class="btn btn-success" name="no_of_options_ok" onclick="noOfMcqOptions();">Go!</button>
						      </span>
						    </div>
						  </div>
						</div>
						<br>
						<div id="mcqOptions">
						</div>
						<br>
				    	<div id="mcqAnswerDiv" style="cursor: pointer;">
				      		<h4 >Select Answer</h4> <hr>
				      		<div id="mcqAnswer" >
				      			<div class="form-group col-sm-4 col-sm-offset-4">
								  <select class="form-control" id="mcqansweroption"></select>
								</div>
				      		</div>			        	
				    	</div>
				    	<div class="col-sm-8 col-sm-offset-2 text-center" id="submitMcqBtn">
				    		<div id="mcqQuesErrDiv" style="color: red;"></div>				    		
				    		<input type="hidden" name="mcq_exam_id" id="mcq_exam_id" value="<?php echo $exam_id;?>">
				    		<button type="button" class="btn btn-success" name="submitMcq" onclick="addMcqQues();">Submit</button>
				    	</div>			    	
				      </div>
				      <div class="modal-footer" style="border: none;">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				<button class="btn btn-success"  data-toggle="modal" data-target="#addMtoMcq">
			  		<i class="fa fa-plus" aria-hidden="true"></i> Add More Than One Correct MCQ
			  	</button>
			  	<!-- Modal -->
				<div id="addMtoMcq" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">ADD More Than One Correct MCQ</h4>
				      </div>
				      <div class="modal-body">
				      	<div id="mcqMtoQuesDiv" style="cursor: pointer;">
				      		<h4>Your Question</h4> <hr>
				        	<div  id="mcqMtoQuestion">
				        		<textarea name="editor6" id="mtoMcqQuestionTextbox"></textarea>	
				        	</div>				        	
				    	</div>
				    	<br>
				    	<div class="row">
						  <div class="col-lg-6" id="no_of_mto_options" style="cursor: pointer;" title="No of Options">
						    <div class="input-group">
						      <input type="number" min="2" id="no_of_mto_options_input" class="form-control" placeholder="No Of Options">
						      <span class="input-group-btn">
						        <button type="button" class="btn btn-success" name="no_of_mto_options_ok" onclick="noOfMtoMcqOptions();">Go!</button>
						      </span>
						    </div>
						  </div>
						</div>
						<br>
						<div id="mtoMcqOptions">
						</div>
						<br>
				    	<div id="mtoMcqAnswerDiv" style="cursor: pointer;">
				      		<h4>Select Answer</h4><hr>
				      		<div id="mtoMcqAnswer">
				      			<div class="form-group col-sm-4 col-sm-offset-4" id="mtomcqansweroption"> 				
				      			</div>
				      		</div>			        	
				    	</div>
				    	<div class="col-sm-8 col-sm-offset-2 text-center" id="submitMtoMcqBtn">
				    		<div id="mtoMcqQuesErrDiv" style="color: red;"></div>				    		
				    		<input type="hidden" name="mto_mcq_exam_id" id="mto_mcq_exam_id" value="<?php echo $exam_id;?>">
				    		<button type="button" class="btn btn-success" name="submitMtoMcq" onclick="addMtoMcqQues();">Submit</button>
				    	</div>		    	
				      </div>
				      <div class="modal-footer" style="border: none;">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				<button class="btn btn-success" data-toggle="modal" data-target="#addDesc">
			  		<i class="fa fa-plus" aria-hidden="true"></i> Add Descriptive Question
			  	</button>
				<!-- Modal -->
				<div id="addDesc" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">ADD Descriptive Question</h4>
				       </div>
				      <div class="modal-body">
				      	<div id="descQuesDiv" style="cursor: pointer;">
				      		<h4 data-toggle="collapse">Your Question</h4> <hr>
				        	<div  id="descQuestion">
				        		<textarea name="editor11" id="descQuestionTextbox"></textarea>	
				        	</div>				        	
				    	</div>
				    	<div class="submitDescBtn col-sm-8 col-sm-offset-2 text-center">
				    		<div id="descQuesErrDiv" style="color: red;"></div>
				    		<input type="hidden" name="desc_exam_id" id="desc_exam_id" value="<?php echo $exam_id;?>">	
				    		<button type="button" class="btn btn-success" name="submitDesc" onclick="addDescQues();">Submit Descriptive Question</button>
				    	</div>				    					    	
				      </div>
				      <div class="modal-footer" style="border: none;">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
		  	</div>	  	
		</div>
	</div>
	<div class="panel panel-info">
  		<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Questions Added</div>
  		<div class="panel-body">
			<div class="row text-center">
		  		<button class="btn btn-default selectQues" rel="mcq">
					Single Correct MCQ Questions
				</button>
				<button class="btn btn-default selectQues" rel="mto_mcq">
					More Than One Correct MCQ Questions
				</button>  
				<button class="btn btn-default selectQues" rel="descriptive">
					Descriptive Questions
				</button> 
		  	</div>
		  	<div class="col-sm-12 ">
			  	<div id="mcq" style="">
			  		<h2 class="text-center"> Single Correct MCQ Questions</h2>
			  		<div col-sm-10 col-sm-offset-1" id="mcqQuestions">
            				
            				<?php
            				// if($query2->num_rows() <= 0))
            				// {
            				// 	echo '<p style="color:red" class="text-center">No Question Added Yet.</p>'
            				// }
            				// else{
            				foreach ($query2->result() as $rowmcq)
    						{?>
    							<div class="thisMcq">            
			            					<fieldset class="col-md-12">    	
												<legend>#Question</legend>	
											<div class="panel panel-default">		
												<div class="panel-body">
													<p><?php echo $rowmcq->mcq;?></p>
												</div>
												<div class="panel panel-default">
												<div class="panel-body">
													<ol>
													<?php
													foreach ($rowmcq->options as $option)
									    				{?>
									    					<li>
												    			<?php echo $option->value;?>
															</li>
														<?php
														}?>
													</ol>							    						
									    		</div>
											</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-body">
													<?php 
													foreach ($rowmcq->correct_option as $correct_option_value)
									    				{?>
									    					<p><?php echo $correct_option_value->value;?></p>
														<?php
									    				}?>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-sm-8 col-sm-offset-2 text-center">
											<a href="<?php echo base_url().'index.php?admin/mcqQuestionEdit/'.$rowmcq->question_id;?>" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i>Edit</a>	
		        		
											<?php echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$rowmcq->question_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>';?>
						                <!-- Modal -->
						                <?php echo '<div id="myModal'.$rowmcq->question_id.'" class="modal fade" role="dialog">'; ?>
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
						                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteYes" value='.$rowmcq->question_id.'><i class="fa fa-check" aria-hidden="true"></i> Yes</button>';?>
						                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteNo" value='.$rowmcq->question_id.'><i class="fa fa-times" aria-hidden="true"></i> No</button>' ?>
						                        </div>
						                      </div>
						                      <div class="modal-footer">
						                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                      </div>
						                    </div>
						                  </div>
										</div>
									</fieldset>											
								</div>							
    						<?php
    						}
            				?>					
			  		</div>
			  	</div>
			  	<div id="mto_mcq" style="display: none">
			  		<h2 class="text-center"> More Than One Correct MCQ Questions</h2>
				  	<div  col-sm-10 col-sm-offset-1" id="mto_mcqQuestions">
				  		<?php
				  			// if($query4->num_rows()<=0)
         //    				{
         //    					echo '<p style="color:red" class="text-center">No Question Added Yet.</p>'
         //    				}
         //    				else{
				  			$old = '';
            				foreach ($query4->result() as $rowmtomcq)
    						{	
    							if( $old !=$rowmtomcq->question_id){
    							?>
    							<div class="thisMtoMcq">            
			            			<fieldset class="col-md-12">    	
										<legend>#Question</legend>	
										<div class="panel panel-default">		
											<div class="panel-body">
												<p><?php echo $rowmtomcq->mto_mcq;?></p>
											</div>
											<div class="panel panel-default">
												<div class="panel-body">
													<ol>
													<?php
													foreach ($rowmtomcq->optionss as $option)
									    				{?>
									    					<li>
												    			<?php echo $option->value;?>
															</li>
														<?php
														}?>
													</ol>							    						
									    		</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-body">
												<?php 
												foreach ($rowmtomcq->correct_options as $correct_option_value)
								    				{?>
								    					<p><?php echo $correct_option_value->value;?></p>
													<?php
								    				}?>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-8 col-sm-offset-2 text-center">
											<a href="<?php echo base_url().'index.php?admin/mtoMcqQuestionEdit/'.$rowmtomcq->question_id;?>" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i>Edit</a>	
		        		
											<?php echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$rowmtomcq->question_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>';?>
						                <!-- Modal -->
						                <?php echo '<div id="myModal'.$rowmtomcq->question_id.'" class="modal fade" role="dialog">'; ?>
							                <div class="modal-dialog">
							                    <div class="modal-content">
							                      <div class="modal-header">
							                        <button type="button" class="close" data-dismiss="modal">&times;</button>
							                        <h5 class="modal-title">Delete This Exam</h5>
							                      </div>
							                      <div class="modal-body text-center">
							                        Do You Want To Delete This Examination Event?
							                        <br>
							                        <div>
							                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteYes" value='.$rowmtomcq->question_id.'><i class="fa fa-check" aria-hidden="true"></i> Yes</button>';?>
							                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteNo" value='.$rowmtomcq->question_id.'><i class="fa fa-times" aria-hidden="true"></i> No</button>' ?>
							                        </div>
							                      </div>
							                      <div class="modal-footer">
							                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							                      </div>
							                    </div>
							                </div>
						              	</div>
									</fieldset>											
								</div>
    						<?php
    							}
								$old = $rowmtomcq->question_id;	
							}
            				?>	    
			  		</div> 			
				</div>  				
			  	<div id="descriptive" style="display: none">
			  		<h2 class="text-center"> Descriptive Questions</h2>
				  	<div col-sm-10 col-sm-offset-1" id="descQuestions">
				  		<?php
            				// if($query3->num_rows() <= 0)
            				// {
            				// 	echo '<p style="color:red" class="text-center">No Question Added Yet.</p>'
            				// }
            				// else{
            				foreach ($query3->result() as $rowdesc)
    						{?>
						  		<div class="thisDesc">            
		            					<fieldset class="col-md-12">    	
											<legend>#Question</legend>					
											<div class="panel panel-default">
												<div class="panel-body">
													<p><?php echo $rowdesc->descriptive;?></p>
												</div>
											</div>
											<div class="col-sm-8 col-sm-offset-2 text-center">
										<a href="<?php echo base_url().'index.php?admin/descQuestionEdit/'.$rowdesc->question_id;?>" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i>Edit</a>	
		        		
											<?php echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$rowdesc->question_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>';?>
						                <!-- Modal -->
						                <?php echo '<div id="myModal'.$rowdesc->question_id.'" class="modal fade" role="dialog">'; ?>
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
						                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteYes" value='.$rowdesc->question_id.'><i class="fa fa-check" aria-hidden="true"></i> Yes</button>';?>
						                        <?php echo '<button type="button" class="btn btn-danger"  id="deleteNo" value='.$rowdesc->question_id.'><i class="fa fa-times" aria-hidden="true"></i> No</button>' ?>
						                        </div>
						                      </div>
						                      <div class="modal-footer">
						                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                      </div>
						                    </div>
						                    </div>
						                  </div>					
										</fieldset>				
										<div class="clearfix"></div>
										
		            			</div>
		            	    <?php
		            		}
		            		?>  
				  	</div> 			
			  	</div>
			</div>
  		</div>
	</div>
	 
</div>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>
		
		$(document).ready(function(){



		$("div#mcqAnswerDiv").css("display", "none");
		$("div#submitMcqBtn").css("display", "none");
		$("div#mtoMcqAnswerDiv").css("display", "none");
		$("div#submitMtoMcqBtn").css("display", "none");
		$('[data-toggle="tooltip"]').tooltip();  
		$('button.selectQues').on('click', function(){
			var target = $(this).attr('rel');
			console.log(target);   				
				$("div#"+target).css("display", "block").siblings("div").css("display", "none");   				
		}); 
		
		$('button#deleteYes').click(function(event) {	
			deleteId = (this).value;
			var exam_id = <?php echo $exam_id;?>;
			$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/deleteQuestion',
				        type: 'POST',
				        data: {
				            deleteId : deleteId,
				        },
				        async: false,
				        success: function(datareturn) {
				            console.log(datareturn);
				             document.location.href = '<?php echo base_url();?>index.php?admin/examinationEdit/'+exam_id;
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
		
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.replace( 'editor6' );		
		CKEDITOR.replace( 'editor11' );
		});	
			
			function noOfMcqOptions(){
				var no_of_options = $('#no_of_options_input').val();
				var newdiv;
				if ($('.mcqOptInput').length) {
					$('.mcqOptInput').remove();
					$('.mcqOptionsInput').remove();
					$("div#mcqAnswerDiv").css("display", "none");	
					$("div#submitMcqBtn").css("display", "none");	
					}
				var j;

				$('#mcqansweroption').append('<option class="mcqOptionsInput">Enter Choice</option>');

			    for(var i = 0; i < no_of_options; i++) {
			    	j=i+1;
			        newMcqOptdiv = $('<div id="mcqOpt'+j+'Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option" class="mcqOptInput"><h4 data-toggle="collapse" data-target="#mcqOpt'+j+'">Option '+j+'</h4><hr><div  id="mcqOpt'+j+'" class="collapse"><textarea name="mcqOptEditor'+j+'" id="mcqOpt'+j+'Textbox"></textarea></div></div>');
			        $('#mcqOptions').append(newMcqOptdiv);

			    	CKEDITOR.replace( 'mcqOptEditor'+j+'');		    	
			    	$('#mcqansweroption').append('<option class="mcqOptionsInput">'+j+'</option>');
			    	}
			    	$("div#mcqAnswerDiv").css("display", "block");			    	
			    	$("div#submitMcqBtn").css("display", "block");
			}
			function noOfMtoMcqOptions(){
				var no_of_options = $('#no_of_mto_options_input').val();
				var newdiv;
				if ($('.mtoMcqOptInput').length) {
					$('.mtoMcqOptInput').remove();
					$('.checkbox').remove();
					$("div#mtoMcqAnswerDiv").css("display", "none");	
					$("div#submitMtoMcqBtn").css("display", "none");	
					}
				var j;

			    for (var i = 0; i < no_of_options; i++) {
			    	j=i+1;
			        newMtoMcqOptdiv = $('<div id="mtoMcqOpt'+j+'Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option" class="mtoMcqOptInput"><h4 data-toggle="collapse" data-target="#mtoMcqOpt'+j+'">Option '+j+'</h4><hr><div  id="mtoMcqOpt'+j+'" class="collapse"><textarea name="mtoMcqOptEditor'+j+'" id="mtoMcqOpt'+j+'Textbox"></textarea></div></div>');
			        $('#mtoMcqOptions').append(newMtoMcqOptdiv);

			    	CKEDITOR.replace( 'mtoMcqOptEditor'+j+'');		    	
			    	$('#mtomcqansweroption').append('<div class="checkbox"><label><input type="checkbox" name="checkboxlist" value="'+j+'">Option'+j+'</label></div>');
			    	}
			    	$("div#mtoMcqAnswerDiv").css("display", "block");
					$("div#submitMtoMcqBtn").css("display", "block");
			}
			function addDescQues()
    		{
    			console.log('wsfghfdefg');
    			var editorText = CKEDITOR.instances.descQuestionTextbox.getData();
    			var examId = $('#desc_exam_id').val();
    			if(editorText==""){
    				console.log('empty');
    				$('#descQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else{
    				console.log(editorText);
    				$('#descQuesErrDiv').html(''); 
    				$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/addDescQues',
				        type: 'POST',
				        data: {
				            examId : examId,
				            editorText: editorText,
				            },
				        async: false,
				        success: function(datareturn) {
				            console.log('updated');
				            document.location.href = '<?php echo base_url();?>index.php?admin/examinationEdit/'+examId;
        				},
        				error: function(XMLHttpRequest, textStatus, errorThrown) {
   						  alert(errorThrown);
  						}
   					});  
    			}
    		}
    		function addMtoMcqQues()
    		{
    			var mtoMcqQuestion = CKEDITOR.instances.mtoMcqQuestionTextbox.getData();
    			var examId = $('#mto_mcq_exam_id').val();
    			var no_of_options = $('#no_of_mto_options_input').val();				
    			var options  = [];
    			var optLeftEmpty = false;
    			for(i=1; i<=no_of_options; i++)
    			{
    				if(eval('CKEDITOR.instances.mtoMcqOpt'+i+'Textbox').getData()=='')
    				{
    					optLeftEmpty= true;
    					break;
    				}
    				options.push(eval('CKEDITOR.instances.mtoMcqOpt'+i+'Textbox').getData());
    			}
    			
    			if(!$('input[name=checkboxlist]:checked').is(':checked'))
    			{
    				$('#mtoMcqQuesErrDiv').html('Answer Left Empty');    			
    			}else if(mtoMcqQuestion==""||optLeftEmpty == true){
    				$('#mtoMcqQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else
    			{
    				var checkValues = $('input[name=checkboxlist]:checked').map(function()
		            {
		                return $(this).val();
		            }).get()
    				console.log(mtoMcqQuestion);
    				$('#mtoMcqQuesErrDiv').html(''); 
    				console.log(checkValues);
    				$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/addMtoMcqQues',
				        type: 'POST',
				        data: {
				            examId : examId,
				            mtoMcqQuestion: mtoMcqQuestion,
				            mtoMcqOpt:options,
				            mtoMcqAnswer:checkValues,
				            no_of_options: no_of_options
				            },
				        async: false,
				        success: function(datareturn) {
				            console.log('updated done');
				            document.location.href = '<?php echo base_url();?>index.php?admin/examinationEdit/'+examId;
        				},
        				error: function(XMLHttpRequest, textStatus, errorThrown) {
   						  alert(errorThrown);
  						}
   					});  
    			}
    		}
    		function addMcqQues()
    		{
    			var mcqQuestion = CKEDITOR.instances.mcqQuestionTextbox.getData();    			
    			var no_of_options = $('#no_of_options_input').val();				
    			var options  = [];
    			var optLeftEmpty;
    			for(i=1; i<=no_of_options; i++)

    			{
    				if(eval('CKEDITOR.instances.mcqOpt'+i+'Textbox').getData()=='')
    				{
    					optLeftEmpty= true;
    					break;
    				}
    				options.push(eval('CKEDITOR.instances.mcqOpt'+i+'Textbox').getData());
    			}
    			var no_of_options  = $('#no_of_options_input').val();
    			var examId = $('#mcq_exam_id').val();
    			var mcqAnswer = $('#mcqansweroption').val();
    			
    			if($('#mcqansweroption').val()=='Enter Choice')
    			{
    				$('#mcqQuesErrDiv').html('Answer Left Empty');    			
    			}else if(mcqQuestion==""||optLeftEmpty== true){
    				$('#mcqQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else{
    				$('#mcqQuesErrDiv').html(''); 
    				$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/addMcqQues',
				        type: 'POST',
				        data: {
				            examId : examId,
				            mcqQuestion: mcqQuestion,
				            mcqOpt:options,
				            mcqAnswer: mcqAnswer,
				            no_of_options: no_of_options
				            },
				        async: false,
				        success: function(datareturn) {
				            console.log(datareturn);
				           	document.location.href = '<?php echo base_url();?>index.php?admin/examinationEdit/'+examId;
        				},
        				error: function(XMLHttpRequest, textStatus, errorThrown) {
   						  alert(errorThrown);
  						}
   					});  
    			}
    		}
		
</script>
<style type="text/css">
	fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}	
	
		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
</style>
