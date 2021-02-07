<style>
.a_link{border-radius:46px;margin-left:25em;margin-top:3px;}
</style>
<div id="content">
  <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo  base_url('Admin/add_employee_view');?>" class="tip-bottom">Add Employeer</a> <a href="<?php echo  base_url('Admin/add_employee_view');?>" class="current">List Employee</a> </div>
    </div>
<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
  <div class="container-fluid">
   <div class="row-fluid">
   
      <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Employee List</h5>
		<br/><br/>
		<a href="<?php echo  base_url('Admin/add_employee_view');?>" class="btn btn-danger pull-right">Add Employee</a>
          </div>
          <div class="widget-content nopadding">
		  <br/> <br/> 
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Full Name</th>
				   <th>Branch</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                 
				  <th>Address</th>
				  <th>Employee Code</th>
				  <th>Employee Designation</th>
				  <th>Status</th>
				  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $i=1;
			  foreach($list as $row) {?>
                <tr class="gradeX">
				 <td><?php echo $i++; ?></td>
                  <td><?php echo $row->emp_intial; ?>&nbsp;<?php echo $row->e_first_name; ?></td>
				  <td><?php echo $row->e_branch; ?></td>
                  <td><?php echo $row->e_email; ?></td>
                  <td><?php echo $row->e_mobile; ?></td>
                 
                  <td><?php echo $row->e_address; ?></td>
				   <td><?php echo $row->e_code; ?></td>
				    <td><?php echo $row->e_designation; ?></td>
				    <td><?php echo $row->status; ?></td>
				   <td class="center">
				<div class="btn-group">
		<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		Action<span class="caret" ></span>
		</button>
		 <ul class="dropdown-menu" role="menu">
		 <?php
		 if($row->emp_login_id!=NULL)
		 {
			 ?>
			<li><a href="<?php echo base_url('Admin/edit_employee_login/'.$row->emp_login_id); ?>" style="border-radius:10px; margin-left:8px;">Edit </a></li>
      <?php			
		 }
		 else
		 {
			 ?>
	 
		  <li><a href="<?php echo base_url('Admin/edit_employee/'.$row->emp_id); ?>" style="border-radius:10px; margin-left:8px;">Edit </a></li>
		 <?php
		 }
		 ?>
		 <li><a  data-toggle="modal" data-target="#status-<?=$row->emp_id?>" href="#" style="border-radius:10px; margin-left:8px;">Status</a></li>
		
	</ul>
	</div>
        </td>
                </tr>
				<!-- Modal -->

		
<div class="modal hide" style="border-radius:20px;" id="status-<?=$row->emp_id?>" role="dialog" >
     <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Update Status </h4>
      </div>
         <div class="modal-body">
     <form action="<?php 
                echo  base_url('Admin/employee_update_status');?>" method="post" class="form-horizontal">
<div class="control-group">
<input type="hidden" name="id" value="<?php echo $row->emp_id; ?>">
<input type="hidden" name="lg_id" value="<?php echo $row->emp_login_id; ?>">
                                <label class="control-label">Employee Status:</label>
                                <div class="controls">
                                   <select name="desig" class="span11" placeholder="Branch Name" required >
									
							<option value="<?php echo $row->status; ?>"><?php echo $row->status; ?></option>
									<option value="active">active</option>
									<option value="inactive">inactive</option>
									</select>
                                </div>								
                            </div>	   
							
      </div>
        <div class="modal-footer ">
         <a href="#"><button name="save" class="btn btn-primary" ><span class="glyphicon 
		glyphicon-ok-sign"></span>Yes</button></a>
	<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div> 
	  </form>
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
<script>
setTimeout(function() {
    $('#mydiv').fadeOut('slow');
}, 1000); // <-- time in milliseconds
</script>