<!DOCTYPE html>
<html lang="en">
<head>
<?php if(isset($title)) { ?>
<title><?php echo $title; ?></title>
<?php } else{ ?>
	<title>Sarathy Motors</title>
<?php } ?>
<link rel="icon" type="image/png" href="<?php echo  base_url('resource/images/ICON.png'); ?>" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="<?php echo  base_url('resource/admin/js/jquery.min.js'); ?>"></script> 
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/bootstrap-responsive.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/fullcalendar.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/maruti-style.css'); ?>" />
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/maruti-media.css'); ?>" class="skin-color" />
<script src="<?php echo  base_url('resource/admin/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo  base_url('resource/admin/js/bootstrap-multiselect.js'); ?>"></script> 
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/bootstrap-multiselect.css'); ?>" /> 
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/jquery.dataTables.min.css'); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo  base_url('resource/admin/css/select2.min.css'); ?>" /> 
<style type="text/css">
  .icon{
    color:#000 !important;
  }
@media only screen and (max-width: 1026px) {
    #user-nav {
        display: none;
    }
} 
</style>
</head>
<script type="text/javascript">
  $(document).ready(function() {
    $('.item1').select2({

    dropdownParent: $('#locationCodesParent')            
});
 $('.item2').select2({

    dropdownParent: $('#locationCodesParent2')            
});//Add this
});
</script>
<body>
<!--Header-part-->
<div id="header">
  <h1><a href="#"></a></h1>
</div>
<!--close-Header-part-->
<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="#" style="color:#000;"><i class="icon icon-user" aria-hidden="true"></i> <span class="text">Welcome - Staff Panel</span></a></li>
    <li class=""><a title="" href="#" style="color:#000;"><i class="icon icon-phone" aria-hidden="true"></i> <span class="text">+91 9847771177 / 04742729618</span></a></li>
    <li class=""><a title="" href="<?php echo base_url('Staff/logout');?>" style="color: #000;"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    <div style="width:300px;height:60px; padding-top:50px;"></div>
  </ul>
</div>
<!--close-top-Header-menu-->
<div id="sidebar" style="background: #0e60c5;"><a href="#" class="visible-phone"><i class="icon icon-home"></i>Menu</a>
  
  
<ul>
<li> <a href="<?php echo base_url('Staff/staff_home_page');?>"><span>Home</span></a> </li>



<li class="submenu"> <a href="#"><span>Customer</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/add_customer');?>">Add Customer</a></li>
		 <li><a href="<?php echo base_url('Staff/list_customer');?>" >List Customer</a></li>
      </ul>
    </li>



 <li class="submenu"> <a href="#"><span>Invoice</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/invoice_labour');?>" target="_blank">Labour Invoice</a></li>
		 <li><a href="<?php echo base_url('Staff/invoice_insurance');?>" target="_blank">Insurance Invoice</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><span>Ready for bill list</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/list_invoice');?>" >Labour </a></li>
		 <li><a href="<?php echo base_url('Staff/list_insurance_invoice');?>">Insurance </a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><span>Reports</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/list_job_card_staff');?>" target="_blank">Job Card Bill Summary</a></li>
		 <li><a href="<?php echo base_url('Staff/list_job_card_statement');?>" target="_blank">Job Card Statement</a></li>
      </ul>
    </li>
	 
	<li class="submenu"> <a href="#"><span>Previous Bills</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/list_previous_bill_staff');?>">Labour</a></li>
		 <li><a href="<?php echo base_url('Staff/list_previous_bill_insurances');?>">Insurance</a></li>
      </ul>
    </li>
    <li> <a href="<?php echo base_url('Staff/vehicle_history_staff');?>"><span>Vehicle History</span></a> </li>
	<li class="submenu"> <a href="#"><span>My Profile</span></a>
      <ul>
        <li><a href="<?php echo base_url('Staff/change_password');?>">Change Password</a></li>
        
      </ul>
    </li>	

	

   	
  </ul>

</div>