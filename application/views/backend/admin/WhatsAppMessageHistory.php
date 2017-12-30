<hr>
<div class="row">
	<h2 class="col-sm-8 col-sm-offset-2 text-center">History</h2>
	<table class="table table-striped">
      <tr>
          <th><h4>Student Id</h4></th>
          <th><h4>Sent On</h4></th>
          <th><h4>Student Name</h4></th>
      </tr>

      <?php 
        foreach ($query->result() as $row)
        {        
         ?>
        <tr>
          <td><?php echo $row->student_id;?></td>
          <td><?php echo $row->sent_on;?></td>
          <td><?php echo $row->name;?></td>
          <td></td>
        </tr>
      <?php }?>
    </table>
</div>
<hr>
<script type="text/javascript">

</script>