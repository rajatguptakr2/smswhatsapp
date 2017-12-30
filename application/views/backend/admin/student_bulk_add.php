<hr />
<?php echo form_open(base_url() . 'index.php?admin/student_bulk_add/add_bulk_student' , array('class' => 'form-inline validate','enctype' => 'multipart/form-data', 'style' => 'text-align:center;'));?>
<div class="row">	
	<div class="col-md-4">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class');?></label>
			<select name="class_id" id="class_id" class="form-control selectboxit" required
				onchange="get_sections(this.value)"  data-validate="required"  data-message-required="<?php echo get_phrase('value_required');?>">
				<option value=""><?php echo get_phrase('select_class');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<div id="section_holder"></div>
	<div class="col-md-4">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('upload_file');?></label><br>
		<input type="file" name="upload_file" class="form-control" accept=".csv" id="upload_file"  data-validate="required"  data-message-required="<?php echo get_phrase('required');?>" >
	</div>	
</div><br>

<br>
<div id="bulk_add_form">
<br>
<div class="row">
	<center>
		<button type="submit" class="btn btn-success" id="submit_button">
			<i class="fa fa-upload" aria-hidden="true"></i> <?php echo get_phrase('import');?>
		</button>
	</center>
</div>
</div>
<br>
<br>
<div class="panel panel-default">
<div class="panel-body">
<div class="col-sm-12" style="text-align: left;">				
					<h4 style="color:#3A87AD">You must have to follow the following instruction at the time of importing data</h4>										
						<p>Student ID is auto generated.</p>
						<p>Fields are required in file.</p>
						<p>Birth date must be less than current date.</p>
						<p>Student import detail must match with application selected language.</p>					
					<h5>Download the sample format of CSV sheet. &nbsp;<b> <a href="<?php echo base_url(); ?>assets/studentListExample.csv" style="color:#3A87AD"><b>Download</b></a></b></h5>
				
			</div>
			</div>
			</div>

<style>
.validate-has-error {    
    color: #cc2424;
}
.panel-body {   
    background-color: #f0f7fd;
}
</style>
<?php echo form_close();?>

<script type="text/javascript">
var class_selection = '';
jQuery(document).ready(function($) {
$('#submit_button').attr('disabled', 'disabled');	
});
	

	function get_sections(class_id) {
		if(class_id !== ''){
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_sections/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
                jQuery('#bulk_add_form').show();
            }
        });
	  }
	}

	function append_student_entry()
	{
		$("#student_entry_append").append(blank_student_entry);
	}

	// REMOVING INVOICE ENTRY
	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}
	function check_validation(){
		if(class_selection !== ''){
			$('#submit_button').removeAttr('disabled')
		}
		else{
			$('#submit_button').attr('disabled', 'disabled');
		}
	}
	$('#class_id').change(function() {
		class_selection = $('#class_id').val();
		check_validation();
	});
</script>
