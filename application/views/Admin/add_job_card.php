
<style>
.text-danger{
	color:red;
}
</style>
<div id="content" style="zoom:90%;">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Job Card</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Job Card</h5>
                        <h5>Add Job Card</h5>
                    </div>
                    <div class="widget-content nopadding" style="height:500px;">
                        <form action="<?php 
                echo  base_url('Admin/job_card_process');?>" method="post" class="form-horizontal">
				 <div class="span12">
				 <div class="span3">
				    <div class="control-group">
                                <label class="control-label" style="width:120px">Vehicle :</label>
                                <div class="controls" style="margin-left:128px">
								<select style="width:167px;" name="vehicle">
								<option value="">--Select--</option>
								<option value="car">car</option>
								<option value="bike">bike</option>
								</select>
									<span class="text-danger"><?php echo form_error('vehicle'); ?></span>
                                </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label" style="width:120px">Mobile Number :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="mob1"  placeholder="" value="" />
									<br><br>
									<input type="text" name="mob2"  placeholder="" value="" />
									<span class="text-danger"><?php echo form_error('mob1'); ?></span>
									<span class="text-danger"><?php echo form_error('mob2'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">Email Id :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="email" name="email"  placeholder="" value="" />
									
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">KM Reading :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="km"  placeholder="" value="" />
									<span class="text-danger"><?php echo form_error('km'); ?></span>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Service Advisor:</label>
                                <div class="controls" style="margin-left:130px">
								<select style="width:167px;" name="service">
								<option value="">--Select--</option>
								<option value="Kiran">Kiran</option>
								<option value="Amal">Amal</option>
								</select>
									<span class="text-danger"><?php echo form_error('service'); ?></span>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Mechanic:</label>
                                <div class="controls" style="margin-left:130px">
								<select style="width:167px;" name="mechanic">
								<option value="">--Select--</option>
								<option value="mechanic1">mechanic1</option>
								<option value="mechanic2">mechanic2</option>
								</select>
									<span class="text-danger"><?php echo form_error('mechanic'); ?></span>
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Expected Start Time:</label>
                                <div class="controls" style="margin-left:130px">
								 <input type="Time" name="time"  placeholder="" value="" />
									<span class="text-danger"><?php echo form_error('time'); ?></span>
                                </div>								
                            </div>
							   		</div>	
										 <div class="span6">
										 <h6 style="margin-left:100px;">System Calculated Estimates</h6>
				             &nbsp;Parts:&nbsp;&nbsp;<input type="text" name="spart"  placeholder="" value="" />
							&nbsp;&nbsp;Labours:&nbsp;&nbsp; <input type="text" name="slabour"  placeholder="" value="" />
							&nbsp;&nbsp;Total:&nbsp;&nbsp; <input type="text" name="stotal"  placeholder="" value="" /><br><br>
							Delivery Time:&nbsp;&nbsp; <input type="time" name="sdelivery"  placeholder="" value="" style="width:500px;"/>
							<h6 style="margin-left:100px;">Orginal Estimates Given To Customer</h6>
				             &nbsp;Parts:&nbsp;&nbsp;<input type="text" name="opart"  placeholder="" value="" />
							&nbsp;&nbsp;Labours:&nbsp;&nbsp; <input type="text" name="olabour"  placeholder="" value="" />
							&nbsp;&nbsp;Total:&nbsp;&nbsp; <input type="text" name="ototal"  placeholder="" value="" /><br><br>
							Delivery Time:&nbsp;&nbsp; <input type="time" name="odelivery"  placeholder="" value="" style="width:500px;"/>
							<h6 style="margin-left:100px;">Revised Estimates Given To Customer</h6>
				             &nbsp;Parts:&nbsp;&nbsp;<input type="text" name="rpart"  placeholder="" value="" />
							&nbsp;&nbsp;Labours:&nbsp;&nbsp; <input type="text" name="rlabour"  placeholder="" value="" />
							&nbsp;&nbsp;Total:&nbsp;&nbsp; <input type="text" name="rtotal"  placeholder="" value="" /><br><br>
							Delivery Time:&nbsp;&nbsp; <input type="time" name="rdelivery"  placeholder="" value="" style="width:500px;"/><br><br>&nbsp;
                            <input type="checkbox" name="branch"  placeholder="" value="" style="" required/>&nbsp;
							<q style="margin-top:100px;">Ready For Bill</q>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="bill"  placeholder="" value="" style="width:400px;"/>
							</div>
	 <div class="span3">
	 <h6 style="margin-left:100px;">Document Details</h6>
				    <div class="control-group">
                                <label class="control-label" style="width:120px">Hold Code:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="hold"  placeholder="" value="" />
									<span class="text-danger"><?php echo form_error('id'); ?></span>
                                </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label" style="width:120px">Customer Paid Amount :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="amount"  placeholder="" value="" />
									<span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">CRM Customer Id:</label>
                                <div class="controls" style="margin-left:130px">
                                     <input type="text" name="id"  placeholder="" value="" />
								 </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Root Cause Of Report :</label>
                                <div class="controls" style="margin-left:130px">
                                    <textarea name="creport" rows="4"></textarea>
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">Vehicle Card :</label>
                                <div class="controls" style="margin-left:130px">
                                    <textarea name="vcard" rows="4"></textarea>
								 </div>								
                            </div>
							
							
							   		</div>						
                            <div class="form-actions" style="height:200px;margin-top:290px;">
						
							<br><br><br><br><br><br><br>
                             <button type="submit" class="btn btn-danger" style="border-radius:50px;margin-left: 432px;">Submit</button>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>  
                           
							</div>
							<?php echo form_close(); ?>
                        </form>
		
                    </div>

                </div>
         
        </div>
    </div>
	</div>
	</div>