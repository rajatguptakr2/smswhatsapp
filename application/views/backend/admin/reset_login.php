               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('student_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>							
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('section');?></div></th> 
                            <th><div><?php echo get_phrase('login_id');?></div></th> 
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $teachers	=	$this->db->get('student')->result_array();   foreach($teachers as $row):  ?>
                        <tr>
                            <td><?php echo $row['student_id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php 
							$classid = $this->db->get_where('enroll', array('student_id =' => $row['student_id']))->row();
							$class_id = $classid->class_id;
							$section_id = $classid->section_id;							
							echo $className = $this->db->get_where('class', array('class_id =' => $class_id ))->row()->name; 
												
							?></td>
                            <td><?php echo $sectionName = $this->db->get_where('section', array('section_id =' => $section_id ))->row()->name;  ?> </td>
                            <td><?php echo $row['student_logid'];?> </td>
                            <td><a href="<?php echo base_url();?>index.php?admin/update_student_login/<?php echo $row['student_id'];?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

