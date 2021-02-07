<style>
.text-danger{
	color:red;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Model</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span7 offset1 >"
                <div class="widget-box" style="width:1000px;">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Model</h5>
						<a href="<?php echo base_url('Admin/list_model');?>" class="btn btn-danger pull-right">List Model</a>						
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/update_model');?>" method="post" class="form-horizontal">
				 <div class="span6">
				    
							
                            <?php foreach($one as $row){ ?>
							<div class="control-group"><br><br><br>
                                <label class="control-label"> Model Code :</label>
                                <div class="controls">
                                    <input type="text" name="mcode" class="span11" placeholder="" value="<?php echo $row->mod_code;?>" />
									<span class="text-danger"><?php echo form_error('model'); ?></span>
                                </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label"> Model Name :</label>
                                <div class="controls">
								<input type="hidden" name="mid" value="<?php echo $row->model_id;?>">
                                    <input type="text" name="model" class="span11" placeholder="" value="<?php echo $row->mod_name;?>" />
									<span class="text-danger"><?php echo form_error('model'); ?></span>
                                </div>								
                            </div>
							 
							
							
							 	</div>	
                            <div class="form-actions" style="">
						
							
							<br><br><br><br><br><br>
							<br><br>
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