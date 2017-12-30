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
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="user_type"><?php echo get_phrase('user_type'); ?></label>
                        <select class="form-control">
                            <option value=""><?php echo get_phrase('please_select'); ?></option>
                            <option value="student"><?php echo get_phrase('student'); ?></option>
                            <option value="employee"><?php echo get_phrase('employee'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="student_name"><?php echo get_phrase('student_name'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="employee_name"><?php echo get_phrase('employee_name'); ?></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" id="saveData"><?php echo get_phrase('save'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#fee_payment"><?php echo get_phrase('fee_payment'); ?></a></li>
    <li><a data-toggle="tab" href="#paid_list"><?php echo get_phrase('paid_list'); ?></a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active" id="fee_payment">
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="fee_type"><?php echo get_phrase('fee_type'); ?></label>
                                <select class="form-control" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="amount"><?php echo get_phrase('amount'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="fine"><?php echo get_phrase('fine'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="discount"><?php echo get_phrase('discount'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="remarks"><?php echo get_phrase('remarks'); ?></label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="mode_of_pay"><?php echo get_phrase('mode_of_payment'); ?></label>
                                <select class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="total_amount"><?php echo get_phrase('total_amount'); ?></label>
                                <input type="text" class="form-control" disabled>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="receipt"><?php echo get_phrase('do_you_want_receipt?'); ?></label>
                                <input type="checkbox">
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="receipt_no"><?php echo get_phrase('receipt_no'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" id="makePayment"><?php echo get_phrase('make_payment'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="paid_list">
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script for form submission -->
<script>
    $('#saveData').on('click', function(){
        alert()
    })
</script> 