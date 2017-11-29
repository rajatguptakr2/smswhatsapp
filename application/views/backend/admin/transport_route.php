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
                <?php echo get_phrase('add_route'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="vehicle_no"><?php echo get_phrase('vehicle_no'); ?></label><span class="error">&nbsp;*</span>
                    <select class="form-control" id="vehicle_no">
                        <!-- get dynamically-->
                        <option></option>
                        <option value="test">test</option>
                    </select>
                    <span class="error" id="no_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="form-group">
                    <label for="route_code"><?php echo get_phrase('route_code'); ?><span class="error">&nbsp;*</span></label>
                    <input type="text" class="form-control" id="route_code">
                    <span class="error" id="code_error"></span>
                </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="route_start_place"><?php echo get_phrase('route_start_place'); ?><span class="error">&nbsp;*</span></label>
                        <textarea class="form-control" id="start_place"></textarea>
                        <span class="error" id="start_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="route_stop_place"><?php echo get_phrase('route_stop_place'); ?><span class="error">&nbsp;*</span></label>
                        <textarea class="form-control" id="stop_place"></textarea>
                        <span class="error" id="stop_error"></span>
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
        var routeCode = $('#route_code').val();
        var startPlace = $('#start_place').val();
        var stopPlace = $('#stop_place').val();
        if(vehicleNumber == '' ){
            $('#no_error').text('Please select vehicle number');
        }else{
            $('#no_error').text('');
        }
        if(routeCode == ''){
            $('#code_error').text('Route Code required');
        }else{
            $('#code_error').text('');
        }
        if(startPlace == ''){
            $('#start_error').text('Route start place required');
        } else{
            $('#start_error').text('');
        }
        if(stopPlace == ''){
            $('#stop_error').text('Route stop place required');
        }else{
            $('#stop_error').text('');
        }
        if(vehicleNumber == '' || routeCode == '' || startPlace == '' || stopPlace == ''){
            formSubmit = false;
        }else{
            formSubmit = true;
        }
        if(formSubmit){
            alert(vehicleNumber + routeCode + startPlace + stopPlace);
        }

    });
</script>