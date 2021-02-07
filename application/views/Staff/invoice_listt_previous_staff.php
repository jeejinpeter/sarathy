<div id="content">
  <div id="content-header">
       <div id="breadcrumb"> <a href="<?php echo  base_url('Staff/staff_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">List Previous Bill</a> </div>  </div>
	   	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
  <div class="container-fluid">
  	<div class="row-fluid">
    <div class="span12">	
            <div class="widget-content">				
		<div style="background-color: #e6e6e6;margin-top:-10px;" class="widget-title">
            <h5 style="color:#000;">Previous Bill(Labour)</h5>
			
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
		<!--<th><h5>Action</h5></th>-->
    </tr>
    </thead>
    <tbody style="background:white;"> 
		<?php $i=1; foreach($invo as $row)  { ?>	 
     <tr> 
	  <td class="center"><?php echo $i++; ?></td>
        <td class="center"><a style="color:red;" target="_blank" href="<?php echo base_url('Staff/invoice_pdf_prev_bill/'.$row->inv_id); ?>"><?php echo $row->in_registr; ?></a><br> <?php echo $row->inv_cus; ?><br><?php echo $row->inv_cus_addres; ?><br><?php echo $row->inv_pho; ?></td>
		<td class="center"><?php echo $row->branch_name; ?></td>
        <td class="center"><?php echo $row->inv_job_card_no; ?></td>
        <td class="center"><?php echo $row->inv_no; ?></td>
		<td class="center"><?php echo date("d-m-Y", strtotime($row->inv_jcard_date));  ?></td>
		<td class="center"><?php echo $row->inv_repair_typ; ?></td>
		<td class="center"><?php echo $row->inv_modl; ?></td>
		<td class="center"><?php echo $row->inv_total; ?></td>
	<!--	<td class="center">
		<div class="btn-group">
	<a class="btn btn-danger dropdown-toggle" target="_blank" href="<?php echo base_url('Staff/invoice_pdf_prev_bill/'.$row->inv_id); ?>" style="border-radius:10px; margin-left:8px;">Print</a>
	</div>
        </td>-->
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
</script>