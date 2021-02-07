
<style>
input#submit{ background:none; border:none; font-size:1em; color:blue; }

	#user_data_filter{
	 margin-top: -34px;
    margin-left: 216px;
	}
</style>
<div id="content">
  <div id="content-header">
       <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">List Ready for Bill</a> </div>  </div>
	   	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
  <div class="container-fluid">
  	<div class="row-fluid">
    <div class="span12">	
            <div class="widget-content">				
		<div style="background-color: #e6e6e6;margin-top:-10px;" class="widget-title">
            <h5 style="color:#000;"> Ready for Bill List(Insurance)</h5>
			<!--<div class="btn" style="float:right;margin:3px; background:red;"><a class="btn-btn-danger" style="color:white!important;" href="<?php echo base_url('Admin/invoice_insurance');?>"> Add Insurance Invoice</a></div>-->
          </div> 
	  
              <table id="user_data" class="table table-bordered ">
    <thead>
    <tr>  
        <th><h5>Sl:No</h5></th>	
        <th><h5>Customer Details</h5></th>
		<th><h5>Branch</h5></th>
        <th><h5>Jobcard No</h5></th>
        <th><h5>Invoice No</h5></th>
		<th><h5>Jobcard Date</h5></th>
		<th><h5>Service Type</h5></th>
		<th><h5>Model</h5></th>
		<th><h5>Total Amount</h5></th>
    </tr>
    </thead>
    <tbody style="background:white;"> 
		<?php $i=1; foreach($invo as $row)  { ?>	 
     <tr> 
	  <td class="center"><?php echo $i++; ?></td>
        <form action="<?php 
                echo  base_url('Admin/edit_insurance_invoice');?>" method="post" name="all-<?php echo $i;?>" class="form-horizontal">  
				<input type="hidden" name="inv_id" value="<?php echo $row->inv_id;?>" readonly />
        <td class="center">
		<input type="submit" id="submit" style="color:red;" href="#" value="<?php echo $row->in_registr; ?>">
		
		<br>&nbsp; <?php echo $row->inv_cus; ?><br>&nbsp;<?php echo $row->inv_pho; ?></td>	
 </form>	 
        <td class="center"><?php echo $row->branch_name; ?></td>
        <td class="center"><?php echo $row->inv_job_card_no; ?></td>
        <td class="center"><?php echo $row->inv_no; ?></td>
		<td class="center"><?php echo date("d-m-Y", strtotime($row->inv_jcard_date));  ?></td>
		<td class="center"><?php echo $row->inv_repair_typ; ?></td>
		<td class="center"><?php echo $row->inv_modl; ?></td>
		<td class="center"><?php echo $row->inv_total; ?></td>
                  
		</tr>
		<?php } ?>		
    </tbody>
    </table>
</div>
	  </div>
  </div>
</div>
</div>
<script>

  var table = $('#user_data').DataTable({ 
       // "processing": true, //Feature control the processing indicator.
       // "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
         "bFilter":true,
		 "ordering":true,
		 'bLengthChange': false,
		 'paging': true,
		 "bInfo" : true,
        // Load data for the table's content from an Ajax source
        

    });

setTimeout(function() {
    $('#mydiv').fadeOut('slow');
}, 1000); // <-- time in milliseconds
</script>