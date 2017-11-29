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
                <?php echo get_phrase('fee_collection'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?></label>
                        <select class="form-control" id="type">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="employee"><?php echo get_phrase('employee'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_department">
                    <div class="form-group">
                        <label for="department"><?php echo get_phrase('department'); ?></label>
                        <select class="form-control" id="department">
                            <!-- get dynamically -->
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                        </select>
                        <span class="error" id="department_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 hidden" id="show_employee">
                    <div class="form-group">
                        <label for="employee"><?php echo get_phrase('employee'); ?></label>
                        <select class="form-control" id="employee">
                            <!-- get dynamically-->
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                        </select>
                        <span class="error" id="emp_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-1 hidden" id="show_button">
                    <button class="btn btn-primary" id="go">Go</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#type').on('change', function(){
      var type = $('#type').val();
      if(type == 'employee'){
        $('#show_department').removeClass('hidden');
        $('#show_employee').removeClass('hidden');
        $('#show_button').removeClass('hidden');
      }else{
        $('#show_department').addClass('hidden');
        $('#show_employee').addClass('hidden');
        $('#show_button').addClass('hidden');
      }
    });
    $('#go').on('click', function(){
      var formSubmit = false;
      var department = $('#department').val();
      var employee = $('#employee').val();
      if(department == ''){
        $('#department_error').text('Please select department');
      }else{
        $('#department_error').text('');
      }
      if(employee == ''){
        $('#emp_error').text('Please select employee');
      }else{
        $('#emp_error').text('');
      }
      if(department == '' || employee == ''){
        formSubmit = false;
      }else{
        formSubmit = true;
      }
      if(formSubmit){
        alert(employee + department);
      }
    });
</script>
