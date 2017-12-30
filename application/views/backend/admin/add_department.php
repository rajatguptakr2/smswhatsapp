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
                <?php echo get_phrase('add_department'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="department"><?php echo get_phrase('department'); ?></label>
                        <input type="text" class="form-control" id="department">
                        <span class="error" id="department_error">
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary" id="save">
                            <?php echo get_phrase('save'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('list'); ?>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Department</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($department_list as $list){
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
<script>
var host = 'http://localhost/demoi/index.php?admin/department/';
$('.remove').bind('click', function(){
  var id = $(this).val();
  var schoolId = 1;
  $.ajax({
    url: host + 'delete/' + id,
    type: 'POST',
    dataType: 'json',
    success: function(data){
      alert(data.message);
      setTimeout(function(){
        location.reload();
      },0);
    },error: function(data){
      alert(data.message);
    }
  });
});

  $('#department').keyup(function(){
    var department = $('#department').val();
    if(department == ''){
      $('#department_error').text('Department cannot be empty');
    }else{
      $('#department_error').text('');
    }
  });
  $('#save').on('click', function(){
    var formSubmit = false;
    var department = $('#department').val();
    if(department == ''){
      $('#department_error').text('Department cannot be empty');
      formSubmit = false;
    }else{
      $('#department_error').text('');
      formSubmit = true;
    }
    if(formSubmit){
      //
      $.ajax({
        type: 'POST',
        url: host + '/add',
        dataType: 'json',
        data: {'name': department},
        success: function(data){
          alert(data.message);
          if(data.status == '400'){
            setTimeout(function(){
              location.reload();
            },0);
          }
        },
        error: function(){
          alert(data.message);
        }

      });
    }else{
      //
    }
  });
</script>
