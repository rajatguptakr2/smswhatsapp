<hr>
<div class="row">
  <div class="col-xs-12 col-md-12 alert alert-warning">
    <h4>Work in progress</h4>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <?php echo get_phrase('add_fare'); ?>
      </div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="route"><?php echo get_phrase('route_code'); ?></label>
            <select class="form-control" id="route">
              <option></option>
            </select>
            <span class="error" id="code_error"></span>
          </div>
          <div class="form-group">
            <label for="route"><?php echo get_phrase('stoppage_name'); ?></label>
            <input type="text" class="form-control" id="stoppage">
            <span class="error" id="stop_error"></span>
          </div>
          <div class="form-group">
            <label for="route"><?php echo get_phrase('fare'); ?></label>
            <input type="text" class="form-control" id="fare">
            <span class="error" id="fare_error"></span>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" id="save">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">List</div>
      <div class="panel-body"></div>
    </div>
  </div>
</div>
<script>
  $('#save').on('click', function(){
    var formSubmit = false;
    var routeCode = $('#route').val();
    var stopName = $('#stoppage').val();
    var fare = $('#fare').val();
    if(routeCode == ''){
      $('#code_error').text('Please select a route');
    }else{
      $('#code_error').text('');
    }
    if(stopName == ''){
      $('#stop_error').text('Stoppage name cannot be empty');
    }else{
      $('#stop_error').text('');
    }
    if(fare == ''){
      $('#fare_error').text('Fare cannot be empty');
    }else{
      $('#fare_error').text('');
    }
    if(routeCode == '' || stopName == '' || fare == ''){
      formSubmit = false;
    }else{
      formSubmit = true;
    }
    if( formSubmit ){
      //Form Submit
      alert();
    }else{
      // Error message
    }

  });
</script>
