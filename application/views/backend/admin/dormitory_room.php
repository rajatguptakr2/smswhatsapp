<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('add_hostel_room'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="hostel_type"><?php echo get_phrase('hostel_type'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control" id="type">
                            <option value=""> Get Dynamically </option>
                            <option value="test"></option>
                        </select>
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="hostel_name"><?php echo get_phrase('hostel_name'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control" id="name">
                            <option value=""> Get Dynamically </option>
                            <option value="test">test</option>
                        </select>
                        <span class="error" id="name_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="floor_name"><?php echo get_phrase('floor_name'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control" id="fname">
                        <span class="error" id="fname_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <input type="text" placeholder="Room No." class="form-control" id="room_no">
                        <span class="error" id="no_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <input type="text" placeholder="No of Beds" class="form-control" id="bed_no">
                        <span class="error" id="bed_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <input type="text" placeholder="Amount" class="form-control" id="amount">
                        <span class="error" id="amount_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="addmore">+</button>
                        <span class="error" id="addmore_error"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="fee_type"><?php echo get_phrase('fee_type'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control" id="feetype">
                            <option value="">Please Select</option>
                            <option value="annual"><?php echo get_phrase('annual'); ?></option>
                            <option value="bi_annual"><?php echo get_phrase('bi_annual'); ?></option>
                            <option value="tri_annual"><?php echo get_phrase('tri_annual'); ?></option>
                            <option value="quarterly"><?php echo get_phrase('quarterly'); ?></option>
                            <option value="monthly"><?php echo get_phrase('monthly'); ?></option>
                        </select>
                        <span class="error" id="feetype_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" id="save_btn"><?php echo get_phrase('save'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('list'); ?>
            </div>
            <div class="panel-body"></div>
        </div>
    </div>
</div>
<script>
$('#addmore').on('click', function(){
  var floorName = $('#fname').val();
  var roomNo = $('#room_no').val();
  var beds = $('#bed_no').val();
  var amount = $('#amount').val();
  if(roomNo == ''){
    $('#no_error').text('Rooms cannot be empty');
  }else{
    $('#no_error').text('');
  }
  if(floorName == ''){
    $('#fname_error').text('floor name cannot be empty');
  }else{
    $('#fname_error').text('');
  }
  if(beds == ''){
    $('#bed_error').text('Beds cannot be empty');
  }else{
    $('#bed_error').text('');
  }
  if(amount == ''){
    $('#amount_error').text('Amount cannot be empty');
  }
  else{
    $('#amount_error').text('');
  }
});
$('#save_btn').on('click', function(){
  var hostelType = $('#type').val();
  var hostelName = $('#name').val();
  var floorName = $('#fname').val();
  var roomNo = $('#room_no').val();
  var beds = $('#bed_no').val();
  var amount = $('#amount').val();
  var feeType = $('#feetype').val();
  var formSubmit = false;
  if(hostelType == ''){
    $('#type_error').text('Please select hostel type');
  }else{
    $('#type_error').text('');
  }
  if(hostelName == ''){
    $('#name_error').text('Hostel name cannot be empty');
  }else{
    $('#name_error').text('');
  }
  if(roomNo == ''){
    $('#no_error').text('Rooms cannot be empty');
  }else{
    $('#no_error').text('');
  }
  if(floorName == ''){
    $('#fname_error').text('floor name cannot be empty');
  }else{
    $('#fname_error').text('');
  }
  if(beds == ''){
    $('#bed_error').text('Beds cannot be empty');
  }else{
    $('#bed_error').text('');
  }
  if(amount == ''){
    $('#amount_error').text('Amount cannot be empty');
  }
  else{
    $('#amount_error').text('');
  }
  if(feeType == ''){
    $('#feetype_error').text('Please select fee type');
  }else{
    $('#feetype_error').text('');
  }
});
</script>
