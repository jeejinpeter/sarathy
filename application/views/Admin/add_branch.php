
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Add Branch</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span6 offset3 >"
                <div class="widget-box" >
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Branch</h5>
						<a href="<?php echo base_url('Admin/list_branch');?>" class="btn btn-danger pull-right">List Branch</a>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/branch_process');?>" method="post" class="form-horizontal">
				 <div class="span11">
				    
							 
                            <div class="control-group">
                                <label class="control-label">Branch Id :</label>
                                <div class="controls">
                                    <input type="text" name="id" class="span11" placeholder="Branch Id" required />
									
                                </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label"> Branch Name :</label>
                                <div class="controls">
                                    <input type="text" name="branch" class="span11" placeholder="Branch Name" required />
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
								 <textarea name="address" rows="4" class="span11" placeholder="Address" required="required"><?php echo set_value('address');?></textarea>
									<span class="text-danger"><?php echo form_error('address'); ?></span>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label">Phone Number :</label>
                                <div class="controls">
                                    <input type="text" name="phno" class="span11" placeholder="Contact Number"/>
									
                                </div>								
                            </div>
							   		</div>	
                            <div class="form-actions" style="">
						
							
                                <button type="submit" class="btn btn-danger" style="border-radius:50px;">Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>
                           
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