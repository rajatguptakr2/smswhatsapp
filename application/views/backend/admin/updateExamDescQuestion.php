<hr>
<div class="row">
<div class="panel panel-primary">
<div class="panel-heading">Update Question</div>
<div class="panel-body">
	      	
	<hr>
	<div class="col-sm-8 col-sm-offset-2 text-center">
		<div id="descQuesDiv" style="cursor: pointer;" data-toggle="tooltip" title="Click To Enter Question">
		      		<h4 >Your Question</h4> <hr>
		        	<div  id="descQuestion" >
		        		<textarea name="editor11" id="descQuestionTextbox"></textarea>	
		        	</div>				        	
		    	</div>
		    	<div class="submitDescBtn col-sm-8 col-sm-offset-2 text-center">
		    		<div id="descQuesErrDiv" style="color: red;"></div>
		    		<input type="hidden" name="desc_exam_id" id="desc_exam_id" value="<?php echo $exam_id;?>">	
		    		<button type="button" class="btn btn-success" name="submitDesc" onclick="updateDescQues();">Submit Descriptive Question</button>
		    	</div>
		    </div>
		</div>
	</div>
</div>
	
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script type="text/javascript">			
	CKEDITOR.replace( 'editor11' );
	$(window).load(function() {
		fillFields();			
	});	
	function fillFields()
	{		
		var question_id = <?php echo $question_id;?>;
		console.log(question_id);
		$.ajax({
		        url: '<?php echo base_url();?>index.php?admin/fillDescQuestion',
		        type: 'POST',
		        data: {
		            question_id : question_id
		        },
		        async: false,
		        success: function(datareturn) {
		            console.log(datareturn);
		            var editorText = CKEDITOR.instances.descQuestionTextbox.setData(datareturn);
		            //	document.location.href = '<?php echo base_url();?>index.php?admin/examination';
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					  alert(errorThrown);
					}
				});
	}
	function updateDescQues()
	{
		var question_id = <?php echo $question_id;?>;
		var exam_id = <?php echo $exam_id;?>;
		var descQuestion = CKEDITOR.instances.descQuestionTextbox.getData();
		$.ajax({
			        url: '<?php echo base_url();?>index.php?admin/updateDescQuestion',
			        type: 'POST',
			        data: {
			            question_id : <?php echo $question_id?>,
			            descQuestion : descQuestion,
			            exam_id : exam_id			            
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
</script>