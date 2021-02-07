<!DOCTYPE html>
<html lang="en">
<head>
<title>Sarathy Motors </title>
<link rel="icon" type="image/png" href="<?php echo  base_url('resource/images/ICON.png'); ?>" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/bootstrap-responsive.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/fullcalendar.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/maruti-style.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/maruti-media.css'); ?>" class="skin-color" />
<script src="<?php echo  base_url('resource/admin/js/jquery.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.dataTables.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.tables.js'); ?>"></script> 

<style type="text/css">
  .icon{
    color:#000 !important;
  }
</style>
</head>
<body>
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Sarathy motors</a></h1>
</div>
<!--close-Header-part-->
<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important"></span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  
</div>
<!--close-top-Header-menu-->
<div id="side">
</div>
<div id="center">
</div>
<div id="right">
</div>

<div id="content" style="padding-bottom:0px !important;">
<div id="content-header">
<div><h4><center><?php echo $this->session->flashdata('msg'); ?></center></h4></div>
<div class="span12">
  <div class="span3" style="margin-left:25px;margin-top:30px;border:1px solid #464545;padding:20px;border-radius:15px;background-color:#f1eff0">
  <img src="<?php echo base_url('resource/admin/img/login-id.png');?>" style="width:100px;margin-left:70px;" class="img-responsive"><br><br><br>
  <?php $attributes = array("name" => "add_receiver","class" => "","style"=>"display:inline;padding:0px;margin:0;");
                echo form_open_multipart("Staff/staff_login_process", $attributes); ?>
   <label class="control-label" style="color:#b70818;font-weight:700;">Login Id</label>
						  <div class="controls">
                        <input type="text" data-validation="required" class="span3" name="username" value="" placeholder="Enter Username" style="border-radius:4px;" required>
						<span class="text-danger"><?php echo form_error('username'); ?></span> </div>
					<label class="control-label" style="color:#b70818;font-weight:700;">Password</label>
					<div class="controls">
                       <input type="password" data-validation="required" class="span3" name="password" value="" placeholder="Enter Password" style="border-radius:4px;" required>
						<span class="text-danger"> <?php echo form_error('password'); ?></span>     
                    </div><br>
					  <button type="submit" id="click_form" class="btn btn-danger" style="border-radius:4px;">LOGIN</button>
					<?php
	echo form_close(); ?>	
					</div>
					<div class="span6" style="float:right !important;">
					<img src="<?php echo base_url('resource/images/stafflogo.png');?>" style="" class="img-responsive">
					</div>
<center>					
  
</center>					
</div>					
<div>
<center>
  <!-----
  <img src="<?php echo base_url('resource/images/maruti-suzuki.jpg');?>"  class="img-responsive">
<---->
  </center>	
</div>  
    </div>
  </div>
</div>
</div>
<div class="row-fluid">
<div class="span10 offset2">&nbsp;&nbsp;&nbsp;<a href="" >Terms & Conditions</a>&nbsp;&nbsp;&nbsp;<a href="">Terms Of Use</a>&nbsp;&nbsp;&nbsp;<a href="">FAQ on Sarathy motors</a>&nbsp;&nbsp;&nbsp;<a href="">Privacy Policy</a>&nbsp;&nbsp;&nbsp;<a href="">Customer Grievance Redresal Policy</a>&nbsp;&nbsp;&nbsp;<a href="">Operation Manual</a></div>
  <div id="" class="span7 offset5"> 2018 &copy; <a href="http://cyberiasoftwares.com/">Cyberia Softwares Pvt.Ltd</a> </div>
</div>
<script src="<?php echo  base_url('resource/admin/js/jquery.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.tables.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.dataTables.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/excanvas.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.ui.custom.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/bootstrap.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.flot.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.flot.resize.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.peity.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/fullcalendar.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.dashboard.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.chat.js'); ?>"></script> 
<script  type="text/javascript" src="<?php echo  base_url('resource/admin/js'); ?>/jquery.form-validator.min.js"></script>
 <script>
  $.validate({
    lang: 'en'
  });
</script>
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
<style>
#side {
    width:40%;
	float:left;
    background: #1a53ff;
    position: absolute;
    clear: both;
    top: 100px;
	height:6%;	
}
#center{
	margin-left:240px;
    width:74%;
    float:left;
    background:#1a53ff;
    position: absolute;
    clear: both;
    top: 100px;
	height:6%;	
}
#right{
	margin-left:1231px;
    width:20%;
    float:left;
    background:#1a53ff;
    position: absolute;
    clear: both;
    top: 100px;
	height:6%;	
}
</style>
</html>