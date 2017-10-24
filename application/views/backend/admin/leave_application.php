<hr>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-warning">Work in progress</div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Leave Application</div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="leave_category">Leave Category Name</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="name">
              <?php
                foreach($leave_list as $list){
                  echo "<option value=".$list->name.">";
                  echo $list->name;
                  echo "</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="from_date">From Date</label><span class="error">*</span>
            <input type="text" class="form-control datepicker" id="from_date">
            <span class="error" id="from_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="to_date">To Date</label><span class="error">*</span>
            <input type="text" class="form-control datepicker" id="to_date">
            <span class="error" id="to_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="reason">Reason</label><span class="error">*</span>
            <textarea class="form-control" id="reason"></textarea>
            <span class="error" id="reason_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" id="create">Create</button>
          </div>
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
              <th>Leave Type</th>
              <th>From Date</th>
              <th>To Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($leave_application_list as $list){
              $i+=1;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$list->category.'</td>';
                echo '<td>'.$list->from_date.'</td>';
                echo '<td>'.$list->to_date.'</td>';
                echo '<td>'.$list->reason.'</td>';
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
var host = "http://localhost/demoi/index.php?admin/leave_application/";
$('#reason').keyup(function(){
  var reason = $('#reason').val();
  if(reason == ''){
    $('#reason_error').text('Reason cannot be empty');
  }else{
    $('#reason_error').text('');
  }
});
$('#create').on('click', function(){
  var formSubmit = false;
  var category = $('#name').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var reason = $('#reason').val();
  if(from_date == ''){
    $('#from_error').text('From date required');
  }else{
    $('#from_error').text('');
  }
  if(to_date == ''){
    $('#to_error').text('To date required');
  }else{
    $('#to_error').text('');
  }
  if(reason == ''){
    $('#reason_error').text('Reason required');
  }else{
    $('#reason_error').text('');
  }
  if(reason == '' || from_date == '' || to_date == ''){
    formSubmit = false;
  }else{
    formSubmit = true;
  }
  if(formSubmit){
    $.ajax({
      type: 'post',
      url: host + 'add',
      data: { 'category': category, 'from_date': from_date, 'to_date': to_date, 'reason': reason},
      dataType: 'json',
      success: function(data){
        alert(data.message);
        if(data.success == '400'){
          setTimeout(function(){
            location.reload();
          }, 0);
        }
      },
      error: function() {
        alert('Request error');
      }
    });
  }
});
</script>
