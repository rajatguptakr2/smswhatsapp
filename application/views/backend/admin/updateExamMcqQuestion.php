<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Update Question</div>
      <div class="panel-body">
      	      	
  		<hr>
  		<div class="col-sm-8 col-sm-offset-2 text-center">
   			<div id="mcqQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
	      		<h4 >Your Question</h4> <hr>
	        	<div>
	        		<textarea name="editor1"  id="mcqQuestionTextbox"></textarea>	
	        	</div>				        	
			</div>
			<div id="mcqOptDiv" style="cursor: pointer;">

			</div>			
	    	<div id="mcqAnswerDiv" style="cursor: pointer;">
	      		<h4>Select Answer</h4> <hr>
	      		<div id="mcqAnswer" >
	      			<div class="form-group col-sm-4 col-sm-offset-4">
					  <select class="form-control" id="mcqansweroption">
					   	<option>Enter Choice</option>					   
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
		$(document).ready(function()
		{
			generateDivs();	
			fillFields();
		});	

		function generateDivs()
		{
			  for(var i =0; i <<?php echo $no_of_options;?>; i++) {
			  		j=i+1;
			    	newMcqOptdiv = $('<div id="mcqOpt'+j+'Div" style="cursor: pointer;"><h4  >Option '+j+'</h4> <hr><div  id="mcqOpt'+j+'"><textarea name="mcqOpt'+j+'Textbox" id="mcqOpt'+j+'Textbox"></textarea>	</div></div>');
			        $('#mcqOptDiv').append(newMcqOptdiv);

			    	CKEDITOR.replace( 'mcqOpt'+j+'Textbox');		    	
			    	$('#mcqansweroption').append('<option value="'+j+'">'+j+'</option>');
			    	}
		}
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
			            var j;
			            console.log(datareturn);
			        	$("select#mcqansweroption").val(parseInt(datareturn.correct)+1);
			            CKEDITOR.instances.mcqQuestionTextbox.setData(datareturn.question);
			            for(i=0; i<datareturn.options.length; i++){
			            	j=i+1;
			            	eval('CKEDITOR.instances.mcqOpt'+j+'Textbox').setData(datareturn.options[i]);	
			            }
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
			var no_of_options = <?php echo $no_of_options;?>;				
    		var options  = [];
    		var optLeftEmpty;
			var mcqQuestion = CKEDITOR.instances.mcqQuestionTextbox.getData();
			var mcqAnswer = $('#mcqansweroption').val();
    			
			for(i=1; i<=no_of_options; i++)
			{
				if(eval('CKEDITOR.instances.mcqOpt'+i+'Textbox').getData()=='')
				{
					optLeftEmpty= true;
					break;
				}
				options.push(eval('CKEDITOR.instances.mcqOpt'+i+'Textbox').getData());
			}
			if($('#mcqansweroption').val()=='Enter Choice')
			{
				$('#mcqQuesErrDiv').html('Answer Left Empty');    			
			}else if(mcqQuestion==""||optLeftEmpty== true){
				$('#mcqQuesErrDiv').html('Some Field Left Empty');    			
			}
			else{
				$.ajax({
					        url: '<?php echo base_url();?>index.php?admin/updateMcqQuestion',
					        type: 'POST',
					        data: {
					            question_id : question_id,
					           	exam_id : exam_id,
					            mcqQuestion: mcqQuestion,
					            mcqOpt:options,
					            mcqAnswer: mcqAnswer,
					            no_of_options: no_of_options			            
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