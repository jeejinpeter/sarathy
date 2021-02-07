<style>
.text-danger{
	color:red;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Add Employee</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Employee</h5>
						<a class="btn btn-danger pull-right" href="<?php echo base_url('Admin/list_employee');?>"><b>List Employee</b></a>
   
						
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/add_employee_processing');?>" method="post" class="form-horizontal">
				 <div class="span12">
				  <div class="span6"><br/>
 <div class="widget-title"> 
                        <h5><u>Basic Information</u></h5>
                    </div>				  
<br>				  
                           
                            <div class="control-group">
                                <label class="control-label">Name :</label>
								<div class="controls">  
								<select name="intial" class="span3" required >
								<?php if(set_value('intial')) { ?>
								<option value="<?php echo set_value('intial');?>"><?php echo set_value('intial');?></option>	<?php } ?>					
		<option value=""></option>			
		<option value="Mr.">Mr.</option>
		<option value="Ms.">Ms.</option>
								</select>
								<input type="text" name="first_name" class="span8" placeholder="" value="<?php echo set_value('first_name');?>" required />
								<span class="text-danger"><?php echo form_error('first_name'); ?></span>
								</div>								
                            </div>
							 
                 
							<div class="control-group">
                                <label class="control-label">Branch Name :</label>
                                <div class="controls">
                                    <select name="branch" class="span11" placeholder="Branch Name" required >
									
									<option value="">--Select--</option>
									 <?php
							 	
					foreach($branch as $row)
					{
					?>
									<option value="<?php echo $row->branch_name;?>"><?php echo $row->branch_name;?>(<?php echo $row->branch_id;?>)</option>
									<?php 
					}
                                ?>
									</select>
                                </div>								
                            </div>
							 
							
								
  	  <div class="control-group">
                                <label class="control-label">Address:</label>
                                <div class="controls">
								 <textarea name="address" rows="4" class="span11" placeholder="Address" ><?php echo set_value('address');?></textarea>
									<span class="text-danger"><?php echo form_error('address'); ?></span>
                                </div>
                            </div>
</div>
					<div class="span6"><br/>
										
<div class="widget-title"> 
                        <h5><u>Personal Details</u></h5>
                    </div>				  
<br>				  		
 
							
							
						      <div class="control-group">
                                <label class="control-label">Mobile No :</label>
                                <div class="controls">
                                    <input type="text" name="u_phone" class="span11" placeholder="" value="<?php echo set_value('u_phone');?>" />
									<span class="text-danger"><?php echo form_error('u_phone'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label">Employee Code:</label>
                                <div class="controls">
                                    <input type="text" name="e_code" class="span11" placeholder="" value="<?php echo set_value('e_code');?>" required/>
									<span class="text-danger"><?php echo form_error('e_code'); ?></span>
                                </div>								
                            </div>
								<div class="control-group">
                                <label class="control-label">Employee Designation:</label>
                                <div class="controls">
                                    <select name="desig" class="span11" placeholder="Branch Name" required >
									
									<option value="">--Select Designation--</option>
									<option value="Mechanic">Technician</option>
									<option value="Service Advisor">Service Advisor</option>
										<option value="Billing Staff">Billing Staff</option>
										<option value="Floor Supervisor">Floor Supervisor</option>
									</select>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label">Email Id :</label>
                                <div class="controls">
                                    <input type="email" name="u_email" class="span11" placeholder="" value="<?php echo set_value('u_email');?>" />
									<span class="text-danger"><?php echo form_error('u_email'); ?></span>
                                </div>
                            </div>
                          
							
							
							<div class="control-group">
                                <label class="control-label"><input type="checkbox" value="user" name="status" id="user" style="margin-top: -2px;"  onclick="javascript:userCheck();" >&nbsp;&nbsp;Add as User</label>
								 
                            </div>
							<div id="dshow" style="display:none;" >
							<div class="control-group">
                                <label class="control-label">Username:</label>
                                <div class="controls">
                                    <input type="text" name="username" class="span11" value="<?php echo set_value('username');?>" />
									 
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label">Password :</label>
                                <div class="controls">
                                    <input type="password" name="password" class="span11" placeholder="" value="<?php echo set_value('password');?>" />
									 
                                </div>								
                            </div></div>
							<br><br>
					</div>	
<div class="form-actions" style="">
						<div class="pull-right">
							
                                <button type="submit" class="btn btn-danger" style="border-radius:50px;">Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>
                           </div>
							</div>
					</div>	
                            
							<?php echo form_close(); ?>
                        </form>

                    </div>

                </div>
         
        </div>
    </div>
	</div>
	<script>
setTimeout(function() {
    $('#mydiv').fadeOut('slow');
}, 2000); // <-- time in milliseconds
</script>

	
	<script type="text/javascript">

function userCheck() {
    if (document.getElementById('user').checked) {
        document.getElementById('dshow').style.display = 'block';
    }
    else document.getElementById('dshow').style.display = 'none';

}

</script>