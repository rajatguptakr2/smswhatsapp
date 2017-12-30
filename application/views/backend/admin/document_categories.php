<div class="panel panel-default top-buffer">
 <?php if($doc_id){ ?>	
     <form name="documentfrm" id="documentfrm" method="POST" action="<?php echo base_url(); ?>index.php?admin/document_categories/edit_category/<?php echo $doc_id; ?>">
 <?php }else{ ?>
     <form name="documentfrm" id="documentfrm" method="POST" action="<?php echo base_url(); ?>index.php?admin/document_categories/add_category">
 <?php } ?>
<?php $val  = $this->db->get_where("doucment_category", array("doc_id" => $doc_id ))->row(); ?>
	<div class="panel-body">
	<div class="col-sm-12 top-buffer">				
		<input type="text" id="doc_name" value="<?php if(isset($val->doc_name) && $val->doc_name!=""){ echo $val->doc_name; }?>" class="form-control" required name="doc_name"  placeholder="Document Category">	
	</div>
	<div class="col-sm-12 top-buffer">			
        <label for="doc_type">User Type <span class="error"> *</span></label>	<br>
		<label for="doc_typeS"><input type="radio" id="doc_typeS" <?php if(isset($val->doc_type) && $val->doc_type!="" && $val->doc_type=="S"){ echo "checked"; }?>  name="doc_type" value="S" required > <span>Student</span>&nbsp;</label>	
		<label for="doc_typeE"><input type="radio" id="doc_typeE" <?php if(isset($val->doc_type) && $val->doc_type!="" && $val->doc_type=="E"){ echo "checked"; }?>  name="doc_type" value="E" required > <span>Employee </span>&nbsp;	</label>		
		<label for="doc_typeB"><input type="radio" id="doc_typeB" <?php if(isset($val->doc_type) && $val->doc_type!="" && $val->doc_type=="B"){ echo "checked"; }?>  name="doc_type" value="B"  required > <span>Both</span>&nbsp;	</label>		
	</div>	
	<div class="col-sm-12 top-buffer">	
     <?php if($doc_id){ ?>	
		<input type="submit" id="create" class="btn btn-success" name="create" value="Update" >	
	 <?php }else{ ?>
	   <input type="submit" id="create" class="btn btn-success" name="create" value="Create" >	
	 <?php }  ?>
		<input type="reset" id="reset" class="btn btn-default margin" onclick="myFunction()" name="reset" value="Reset" >	
	</div>	
	</div>
 </form>
</div>
<script>
function myFunction() {
    document.getElementById("documentfrm").reset();
}
</script>
<style>
.top-buffer { margin-top:20px; }
.panel-default{
	border-color: #e0e0e0;
    border-top: 2px solid #008d4c;
}
.btn{
	width: 130px;
	}
.margin{
		margin-left: 18px;
	}
label{
	color:#333;
}
</style>
<div class="col-xs-12">
  <div class="col-lg-8 col-sm-8 col-xs-12 no-padding edusecArLangCss"><h3 class="box-title"><i class="fa fa-th-list"></i> Document Category List</h3></div>
  <!--div class="col-lg-4 col-sm-4 col-xs-12" style="padding-top: 10px !important;">	
	<div class="col-xs-4">
	<input type="submit" id="create" class="btn btn-primary" name="create" value="PDF" >	
	</div>
	<div class="col-xs-4">
	<input type="submit" id="create" class="btn btn-success" name="create" value="EXCEL" style="margin-left: 50px;" >
	</div>
  </div-->
</div>
<br><br>
  <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div><?php echo get_phrase('category');?></div></th>
                            <th><div><?php echo get_phrase('user_type');?></div></th>                            
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1; 
                            $parents   =   $this->db->get('doucment_category')->result_array();
                            foreach($parents as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['doc_name'];?></td>
                            <td><?php if($row['doc_type'] == 'S'){ echo "Student"; }elseif($row['doc_type'] == 'E') { echo "Employee"; }else{ echo "Both"; }?></td>                           
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php?admin/preview_doccat/<?php echo $row['doc_id'];?>">
                                                <i class="fa fa-search"></i>
                                                    <?php echo get_phrase('Preview');?>
                                                </a>
                                         </li>
										  <li class="divider"></li>      
										<li>
                                            <a href="<?php echo base_url(); ?>index.php?admin/document_categories/update_category/<?php echo $row['doc_id'];?>">
                                                <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit');?>
                                                </a>
                                         </li>
                                        <li class="divider"></li>                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                            <a href="<?php echo base_url();?>index.php?admin/document_categories/delete_category/<?php echo $row['doc_id'];?>">
                                                <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
                                                </a>
                                        </li>
                                    </ul>
                                </div>                                
                            </td>
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
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(5, true);
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

