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
                <?php echo get_phrase('add_destination_&_fees'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="route_code"><?php echo get_phrase('route_code'); ?></label><span class="error">&nbsp;*</span>
                    <select class="form-control" id="route_code">
                        <!-- get dynamically-->
                        <option></option>
                        <option value="text">test</option>
                    </select>
                    <span class="error" id="code_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="pickup_drop"><?php echo get_phrase('pickup_&_drop'); ?><span class="error">&nbsp;*</span></label>
                    <input type="text" class="form-control" id="pick_drop">
                    <span class="error" id="pick_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="stop_time"><?php echo get_phrase('stop_time'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control" id="stop_time">
                        <span class="error" id="stop_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="amount"><?php echo get_phrase('amount'); ?></label>
                        <input type="text" class="form-control" id="amount">
                        <span class="error" id="amount_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="fee_type"><?php echo get_phrase('fee_type'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control" id="fee_type">
                            <option value="">Please Select</option>
                            <option value="annual"><?php echo get_phrase('annual'); ?></option>
                            <option value="bi_annual"><?php echo get_phrase('bi_annual'); ?></option>
                            <option value="tri_annual"><?php echo get_phrase('tri_annual'); ?></option>
                            <option value="quarterly"><?php echo get_phrase('quarterly'); ?></option>
                            <option value="monthly"><?php echo get_phrase('monthly'); ?></option>
                        </select>
                        <span class="error" id="type_error"></span>
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
        var routeCode = $('#route_code').val();
        var pickupDrop = $('#pick_drop').val();
        var stopTime = $('#stop_time').val();
        var amount = $('#amount').val();
        var feeType = $('#fee_type').val();
        var formSubmit = false;
        if(routeCode == ''){
            $('#code_error').text('Please select route code');
        }else{
            $('#code_error').text('');
        }
        if(pickupDrop == ''){
            $('#pick_error').text('Pickup and Drop required');
        }else{
            $('#pick_error').text('');
        }
        if(stopTime == ''){
            $('#stop_error').text('Stop time rquired');
        }else{
            $('#stop_error').text('');
        }
        if(feeType == ''){
            $('#type_error').text('Please select fee type');
        }else{
            $('#type_error').text('');
        }
        if(routeCode == '' || pickupDrop == '' || stopTime == '' || feeType == ''){
            formSubmit = false;
        }else{
            formSubmit = true;
        }

        if(formSubmit){
            alert(routeCode + stopTime + pickupDrop + amount + feeType);
        }


    });    
</script>