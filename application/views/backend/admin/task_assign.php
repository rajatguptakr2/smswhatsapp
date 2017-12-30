<hr>
<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="alert alert-warning">
            <h3>Work In Progress</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('assign_task'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="task"><?php echo get_phrase('task'); ?><span class="error"> *</span></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="description"><?php echo get_phrase('description'); ?><span class="error"> *</span></label>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="priority"><?php echo get_phrase('priority'); ?><span class="error"> *</span></label>
                        <select class="form-control">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="highest_priority"><?php echo get_phrase('highest_priority'); ?></option>
                            <option value="high_priority"><?php echo get_phrase('high_priority'); ?></option>
                            <option value="normal_priority"><?php echo get_phrase('normal_priority'); ?></option>
                            <option value="low_priority"><?php echo get_phrase('low_priority'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="task_date"><?php echo get_phrase('task_date'); ?><span class="error"> *</span></label>
                        <input type="text" class="form-control datepicker">
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?><span class="error"> *</span></label>
                        <select class="form-control">
                            <option>get Dynamically</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="status"><?php echo get_phrase('status'); ?><span class="error"> *</span></label>
                        <select class="form-control">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="open"><?php echo get_phrase('open'); ?></option>
                            <option value="on_hold"><?php echo get_phrase('on_hold'); ?></option>
                            <option value="resolved"><?php echo get_phrase('resolved'); ?></option>
                            <option value="closed"><?php echo get_phrase('closed'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary"><?php echo get_phrase('save'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>