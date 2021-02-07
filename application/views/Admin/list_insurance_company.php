<div id="content">
  <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">List Insurance Company</a> </div>
    </div>
<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
  <div class="container-fluid">
<div class="row-fluid">

   <div class="span7 offset1">
         
       <div class="widget-box span12" style="width:1000px;">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>List Insurance Company</h5>
			<br><br>
			 <div><a href="<?php echo  base_url('Admin/insurance_company');  ?>" class="btn btn-danger pull-right" >Add Company</a></div>
       
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Sl No</th>
				  <th>Insurance Company Name</th>
                  <th>Address</th>
                  
				  <th>GST IN</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $i=1;
			  foreach($list_ins as $row) {?>
                 <tr class="gradeX">
				 <td style="text-align:center;"><?php echo $i++; ?></td>
                 <td><?php echo $row->icompany_name; ?></td>
                 <td><?php echo $row->icompany_address; ?></td>
				 <td><?php echo $row->icompany_gst; ?></td>
				
                 <td class="center">
				<div class="btn-group">
		<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		Action<span class="caret" ></span>
		</button>
		 <ul class="dropdown-menu" role="menu">
		 <li><a href="<?php echo base_url('Admin/edit_insurance_company/'.$row->com_id); ?>" style="border-radius:10px; margin-left:8px;">Edit </a></li>
		 <li><a  data-toggle="modal" data-target="#delete-<?=$row->com_id?>" href="#" style="border-radius:10px; margin-left:8px;">Delete </a></li>
		
	</ul>
	</div>
        </td>
                </tr>
	
	 <?php
	echo form_close(); ?>

	     
        </div>
    <!-- /.modal-content --> 
	</div>
<div class="modal hide" style="border-radius:20px;" id="delete-<?=$row->com_id?>" role="dialog" >
     <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete This Entry</h4>
      </div>
         <div class="modal-body">
       <div class="alert alert-default"><span class="glyphicon glyphicon-warning-sign"></span> Are you Sure you Want to Delete this Record?</div>   
      </div>
        <div class="modal-footer ">
         <a href="<?php echo base_url('Admin/delete_insurance_company/'.$row->com_id); ?>"><button name="save" class="btn btn-primary" ><span class="glyphicon 
		glyphicon-ok-sign"></span>Yes</button></a>
	<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div> 
  </div>
    </div>	
</div>				
			  <?php }  ?>
              </tbody>
            </table>
          </div>
       
        </div>
      </div>
  </div>
  </div>
</div>