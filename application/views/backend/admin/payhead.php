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
            <label for="pay_head_name">Pay Head Name</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control" id="pay_head">
            <span class="error" id="pay_head_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description"></textarea>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label><span class="error">&nbsp;*</span></label>
            <select class="form-control" id="type">
              <option value="addition">Addition</option>
              <option value="deduction">Deduction</option>
            </select>
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
              <th>Pay Head Name</th>
              <th>Desscription</th>
              <th>Is Addition/Deduction</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($paytype_list as $list){
              $i+=1;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$list->name.'</td>';
                echo '<td>'.$list->description.'</td>';
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
var host = "http://localhost/demoi/index.php?admin/payhead/";
$('#pay_head').keyup(function(){
  var pay = $('#pay_head').val();
  if(pay == ''){
    $('#pay_head_error').text('Pay Head Name cannot be empty');
  }else{
    $('#pay_head_error').text('');
  }
});
  $('#save').on('click', function(){
    var formSubmit = false;
    var payHeadName = $('#pay_head').val();
    var description = $('#description').val();
    var type = $('#type').val();
    if(payHeadName == ''){
      $('#pay_head_error').text('Pay Head Name cannot be empty');
      formSubmit = false;
    }else{
      formSubmit = true;
      $('#pay_head_error').text('');
    }
    if(formSubmit){
      $.ajax({
        type: 'POST',
        url: host + 'add',
        dataType: 'json',
        data: {
          'pay': payHeadName,
          'desc': description,
          'type': type
        },
        success: function(data){
          alert(data.message);
        },
        error: function(){
          alert("Error in request");
        }
      });
    }
  });
</script>
