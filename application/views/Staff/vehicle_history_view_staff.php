
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Staff/staff_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">Vehicle History</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span6 offset3 >"
                <div class="widget-box" >
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Vehicle History</h5>
					</div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Staff/vehicle_history_pdf_staff');?>" method="post" target="_blank" class="form-horizontal">
				 <div class="span11">
				    
							 
                            <div class="control-group">
                                <label class="control-label">Vehicle No :</label>
                                <div class="controls">
                                    <input type="text" name="id" class="span11" placeholder="Vehicle No" required />
									
                                </div>								
                            </div>
                       
							</div>	
                            <div class="form-actions" style="">
						<button type="submit" class="btn btn-danger" style="border-radius:10px;">View</button>
								
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