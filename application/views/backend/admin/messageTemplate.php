<hr>
<div class="row">
   <?php if($this->session->flashdata('created_template)')){ ?>
      <div class='alert alert-success row' style="text-align: center;">
        <?php echo $this->session->flashdata('created_template');?>
      </div>
  <?php }?>
	<h2 class="col-sm-8 col-sm-offset-2 text-center">Your Message Templates</h2>
	<table class="table table-striped">
      <tr>
          <th><h4>Temmplate Id</h4></th>
          <th><h4>Template Name</h4></th>
          <th><h4>Created On</h4></th>
          
      </tr>

      <?php 
        foreach ($query->result() as $row)
        {        
         ?>
        <tr>
          <td><?php echo $row->id;?></td>          
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->created_on;?></td>
          <td></td>
        </tr>
      <?php }?>
    </table>
</div>
<div class="row">
<form action="index.php?admin/postMessageTemplate" method="post">
    <div class="form-group row" style="text-align: center;"><h4>Create A Template</h4></div>
    <hr>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Template Name</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="name" placeholder="name" name="name"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="message" class="col-sm-2 col-form-label">Template Here</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="message" placeholder="Template Content" name="message"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-6 col-sm-4">
        <div id="msgErrDiv" style="color: red;"></div>
        <button type="submit" class="btn btn-primary" onclick="return submitTemplate();">Save Template</button>
      </div>
    </div>
  </form>
</div>
<hr>
<script type="text/javascript">
  function submitTemplate()
  {
    var name = $('#name').val();         
    var message = $('#message').val();         
      if(name==""||message=="")
      {
        $('#msgErrDiv').html('Fields Left Empty'); 
        return false;      
      }
      else
      {       
       return true;
      }
  }
</script>