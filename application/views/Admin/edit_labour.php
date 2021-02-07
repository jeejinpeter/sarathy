<style>
.text-danger{
	color:red;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Labour Code</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span6 offset3" >
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Labour Code</h5>
						<a href="<?php echo base_url('Admin/list_labour');?>" class="btn btn-danger pull-right">List Labour Code</a>						
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/update_labour');?>" method="post" class="form-horizontal">
				 <div class="span11">
				    
							
                            <?php foreach($one as $row){ ?>
                           <div class="control-group">
                                <label class="control-label"> Labour Code :</label>
                                <div class="controls">
								<input type="hidden" name="bid" value="<?php echo $row->labour_id;?>">
                                    <input type="text" name="code" class="span11" placeholder="" value="<?php echo $row->labour_code;?>" />
									<span class="text-danger"><?php echo form_error('code'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label"> Name :</label>
                                <div class="controls">
                                    <input type="text" name="name" class="span11" placeholder="" value="<?php echo $row->labour_title;?>" />
									<span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label"> Description :</label>
                                <div class="controls">
                                    <textarea name="desc" class="span11" placeholder=""  /><?php echo $row->discription;?></textarea>
									<span class="text-danger"><?php echo form_error('desc'); ?></span>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label"> Repair Type :</label>
                                <div class="controls">
                                    <select class="span11" name="repair">
									<option value=" <?php echo $row->repair_type; ?>">Paid Service</option>
									<option value=" <?php echo $row->repair_type; ?>">Free Service</option>
									</select>
									<span class="text-danger"><?php echo form_error('repair'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label"> Sale Price :</label>
								
                                <div class="controls">
                                   <input type="number" id="amt" required name="sale" class="span11" placeholder="" value="<?php echo $row->sale_price;?>" />
                                </div>	
                            
					</div>			</div>	
                            <div class="form-actions" style="">
						
							
							<br><br><br><br><br><br><br><br><br><br>
							<br><br><br><br>
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
	<script>
setTimeout(function() {
    $('#mydiv').fadeOut('slow');
}, 1000); // <-- time in milliseconds
</script>