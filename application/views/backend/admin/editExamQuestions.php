<hr>
<div class="row">
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
				      	<div id="mcqQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
				      		<h4 data-toggle="collapse" data-target="#mcqQuestion">Your Question</h4> <hr>
				        	<div  id="mcqQuestion" class="collapse">
				        		<textarea name="editor1"  id="mcqQuestionTextbox"></textarea>	
				        	</div>
				        	
				    	</div>
				    	<div id="mcqOpt1Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqOpt1">Option 1</h4> <hr>
				        	<div  id="mcqOpt1" class="collapse">
				        		<textarea name="editor2" id="mcqOpt1Textbox"></textarea>	
				        	</div>			        	
				    	</div>
				    	<div id="mcqOpt2Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqOpt2">Option 2</h4> <hr>
				      		<div  id="mcqOpt2" class="collapse">
				      			<textarea name="editor3" id="mcqOpt2Textbox"></textarea>	
				      		</div>			        	
				    	</div> 
				    	<div id="mcqOpt3Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqOpt3">Option 3</h4> <hr>
				      		<div  id="mcqOpt3" class="collapse">
				      			<textarea name="editor4" id="mcqOpt3Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqOpt4Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqOpt4">Option 4</h4> <hr>
				      		<div id="mcqOpt4" class="collapse">
				      			<textarea name="editor5" id="mcqOpt4Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqAnswerDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Correct Option">
				      		<h4 data-toggle="collapse" data-target="#mcqAnswer">Select Answer</h4> <hr>
				      		<div id="mcqAnswer" class="collapse">
				      			<div class="form-group col-sm-4 col-sm-offset-4">
								  <select class="form-control" id="mcqansweroption">
								    <option>Enter Choice</option>
								    <option>1</option>
								    <option>2</option>
								    <option>3</option>
								    <option>4</option>
								  </select>
								</div>
				      		</div>			        	
				    	</div>
				    	<div class="submitMcqBtn col-sm-8 col-sm-offset-2 text-center">
				    		<div id="mcqQuesErrDiv" style="color: red;"></div>				    		
				    		<input type="hidden" name="mcq_exam_id" id="mcq_exam_id" value="<?php echo $exam_id;?>">
				    		<button type="button" class="btn btn-success" name="submitMcq" onclick="addMcqQues();">Submit MCQ</button>
				    	</div>			    	
				      </div>
				      <div class="modal-footer">
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
				      	<div id="mcqMtoQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
				      		<h4 data-toggle="collapse" data-target="#mcqMtoQuestion">Your Question</h4> <hr>
				        	<div  id="mcqMtoQuestion" class="collapse">
				        		<textarea name="editor6" id="mtoMcqQuestionTextbox"></textarea>	
				        	</div>
				        	
				    	</div>
				    	<div id="mcqMtoOpt1Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqMtoOpt1">Option 1</h4> <hr>
				        	<div  id="mcqMtoOpt1" class="collapse">
				        		<textarea name="editor7" id="mtoMcqOpt1Textbox"></textarea>	
				        	</div>			        	
				    	</div>
				    	<div id="mcqMtoOpt2Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqMtoOpt2">Option 2</h4> <hr>
				      		<div  id="mcqMtoOpt2" class="collapse">
				      			<textarea name="editor8" id="mtoMcqOpt2Textbox"></textarea>	
				      		</div>			        	
				    	</div> 
				    	<div id="mcqMtoOpt3Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqMtoOpt3">Option 3</h4> <hr>
				      		<div  id="mcqMtoOpt3" class="collapse">
				      			<textarea name="editor9" id="mtoMcqOpt3Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqMtoOpt4Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 data-toggle="collapse" data-target="#mcqMtoOpt4">Option 4</h4> <hr>
				      		<div id="mcqMtoOpt4" class="collapse">
				      			<textarea name="editor10" id="mtoMcqOpt4Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqOptAnswerDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Correct Option">
				      		<h4 data-toggle="collapse" data-target="#mtoMcqOptAnswer">Select Answer</h4> <hr>
				      		<div id="mtoMcqOptAnswer" class="collapse">
				      			<div class="form-group col-sm-4 col-sm-offset-4">
									<div class="checkbox">
 										<label><input type="checkbox" name="checkboxlist" value="">Option 1</label>
								  	</div>
							   		<div class="checkbox">
									  	<label><input type="checkbox" name="checkboxlist" value="">Option 2</label>
									</div>
									<div class="checkbox disabled">
									  	<label><input type="checkbox" name="checkboxlist" value="">Option 3</label>
									</div>
									<div class="checkbox disabled">
									  	<label><input type="checkbox" name="checkboxlist" value="">Option 4</label>
									</div>
								</div>
				      		</div>			        	
				    	</div>
				    	<div class="submitMtoMcqBtn col-sm-8 col-sm-offset-2 text-center">
				    		<div id="mtoMcqQuesErrDiv" style="color: red;"></div>				    		
				    		<input type="hidden" name="mto_mcq_exam_id" id="mto_mcq_exam_id" value="<?php echo $exam_id;?>">	
				    		<button type="button" class="btn btn-success" name="submitMtoMcq" onclick="addMtoMcqQues();">Submit MCQ</button>
				    	</div>			    	
				      </div>
				      <div class="modal-footer">
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
				      	<div id="descQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
				      		<h4 data-toggle="collapse" data-target="#descQuestion">Your Question</h4> <hr>
				        	<div  id="descQuestion" class="collapse">
				        		<textarea name="editor11" id="descQuestionTextbox"></textarea>	
				        	</div>				        	
				    	</div>
				    	<div class="submitDescBtn col-sm-8 col-sm-offset-2 text-center">
				    		<div id="descQuesErrDiv" style="color: red;"></div>
				    		<input type="hidden" name="desc_exam_id" id="desc_exam_id" value="<?php echo $exam_id;?>">	
				    		<button type="button" class="btn btn-success" name="submitDesc" onclick="addDescQues();">Submit Descriptive Question</button>
				    	</div>				    					    	
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
			  	<div id="mcq" style="display: none">
			  		<hr>
			  		<div col-sm-10 col-sm-offset-1" id="mcqQuestions">
            				<?php
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
											</fieldset>											
								</div>							
    						<?php
    						}
            				?>					
			  		</div>
			  	</div>
			  	<div id="mto_mcq" style="display: none">
			  		<hr>
				  	<div  col-sm-10 col-sm-offset-1" id="mto_mcqQuestions">
				  		<?php
            				foreach ($query4->result() as $rowmtomcq)
    						{?>
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
													foreach ($rowmtomcq->options as $option)
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
											</fieldset>											
								</div>							
    						<?php
    						}
            				?>	    
			  		</div> 			
				</div>  				
			  	<div id="descriptive" style="display: none">
			  		<hr>
				  	<div col-sm-10 col-sm-offset-1" id="descQuestions">
				  		<?php
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
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.replace( 'editor2' );
		CKEDITOR.replace( 'editor3' );
		CKEDITOR.replace( 'editor4' );
		CKEDITOR.replace( 'editor5' );
		CKEDITOR.replace( 'editor6' );
		CKEDITOR.replace( 'editor7' );
		CKEDITOR.replace( 'editor8' );
		CKEDITOR.replace( 'editor9' );
		CKEDITOR.replace( 'editor10' );
		CKEDITOR.replace( 'editor11' );
		$(document).ready(function(){
    		$('[data-toggle="tooltip"]').tooltip();  
    		$('button.selectQues').on('click', function(){
    			var target = $(this).attr('rel');
    			console.log(target);   				
   				$("div#"+target).css("display", "block").siblings("div").css("display", "none");   				
				}); 
    		});
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
    			console.log('wsfghfdefg');
    			var mtoMcqQuestion = CKEDITOR.instances.mtoMcqQuestionTextbox.getData();
    			var mtoMcqOpt1 = CKEDITOR.instances.mtoMcqOpt1Textbox.getData();
    			var mtoMcqOpt2 = CKEDITOR.instances.mtoMcqOpt2Textbox.getData();
    			var mtoMcqOpt3 = CKEDITOR.instances.mtoMcqOpt3Textbox.getData();
    			var mtoMcqOpt4 = CKEDITOR.instances.mtoMcqOpt4Textbox.getData();
    			var examId = $('#mto_mcq_exam_id').val();
    			
    			
    			if(!$('input[name=checkboxlist]:checked').is(':checked'))
    			{
    				$('#mtoMcqQuesErrDiv').html('Answer Left Empty');    			
    			}else if(mtoMcqQuestion==""||mtoMcqOpt1==""||mtoMcqOpt2==""||mtoMcqOpt3==""||mtoMcqOpt4==""){
    				console.log('empty');
    				$('#mtoMcqQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else
    			{
    				var checkValues = $('input[name=checkboxlist]:checked').map(function()
		            {
		                return $(this).val();
		            }).get()
    				console.log(mtoMcqQuestion);
    				console.log(mtoMcqOpt1);
    				console.log(mtoMcqOpt2);
    				console.log(mtoMcqOpt3);
    				console.log(mtoMcqOpt4);
    				console.log(checkValues);
    				$('#mtoMcqQuesErrDiv').html(''); 
    				
    				$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/addMtoMcqQues',
				        type: 'POST',
				        data: {
				            examId : examId,
				            mtoMcqQuestion: mtoMcqQuestion,
				            mtoMcqOpt1:mtoMcqOpt1,
				            mtoMcqOpt2:mtoMcqOpt2,
				            mtoMcqOpt3:mtoMcqOpt3,
				            mtoMcqOpt4:mtoMcqOpt4,
				            mtoMcqAnswer:checkValues,
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
    		function addMcqQues()
    		{
    			console.log('wsfghfdefg');
    			var mycheck = ;
    			var  = $('#mcq_exam_id').val();
    			
    			if($('#mcqansweroption').val()=='Enter Choice')
    			{
    				$('#mcqQuesErrDiv').html('Answer Left Empty');    			
    			}else if(mcqQuestion==""||mcqOpt1==""||mcqOpt2==""||mcqOpt3==""||mcqOpt4==""){
    				console.log('empty');
    				$('#mcqQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else{
    				console.log(mcqQuestion);
    				console.log(mcqOpt1);
    				console.log(mcqOpt2);
    				console.log(mcqOpt3);
    				console.log(mcqOpt4);
    				$('#mcqQuesErrDiv').html(''); 
    				$.ajax({
				        url: '<?php echo base_url();?>index.php?admin/addMcqQues',
				        type: 'POST',
				        data: {
				            examId : examId,
				            mcqQuestion: mcqQuestion,
				            mcqOpt1:mcqOpt1,
				            mcqOpt2:mcqOpt2,
				            mcqOpt3:mcqOpt3,
				            mcqOpt4:mcqOpt4,
				            mcqAnswer: mcqAnswer,
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
