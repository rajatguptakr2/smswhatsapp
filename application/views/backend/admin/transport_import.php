<hr/>
<div class="row">
    <div class="col-md-6">
        <h2 class="alert alert-warning">Work in Progress</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-warning">Download the excel file format from below link and
             copy the below values in corresponding columns while filling excel sheet. 
             <br>
             <a href="#">Download the excel file here</a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo get_phrase('transport_allocation_import'); ?>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label for="browse_file"><?php echo get_phrase('browse_file'); ?><span class="error">*  </span></label>
                        <input type="file" id="file_upload">
                        <span class="error" id="file_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" id="save"><?php echo get_phrase('submit'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#save').on('click', function(){
        var file = $('#file_upload')[0].files[0];
        if(file == '' || file == undefined){
            alert('select file');
        } else{
            alert('filename = ' + file.name + 'filesize = : ' + file.size);
        }
    });
</script>