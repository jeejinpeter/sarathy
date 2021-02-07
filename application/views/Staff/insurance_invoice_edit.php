
<style>
.text-danger{
	color:red;
}
.pdfs{
	padding-top:0px !important;
}

#locationCodesParent{ 
    position: relative;
    width: 550px;
    height: -230px;
}
.select2-dropdown{
	width:200px !important;
}
select, input[type="file"] {
    height: 24px;
    line-height: 30px;
}
input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	height: 14px;
}
.select2-container--default .select2-selection--single {
	height: 24px!important;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="tip-bottom">INVOICE</a> <a href="#" class="current">Insurance</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid" style="margin-top:-60px;">
 <div id="content" style="zoom:100%;">         
                <div class="widget-box">
				 <form action="<?php echo base_url('Staff/invoice_insurance_pdf_ready');?>" method="post" class="form-horizontal" target="_blank">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>INVOICE (Insurance)</h5>
						 <button style="float:right;" type="submit" name="ready" value="Ready For Bill" class="btn btn-danger" style="border-radius:60px;">Add to Ready for Bill</button>
                    </div>
					   <div class="widget-content nopadding" style="min-height:700px;height:auto !important;">
                       
				<?php 
				foreach($cust as $row){ ?>
				 <div class="span12">
				 <div class="span3">
				  <div class="control-group">
                                <label class="control-label" style="width:120px">Branch Name:</label>
                                <div class="controls" style="margin-left:130px">
								<select name="branchname" required style="width:165px;font-size:9px;"id="branch" readonly>
								<option value="<?php echo $row->b_id;?>"><?php echo $row->branch_name; ?>  [<?php echo $row->branch_id; ?>]</option>
								</select>
								 </div>								
                            </div>
				    <div class="control-group">
                                <label class="control-label" style="width:120px">Jobcard No :</label>
                               <div class="controls" style="margin-left:130px">
                                     <input type="text" name="jno" value="<?php echo $row->inv_job_card_no ;?>" value="" readonly />  </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label" style="width:120px">Jobcard Date :</label>
                                <div class="controls" style="margin-left:130px">
                                   <input type="date" name="jname" value="<?php echo $row->inv_jcard_date ;?>" readonly />
                                </div>								
                            </div>
							 <div class="control-group">
							 <div id="msg"></div>
                                <label class="control-label" style="width:120px">Invoice No :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="invoic"  value="<?php echo $row->inv_no ;?>" readonly />
									
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">Invoice Date :</label>
                                <div class="controls" style="margin-left:130px">
                                     <input type="date" name="invoicedate" value="<?php echo date('Y-m-d');?>" readonly />
									
                                </div>								
                            </div>
							
							
						
							   		</div>
									 <div class="span3">
								<div class="control-group">
                                <label class="control-label" style="width:120px">Registration No:</label>
                                <div class="controls" style="margin-left:128px">
							<input type="text" name="rno"  value="<?php echo $row->in_registr ;?>" readonly />
									
                                </div>								
                            </div>
						 <div class="control-group">
                                <label class="control-label" style="width:120px">Model Name:</label>
                                <div class="controls" style="margin-left:128px">
							<input type="text" name="mname"  value="<?php echo $row->inv_modl ;?>" readonly />
									
                                </div>								
                            </div>	
							
				    <div class="control-group">
                                <label class="control-label" style="width:120px">KM Reading:</label>
                                <div class="controls" style="margin-left:128px">
						<input type="text" name="km"  value="<?php echo $row->inv_km ;?>"  />
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Chassis No:</label>
                                <div class="controls" style="margin-left:128px">
						<input type="text" name="cno"  value="<?php echo $row->inv_chassis ;?>" readonly />
									
                                </div>								
                            </div>
							
							<div class="control-group">
                                <label class="control-label" style="width:120px">Engine No:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="eno"  value="<?php echo $row->in_engine ;?>" readonly />
									
                                </div>								
                            </div>
                         
							
							
							
							   		</div>	
									<div class="span3">
									<div class="control-group">
                                <label class="control-label" style="width:120px">Customer Name:</label>
                                <div class="controls" style="margin-left:130px">
                         <input type="text" name="cusname"  value="<?php echo $row->inv_cus ;?>" readonly />
									
                                </div>								
                            </div>
						
							<div class="control-group">
                                <label class="control-label" style="width:120px">Insurance:</label>
                                <div class="controls" style="margin-left:130px">
                                <input type="text"   value="<?php echo $row->icompany_name ;?>" readonly />
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Insurance GSTIN:</label>
                                <div class="controls" style="margin-left:130px">
                                  <input type="text"  value="<?php echo $row->icompany_gst ;?>" readonly />
									
                                </div>								
                            </div>
								 <div class="control-group">
                                <label class="control-label" style="width:120px">Insurance Address:</label>
                                <div class="controls" style="margin-left:130px;">
                                  <textarea style="height:60px;resize:none;" rows="4" readonly ><?php echo $row->icompany_address ;?></textarea>
								 </div>								
                            </div>
									</div>

 <div class="span3">
 <div class="control-group">
                                <label class="control-label" style="width:120px">Mobile Number :</label>
                             <div class="controls" style="margin-left:130px">
                                   <input type="text" name="cusph"  value="<?php echo $row->inv_pho ;?>"  />
                                </div>								
                            </div>
 <div class="control-group">
                                <label class="control-label" style="width:120px">Invoice Type :</label>
                             <div class="controls" style="margin-left:130px">
                                   <input type="text" name="invtype"  value="<?php echo $row->inv_type ;?>" readonly />
                                </div>								
                            </div>
 <div class="control-group">
                                <label class="control-label" style="width:120px">Repair Type:</label>
                                <div class="controls" style="margin-left:130px">
					
					 		<select name="repairty"  style="width:165px;" required>
								<option value="<?php echo $row->inv_repair_typ ;?>"><?php echo $row->inv_repair_typ ;?></option>
								<option value="First free service"> First free service</option>
								<option value="Second free service"> Second free service</option>
								<option value="Third free service"> Third free service</option>
								<option value="Paid service"> Paid service</option>
								<option value="Paid service"> AMC service</option>
								<option value="Accidental Repair"> Accidental Repair</option>
								<option value="Other Repairs(within warranty)"> Other Repairs (within warranty)</option>
								<option value="Other Repairs(outside warranty)">Other Repairs (outside warranty)</option>
								
								</select>
                                </div>								
                            </div>
						<div class="control-group">
                                <label class="control-label" style="width:120px">Advisor Name:</label>
                                <div class="controls" style="margin-left:128px">
								<!--<input type="text" name="advname"  value="<?php echo $row->e_first_name;?>" readonly />-->
								<?php $adv=$row->advai;
								if(isset($adv)) {
									$branch_id=$row->b_id;
								$branchss = $this->Bill_model->select_advi_by_brnch($branch_id);
								?>
								<select name="advname" id="Adviz"  style="width:165px;" >
								<option value="<?php echo $row->advai_id;?>"><?php echo $row->advai;?></option>
								<?php foreach($branchss as $rowss){  ?>
								<option value="<?php echo $rowss->emp_id;?>"><?php echo $rowss->e_first_name;?>(<?php echo $rowss->e_code?>)</option><?php } ?>
								</select>
								<?php } else { 
								$branch_id=$row->b_id;
								$branchss = $this->Bill_model->select_advi_by_brnch($branch_id);
							?>
								<select name="advname" id="Adviz"  style="width:165px;" >
								<option value="">---select---</option>
								<?php foreach($branchss as $rowss){  ?>
								<option value="<?php echo $rowss->emp_id;?>"><?php echo $rowss->e_first_name;?>(<?php echo $rowss->e_code?>)</option><?php } ?>
								</select>
								<?php  } ?>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Mechanic Name:</label>
                                <div class="controls" style="margin-left:128px">
									<!--<input type="text" name="mechname"  value="<?php echo $row->e_first_name ;?>" readonly />-->
									<?php $mechi=$row->mechni;if(isset($mechi)) {
										$branch_id=$row->b_id;
								$branchmm = $this->Bill_model->select_mech_by_brnch($branch_id);
										?>
									<select name="mechname" id="Mechz"  style="width:165px;">
								<option value="<?php echo $row->mechni_id;?>"><?php echo $row->mechni;?></option>
								<?php foreach($branchmm as $rowmm){  ?>
								<option value="<?php echo $rowmm->emp_id;?>"><?php echo $rowmm->e_first_name;?>(<?php echo $rowmm->e_code?>)</option><?php } ?>
								</select>
								<?php } else { 
								$branch_id=$row->b_id;
								$branchmm = $this->Bill_model->select_mech_by_brnch($branch_id); ?>
								<select name="mechname" id="Mechz"  style="width:165px;">
								<option value="">---select---</option>
								<?php foreach($branchmm as $rowmm){  ?>
								<option value="<?php echo $rowmm->emp_id;?>"><?php echo $rowmm->e_first_name;?>(<?php echo $rowmm->e_code?>)</option><?php } ?>
								</select>
									<?php } ?>
                                </div>								
                            </div>
							
							<div class="control-group">
                                <label class="control-label" style="width:120px">Surveyor Name:</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" id="saledate" name="surveyor"  placeholder="" value="<?php echo $row->insurance_serveyor;?>" readonly />
									
                                </div>								
                            </div>
							
</div> 
		 <div class="span12" style="height:100px; width:95%;">
		 <h4>Total Payable Amount : Rs<input type="text" id="TTl" value="<?php echo $row->inv_total ;?>" style="border: none;
    background: none;
    font-size: 18px;" readonly ><h4>
	<input type="hidden" name="id"  value="<?php echo $row->inv_id ;?>" readonly />
	 <button style="float:right;margin-left:15px;" type="submit" name="print" class="btn btn-danger" style="border-radius:60px;" value="Print" onclick="return handleChange()" >Print</button>
	
		   		<!--<a href="<?php echo  base_url(); ?>Admin/invoice_pdf/<?php echo $row->inv_id ;?>" style="float:right;margin-left:15px;"   class="btn btn-danger" style="border-radius:60px;" target="_blank">Print</a>-->
                       <div class="form-actions" style="">	     
							</div>
</div>	

				<?php } ?>
				 <div class="span12" style="height:250px!important;overflow-x:hidden; overflow-y: scroll!important;width:1250px!important;">
						<div class="span12 mainz">			 
<div class="span2"><label style="font-size:13px;margin-top:29px;">Labour Code</label></div>						
<div class="span2" style="margin-left: -92px;margin-top:29px;"><label style="font-size:13px;">Labour Name</label></div>
<div class="span2" style="margin-left: -75px;margin-top:29px;"><label style="font-size:13px;">SAC Code</label></div>
<div class="span1" style="margin-left: -105px;margin-top:29px;"><label style="font-size:13px;">Job Type</label></div>
<div class="span1" style="margin-left: -10px;margin-top:29px;"><label style="font-size:10px;width:75px">Rate</label></div>
<div class="span1" style="margin-left:4px;margin-top:29px;"><label style="font-size:10px;">Dis %</label></div>
<div class="span1" style="margin-left:-13px;margin-top:29px;"><label style="font-size:10px;">Dis</label></div>
<div class="span2" style="margin-left:-6px;margin-top:29px;"><label style="font-size:10px;">Taxable Amt</label></div>
<div class="span2" style="margin-left:-59px;margin-top:29px;" ><label style="font-size:10px;">SGST/UTGST %</label></div>
<div class="span1" style=" margin-left:-84px;margin-top:29px;"><label style="font-size:10px;">SGST/UTGST</label></div>
<div class="span1" style="margin-left: -14px;margin-top:29px;" ><label style="font-size:10px;">CGST %</label></div>
<div class="span1" style="margin-left: -3px;margin-top:29px;"><label style="font-size:10px;">CGST</label></div>
<div class="span1" style="margin-left: 10px;margin-top:29px;"><label>Amount</label></div>
<div class="span1" style="margin-left:67px;margin-top:30px;margin-top:29px;"><a href="javascript:void(0);" id="add" ><span class="icon-plus"></span></a></div>
 	
			<?php $i=0;$j=1;

				foreach($invo as $row){	

				?>				
																	
					<div class="count">
						<?php if($i==0)	{
						?>
								<div id="rezult1" class="row_count">
						<div class="contents1">						
				<div class="span2" style="margin-left:0px;font-size:9px" ><select class="labour_code22 item1" id="locationCodesParent" name="lc[]" onChange="UpdateInfo1(this.value,<?php echo $j;?>);" style="width:80px;" >
				<option value="<?php echo $invo[$i]['lc_lab_code'];?>"><?php echo $invo[$i]['lc_lab_code'];?> [ <?php echo $invo[$i]['lc_lb_name']; ?> ]</option>
				<?php foreach($labour as $rowss) { ?> <option value="<?php echo  $rowss['labour_code']; ?>"><?php echo $rowss['labour_code']; ?> [ <?php echo $rowss['labour_title']; ?>]</option> <?php } ?>
				</select>
				</div>
						<div class="span2" style="margin-left: -99px;"><input type="text" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_lb_name']; } ?>" class="" name="lna[]" id="labour_name-<?php echo $j;?>" style="width:93px;font-size:10px;" readonly /></div>
						<div class="span2 pdfs" style="margin-left: -72px;"><input type="text"  name="sacd[]" style="width:57px;font-size:10px;" value="998729" readonly /></div>
						<div class="span1" style="margin-left: -108px;">
						<select style="width:100px;" name="jb_ty[]" id="jtype-<?php echo $j;?>" onChange="jobtype(<?php echo $j;?>);"> <option value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_type']; }?>"><?php if(isset($invo[$i])) { echo $invo[$i]['lc_type']; }?></option> 
						<option value="Paid Service">Paid Service</option> 
						<option value="Expense">Expense</option> 
						<option value="Free Service">Free Service</option> </select>
					    </div>
						
						
						<div class="span1" style="margin-left:-9px;;"><input  type="text" id="rate-<?php echo $k=$j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_rate']; }?>" onkeyup="add_number(<?php echo $j;?>);" name="lrate[]" style="width:50px;" /></div>
						
						<div class="span1" style="margin-left:-8px;"><input type="text" style="width:50px;" class="" name="ldis[]" onkeyup="add_number(<?php echo $j;?>);" id="dis-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_disc_p']; }?>" /></div>
						
						<div class="span1" style="margin-left:-5px;"><input type="text" style="width:50px;" class="ldisc" name="ldisc[]" id="ndisc-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_disc']; }?>" readonly /></div>
						
						<div class="span2" style="margin-left:-5px;"><input  type="text"  name="ltax[]"  style="width:100px;"   id="taxs-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_tax_amunt']; } ?>" class="ltax"  readonly /></div>
						
						<div class="span2" style="margin-left:-59px;" ><input  type="text" class="" name="lugstp[]" style="width:75px;"  id="utgp-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_sgst_p']; }?>" readonly /></div>
						
						<div class="span1" style=" margin-left:-84px"><input  type="text" class="lugst" name="lugst[]" id="utg-<?php echo $j;?>"  style="width:50px;" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_sgst_a']; }?>" readonly  /></div>
						
						<div class="span1" style="margin-left: -14px;" ><input type="text" class="" name="lcgstp[]" id="cgstp-<?php echo $j;?>" style="width:50px;" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_cgst_p']; }?>" readonly /></div>
						
						<div class="span1" style="margin-left: -3px;"><input type="text" class="lcgst" name="lcgst[]" id="cgst-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_cgst_a']; }?>"  style="width:50px;" readonly /></div>
						
						<div class="span1" style="margin-left: 10px;"><input  type="text" class="lamt" name="lamt[]" id="total-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_amount'];} ?>"  style="width:115px;" readonly /></div>
						<div class="span1"  style="margin-left:75px;margin-top:10px;"><span class="rem1"><a href="javascript:void(0);" onclick="calculate1(<?php echo $invo[$i]['lcr_id'];?>);claculate_all_sums();" ><span class="icon-minus"></span></a></span></div>
					</div>
					</div>	
						<?php }	?>
						<?php if($i>0)	{ 
						?>
						<div id="rezult2" class="row_count">
						<div class="contents2">
				<div class="span2" style="margin-left:0px;font-size:9px" ><select class="labour_code22 item1" id="locationCodesParent" name="lc[]" onChange="UpdateInfo1(this.value,<?php echo $j;?>);" style="width:80px;" >
				<option value="<?php echo $invo[$i]['lc_lab_code'];?>"><?php echo $invo[$i]['lc_lab_code'];?> [ <?php echo $invo[$i]['lc_lb_name']; ?> ]</option>
				<?php foreach($labour as $rowss) { ?> <option value="<?php echo  $rowss['labour_code']; ?>"><?php echo $rowss['labour_code']; ?> [ <?php echo $rowss['labour_title']; ?>]</option> <?php } ?>
				</select>
				</div>
						<div class="span2" style="margin-left: -99px;"><input type="text" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_lb_name']; } ?>" class="" name="lna[]" id="labour_name-<?php echo $j;?>" style="width:93px;font-size:10px;" readonly /></div>
						<div class="span2 pdfs" style="margin-left: -72px;"><input type="text"  name="sacd[]" style="width:57px;font-size:10px;" value="998729" readonly /></div>
						<div class="span1" style="margin-left: -108px;">
						<select  style="width:100px;" name="jb_ty[]" id="jtype-<?php echo $j;?>" onChange="jobtype(<?php echo $j;?>);"> <option value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_type']; }?>"><?php if(isset($invo[$i])) { echo $invo[$i]['lc_type']; }?></option> 
						<option value="Paid Service">Paid Service</option> 
						<option value="Expense">Expense</option> 
						<option value="Free Service">Free Service</option> </select>
					    </div>
						<div class="span1" style="margin-left:-9px;;"><input  type="text" id="rate-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_rate']; }?>" onkeyup="add_number(<?php echo $j;?>);" name="lrate[]" style="width:50px;"  /></div>
						
						<div class="span1" style="margin-left:-8px;"><input type="text" style="width:50px;" class="" name="ldis[]" onkeyup="add_number(<?php echo $j;?>);" id="dis-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_disc_p']; }?>" /></div>
						
						<div class="span1" style="margin-left:-5px;"><input type="text" style="width:50px;" class="ldisc" name="ldisc[]" id="ndisc-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_disc']; }?>" readonly /></div>
						
						<div class="span2" style="margin-left:-5px;"><input  type="text"  name="ltax[]"  style="width:100px;"   id="taxs-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_tax_amunt']; } ?>" class="ltax" readonly /></div>
						
						<div class="span2" style="margin-left:-59px;" ><input  type="text" class="" name="lugstp[]" style="width:75px;"  id="utgp-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_sgst_p']; }?>" readonly /></div>
						
						<div class="span1" style=" margin-left:-84px"><input  type="text" class="lugst" name="lugst[]" id="utg-<?php echo $j;?>"  style="width:50px;" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_sgst_a']; }?>" readonly  /></div>
						
						<div class="span1" style="margin-left: -14px;" ><input type="text" class="" name="lcgstp[]" id="cgstp-<?php echo $j;?>" style="width:50px;" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_cgst_p']; }?>" readonly /></div>
						
						<div class="span1" style="margin-left: -3px;"><input type="text" class="lcgst" name="lcgst[]" id="cgst-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_cgst_a']; }?>"  style="width:50px;" readonly /></div>
						
						<div class="span1" style="margin-left: 10px;"><input  type="text" class="lamt" name="lamt[]" id="total-<?php echo $j;?>" value="<?php if(isset($invo[$i])) { echo $invo[$i]['lc_amount'];} ?>"  style="width:115px;" readonly /></div>
						<div class="span1"  style="margin-left:75px;margin-top:10px;"><span class="rem4" id="" ><a href="javascript:void(0);" onclick="calculate2(<?php echo $invo[$i]['lcr_id'];?>);claculate_all_sums();"><span class="icon-minus"></span></a></span></div>
					</div>
					</div>
						</div>	
				<?php }	?>
					
					
					<?php $i++;$j++;
					}
				?>
						<div id="rezult" >
						</div>	
					
						 <div class="span8" style="float:right;">
<?php 
				foreach($cust as $row1){ ?>	
 <input type="hidden" name="inv_id" value="<?php echo $row1->inv_id ;?>" readonly />				
						<div class="pdfs span1" style="    margin-left: 23px;"> <b style="padding-top:20px;">Total</b></div>
	 <div class="pdfs span1" style="margin-left:0px;" >
<input style="width:50px;" type="text" class="" name="tdisc"  id="disctotal" value="<?php echo $row1->inv_disc_total ;?>"  readonly /></div>
 <div class="pdfs span2" style="margin-left:20px;" >
	 <input style="width:98px;" type="text" class="" name="ttotl"  id="taxtotal" value="<?php echo $row1->inv_taxtotal ;?>"  readonly /></div>
	  <div class="pdfs span2" > <input style="margin-left:76px!important;width:50px;" type="text" class="" name="sgtotal"   id="sgsttotal" value="<?php echo $row1->inv_sgstotal ;?>" readonly  /></div>
	    <div class="pdfs span1" > <input style="margin-left:78px!important;width:50px;" type="text"  name="gstotl"   id="gsttotal" value="<?php echo $row1->inv_gsttotal ;?>"  readonly /></div>
		 <div class="pdfs span2" style="margin-left:107px;" ><input style="margin-left:6px!important;width:115px;" type="text" class="" name="total"   id="netamount" value="<?php echo $row1->inv_total ;?>" readonly /></div>
	  </div>
			</div>
						</div>
							<?php }  ?> 			 
                        </form>
		
                    </div>

                </div>
         
        </div>
    </div>
	</div>
	</div>
</div>
</div>
</div>
<script>

function handleChange(input) {
    var x = document.getElementById("Adviz").value;
    var x1 = document.getElementById("Mechz").value;
    if (x === "" || x1 === "") {
        alert("Advisor and Mechanic Names are Required");
        return false;
    }
    return true;
}

$('.input_capital').on('input', function(evt) {
  $(this).val(function(_, val) {
    return val.toUpperCase();
  });
});

$(document).ready(function() {
	
window.addEventListener("keydown", function(e) {
    // space and arrow keys
    if([ 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
	
		 if(e.keyCode === 40){
        addrow();
    }else if(e.keyCode === 38){
    

	}
    }
}, false);
$('.labour_code22').select2();
	var count=$(".count .row_count").length+1;
   $("#add").click(function(){
	    addrow();
    });
function addrow(){	   
		 var html="<div class='contents'>"; $("#rezult").append(html);
var html="<div class='span2 pdfs locationCodesParent'  style='margin-left:0px;font-size:9px'><select class='labour_code2 item1' id='locationCodesParent' name='lc[]'  style='width:80px;' onChange='UpdateInfo1(this.value,"+count+");'><option value=''></option> <?php foreach($labour as $row) { ?> <option value='<?php echo $row['labour_code']; ?>'><?php echo $row['labour_code']; ?>     [  <?php echo $row['labour_title']; ?>  ]</option><?php } ?></select></div>"; $("#rezult").append(html); $('.labour_code2').select2();		 
		 var html="<div class='span2 pdfs' style='margin-left: -99px;'><input type='text'  name='lna[]' id='labour_name-"+count+"' style='width:93px;font-size:10px;' readonly /></div>"; $("#rezult").append(html);
		  var html="<div class='span2 pdfs' style='margin-left: -72px;'><input type='text'  name='sacd[]' style='width:57px;font-size:10px;'value='998729' readonly /></div>"; $("#rezult").append(html);
		 
		 var html="<div class='span1 pdfs' style='margin-left: -108px;'><select style='width:100px;' name='jb_ty[]' id='jtype-"+count+"' onChange='jobtype("+count+");' required> <option value=''>--Select--</option> <option value='Paid Service' >Paid Service</option> <option value='Expense'>Expense</option> <option value='Free Service'>Free Service</option> </select></div>"; $("#rezult").append(html);
		 var html="<div class='span1 pdfs' style='margin-left:-9px;'><input  type='text' id='rate-"+count+"' name='lrate[]' style='width:50px;'   value='0'  onkeyup=add_number('"+count+"')   /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: -8px;'><input type='text' id='dis-"+count+"' name='ldis[]' value='0' onkeyup=add_number('"+count+"') style='width:50px;'  /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: -4px;'><input class='ldisc'  type='text'  name='ldisc[]' id='ndisc-"+count+"'  style='width:50px;' readonly  /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left:-6px;'><input style='width:100px;' type='text' class='ltax' id='taxs-"+count+"' name='ltax[]' readonly  /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left:47px;'><input  type='text' id='utgp-"+count+"' class='lugstp'  name='lugstp[]' style='width:75px;'  readonly /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: 21px;'><input  type='text' class='lugst'  name='lugst[]' id='utg-"+count+"'  style='width:50px;' readonly  /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: -3px;' ><input type='text' class='lcgstp'  name='lcgstp[]' id='cgstp-"+count+"'  style='width:50px;' readonly /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: -3px;'><input type='text' class='lcgst' name='lcgst[]' id='cgst-"+count+"'   style='width:50px;' readonly /></div>"; $("#rezult").append(html);
		var html="<div class='span1 pdfs' style='margin-left: 10px;'><input  type='text'  id='total-"+count+"' name='lamt[]' class='lamt'  style='width:114px;' readonly /></div>"; $("#rezult").append(html);
 var html="<div class='span1 pdfs' style='margin-top:11px;margin-left:75px;'><span class='rem' ><a href='javascript:void(0)' onclick='claculate_all_sums()' ><span class='icon-minus'></span></a></span></div>"; $("#rezult").append(html);
     var html="</div>"; $("#rezult").append(html);
    count++;
    } 
//window.onload = addrow();	
	
setTimeout(function() {
    $('#msg').fadeOut('slow');
}, 3000); // <-- time in milliseconds

	
	
});

function jobtype(k)
{ 
 var job_type = document.getElementById("jtype-"+k).value;
if(job_type == "Expense" || job_type == "Free Service")
{
document.getElementById("taxs-"+k).value = parseFloat(0.00);
document.getElementById("utgp-"+k).value = parseFloat(0.00);
document.getElementById("utg-"+k).value = parseFloat(0.00);
document.getElementById("cgstp-"+k).value = parseFloat(0.00);
document.getElementById("cgst-"+k).value = parseFloat(0.00);
document.getElementById("total-"+k).value = parseFloat(0.00); 
 claculate_all_sums();
}
else{
    add_number(k);
}

}
function add_number(k) {
var rate = parseFloat(document.getElementById("rate-"+k).value);
var disc1=document.getElementById("dis-"+k).value;
if(disc1=='')
{
var zero=parseFloat(0);
document.getElementById("dis-"+k).value =parseFloat(zero);
}else
{
parseFloat(disc1);
document.getElementById("dis-"+k).value =disc1;
}
var disc=parseFloat(document.getElementById("dis-"+k).value);
var ndisc=parseFloat((rate * disc) /100).toFixed(2);
var discnt =rate - ndisc;
var disamt =parseFloat(discnt).toFixed(2);

var utgp = 9;
var persnt = parseFloat((discnt * utgp) /100).toFixed(2);
var totl = discnt +(persnt * 2);
var totls = parseFloat(totl).toFixed(2);
document.getElementById("taxs-"+k).value = disamt;
document.getElementById("utgp-"+k).value = utgp;
document.getElementById("utg-"+k).value = persnt;
document.getElementById("cgstp-"+k).value = utgp;
document.getElementById("cgst-"+k).value = persnt;
document.getElementById("total-"+k).value = totls;
document.getElementById("ndisc-"+k).value = ndisc;

 claculate_all_sums();
}
 $('#rezult').on('click', '.rem', function() {
     $(this).parent().prevUntil(".contents").remove();
     $(this).parent().remove();
claculate_all_sums();	 
 });
function calculate1(k)
 {
	  var inc_id=k;
	  var id=$("input[name=inv_id]").val();
  $.ajax({
    type:"POST",
	url :"remove_invoice_row",
	dataType : "json",
	data:{"inv_id":id,"inc_id":inc_id},
	success:function(html)
	{
//alert(html);
 // window.location.reload();	
	}
 });
$('.rem1').on('click', function() {
     $(this).parent().prevUntil(".contents1").remove();
     $('.rem1').parent().remove();
	  claculate_all_sums();
	 });
 }
 function calculate2(k)
 {
	  var inc_id=k;
	  var id=$("input[name=inv_id]").val();
  $.ajax({
    type:"POST",
	url :"remove_invoice_row",
	dataType : "json",
	data:{"inv_id":id,"inc_id":inc_id},
	success:function(html)
	{
//alert(html);	
 // window.location.reload();
	}
 });
$('.rem4').on('click', function() {
     $(this).parent().prevUntil(".contents2").remove();
     $(this).parent().remove();
	  claculate_all_sums();
 });
 }
function UpdateInfo1(a,i)
{
    var itemName = a;
    $.ajax({
		type:'POST',
        url:'get_labour_name',
	    data:{'id':itemName},
		dataType: 'JSON',
        success:function(html){
			var name = html.name;
			var rate2 = html.rate;
			document.getElementById("labour_name-"+i).value=name ;
			document.getElementById("rate-"+i).value=rate2 ;
			var k=i;
			var rate = parseFloat(document.getElementById("rate-"+k).value);
var disc1=document.getElementById("dis-"+k).value;
if(disc1=='')
{
var zero=parseFloat(0);
document.getElementById("dis-"+k).value =parseFloat(zero);
}else
{
parseFloat(disc1);
document.getElementById("dis-"+k).value =disc1;
}
var disc=parseFloat(document.getElementById("dis-"+k).value);
var rate = parseFloat(document.getElementById("rate-"+k).value);
var ndisc=parseFloat((rate * disc) /100).toFixed(2);
					var discnt =eval(rate)- eval(ndisc);
					var disamt =parseFloat(discnt).toFixed(2);
					
var utgp = 9;
var persnt = parseFloat((discnt * utgp) /100).toFixed(2);
var totl = discnt +(persnt * 2);
var totls = parseFloat(totl).toFixed(2);

document.getElementById("taxs-"+k).value = disamt;
document.getElementById("utgp-"+k).value = utgp;
document.getElementById("utg-"+k).value = persnt;
document.getElementById("cgstp-"+k).value = utgp;
document.getElementById("cgst-"+k).value = persnt;
document.getElementById("total-"+k).value = totls;

claculate_all_sums(); 
        },
    });
}
//----Here is the function for calculating all the total amounts.. Please call this function after each update of individual fields.
function claculate_all_sums(){
var ltax = 0;
var lugst = 0;
var lcgst = 0;
var lamt = 0;
var ldisc=0;
$(".ltax").each(function () {
ltax += +$(this).val();
});
$(".lugst").each(function () {
lugst += +$(this).val();
});
$(".lcgst").each(function () {
lcgst += +$(this).val();
});
$(".lamt").each(function () {
lamt += +$(this).val();
});
$(".ldisc").each(function () {
ldisc += +$(this).val();
});

$('#disctotal').val(parseFloat(ldisc).toFixed(2));
$('#taxtotal').val(parseFloat(ltax).toFixed(2));
$('#sgsttotal').val(parseFloat(lugst).toFixed(2));
$('#gsttotal').val(parseFloat(lcgst).toFixed(2));
$('#netamount').val(parseFloat(lamt).toFixed(2));
$('#TTl').val(parseFloat(lamt).toFixed(2));
}
</script>  

