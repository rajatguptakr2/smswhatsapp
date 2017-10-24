<hr>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-warning">Work in progress</div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">Add Leave Category</div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="leave_category">Leave Category Name</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control" id="name">
            <span class="error" id="name_error"></span>
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
      <div class="panel-heading">List</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            foreach ($leave_list as $list){
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
var host = "http://localhost/demoi/index.php?admin/leave/";
  $('#name').keyup(function(){
    var name = $('#name').val();
    if(name == ''){
      $('#name_error').text('Leave name cannot be empty');
    }else{
      $('#name_error').text('');
    }
  });
  $('#save').on('click', function(){
    var formSubmit = false;
    var name = $('#name').val();
    if(name == ''){
      $('#name_error').text('Leave name cannot be empty');
      formSubmit = false;
    }else{
      $('#name_error').text('');
      formSubmit = true;
    }
    if(formSubmit){
      $.ajax({
        type: 'post',
        url: host + '/add',
        data: {'name' : name},
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
          alert('Error in request');
        }
      });
    }
  });
</script>
