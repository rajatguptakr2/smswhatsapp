<hr>
<div class="col-sm-12 alert alert-success" hidden="true"></div>
<div class="col-sm-12 alert alert-danger" hidden="true"></div>
<div class="row">
  <div class="panel panel-info">
    <div class="panel-heading"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp Message</div>
      <div class="panel-body">
        <div class="row text-center">
          <button class="btn btn-default selectMsgType" rel="singleMessageWhatsApp">
            Message Them All
          </button>
          <button class="btn btn-default selectMsgType" rel="groupMessageWhatsapp">
            Message a Group
          </button>
        </hr>
            <div id="singleMessageWhatsApp" class="col-sm-12" style="display: none">
              <form action="index.php?admin/postmultipleWhatsappMessage" method="post">
                <div class="form-group row" style="text-align: center;">
                  
                </div>
                <hr>
                <div class="form-group row">
                  <label for="message" class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="message" placeholder="Message" name="message"></textarea>
                  </div>
                </div>
                  <div class="form-group row">
                    <div id="msgErrDiv" style="color: red;">
                      
                    </div>
                    <div class="offset-sm-6 col-sm-4">
                      <button type="submit" class="btn btn-primary" onclick="return submitBulkMessage();">Send Message</button>
                    </div>
                  </div>
              </form>
            </div>
            <div id="groupMessageWhatsapp" class="col-sm-12 text-center" style="display: none">
                <div class="col-sm-5"> 
                  <form action="index.php?admin/postmultipleGroupWhatsappMessage" method="post">
                   
                    <table class="table table-striped">
                      <thead>Your Groups</thead>
                      <tr>
                          <th><h4>Name</h4></th>
                          <th><h4>Created On</h4></th>
                          <th><h4>Updated On</h4></th>
                          <th><h4>Watch</h4></th>
                          <th><h4>Send</h4></th>
                      </tr>
                      <?php 
                        foreach ($query->result() as $row)
                        {        
                       ?>
                          <tr>
                            <td><?php echo $row->name;?></td>
                            <td><?php echo $row->created_on;?></td>
                            <td><?php echo $row->updated_on;?></td>
                            <td>
                            <?php echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$row->id.'">Students</button>'?>
                                  <!-- Modal -->
                                  <?php echo '<div id="myModal'.$row->id.'" class="modal fade" role="dialog">'; ?>
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h5 class="modal-title">Group Students</h5>
                                        </div>
                                        <div class="modal-body">
                                          <?php
                                          foreach ($query2->result() as $row2)
                                            {
                                              if($row2->group_id == $row->id)                            
                                              {?>                             
                                                <p><?php echo $row2->name.'('.$row2->emergency_contact.')';?></p>
                                              <?php } ?>
                                          <?php }?>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                              </td>
                              <td>
                                <div class="checkbox">
                                    <input type="checkbox" name="checkboxlist[]" id="<?php echo $row->id;?>" value="<?php echo $row->id;?>" autocomplete="off">
                                </div>
                              </td>
                          </tr>
                  <?php }?>
                    </table>
                  </div>
                  <div class="col-sm-5 col-sm-offset-1">                    
                    <h4 class="text-center">Select Template If You Want</h4>
                    <table class="table table-striped">
                      <tr>
                        <th>Template Id</th>
                        <th>Template Name</th>
                        <th>Created On</th>
                        <th>Message</th>
                        <th>Select</th>
                      </tr>
                     <?php
                      foreach ($query3->result() as $row3)
                        {        
                         echo'
                        <tr>
                          <td>'.$row3->id.'</td>
                          <td>'.$row3->name.'</td>
                          <td>'.$row3->created_on.'</td>
                          <td>'.$row3->message.'</td>
                          <td>
                            <div class="radio">
                                <input type="radio" name="myradio" id="'.$row3->id.'" value="'.$row3->message.'">
                            </div>
                          </td>
                        </tr>';
                      }?>
                    </table>
                  </div>
                  <label for="message" class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="groupMessage" placeholder="Message" name="groupMessage"></textarea>
                  </div>
                   <div class="col-sm-8 col-sm-offset-2 text-center">
                    <div id="grpMsgErrDiv" style="color: red;">
                      
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return submitMultipleMessage()">Send Message</button>
                  </div>
                </div>
               </form>
            </div>
        </div>
      </div>
  </div>  
</div>
<hr>

<style>
* {
  box-sizing: border-box;
}

#myInputName,#myInputGender,#myInputBirthday, #myInputDorm, #myInputTrans   {
  background-image: url('');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
        $('button.selectMsgType').on('click', function(){
          var target = $(this).attr('rel');
          console.log(target);          
          $("div#"+target).css("display", "block").siblings("div").css("display", "none");          
        }); 
        
        $('input[type="radio"]').click(function()
        {
          if ($(this).is(':checked'))
          {
            $('#groupMessage').html($(this).val());
          }
        });
    });

  function submitMultipleMessage()
  {
      
      var groupMessage = $('#groupMessage').val();         
      if(!($('input[type="checkbox"]:checked').is(':checked')) && (groupMessage==""))
      {
        $('#grpMsgErrDiv').html('Select the group and enter message');   
        return false;      
      }
      else if(!$('input[type="checkbox"]:checked').is(':checked'))
      {
        $('#grpMsgErrDiv').html('Select the group'); 
        return false;        
      }
      else if(groupMessage=="")
      {
        $('#grpMsgErrDiv').html('Message Left Empty');   
        return false;      
      }
      else
      {
       
       console.log('fdsfdsfdsfsdfdsfsdfdsfdsfsd');
       return true;

      }
  }
  function submitBulkMessage()
  {
      
      var groupMessage = $('#message').val();         
      if(groupMessage=="")
      {
        $('#msgErrDiv').html('Message Left Empty'); 
        return false;      
      }
      else
      {       
       return true;
      }
  }
</script>
</head>
<body>