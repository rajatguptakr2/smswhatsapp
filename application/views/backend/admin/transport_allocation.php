<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('transport_allocation'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="route_code"><?php echo get_phrase('route_code'); ?></label><span class="error">&nbsp;*</span>
                    <select class="form-control" id="route_code">
                        <!-- get dynamically-->
                        <option></option>
                        <option value="test">Test</option>
                    </select>
                    <span class="error" id="code_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="destination"><?php echo get_phrase('destination'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="destination">
                            <!-- get dynamically-->
                            <option></option>
                            <option value="test">Test</option>
                        </select>
                        <span class="error" id="destination_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="type"><?php echo get_phrase('type'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="type">
                            <!-- get dynamically-->
                            <option value="">Please Select</option>
                            <option value="student"><?php echo get_phrase('student'); ?></option>
                            <option value="employee"><?php echo get_phrase('employee'); ?></option>
                        </select>
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 hidden" id="show_course">
                    <div class="form-group">
                        <label for="course"><?php echo get_phrase('course'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="course">
                            <!-- get dynamically-->
                            <option value="">Please Select</option>
                            <option value="test">test</option>
                        </select>
                        <span class="error" id="course_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 hidden" id="show_batch">
                    <div class="form-group">
                        <label for="batch"><?php echo get_phrase('batch'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="batch">
                            <!-- get dynamically-->
                            <option value="">Please Select</option>
                            <option value="test">test</option></option>
                        </select>
                        <span class="error" id="batch_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 hidden" id="show_stu_name">
                    <div class="form-group">
                        <label for="student_name"><?php echo get_phrase('student_name'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="stu_name">
                            <!-- get dynamically-->
                            <option value="">Please Select</option>
                            <option value="test">Test</option>
                        </select>
                        <span class="error" id="stu_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 hidden" id="show_emp_name">
                    <div class="form-group">
                        <label for="employee_name"><?php echo get_phrase('employee_name'); ?></label><span class="error">&nbsp;*</span>
                        <select class="form-control" id="emp_name">
                            <!-- get dynamically-->
                            <option value="">Please Select</option>
                            <option value = "test">Test</option>
                        </select>
                        <span class="error" id="emp_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="start_date"><?php echo get_phrase('start_date'); ?></label>
                        <input type="text" class="form-control datepicker" id="start_date">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="stop_date"><?php echo get_phrase('stop_date'); ?></label>
                        <input type="text" class="form-control datepicker" id="stop_date">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" id="save"><?php echo get_phrase('save'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo get_phrase('list'); ?></div>
            <div class="panel-body"></div>
        </div>
    </div>
</div>
<script>
     $('#type').on("change", function(){
            var type = $('#type').val();
            if(type == 'student'){
                $('#show_course').removeClass('hidden');
                $('#show_batch').removeClass('hidden');
                $('#show_stu_name').removeClass('hidden');
                $('#show_emp_name').addClass('hidden');
            } else if(type == 'employee'){
                $('#show_emp_name').removeClass('hidden');
                $('#show_course').addClass('hidden');
                $('#show_batch').addClass('hidden');
                $('#show_stu_name').addClass('hidden');
            } else{
                $('#show_course').addClass('hidden');
                $('#show_batch').addClass('hidden');
                $('#show_stu_name').addClass('hidden');
                $('#show_emp_name').addClass('hidden');
            }
        });
        $('#save').on('click', function(){
            var routeCode = $('#route_code').val();
            var destination = $('#destination').val();
            var type = $('#type').val();
            var startDate = $('start_date').val();
            var stopDate = $('#stop_date').val();
            var formSubmit = false;
            if(routeCode == ''){
              $('#code_error').text('Please select route code');
            }else{
              $('#code_error').text('');
            }
            if(destination == ''){
              $('#destination_error').text('Please select destination');
            }else{
              $('#destination_error').text('');
            }
            if(type == ''){
              $('#type_error').text('Please select type');
            }else{
              $('#type_error').text('');
            }
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
                  $('#stu_error').text('Please select student name');
                }else{
                  $('#stu_error').text('');
                }
            }
            if(type == 'employee'){
              var employeeName = $('#emp_name').val();
              if(employeeName == ''){
                $('#emp_error').text('Please select employee name');
              }else{
                $('#emp_error').text('');
              }
            }
            if(routeCode == '' || destination == '' || type == ''){
              formSubmit = false;
            }else if(type != ''){
              if(type == 'student'){
                if(batch == '' || course == '' || studentName == ''){
                  formSubmit = false;
                }else{
                  formSubmit = true;
                }
              }else{
                if(employeeName == ''){
                  formSubmit = false;
                }else{
                  formSubmit = true;
                }
              }
            }else{
              formSubmit = true;
            }
            if(formSubmit){
              alert(routeCode + destination + type);
            }else{
              
            }
        });
</script>
