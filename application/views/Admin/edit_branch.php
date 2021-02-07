<style>
.text-danger{
	color:red;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Branch</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
           <div class="span6 offset3">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Branch</h5>
						
			 <div ><a href="<?php echo  base_url('Admin/list_branch');  ?>" class="btn btn-danger pull-right" >List Branch</a></div>
			 
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/branch_update');?>" method="post" class="form-horizontal">
			
				 <div class="span11">	
<br>				  <?php foreach($one as $row){ ?>
                            <div class="control-group">
							<input type="hidden" name="bid" value="<?php echo $row->b_id;?>">
                                <label class="control-label">Branch Id :</label>
                                <div class="controls">
                                    <input type="text" name="b_id" class="span11" value="<?php echo $row->branch_id; ?>" />
										
									 
                                </div>								
                            </div>
							
                            <div class="control-group">
                                <label class="control-label">Branch Name :</label>
                                <div class="controls">
                                    <input type="text" name="b_name" class="span11" placeholder="" value="<?php echo $row->branch_name;?>" />
									
                                </div>								
                            </div>	
								<div class="control-group">
                                <label class="control-label"> Branch Address :</label>
                                <div class="controls">
                                    <textarea name="b_address" class="span11" placeholder="" /><?php echo $row->branch_address;?></textarea>
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label">Phone Number :</label>
                                <div class="controls">
                                    <input type="text" name="phno" class="span11" placeholder="Contact Number" value="<?php echo $row->branch_ph;?>"/>
									
                                </div>								
                            </div>
                           
					</div>	  
					</div>	
                            <div class="form-actions" style="">
						<br><br><br><br><br><br><br><br><br>
							
                                <button type="submit" class="btn btn-danger" style="border-radius:50px;">Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>
                           
							</div>
							<?php 
							}
							echo form_close(); ?>
                        </form>

                    </div>

                </div>
         </div>
        </div>
    </div>