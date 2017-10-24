<style>
.top-buffer { margin-top:20px; }
.panel-default{
	border-color: #e0e0e0;
    border-top: 2px solid #3c8dbc;
}
.table > tbody > tr > td{
	    border-bottom: 1px solid #dddddd;
		border-top: 0px solid #dddddd; 
}
.table > tbody > tr > th{
	    border-bottom: 1px solid #dddddd;
		border-top: 0px solid #dddddd; 
}
</style>

<p class="top-buffer"> <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-primary">Back</button>
  <a href="<?php echo base_url(); ?>index.php?admin/document_categories/update_category/<?php echo $doc_id; ?>" class="btn btn-info">Update</a>
  <button type="button" class="btn btn-danger">Delete</button>
</p>
<?php $val = $this->db->get_where('doucment_category',array('doc_id' => $doc_id ))->row();  ?>
<div class="panel panel-default top-buffer">
		<div class="panel-body">
			<table class="table  detail-view">
			    <tbody>
				<tr><th>Category</th>
				<td><?php echo  $val->doc_name; ?></td></tr>
				<tr><th>Created At</th>
				<td><?php echo  $val->doc_added; ?></td></tr>
				<tr><th>Created By</th>
				<td><?php echo  $val->doc_addedby; ?></td></tr>
				<tr><th>Updated At</th>
				<td><?php if( $val->doc_updated != '0000-00-00 00:00:00') echo  $val->doc_updated; ?></td></tr>
				<tr><th>Updated By</th>
				<td><?php echo  $val->doc_updatedby; ?></td></tr></tbody>
			</table>
		</div>
</div>

