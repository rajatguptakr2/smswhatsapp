<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('room_transfer_/_vacate'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control">
                            <option>Get Dynamically</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="employee_name"><?php echo get_phrase('employee_name'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="student_name"><?php echo get_phrase('student_name'); ?><span class="error">&nbsp;*</span></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="select"><?php echo get_phrase('select'); ?><span class="error">&nbsp;*</span></label>
                        <select class="form-control">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="transfer"><?php echo get_phrase('transfer'); ?></option>
                            <option value="vacate"><?php echo get_phrase('vacate'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <button class="btn btn-primary"><?php echo get_phrase('go'); ?></button>
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