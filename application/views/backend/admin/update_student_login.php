<br>
<div class="panel panel-default">
 <div class="panel-body">
 <form name="reset_frm" id="reset_frm"  method="POST">
<div class="col-sm-12">
   <label>User Login ID <span class="text-danger">*</span></label>   
   <input type="text" name="student_logid" required id="student_logid" class="form-control" value="<?php echo $result= $this->db->get_where('student', array('student_id' => $stu_id))->row()->student_logid ;?>">
  <input type="hidden" name="student_id" value="<?php echo $stu_id; ?>">
   <p class="text-danger" id="err"></p>
  <br>
	<input type="submit" class="btn btn-info btn-lg"  name="update" id="update" value="Update" />	
	<a onclick="window.history.go(-1); return false;" href="#" class="btn btn-default btn-lg"> Cancel </a>
</div>
</form>
</div>
</div>
<script>
$('#reset_frm').submit(function(ev) {
    ev.preventDefault();
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>index.php?admin/update_student_login',
            data: $('form').serialize(),
            success: function (result) {
				if(result == 1){
					 $("#err").html("Login Id Already Exist.");
					 $("#err").css("color","red");
				}else{ 
					 $("#err").html("Updated Sucessfully.");
					 $("#err").css("color","green");
				}            
            }
          });
   });
</script>