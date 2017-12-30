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
                <?php echo get_phrase('add_vehicle'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="vehicle_no"><?php echo get_phrase('vehicle_no'); ?></label><span class="error">&nbsp;*</span>
                    <input type="text" id="vehicle_no" class="form-control" >
                    <span class="error" id="no_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="no_of_seats"><?php echo get_phrase('no_of_seats'); ?><span class="error">&nbsp;*</span></label>
                    <input type="text" id="seats" class="form-control" >
                    <span class="error" id="seat_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="maximum_allowed"><?php echo get_phrase('maximum_allowed'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" id="max_allow" class="form-control">
                        <span class="error" id="max_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="vehicle_type"><?php echo get_phrase('vehicle_type'); ?><span class="error">&nbsp;*</span></label>
                        <select name="vehicle_type" id="type" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('please_select');?></option>
                            <option value="contract"><?php echo get_phrase('contract');?></option>
                            <option value="ownership"><?php echo get_phrase('ownership');?></option>
                        </select>
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="contact_person"><?php echo get_phrase('contact_person'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" id="contact_person" class="form-control">
                        <span class="error" id="contact_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="insurance_renewal_data"><?php echo get_phrase('insurance_renewal_date'); ?></label>
                        <input type="text" id="renew_date" class="form-control datepicker">
                    </div>
                </div>
                <div class="col-xs-12" id="result">

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
            <div class="panel-body">
            
            </div>
        </div>
    </div>
</div>
<!-- Form Submit using AJAX -->
<script>
    $('#save').on('click', function() {
        var formSubmit = false;
        var vehicleNumber = $('#vehicle_no').val();
        var noOfSeats = $('#seats').val();
        var maxAllowed = $('#max_allow').val();
        var vehicleType = $('#type').val();
        var contactPerson = $('#contact_person').val();
        var renewDate = $('#renew_date').val();

        //Validations
        if( vehicleNumber == ''){
            $('#no_error').html('<p>Vehicle number required.</p>');
        } else{
            $('#no_error').html('');
        }
        if(noOfSeats == ''){
            $('#seat_error').html('<p>NUmber of seats required</p>');
        } else{
            $('#seat_error').html('');
        }
        if(maxAllowed == ''){
            $('#max_error').html('<p>Maximum seat allowed required</p>');
        } else{
            $('#max_error').html('');
        }
        if(vehicleType == '') {
            $('#type_error').html('<p>Please vehicle type</p>');
        } else{
            $('#type_error').html('');
        }
        if(contactPerson == ''){
            $('#contact_error').html('<p>Contact person required</p>');
        } else{
            $('#contact_error').html('');
        }

        if(vehicleNumber == '' || noOfSeats == '' || maxAllowed == '' || vehicleType == '' || contactPerson == ''){
            formSubmit = false;
        } else{
            formSubmit =  true;
        }

        if(formSubmit){
          var host = 'http://localhost/demoi/index.php?admin/vehicle/';
            $.ajax({
              type: 'POST',
              url: host + 'add',
              dataType: 'json',
              data: {
                'vehicleNumber': vehicleNumber,
                'seats': noOfSeats,
                'max': maxAllowed,
                'type': vehicleType,
                'contactPerson': contactPerson,
                'insuranceDate': renewDate
              },
              success: function(data){
                alert(data.message);
              },
              error: function(data){
                alert(data.message);
              }
            });
        }
    });
</script>
