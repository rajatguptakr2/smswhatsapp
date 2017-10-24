<hr>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="alert alert-warning">
            <h4>Work in Progress</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('employee_registeration'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo get_phrase('employee_details'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label for="employee_code"><?php echo get_phrase('employee_code'); ?><span class="error">*</span></label>
                                  <input type="text" class="form-control" id="code">
                                  <span class="error" id="code_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label for="joining_date"><?php echo get_phrase('joining_date'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control datepicker" id="join_date">
                                    <span class="error" id="join_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label for="department"><?php echo get_phrase('department'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="department">
                                      <?php
                                        foreach ($department_list as $department){
                                          echo '<option value="'.$department->name.'">';
                                          echo $department->name;
                                          echo '</option>';
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label for="designation"><?php echo get_phrase('designation'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="designation">
                                      <?php
                                        foreach ($designation_list as $designation){
                                          echo '<option value="'.$designation->name.'">';
                                          echo $designation->name;
                                          echo '</option>';
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label for="qualification"><?php echo get_phrase('qualification'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control" id="qualification">
                                    <span class="error" id="qualification_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label for="total_experience"><?php echo get_phrase('total_experience'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control" id="experience">
                                    <span class="error" id="experience_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label for="user_type"><?php echo get_phrase('user_type'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="usertype">
                                      <?php
                                        foreach ($usertype_list as $user){
                                          echo '<option value="'.$user->usertype.'">';
                                          echo $user->usertype;
                                          echo '</option>';
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo get_phrase('personel_details'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="first_name"><?php echo get_phrase('first_name'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control" id="first_name">
                                    <span class="error" id="firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="middle_name"><?php echo get_phrase('middle_name'); ?></label>
                                    <input type="text" class="form-control" id="middle_name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="last_name"><?php echo get_phrase('last_name'); ?></label>
                                    <input type="text" class="form-control" id="last_name">
                                    <span class="error" id="lastname_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="date_of_birth"><?php echo get_phrase('date_of_birth'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control datepicker" id="dob">
                                    <span class="error" id="dob_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="gender"><?php echo get_phrase('gender'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="gender">
                                        <option value="male"><?php echo get_phrase('male'); ?></option>
                                        <option value="female"><?php echo get_phrase('female'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="upload_photo"><?php echo get_phrase('upload_photo'); ?></label>
                                    <input type="file" class="form-control" id="photo">
                                    <span class="error" id="photo_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo get_phrase('contact_details'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="present_address"><?php echo get_phrase('present_address'); ?><span class="error">*</span></label>
                                    <textarea class="form-control" id="present_addr"></textarea>
                                    <span class="error" id="present_addr_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="permanent_address"><?php echo get_phrase('permanent_address'); ?><span class="error">*</span></label>
                                    <textarea class="form-control" id="permanent_addr"></textarea>
                                    <span class="error" id="permanent_addr_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="country"><?php echo get_phrase('country'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="country">
                                        <option value="test">Test</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="state"><?php echo get_phrase('state'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="state">
                                        <option value="test">Test</option>
                                    </select>
                                </div>
                            </div><div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="city"><?php echo get_phrase('city'); ?><span class="error">*</span></label>
                                    <select class="form-control" id="city">
                                        <option value="test">Test</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="pin"><?php echo get_phrase('pin'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control" id="pin">
                                    <span class="error" id="pin_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="mobile_no"><?php echo get_phrase('mobile_no'); ?><span class="error">*</span></label>
                                    <input type="text" class="form-control" id="mobile_no">
                                    <span class="error" id="mobile_no_error"></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="email"><?php echo get_phrase('email'); ?><span class="error">*</span></label>
                                    <input type="email" class="form-control" id="email">
                                    <span class="error" id="email_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="save"><?php echo get_phrase('save'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  var host = "http://localhost/demoi/index.php?admin/employee/";
  $('#save').bind('click', function(){
    var formSubmit = false;
    var employeeCode = $('#code').val();
    var joinDate = $('#join_date').val();
    var department = $('#department').val();
    var designation = $('#designation').val();
    var qualification = $('#qualification').val();
    var totalExperience = $('#experience').val();
    var usertype = $('#usertype').val();
    var firstName = $('#first_name').val();
    var middleName = $('#middle_name').val();
    var lastName = $('#last_name').val();
    var dob = $('#dob').val();
    var gender = $('#gender').val();
    var presentAddress = $('#present_addr').val();
    var permanentAddress = $('#permanent_addr').val();
    var country = $('#country').val();
    var state = $('#state').val();
    var city = $('#city').val();
    var pin = $('#pin').val();
    var mobileNumber = $('#mobile_no').val();
    var email = $('#email').val();

    // Validations
    if(employeeCode == ''){
      $('#code_error').text('Employee code cannot be empty');
    }else{
      $('#code_error').text('');
    }
    if(joinDate == ''){
      $('#join_error').text('Join date cannot be empty');
    }else{
      $('#join_error').text('');
    }
    if(qualification == ''){
      $('#qualification_error').text('Qalification cannot be empty');
    }else{
      $('#qualification_error').text('');
    }
    if(totalExperience == ''){
      $('#experience_error').text('Experience cannot be empty');
    }else{
      $('#experience_error').text('');
    }
    if(firstName == ''){
      $('#firstname_error').text('First name cannot be empty');
    }else{
      $('#firstname_error').text('');
    }
    if(lastName == ''){
      $('#lastname_error').text('Last name cannot be empty');
    }else{
      $('#lastname_error').text('');
    }
    if(dob == ''){
      $('#dob_error').text('Date of Birth cannot be empty');
    }else{
      $('#dob_error').text('');
    }
    if(presentAddress == ''){
      $('#present_addr_error').text('Present Address cannot be empty');
    }else{
      $('#present_addr_error').text('');
    }
    if(permanentAddress == ''){
      $('#permanent_addr_error').text('Permanent address cannot be empty');
    }else{
      $('#permanent_addr_error').text('');
    }
    if(pin == ''){
      $('#pin_error').text('Pin code cannot be empty');
    }else{
      $('#pin_error').text('');
    }
    if(mobileNumber == ''){
      $('#mobile_no_error').text('Mobile number cannot be empty');
    }else{
      $('#mobile_no_error').text('');
    }
    if(email == ''){
      $('#email_error').text('Email cannot be empty');
    }else{
      $('#email_error').text('');
    }
    if(employeeCode == '' || joinDate == '' || qualification == '' ||
      totalExperience == '' || firstName == '' || lastName == '' ||
      dob == '' || presentAddress == '' || permanentAddress == '' || pin == '' ||
      mobileNumber == '' || email == ''){
        formSubmit = false;
      }else{
        formSubmit = true;
      }
      if(formSubmit){
        $.ajax({
          type: 'POST',
          url : host + 'add',
          dataType: 'json',
          data: {
            'employeeCode': employeeCode,
            'joinDate': joinDate,
            'department': department,
            'designation': designation,
            'qualification': qualification,
            'totalExperience': totalExperience,
            'usertype': usertype,
            'firstName': firstName,
            'middleName': middleName,
            'lastName': lastName,
            'dob': dob,
            'gender': gender,
            'presentAddress': presentAddress,
            'permanentAddress': permanentAddress,
            'country': country,
            'state': state,
            'city': city,
            'pin': pin,
            'mobile': mobileNumber,
            'email': email
          },
          success: function(data){
            alert(data.message);

          },
          error: function(data){

          }
        });
      }
  });
</script>
