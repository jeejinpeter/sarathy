
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Insurance Company</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span6 offset3">
                <div class="widget-box" >
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Insurance Company</h5>
						<a href="<?php echo base_url('Admin/list_insurance_company');?>" class="btn btn-danger pull-right">List Company</a>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/add_insurance_company');?>" method="post" class="form-horizontal">
				 <div class="span11">
				    
							 
                            <div class="control-group">
                               <label class="control-label">Insurance Company Name :</label>
								<div class="controls">  
								<input type="text" name="company_name" class="span11" placeholder="" value="<?php echo set_value('company_name');?>" />
								<span class="text-danger"><?php echo form_error('company_name'); ?></span>
								</div>								
                            </div>
                           <div class="control-group">
                              <label class="control-label">Address:</label>
                                <div class="controls">
								 <textarea name="address" rows="4" class="span11" placeholder="Address" required="required"><?php echo set_value('address');?></textarea>
									<span class="text-danger"><?php echo form_error('address'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                             <label class="control-label">GST IN:</label>
                                <div class="controls">  
								<input type="text" name="gst" class="span11" placeholder="" value="<?php echo set_value('gst');?>" />
								<span class="text-danger"><?php echo form_error('gst'); ?></span>
								</div>							
                            </div>
							   		</div>	
                            <div class="form-actions" style="height:300px;">
						
							<br><br><br><br><br><br><br><br><br><br>
                                <button type="submit" class="btn btn-danger" style="border-radius:50px;" >Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>
                           
							</div>
							<?php echo form_close(); ?>
                      

                    </div>
</div>
                </div>
         
        </div>
    </div>
	