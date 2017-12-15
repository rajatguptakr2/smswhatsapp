<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Update Question</div>
      <div class="panel-body">
      	      	
  		<hr>
  		<div class="col-sm-8 col-sm-offset-2 text-center">
<div id="mcqMtoQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
				      		<h4 >Your Question</h4> <hr>
				        	<div  id="mcqMtoQuestion" >
				        		<textarea name="editor6" id="mtoMcqQuestionTextbox"></textarea>	
				        	</div>
				        	
</div>
<div id="mcqMtoOpt1Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
		<h4 >Option 1</h4> <hr>
	<div  id="mcqMtoOpt1" >
		<textarea name="editor7" id="mtoMcqOpt1Textbox"></textarea>	
	</div>			        	
</div>
<div id="mcqMtoOpt2Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
		<h4 >Option 2</h4> <hr>
		<div  id="mcqMtoOpt2" >
			<textarea name="editor8" id="mtoMcqOpt2Textbox"></textarea>	
		</div>			        	
</div> 
<div id="mcqMtoOpt3Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
		<h4 >Option 3</h4> <hr>
		<div  id="mcqMtoOpt3" >
			<textarea name="editor9" id="mtoMcqOpt3Textbox"></textarea>	
		</div>			        	
</div>
<div id="mcqMtoOpt4Div" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Option">
		<h4 >Option 4</h4> <hr>
		<div id="mcqMtoOpt4" >
			<textarea name="editor10" id="mtoMcqOpt4Textbox"></textarea>	
		</div>			        	
</div>
<div id="mcqOptAnswerDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Correct Option">
		<h4 >Select Answer</h4> <hr>
		<div id="mtoMcqOptAnswer" >
			<div class="form-group col-sm-4 col-sm-offset-4">
			<div class="checkbox">
					<label><input type="checkbox" name="checkboxlist" value="1" id="myCheckbox1" >Option 1</label>
		  	</div>
	   		<div class="checkbox">
			  	<label><input type="checkbox" name="checkboxlist" value="2" id="myCheckbox2">Option 2</label>
			</div>
			<div class="checkbox disabled">
			  	<label><input type="checkbox" name="checkboxlist" value="3"  id="myCheckbox3">Option 3</label>
			</div>
			<div class="checkbox disabled">
			  	<label><input type="checkbox" name="checkboxlist" value="4" id="myCheckbox4">Option 4</label>
			</div>
		</div>
		</div>			        	
</div>
<div class="submitMtoMcqBtn col-sm-8 col-sm-offset-2 text-center">
	<div id="mtoMcqQuesErrDiv" style="color: red;"></div>				    		
	<input type="hidden" name="mto_mcq_exam_id" id="mto_mcq_exam_id" value="<?php echo $exam_id;?>">	
	<button type="button" class="btn btn-success" name="submitMtoMcq" onclick="updateMtoMcqQues();">Submit More Than One Correct MCQ</button>
</div>			    	
</div>
</div>
</div>
</div>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script type="text/javascript">
	
		CKEDITOR.replace( 'editor6' );
		CKEDITOR.replace( 'editor7' );
		CKEDITOR.replace( 'editor8' );
		CKEDITOR.replace( 'editor9' );
		CKEDITOR.replace( 'editor10' );
		$(document).ready(function()
		{
			fillFields();			
		});	
		function fillFields()
		{		
			$.ajax({
			        url: '<?php echo base_url();?>index.php?admin/fillMtoMcqQuestion',
			        type: 'POST',
			        data: {
			            question_id : <?php echo $question_id;?>
			        },
			        async: false,
			        success: function(datareturn) {
			            //console.log(datareturn);
			            var datareturn = $.parseJSON(datareturn);
			            //console.log(datareturn.correct.length);
			            //length = datareturn.correct.length;
			            for (i = 0; i < datareturn.correct.length; i++) 
			            { 
    						
    						if(datareturn.correct[i] == '0')
    						{
    							console.log(i);    						
    							$('#myCheckbox1').attr('checked', true);
    						}
    						else if(datareturn.correct[i] == '1')
    						{
    							console.log(i);
    							$('#myCheckbox2').attr('checked', true);
    						}
    						else if(datareturn.correct[i] == '2')
    						{
    							console.log(i);
    							$('#myCheckbox3').attr('checked', true);
    						}
    						else if(datareturn.correct[i] == '3')
    						{
    							console.log(i);
    							$('#myCheckbox4').attr('checked', true);
    						}
						}
			            CKEDITOR.instances.mtoMcqQuestionTextbox.setData(datareturn.question);
			            CKEDITOR.instances.mtoMcqOpt1Textbox.setData(datareturn.options['0']);
			            CKEDITOR.instances.mtoMcqOpt2Textbox.setData(datareturn.options['1']);
			            CKEDITOR.instances.mtoMcqOpt3Textbox.setData(datareturn.options['2']);
			            CKEDITOR.instances.mtoMcqOpt4Textbox.setData(datareturn.options['3']);
			            //	document.location.href = '<?php echo base_url();?>index.php?admin/examination';
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						  alert(errorThrown);
						}
					});
		}	
		function updateMtoMcqQues()
		{
			var question_id = <?php echo $question_id;?>;
			var exam_id = <?php echo $exam_id;?>;
			var mtoMcqQuestion = CKEDITOR.instances.mtoMcqQuestionTextbox.getData();
			var mtoMcqOpt1 = CKEDITOR.instances.mtoMcqOpt1Textbox.getData();
			var mtoMcqOpt2 = CKEDITOR.instances.mtoMcqOpt2Textbox.getData();
			var mtoMcqOpt3 = CKEDITOR.instances.mtoMcqOpt3Textbox.getData();
			var mtoMcqOpt4 = CKEDITOR.instances.mtoMcqOpt4Textbox.getData();

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
					$('#mtoMcqQuesErrDiv').html(''); 
					$.ajax({
						        url: '<?php echo base_url();?>index.php?admin/updateMtoMcqQuestion',
						        type: 'POST',
						        data: {
						            question_id : <?php echo $question_id?>,
						            mtoMcqQuestion : mtoMcqQuestion,
						            mtoMcqOpt1 : mtoMcqOpt1,
						            mtoMcqOpt2 : mtoMcqOpt2,
						            mtoMcqOpt3 : mtoMcqOpt3,
						            mtoMcqOpt4 : mtoMcqOpt4,
						            exam_id : exam_id,
						            mtoMcqAnswer:checkValues,			            
						        },
						        async: false,
						        success: function(datareturn) {
						             
						            var datareturn = $.parseJSON(datareturn);	
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