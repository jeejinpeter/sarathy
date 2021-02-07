

<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

 .tooltip.tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip.tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}


.text-danger{
	color:red;
}
.pdfs{
	padding-top:10px !important;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="tip-bottom">JOBCARD</a> <a href="#" class="current">Labour</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>JOBCARD & INVOICE DETAILS</h5>
						
                    </div>
                    <div class="widget-content nopadding" style="min-height:1000px;height:auto !important;">
                        <table border="0" cellpadding="" cellspacing="">
                          
				<?php foreach($cust as $row){ ?>
				
				  <tr>
				    <div class="control-group">
                            <td style="padding-left:50px"><label class="control-label" style="width:120px">Jobcard No :</label></td>
                               <div class="controls">
                                <td>
                                    <input type="text" style="border: none;background: #f5f5f5;"  name="jno" value="<?php echo $row->inv_job_card_no ;?>" value="" readonly /></td>
                                </div>								
                            </div><td >&nbsp;&nbsp;</td>
                        <div class="control-group" >
                          <td style="padding-left:60px"><label class="control-label" style="width:120px">Jobcard Date :</label></td>
                                <div class="controls" >
                                    <td><input type="date" style="border: none;background: #f5f5f5;"  name="jname" value="<?php echo $row->inv_jcard_date ;?>" readonly /></td>
                                </div>								
                            </div><td>&nbsp;&nbsp;</td>
						<div class="control-group">
                             <td style="padding-left:60px"><label class="control-label" style="width:120px">Invoice No :</label></td>
                               <div class="controls" >
                                    <td> <input type="text" style="border: none;background: #f5f5f5;" name="invoic"  value="<?php echo $row->inv_no ;?>" readonly /></td>
									</div>								
                            </div></tr>
                            <tr>
					  <div class="control-group">
                            <td style="padding-left:50px"><label class="control-label" style="width:120px">Invoice Date :</label></td>
                                <div class="controls" style="margin-left:130px">
                                    <td><input type="date" style="border: none;background: #f5f5f5;" name="invoicedate" value="<?php echo $row->inv_inv_date ;?>" readonly /></td>
									
                                </div>								
                            </div><td>&nbsp;&nbsp;</td>
					<div class="control-group">
                            <td style="padding-left:60px"><label class="control-label" style="width:120px">Invoice Type :</label></td>
                             <div class="controls" style="margin-left:130px">
                                    <td><input type="text" style="border: none;background: #f5f5f5;" name="invtype"  value="<?php echo $row->inv_type ;?>" readonly /></td>
									
                                </div>								
                            </div><td></td>
						 
							   		
									<div class="span3" style="float: left;">
                                         <div class="control-group">
                        <td style="padding-left:60px"><label class="control-label" style="width:120px">Registration No:</label></td>
                                <div class="controls" style="margin-left:128px">
                                <td style="padding-right:20px"><input type="text" style="border: none;background: #f5f5f5;" name="rno"  value="<?php echo $row->in_registr ;?>" readonly /></td>
                                    
                                </div>                              
                            </div>
                                        
						</tr>
                           
                                <!--
						<div class="control-group">
                            <td><label class="control-label" style="width:120px">Customer Address:</label></td>
                                <div class="controls" style="margin-left:130px">
                                    <td><textarea name="cusaddr" style="border: none;background: #f5f5f5;" rows="4" readonly ><?php echo $row->inv_cus_addres ;?></textarea></td>
								 </div>								
                            </div>   -->
                            
                            <tr>
                    <div class="control-group">
                        <td style="padding-left:50px"><label class="control-label" style="width:120px">Customer Name:</label></td>
                                <div class="controls" style="margin-left:130px">
                                    <td><input type="text" style="border: none;background: #f5f5f5;" name="cusname"  value="<?php echo $row->inv_cus ;?>" readonly /></td>
                                    
                                </div>                              
                            </div><td>  </td>
					 <div class="control-group">
                            <td style="padding-left:60px"><label class="control-label" style="width:120px">Mobile Number:</label></td>
                                <div class="controls" style="margin-left:130px">
                                    <td><input type="number" style="border: none;background: #f5f5f5;" name="cusph"  value="<?php echo $row->inv_pho ;?>" readonly /></td>
									
                                </div>								
                            </div><td>  </td>
					<div class="control-group">
                        <td style="padding-left:60px"><label class="control-label" style="width:120px">Customer GSTIN:</label></td>
                                <div class="controls" style="margin-left:130px">
                                   <td> <input type="text" style="border: none;background: #f5f5f5;" name="cusgst" value="<?php echo $row->inv_cus_gstin ;?>" readonly /></td>
									
                                </div>								
                            </div></tr>
									
                            
                             
                            <tr>
				  <div class="control-group">
                        <td style="padding-left:50px"><label class="control-label" style="width:120px">Model Name:</label></td>
                                <div class="controls" style="margin-left:128px">
						     <td><input type="text" name="mname" style="border: none;background: #f5f5f5;"  value="<?php echo $row->inv_modl ;?>" readonly /></td>
									
                                </div>								
                            </div>	<td>  </td>
				    <div class="control-group">
                        <td style="padding-left:60px"><label class="control-label" style="width:120px">KM Reading:</label></td>
                                <div class="controls" style="margin-left:128px">
								<td><input type="text" style="border: none;background: #f5f5f5;" name="km"  value="<?php echo $row->inv_km ;?>" readonly /></td>
									
                                </div>								
                            </div><td>  </td>
                            <!--
					<div class="control-group">
                        <td><label class="control-label" style="width:120px">Chassis No:</label></td>
                                <div class="controls" style="margin-left:128px">
								<td><input type="text" style="border: none;background: #f5f5f5;" name="cno"  value="<?php echo $row->inv_chassis ;?>" readonly /></td>
									
                                </div>								
                            </div></tr>
							<tr>
					<div class="control-group">
                         <td><label class="control-label" style="width:120px">Engine No:</label></td>
                                <div class="controls" style="margin-left:128px">
								<td><input type="text" style="border: none;background: #f5f5f5;" name="eno"  value="<?php echo $row->in_engine ;?>" readonly /></td>
									
                                </div>								
                            </div></tr>
                          -->
							
							
                                                      
                    <div class="control-group">
                            <td style="padding-left:60px"><label class="control-label" style="width:120px">Repair Type:</label></td>
                                <div class="controls" style="margin-left:130px">
                                    <td><input type="text" style="border: none;background: #f5f5f5;" name="repairty"  value="<?php echo $row->inv_repair_typ ;?>" readonly /></td>
									
                                </div>								
                            </div></tr>
                          <tr>
					
					<div class="control-group">
                        <td style="padding-left:50px"><label class="control-label" style="width:120px">Advisor Name:</label></td>
                                <div class="controls" style="margin-left:128px">
								<td><input type="text" style="border: none;background: #f5f5f5;" name="advname"  value="<?php echo $row->advai ;?>" readonly /></td>
									
                                </div>								
                            </div><td>    </td>
					<div class="control-group">
                        <td style="padding-left:60px"><label class="control-label" style="width:120px">Mechanic Name:</label></td>
                                <div class="controls" style="margin-left:128px">
								<td><input type="text" style="border: none;background: #f5f5f5;" name="mechname"  value="<?php echo $row->mechni ;?>" readonly /></td>
									
                                </div>								
                            </div><td>    </td>
					<div class="control-group">
                        <td style="padding-left:60px"><label class="control-label" style="width:120px">Branch Name:</label></td>
                                <div class="controls" style="margin-left:130px">
                                  <td><input type="text" value="<?php echo $row->branch_name ;?>"  name="branchname"  style="border: none;background:#f5f5f5;" readonly ></td>
								 </div>								
                            </div></tr>
        <div class="modal hide" style="border-radius:20px;" id="status-<?=$row->inv_id?>" role="dialog" >
     <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header" style="background-color: #0e60c5;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Send Email</h4>
      </div>
         <div class="modal-body">
     <form action="<?php echo base_url('Php_pdf/check_stat/'.$row->inv_id)?>" method="post" class="form-horizontal">
<div class="control-group">
<input type="hidden" name="id" value="<?php echo $row->inv_id; ?>">
 <div class="control-group">
                                <label class="control-label">To :</label>
                                <div class="controls">
                                    <input type="text" name="to" class="span11" placeholder="" value="" required/>
								
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label">Subject :</label>
                                <div class="controls">
                                    <input type="text" name="subject" class="span11" placeholder="" value="" required/>
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label">Message:</label>
                                <div class="controls">
                                 <textarea name="message" class="span11" placeholder="" ></textarea>
									
                                </div>								
                            </div>
														
                            </div>	   
							
      </div>
        <div class="modal-footer ">
         <a href="#"><button name="save" class="btn btn-primary" ><span class="glyphicon 
		glyphicon-ok-sign"></span>Yes</button></a>
	<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div> 
	  </form>
  </div>
    </div>	
</div>	          
		<tr><td colspan="7" style="padding-left:100px" ><table width="1000px" border="1" cellspacing="" cellpadding="10">
            <thead>
            <tr><th>Labour Code</th>
                <th>Labour Name</th>
                <th>Rate</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>UTGST</th>
                <th>CGST</th>
                <th>Total Amount</th></tr>
            </thead>
                <?php foreach ($invo as $value) 
                { ?>
                  <tr>
                    <td><?php echo $value->lc_lab_code ;?></td>
                     <td><?php echo $value->lc_lb_name ;?></td>
                     <td><?php echo $value->lc_rate ;?></td>
                     <td><?php echo $value->lc_disc ;?></td>
                     <td><?php echo $value->lc_tax_amunt ;?></td>
                     <td><?php echo $value->lc_sgst_a ;?></td>
                     <td><?php echo $value->lc_cgst_a ;?></td>
                     <td><?php echo $value->lc_amount ;?></td>
                  </tr>
                    <?php
                } ?>
       </table></td></tr>
				 <div class="form-actions" >	
                    <div style="float: right;" >

    <a  href="<?php echo  base_url(); ?>Php_excel/candidate_excel/<?php echo $row->inv_id;?>"  type="submite" class="btn btn-danger" target="_blank"><i class="fa fa-file-excel-o" style="font-size:22px;color:white"></i> Excel</a> 

                        <a style="margin:15px" href="<?php echo  base_url(); ?>Php_pdf/invoice_pdf/<?php echo $row->inv_id ;?>"  type="submit" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:22px;color:white"></i> Pdf</a>
						
						<a style="margin:3px"   href="<?= base_url()?>Phpword/download_word/<?php echo $row->inv_id;?>" class="btn btn-danger"  target="_blank"><i class="fa fa-file-word-o" aria-hidden="true" style="font-size:20px;color:white" ></i> Word</a>
						
                        <a data-toggle="modal" data-target="#status-<?=$row->inv_id?>" style="margin:3px"   href="" class="btn btn-danger" ><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:white" ></i> Email</a>
                       
                           </div>
							</div>
							
							<?php }  ?>  
						  
                    </div></table>
		
                    </div>

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

