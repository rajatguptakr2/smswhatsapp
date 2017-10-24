<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#hostel_type"><?php echo get_phrase('hosetl_type'); ?></a></li>
  <li><a data-toggle="tab" href="#hostel_details"><?php echo get_phrase('hostel_details'); ?></a></li>
</ul>
<div class="tab-content">
  <div id="hostel_type" class="tab-pane fade in active">
    <br>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo get_phrase('add_hostel_type'); ?>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="hostel_type"><?php echo get_phrase('hostel_type'); ?><span class="error">&nbsp;*</span></label>
                            <input type="text" class="form-control" id="type">
                            <span class="error" id="type_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="add"><?php echo get_phrase('add'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo get_phrase('list'); ?>
                </div>
                <div class="panel-body">

                </div>
            </div>
          </div>
    </div>
    </div>
    <div id="hostel_details" class="tab-pane">
      <br>
       <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo get_phrase('add_hostel'); ?>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="hostel_type"><?php echo get_phrase('hostel_type'); ?><span class="error">&nbsp;*</span></label>
                            <select class="form-control" id="htype">
                                <option></option>
                            </select>
                            <span class="error" id="htype_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="hostel_name"><?php echo get_phrase('hostel_name'); ?><span class="error">&nbsp;*</span></label>
                            <input type="text" class="form-control" id="hostel_name">
                            <span class="error" id="name_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="hostel_address"><?php echo get_phrase('hostel_address'); ?><span class="error">&nbsp;*</span></label>
                            <textarea class="form-control" id="address"></textarea>
                            <span class="error" id="address_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="hostel_phone_no"><?php echo get_phrase('hostel_phone_no'); ?><span class="error">&nbsp;*</span></label>
                            <input type="text" class="form-control" id="phone">
                            <span class="error" id="phone_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="warden_name"><?php echo get_phrase('warden_name'); ?><span class="error">&nbsp;*</span></label>
                            <input type="text" class="form-control" id="warden">
                            <span class="error" id="warden_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="warden_address"><?php echo get_phrase('warden_address'); ?><span class="error">&nbsp;*</span></label>
                            <textarea class="form-control" id="waddress"></textarea>
                            <span class="error" id="waddress_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="warden_phone_no"><?php echo get_phrase('warden_phone_no'); ?><span class="error">&nbsp;*</span></label>
                            <input type="text" class="form-control" id="wphone">
                            <span class="error" id="wphone_error"></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="add_hostel"><?php echo get_phrase('add'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo get_phrase('list'); ?>
                </div>
                <div class="panel-body">

                </div>
            </div>
          </div>
    </div>
  </div>
</div>
<script>
  $('#add').on('click', function(e) {
    e.preventDefault();
    var hostelType = $('#type').val();
    var formSubmit = false;
    if(hostelType == ''){
      $('#type_error').text('Hostel type cannot be empty');
      formSubmit = false;
    }else{
      $('#type_error').text('');
      formSubmit = true;
    }
    if(formSubmit){
      //Submit form
    }else{
      //show error message
    }
  });

  $('#add_hostel').on('click', function(){
    var hostel = $('#htype').val();
    var name = $('#hostel_name').val();
    var hostelAddress = $('#address').val();
    var hostelPhone = $('#phone').val();
    var wardenName = $('#warden').val();
    var wardenAddress = $('#waddress').val();
    var wardenPhone = $('#wphone').val();
    var formSubmit = false;
    if(hostel == ''){
      $('#htype_error').text('Please select hostel type');
    }else{
      $('#htype_error').text('');
    }
    if(name == ''){
      $('#name_error').text('Hostel name cannot be empty');
    }else{
      $('#name_error').text('');
    }if(hostelAddress == ''){
      $('#address_error').text('Hostel address cannot be empty');
    }else{
      $('#address_error').text('');
    }if(hostelPhone == ''){
      $('#phone_error').text('Hostel phone cannot be empty');
    }else{
      $('#phone_error').text('');
    }if(wardenName == ''){
      $('#warden_error').text('Warden name required');
    }else{
      $('#warden_error').text('');
    }if(wardenAddress == ''){
      $('#waddress_error').text('Warden address required');
    }else{
      $('#waddress_error').text('');
    }if(wardenPhone == ''){
      $('#wphone_error').text('Warden phone required');
    }else{
      $('#wphone_error').text('');
    }
    if(hostel == '' || name == '' || hostelAddress == '' || hostelPhone == ''||
        wardenName == '' || wardenPhone == '' || wardenAddress == ''){
          formSubmit = false;
    }else{
        formSubmit = true;
    }
    if(formSubmit){
      //Submit form
      alert();
    }else{
      //Display error
    }
  });

</script>
