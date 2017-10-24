<hr>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="alert alert-warning">
            <h4>Work in Progress</h4>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-12">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#add_bank">Add Bank</a></li>
      <li><a data-toggle="tab" href="#employee">Employee</a></li>
      <li><a data-toggle="tab" href="#list_all">List All</a></li>
    </ul>

    <div class="tab-content">
      <div class="row tab-pane fade in active" id="add_bank">
        <div class="col-xs-12 col-md-6">
          <br>
            <div class="col-xs-12 col-md-12">
              <div class="form-group">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control" id="bank_name">
                <span class="error" id="bank_error"></span>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-md-2">
              <button class="btn btn-primary" id="save_bank">Save</button>
            </div>
        </div>
        <br>
        <div class="col-xs-12 col-md-6">
          <br>
          <div class="panel panel-primary">
            <div class="panel-heading">
              List
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($bank_list as $list){
                    $i+=1;
                      echo '<tr>';
                      echo '<td>'.$i.'</td>';
                      echo '<td>'.$list->name.'</td>';
                      echo '<td><button class="btn btn-link remove" value="'.$list->id.'">Remove</button></td>';
                      echo '</tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div id="employee" class="row tab-pane fade">
        <br>
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Bank Details</div>
            <div class="panel-body">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="designation">Designation</label>
                  <select class="form-control" id="designation">
                    <option value=""></option>
                    <?php
                      foreach ($designation_list as $list) {
                        echo '<option value="'.$list->name.'">';
                        echo $list->name."</option>";
                      }
                    ?>
                    <span class="error" id="designation_error"></span>
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="name">Employee Name</label>
                  <select class="form-control" id="emp_name">
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="bank_name">Bank Name</label>
                  <select class="form-control" id="bank">
                    <?php
                      foreach ($bank_list as $list) {
                        echo '<option value="'.$list->name.'">';
                        echo $list->name."</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="branch">Branch</label><span class="error">&nbsp;*</span>
                  <input type="text" class="form-control" id="branch">
                  <span class="error" id="branch_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="bank_address">Bank Address</label><span class="error">&nbsp;*</span>
                  <textarea class="form-control" id="bank_addr"></textarea>
                  <span class="error" id="addr_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="phone">Phone</label><span class="error">&nbsp;*</span>
                  <input type="text" class="form-control" id="phone">
                  <span class="error" id="phone_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="ifsc">IFSC Code</label><span class="error">&nbsp;*</span>
                  <input type="text" class="form-control" id="ifsc">
                  <span class="error" id="ifsc_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="account">Account No</label><span class="error">&nbsp;*</span>
                  <input type="text" class="form-control" id="account">
                  <span class="error" id="account_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="dd_address">DD Payable Address</label><span class="error">&nbsp;*</span>
                  <input type="text" class="form-control" id="dd_addr">
                  <span class="error" id="dd_error"></span>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <button class="btn btn-primary" id="save_details">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="list_all" class="row tab-pane fade">
        <br>
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Bank Details
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee Code</th>
                    <th>Bank</th>
                    <th>Branch</th>
                    <th>Account No</th>
                    <th>IFSC Code</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($details_list as $list){
                    $i+=1;
                      echo '<tr>';
                      echo '<td>'.$i.'</td>';
                      echo '<td>'.$list->employee_code.'</td>';
                      echo '<td>'.$list->bank_name.'</td>';
                      echo '<td>'.$list->branch.'</td>';
                      echo '<td>'.$list->account.'</td>';
                      echo '<td>'.$list->ifsc.'</td>';
                      echo '</tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
var host = "http://localhost/demoi/index.php?admin/bank/";


$('#bank_name').keyup(function(){
  var bankName = $('#bank_name').val();
  if(bankName == ''){
    $('#bank_error').text('Bank name cannot be empty');
  }else{
    $('#bank_error').text('');
  }
});
$('#save_bank').bind('click', function(){
  var bankName = $('#bank_name').val();
  var formSubmit = false;
  if(bankName == ''){
    $('#bank_error').text('Bank name cannot be empty');
    formSubmit = false;
  }else{
    $('#bank_error').text('');
    formSubmit = true;
  }
  if(formSubmit){
    $.ajax({
      type: 'POST',
      url: host + 'add_bank',
      dataType: 'json',
      data: {
        'bankName': bankName
      },
      success: function(data){
        alert(data.message);
        if(data.status == '400'){
            setTimeout(function(){
                location.reload();
            },0);
        }
      },error: function(){
        alert('Developer error');
      }
    });
  }
});
$('.remove').bind('click', function(){
  var id = $(this).val();
  var schoolId = 1;
  $.ajax({
    url: host + 'delete',
    type: 'POST',
    data: {'id': id},
    dataType: 'json',
    success: function(data){
      alert(data.message);
      setTimeout(function(){
        location.reload();
      },0);
    },error: function(){
      alert('Developer error REQUEST Error');
    }
  });
});

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

$('#save_details').on('click', function(){
  var designation = $('#designation').val();
  var employeeName = $('#emp_name').val();
  var bankName = $('#bank').val();
  var branch = $('#branch').val();
  var bankAddress = $('#bank_addr').val();
  var phone = $('#phone').val();
  var ifsc = $('#ifsc').val();
  var account = $('#account').val();
  var dd = $('#dd_addr').val();
  var formSubmit = false;
  if(designation == ''){
    $('#designation_error').text('Please select designation');
  }else{
    $('#designation_error').text('');
  }
  $('#branch').keyup(function(){
    var branch = $('#branch').val();
    if(branch == ''){
      $('#branch_error').text('Branch cannot be empty');
    }else{
      $('#branch_error').text('');
    }
  });
  $('#bankAddress').keyup(function(){
    var bankAddress = $('#bankAddress').val();
    if(bankAddress == ''){
      $('#addr_error').text('Bank Address cannot be empty');
    }else{
      $('#addr_error').text('');
    }
  });
  $('#phone').keyup(function(){
    var phone = $('#phone').val();
    if(phone == ''){
      $('#phone_error').text('Phone cannot be empty');
    }else{
      $('#phone_error').text('');
    }
  });
  $('#ifsc').keyup(function(){
    var ifsc = $('#ifsc').val();
    if(ifsc == ''){
      $('#ifsc_error').text('IFSC cannot be empty');
    }else{
      $('#ifsc_error').text('');
    }
  });
  $('#account').keyup(function(){
    var account = $('#account').val();
    if(account == ''){
      $('#account_error').text('Account Number cannot be empty');
    }else{
      $('#account_error').text('');
    }
  });
  $('#dd_addr').keyup(function(){
    var dd = $('#dd_addr').val();
    if(dd == ''){
      $('#dd_error').text('DD Address cannot be empty');
    }else{
      $('#dd_error').text('');
    }
  });
  if(branch == ''){
    $('#branch_error').text('Branch cannot be empty');
  }else{
    $('#branch_error').text('');
  }
  if(bankAddress == ''){
    $('#addr_error').text('Bank Address cannot be empty');
  }else{
    $('#addr_error').text('');
  }if(phone == ''){
    $('#phone_error').text('Phone cannot be empty');
  }else{
    $('#phone_error').text('');
  }
  if(ifsc == ''){
    $('#ifsc_error').text('IFSC cannot be empty');
  }else{
    $('#ifsc_error').text('');
  }
  if(account == ''){
    $('#account_error').text('Account Number cannot be empty');
  }else{
    $('#account_error').text('');
  }
  if(dd == ''){
    $('#dd_error').text('DD Address cannot be empty');
  }else{
    $('#dd_error').text('');
  }

  if(designation == '' || bankName == '' || bankAddress == '' || branch == '' ||
    phone == '' || ifsc == '' || account == '' || dd == ''){
      formSubmit = false;
    }else{
      formSubmit = true;
    }
    if(formSubmit){
        $.ajax({
          type: 'POST',
          url: host + 'add_details',
          data:{'designation': designation,
            'employee_code': employeeName,
            'bankName': bankName,
            'branch': branch,
            'address': bankAddress,
            'phone': phone,
            'ifsc': ifsc,
            'account': account,
            'dd': dd},
          dataType: 'json',
          success: function(data){
            alert(data.message);
          },
          error: function(){
            alert('Error in sending request');
          }
        });
    }
});

</script>
