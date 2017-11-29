<hr>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="alert alert-warning">
            <h4>Work in Progress</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('employee_list'); ?>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee Code</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Qualification</th>
                    <th>Designation</th>
                    <th>Email</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($employee_list as $list){
                    $i+=1;
                      echo '<tr>';
                      echo '<td>'.$i.'</td>';
                      echo '<td>'.$list->employee_code.'</td>';
                      echo '<td>'.$list->first_name.' '.$list->last_name.'</td>';
                      echo '<td>'.$list->department.'</td>';
                      echo '<td>'.$list->qualification.'</td>';
                      echo '<td>'.$list->designation.'</td>';
                      echo '<td>'.$list->email.'</td>';
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
<script>
  var host = "http://localhost/demoi/index.php?admin/employee/";
  $('.remove').bind('click', function(){
    var id = $(this).val();
    $.ajax({
      type: 'POST',
      url: host + 'delete',
      dataType: 'json',
      data: {'id': id},
      success: function(data){
        alert(data.message);
        if(data.status == '400'){
          setTimeout(function(){
            location.reload();
          },0);
        }
      },error: function(){
        alert('Error by developer');
      }
    });
  });
</script>
