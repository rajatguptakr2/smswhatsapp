<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('SMS_alert'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="SMS_for"><?php echo get_phrase('SMS_for'); ?></label>
                        <select class="form-control" id="sms">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="common_to_all"><?php echo get_phrase('common_to_all'); ?></option>
                            <option value="route_wise"><?php echo get_phrase('route_wise'); ?></option>
                            <option value="destination_wise"><?php echo get_phrase('destination_wise'); ?></option>
                            <option value="individual"><?php echo get_phrase('individual'); ?></option>
                        </select>
                        <span class="error" id="sms_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div classs="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?></label>
                        <select class="form-control" id="type">
                            <option value=""></option>
                            <option value="student"><?php echo get_phrase('student'); ?></option>
                            <option value="employee"><?php echo get_phrase('employee'); ?></option>
                        </select>
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_course">
                    <div classs="form-group">
                        <label for="course"><?php echo get_phrase('course'); ?></label>
                        <select class="form-control" id="course">
                            <option value=""></option>
                        </select>
                        <span class="error" id="course_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_batch">
                    <div classs="form-group">
                        <label for="batch"><?php echo get_phrase('batch'); ?></label>
                        <select class="form-control" id="batch">
                            <option value=""></option>
                        </select>
                        <span class="error" id="batch_error">
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_student">
                    <div classs="form-group">
                        <label for="student_name"><?php echo get_phrase('student_name'); ?></label>
                        <select class="form-control" id="stu_name">
                            <option value=""></option>
                        </select>
                        <span class="error" id="stu_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_employee">
                    <div classs="form-group">
                        <label for="employee_name"><?php echo get_phrase('employee_name'); ?></label>
                        <select class="form-control" id="emp_name">
                            <option value=""></option>
                        </select>
                        <span class="error" id="emp_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="message"><?php echo get_phrase('message'); ?><span class="error">*</span></label>
                        <textarea class="form-control" id="message"></textarea>
                        <span class="error" id="message_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                         <button class="btn btn-primary" id="send"><?php echo get_phrase('send'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $('#type').on('change', function(){
    var type = $('#type').val();
    if(type == 'student'){
      $('#show_course').removeClass('hidden');
      $('#show_batch').removeClass('hidden');
      $('#show_student').removeClass('hidden');
      $('#show_employee').addClass('hidden');
    }else if(type == 'employee'){
      $('#show_course').addClass('hidden');
      $('#show_batch').addClass('hidden');
      $('#show_student').addClass('hidden');
      $('#show_employee').removeClass('hidden');
    }else{
      $('#show_course').addClass('hidden');
      $('#show_batch').addClass('hidden');
      $('#show_student').addClass('hidden');
      $('#show_employee').addClass('hidden');
    }
  });
  $('#send').on('click', function(){
    var formSubmit = false;
    var sms = $('#sms').val();
    var type = $('#type').val();
    var message = $('#message').val();
    if(sms == ''){
      $('#sms_error').text('Please select type');
    }else{
      $('#sms_error').text('');
    }
    if(type == ''){
      $('#type_error').text('Please select user type');
    }else{
      $('#type_error').text('');
    }
    if(message == ''){
      $('#message_error').text('Please select type');
    }else{
      $('#message_error').text('');
    }
    if(type != ''){
      if(type == 'student'){
        var course = $('#course').val();
        var batch = $('#batch').val();
        var studentName = $('#stu_name').val();
        if(course == ''){
          $('#course_error').text('Please select course');
        }else{
          $('#course_error').text('');
        }
        if(batch == ''){
          $('#batch_error').text('Please select batch');
        }else{
          $('#batch_error').text('');
        }
        if(studentName == ''){
          $('#stu_error').text('Please select student');
        }else{
          $('#stu_error').text('');
        }
      }else{
        var employee = $('#emp_name').val();
        if(employee == ''){
          $('#emp_error').text('Please select employee');
        }else{
          $('#emp_error').text('');
        }
      }
    }
    if(sms == '' || type == '' || message == ''){
      formSubmit = false;
    }else if(type == 'student'){

    }else{
      formSubmit == true;
    }
    if(formSubmit){
      //Submit form
      alert();
    }else{
      //Error
    }

  });
</script>
