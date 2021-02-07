<div id="content">
  <div id="content-header">
       <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Change Password</a> </div>  </div>
  <div class="container-fluid">
  	<div class="row-fluid">
    <div class="span12">
	    <div class="span6 offset3">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Change Password</h5>
          </div>
		  	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
          <div class="widget-content">
               <?php $attributes = array("name" => "change_password");
                echo form_open_multipart("Admin/change_admin_password", $attributes);?>
              <div class="control-group">
                <label class="control-label">Old Password :</label>
                <div class="controls">
                  <input type="password" name="oldpassword" class="span11" required placeholder="Old Password" />
		<div style="color:red;"> <b><?php echo form_error('oldpassword'); ?></b></div>  
                </div>			
              </div>
			    <div class="control-group">
                <label class="control-label">New Password :</label>
                <div class="controls">
                  <input type="password" name="newpassword" class="span11" required placeholder="New Password" />
			<div style="color:red;"> <b><?php echo form_error('newpassword'); ?></b></div>
                </div>			
              </div>
			    <div class="control-group">
                <label class="control-label">Verify New Password :</label>
                <div class="controls">
                  <input type="password" name="cnewpassword" class="span11" required placeholder="Verify New Password" />
			<div style="color:red;"> <b><?php echo form_error('cnewpassword'); ?></b></div>	  
                </div>			
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Submit</button>
			  <button type="reset" class="btn btn-default">Reset</button>
              </div>
			<?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  </div>
  </div>
</div>
</div>