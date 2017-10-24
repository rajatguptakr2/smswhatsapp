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
                <?php echo get_phrase('add_driver'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="vehicle_no"><?php echo get_phrase('vehicle_no'); ?></label><span class="error">&nbsp;*</span>
                    <select class="form-control" id="vehicle_no">
                        <!-- get dynamically-->
                        <option value=''></option>
                        <option value='test'>test</option>
                    </select>
                    <span class="error" id="no_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="name"><?php echo get_phrase('name'); ?><span class="error">&nbsp;*</span></label>
                    <input type="text" class="form-control" id="name">
                    <span class="error" id="name_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="present_address"><?php echo get_phrase('present_address'); ?><span class="error">&nbsp;*</span></label>
                        <textarea class="form-control" id="present_address"></textarea>
                        <span class="error" id="addr_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="permanent_address"><?php echo get_phrase('permanent_address'); ?></label>
                        <textarea class="form-control" id="permanent_address"></textarea>
                        <span class="error" id="paddr_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="date_of_birth"><?php echo get_phrase('date_of_birth'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control datepicker" id="dob">
                        <span class="error" id="dob_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="phone"><?php echo get_phrase('phone'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control" id="phone">
                        <span class="error" id="phone_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="license_no"><?php echo get_phrase('license_no'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control" id="license_no">
                        <span class="error" id="license_error"></span>
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
    $('#save').on('click', function(){
        var formSubmit = false;
        var vehicleNumber = $('#vehicle_no').val();
        var name = $('#name').val();
        var presentAddress = $('#present_address').val();
        var permanentAddress = $('#permanent_address').val();
        var dob = $('#dob').val();
        var phone = $('#phone').val();
        var licenseNumber = $('#license_no').val();
        if(vehicleNumber == ''){
            $('#no_error').text('Please select vehicle number');
        } else {
            $('#no_error').text('');
        }
        if(name == ''){
            $('#name_error').text('Name is required');
        } else{
            $('#name_error').text('');
        }
        if(presentAddress == ''){
            $('#addr_error').text('Present Address required');
        } else{
            $('#addr_error').text('');
        }
        if(dob == ''){
            $('#dob_error').text('Please enter date of birth');
        }else{
            $('#dob_error').text('');
        }
        if(phone == ''){
            $('#phone_error').text('Phone Number required');
        } else{
            $('#phone_error').text('');
        }
        if(licenseNumber == ''){
            $('#license_error').text('License number required');
        }else{
            $('#license_error').text('');
        }
        if(vehicleNumber == '' || name == '' || presentAddress == '' ||
        dob == '' || phone == ''|| licenseNumber == ''){
            formSubmit = false;
        }else{
            formSubmit = true;
        }

        if(formSubmit){
            alert(vehicleNumber + name + presentAddress + permanentAddress + dob + phone + licenseNumber);
        }
    });
</script>