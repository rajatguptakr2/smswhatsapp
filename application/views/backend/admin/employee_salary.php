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
          Employee Salary
      </div>
      <div class="panel-body">
        <div class="col-xs-12 col-md-12">
            <div class="form-group">
            <label for="designation">Designation</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="designation">
              <option value=""></option>
              <?php
                foreach ($designation_list as $designation){
                  echo '<option value="'.$designation->name.'">';
                  echo $designation->name;
                  echo '</option>';
                }
              ?>
            </select>
            <span class="error" id="designation_error"></span>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="employee_code">Employee Code</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="emp_code">

            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="year">Year</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="year">
              <option value="2017">2017</option>
              <option value="2018">2018</option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="month">Month</label><span class="error">&nbsp;*</span>
            <select class="form-control" id="month">
              <option value="january">January</option>
              <option value="feburary">Feburary</option>
              <option value="march">March</option>
              <option value="april">April</option>
              <option value="may">May</option>
              <option value="june">June</option>
              <option value="july">July</option>
              <option value="august">August</option>
              <option value="september">September</option>
              <option value="october">October</option>
              <option value="november">November</option>
              <option value="december">December</option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="start_date">Start Date</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control datepicker" id="start_date">
          </div>
        </div>
        <div class="col-xs-12 col-md-12">
          <div class="form-group">
            <label for="stop_date">Stop Date</label><span class="error">&nbsp;*</span>
            <input type="text" class="form-control datepicker" id="stop_date">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">

  </div>
</div>
