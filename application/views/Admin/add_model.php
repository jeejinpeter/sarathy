
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Add Model</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span7 offset1 >"
                <div class="widget-box" style="width:1000px;">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Model</h5>
						<a href="<?php echo base_url('Admin/list_model');?>" class="btn btn-danger pull-right">List Model</a>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/add_model');?>" method="post" class="form-horizontal">
				 <div class="span7">
				    
							 <div class="control-group">
                                <label class="control-label">Vehicle Model Code :</label>
                                <div class="controls">
                                    <input type="text" name="code" class="span11" placeholder="Model Code" required />
									
                                </div>								
                            </div>
                           
                           <div class="control-group">
                                <label class="control-label">Vehicle Model Name :</label>
                                <div class="controls">
                                    <input type="text" name="model" class="span11" placeholder="Model Name" required />
									
                                </div>								
                            </div>
							
							   		</div>	
                            <div class="form-actions" style="">
						
							<br><br><br><br>
                                <button type="submit" class="btn btn-danger" style="border-radius:50px;margin-left:-370px;margin-top:10px;">Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;margin-top:10px;">Cancel</button>
                           
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