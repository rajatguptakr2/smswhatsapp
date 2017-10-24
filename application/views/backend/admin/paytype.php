<hr>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="alert alert-warning">
      <h4>Work in progress</h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Pay Head Type
      </div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="payable">Payable Type Name</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control" id="payable_type">
            <span class="error" id="payable_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <button class="btn btn-primary" id="save">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">List</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Payable Type</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($payable_list as $list){
              $i+=1;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$list->name.'</td>';
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
var host = "http://localhost/demoi/index.php?admin/paytype/";
$('#payable_type').keyup(function(){
  var payable = $('#payable_type').val();
  if(payable == ''){
    $('#payable_error').text('Payable type cannot be empty');
  }else{
    $('#payable_error').text('');
  }
});
$('#save').on('click', function(){
  var formSubmit = false;
  var payable = $('#payable_type').val();
  if(payable == ''){
    $('#payable_error').text('Payable type cannot be empty');
    formSubmit = false;
  }else{
    $('#payable_error').text('');
    formSubmit = true;
  }
  if(formSubmit){
    $.ajax({
      url: host+'/add',
      type: 'post',
      data: {
          'payable': payable
      },
      dataType: 'json',
      success: function(data){
        alert(data.message);
        if(data.status == '400'){
          setTimeout(function(){
            location.reload();
          },0);
        }
      },
      error: function(){
        alert('Request error');
      }
    });
  }
});
</script>
