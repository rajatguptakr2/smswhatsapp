<hr>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="alert alert-warning">
            <h4>Work in Progress</h4>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Salary Setting
      </div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
            <label for="designation">Designation</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="designation">
              <option value=""></option>
              <?php
                foreach ($designation_list as $designation){
                  echo '<option value="'.$designation->name.'">';
                  echo $designation->name;
                  echo '</option>';
                }
              ?>
            </select>
            <span class="error" id="designation_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="employee_name">Employee Name</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="emp_name">

            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="payhead_master">Payhead Master</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="payhead">
              <?php
                foreach ($payhead_list as $list){
                  echo '<option value="'.$list->name.'">';
                  echo $list->name;
                  echo '</option>';
                }
                ?>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="unit">Unit</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control" id="unit">
            <span class="error" id="unit_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="type">Type</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="type">
              <option value="amount">Amount</option>
              <option value="percentage">Percentage</option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" id="save">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        List
      </div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Employee Code</th>
              <th>PayHead</th>
              <th>Unit</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($salary_list as $list){
              $i+=1;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$list->employee_code.'</td>';
                echo '<td>'.$list->payhead.'</td>';
                echo '<td>'.$list->unit.'</td>';
                echo '<td>'.$list->type.'</td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
var host = "http://localhost/demoi/index.php?admin/salary/";
$('#designation').on('change', function(){
  var designation = $('#designation').val();
  $.ajax({
    type: 'POST',
    url: host + 'get_employee_list',
    data: {
      'designation': designation
    },
    dataType: 'json',
    success: function(data){
      $.each(data, function(i, item){
        $('#emp_name').append($('<option>', {
          value: item.employee_code,
          text: item.first_name + ' ' + item.last_name
        }));
      });
    },error: function(){
      alert('error in request');
    }
  });
});

$('#unit').keyup(function(){
  var unit = $('#unit').val();
  if(unit == ''){
    $('#unit_error').text('Unit cannot be empty');
  }else{
    $('#unit_error').text('');
  }
});

$('#save').on('click', function(){
  var designation = $('#designation').val();
  var emp_code = $('#emp_name').val();
  var payhead = $('#payhead').val();
  var unit = $('#unit').val();
  var type = $('#type').val();
  if(designation == ''){
    $('#designation_error').text('Designation cannot be empty');
  }else{
    $('#designation_error').text('');
  }
  if(unit == ''){
    $('#unit_error').text('Unit cannot be empty');
  }else{
    $('#unit_error').text('');
  }
  if(designation == '' || unit == ''){
    formSubmit = false;
  }else{
    formSubmit = true;
  }
  if(formSubmit){
    $.ajax({
      url: host + 'add',
      type: 'post',
      data: {
        'designation': designation,
        'emp_code': emp_code,
        'payhead': payhead,
        'unit': unit,
        'type': type
      },
      dataType: 'json',
      success: function(data){
        alert(data.message);
        if(data.status == '400'){
          setTimeout(function(){
            location.reload();
          });
        }
      },
      error: function(){
        alert('Error in sending request');
      }
    });
  }
});

</script>
