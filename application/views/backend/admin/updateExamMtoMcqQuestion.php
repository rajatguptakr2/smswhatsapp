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
<div id="mtoMcqOptDiv" style="cursor: pointer;">
</div>
<div id="mcqOptAnswerDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Correct Option">
		<h4 >Select Answer</h4> <hr>
		<div class="form-group col-sm-4 col-sm-offset-4" id="mtoMcqOptAnswer">
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
		$(document).ready(function()
		{
			generateDivs();
			fillFields();			
		});	
		function generateDivs()
		{
			  for(var i =0; i < <?php echo $no_of_options;?>; i++) {
			  		j=i+1;
			    	newMcqOptdiv = $('<div id="mtoMcqOpt'+j+'Div" style="cursor: pointer;"><h4  >Option '+j+'</h4> <hr><div  id="mtoMcqOpt'+j+'"><textarea name="mtoMcqOpt'+j+'Textbox" id="mtoMcqOpt'+j+'Textbox"></textarea>	</div></div>');
			        $('#mtoMcqOptDiv').append(newMcqOptdiv);

			    	CKEDITOR.replace( 'mtoMcqOpt'+j+'Textbox');		    	
			    	$('#mtoMcqOptAnswer').append('<div class="checkbox"><label><input type="checkbox" name="checkboxlist" value="'+j+'" id="myCheckbox'+j+'" >Option '+j+'</label></div>');
			    	}
		}
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
			            var datareturn = $.parseJSON(datareturn);
			            for (i = 0; i < datareturn.correct.length; i++) 
			            { 
    						j=i+1;
    						console.log(i);
    						$('#myCheckbox'+j+'').attr('checked', true);
						}
			            CKEDITOR.instances.mtoMcqQuestionTextbox.setData(datareturn.question);
			             for(i=0; i<datareturn.options.length; i++){
			            	j=i+1;
			            	eval('CKEDITOR.instances.mtoMcqOpt'+j+'Textbox').setData(datareturn.options[i]);	
			            }//	document.location.href = '<?php echo base_url();?>index.php?admin/examination';
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
			var no_of_options = <?php echo $no_of_options;?>;
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
				$('#mtoMcqQuesErrDiv').html(''); 
				$.ajax({
					        url: '<?php echo base_url();?>index.php?admin/updateMtoMcqQuestion',
					        type: 'POST',
					        data: {
					            question_id : <?php echo $question_id?>,
					            exam_id : exam_id,
					            mtoMcqQuestion: mtoMcqQuestion,
					            mtoMcqOpt:options,
					            mtoMcqAnswer:checkValues,
					            no_of_options: no_of_options		            
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