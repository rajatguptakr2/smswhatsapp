<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Update Question</div>
      <div class="panel-body">
      	      	
  		<hr>
  		<div class="col-sm-8 col-sm-offset-2 text-center">
   			<div id="mcqQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
				      		<h4 >Your Question</h4> <hr>
				        	<div  >
				        		<textarea name="editor1"  id="mcqQuestionTextbox"></textarea>	
				        	</div>
				        	
				    	</div>
				    	<div id="mcqOpt1Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4  >Option 1</h4> <hr>
				        	<div  id="mcqOpt1">
				        		<textarea name="editor2" id="mcqOpt1Textbox"></textarea>	
				        	</div>			        	
				    	</div>
				    	<div id="mcqOpt2Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4  >Option 2</h4> <hr>
				      		<div  id="mcqOpt2" >
				      			<textarea name="editor3" id="mcqOpt2Textbox"></textarea>	
				      		</div>			        	
				    	</div> 
				    	<div id="mcqOpt3Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4  >Option 3</h4> <hr>
				      		<div  id="mcqOpt3" >
				      			<textarea name="editor4" id="mcqOpt3Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqOpt4Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
				      		<h4 >Option 4</h4> <hr>
				      		<div id="mcqOpt4">
				      			<textarea name="editor5" id="mcqOpt4Textbox"></textarea>	
				      		</div>			        	
				    	</div>
				    	<div id="mcqAnswerDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Correct Option">
				      		<h4  >Select Answer</h4> <hr>
				      		<div id="mcqAnswer" >
				      			<div class="form-group col-sm-4 col-sm-offset-4">
								  <select class="form-control" id="mcqansweroption">
								    <option>Enter Choice</option>
								    <option value="1">1</option>
								    <option value="2">2</option>
								    <option value="3">3</option>
								    <option value="4">4</option>
								  </select>
								</div>
				      		</div>			        	
				    	</div>
				    	<div class="submitMcqBtn col-sm-8 col-sm-offset-2 text-center">
				    		<div id="mcqQuesErrDiv" style="color: red;"></div>				    		
				    		<input type="hidden" name="mcq_exam_id" id="mcq_exam_id" value="<?php echo $exam_id;?>">
				    		<button type="button" class="btn btn-success" name="submitMcq" onclick="updateMcqQues();">Submit MCQ</button>
				    	</div>	
   		</div>
      </div>
    </div>   
</div>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script type="text/javascript">
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.replace( 'editor2' );
		CKEDITOR.replace( 'editor3' );
		CKEDITOR.replace( 'editor4' );
		CKEDITOR.replace( 'editor5' );	
		$(document).ready(function()
		{
			fillFields();			
		});	
		function fillFields()
		{		
			$.ajax({
			        url: '<?php echo base_url();?>index.php?admin/fillMcqQuestion',
			        type: 'POST',
			        data: {
			            question_id : <?php echo $question_id;?>
			        },
			        async: false,
			        success: function(datareturn) {
			            var datareturn = $.parseJSON(datareturn);
			            console.log(datareturn);
			        	$("select#mcqansweroption").val(parseInt(datareturn.correct)+1);
			            CKEDITOR.instances.mcqQuestionTextbox.setData(datareturn.question);
			            CKEDITOR.instances.mcqOpt1Textbox.setData(datareturn.options['0']);
			            CKEDITOR.instances.mcqOpt2Textbox.setData(datareturn.options['1']);
			            CKEDITOR.instances.mcqOpt3Textbox.setData(datareturn.options['2']);
			            CKEDITOR.instances.mcqOpt4Textbox.setData(datareturn.options['3']);
			            //	document.location.href = '<?php echo base_url();?>index.php?admin/examination';
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						  alert(errorThrown);
						}
					});
		}	
		function updateMcqQues()
		{
			var question_id = <?php echo $question_id;?>;
			var exam_id = <?php echo $exam_id;?>;
			var mcqQuestion = CKEDITOR.instances.mcqQuestionTextbox.getData();
			var mcqOpt1 = CKEDITOR.instances.mcqOpt1Textbox.getData();
			var mcqOpt2 = CKEDITOR.instances.mcqOpt2Textbox.getData();
			var mcqOpt3 = CKEDITOR.instances.mcqOpt3Textbox.getData();
			var mcqOpt4 = CKEDITOR.instances.mcqOpt4Textbox.getData();
			var mcqAnswer = $('#mcqansweroption').val();
    			
    			if($('#mcqansweroption').val()=='Enter Choice')
    			{
    				$('#mcqQuesErrDiv').html('Answer Left Empty');    			
    			}else if(mcqQuestion==""||mcqOpt1==""||mcqOpt2==""||mcqOpt3==""||mcqOpt4==""){
    				console.log('empty');
    				$('#mcqQuesErrDiv').html('Some Field Left Empty');    			
    			}
    			else{
					$.ajax({
						        url: '<?php echo base_url();?>index.php?admin/updateMcqQuestion',
						        type: 'POST',
						        data: {
						            question_id : question_id,
						           	mcqQuestion : mcqQuestion,
						            mcqOpt1 : mcqOpt1,
						            mcqOpt2 : mcqOpt2,
						            mcqOpt3 : mcqOpt3,
						            mcqOpt4 : mcqOpt4,
						            exam_id : exam_id,
						            mcqAnswer: mcqAnswer,			            
						        },
						        async: false,
						        success: function(datareturn) {
						            console.log(datareturn);
						            document.location.href = '<?php echo base_url();?>index.php?admin/examinationEdit/'+datareturn;
								},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									  alert(errorThrown);
									}
								});
				}
			}
</script>