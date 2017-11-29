<hr>
<div class="row">
	<div class="panel panel-primary">
      <div class="panel-heading">Add New Examination</div>
      <div class="panel-body">
      	 <form class="form-horizontal" action="index.php?admin/postAddExam" method="post">
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="name">Exam Name</label>
		      <div class="col-sm-10">
		        <input type="text" class="form-control" id="name" placeholder="Enter exam name" name="name" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="doc">Date Of Conduct</label>
		      <div class="col-sm-10">          
		        <input type="date" class="form-control" id="doc" placeholder="Enter password" name="doc" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="from">From</label>
		      <div class="col-sm-10">          
		        <input type="time" class="form-control" id="from" placeholder="Enter Start Time" name="from" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-2" for="to">To</label>
		      <div class="col-sm-10">          
		        <input type="time" class="form-control" id="to" placeholder="Enter End Time" name="to" required>
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-sm-offset-2 col-sm-10">
		        <button type="submit" class="btn btn-default">Submit</button>
		      </div>
		    </div>
  		</form>
      </div>
  </div>
</div>