<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('hostel_visitors'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?></label>
                        <select class="form-control">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="student"><?php echo get_phrase('student'); ?></option>
                            <option value="employee"><?php echo get_phrase('employee'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label for="student_name"><?php echo get_phrase('student_name'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <label for="employee_name"><?php echo get_phrase('employee_name'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="visitor_name"><?php echo get_phrase('visitor_name'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="relation"><?php echo get_phrase('relation'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="date"><?php echo get_phrase('date'); ?></label>
                        <input type="text" class="form-control datepicker">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="time"><?php echo get_phrase('time'); ?></label>
                        <input type="text" class="form-control timepicker">
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <button class="btn btn-primary"><?php echo get_phrase('save'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo get_phrase('list'); ?>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
</div>