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
                <?php echo get_phrase('add_user_type'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?></label>
                        <input type="text" class="form-control" id="type">
                        <span class="error" id="type_error"></span>
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
                    <th>Sid</th>
                    <th>Usertype</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($usertype_list as $list){
                    $i+=1;
                      echo '<tr>';
                      echo '<td>'.$i.'</td>';
                      echo '<td>'.$list->usertype.'</td>';
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
  var host = 'http://localhost/demoi/index.php?admin/usertype/';
  // delete
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

  $('#type').keyup(function(){
    var type = $('#type').val();
    if(type == ''){
      $('#type_error').text('User type cannot be empty');
    }else{
      $('#type_error').text('');
    }
  });
  $('#save').on('click', function(){
    var type = $('#type').val();
    var formSubmit = false;
    if(type == ''){
      $('#type_error').text('User type cannot be empty');
      formSubmit = false;
    }else{
      $('#type_error').text('');
      formSubmit = true;
    }
    if(formSubmit){
      //submit form
      $.ajax({
        url: host + 'add',
        type: 'POST',
        data: {
          'usertype': type
        },
        dataType: 'json',
        success: function(data){
          alert(data.message);
          setTimeout(function(){
            location.reload();
          }, 0);
        },
        error: function(data){
          alert(data.message);
        }
      });
    }
  });
</script>
