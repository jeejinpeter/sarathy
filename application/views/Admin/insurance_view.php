
<style>
.text-danger{
	color:red;
}
.pdfs{
	padding-top:10px !important;
}

#locationCodesParent,#locationCodesParent2{ 
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
input[type=date]::-webkit-inner-spin-button, 
input[type=date]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="tip-bottom">INVOICE</a> <a href="#" class="current">Insurance</a> </div>

    </div>
	<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid" style="margin-top:-55px !important;">
 <div id="content" style="zoom:100%;"> 
  <form action="<?php 
                echo  base_url('Admin/invoice_insurance_process');?>" method="post" class="form-horizontal"> 
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>INVOICE (Insurance)</h5>
						<button style="float:right;" type="submit" name="ready" value="Ready For Bill" class="btn btn-danger" style="border-radius:60px;">Add to Ready for Bill</button>
                    </div>
                    <div class="widget-content nopadding" style="min-height:700px;height:auto !important;">
                      
				
				 <div class="span12">
				 <div class="span3">
				  <div class="control-group">
                                <label class="control-label" style="width:120px">Branch Name:</label>
                                <div class="controls" style="margin-left:130px">
								<select name="branchname" required style="width:165px;font-size:9px;"id="branch">
								<option value="">--Select--</option>
								<?php foreach($brnch as $rowb){ ?>
								<option value="<?php echo $rowb->b_id;?>"><?php echo $rowb->branch_name; ?>  [<?php echo $rowb->branch_id; ?>]</option>
								<?php } ?>
								</select>
								
								
                                  
								 </div>								
                            </div>
				    <div class="control-group">
                                <label class="control-label" style="width:120px">Jobcard No :</label>
                               <div class="controls" style="margin-left:130px">
                                    <input type="text" name="jno"  placeholder="" value="" required />
                                </div>								
                            </div>
                           <div class="control-group">
                                <label class="control-label" style="width:120px">Jobcard Date :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="date" name="jname" onkeydown="return false"  placeholder="" value="" required max="<?php echo date("Y-m-d"); ?>" />
                                </div>								
                            </div>
							 <div class="control-group">
							 <div id="msg"></div>
                                <label class="control-label" style="width:120px">Invoice No :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="invoic" id="invoiceno" placeholder="" value="" readonly />
									
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">Invoice Date :</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="date" name="invoicedate"  placeholder="" value="<?php echo date("Y-m-d");?>" readonly />
									
                                </div>								
                            </div>
							
							
						
							   		</div>
									 <div class="span3">
 	  <div class="control-group">
                                <label class="control-label" style="width:120px">Registration No:</label>
                                <div class="controls" style="margin-left:128px">
								<?php $reg=$this->session->flashdata('reg');
								if(!empty($reg)){?>
								<input type="text" class="input_capital" name="rno"  id="reg" onmousemove="reg_number();" value="<?php echo $this->session->flashdata('reg'); ?>" required />
								<?php } else {?>
								<input type="text" class="input_capital" name="rno"  id="reg" onchange="reg_number();" required />
								<?php } ?>
                                </div>								
                            </div>
						 <div class="control-group">
                                <label class="control-label" style="width:120px">Model Name:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="mname" id="mdname"  placeholder="" value="" readonly />
									
                                </div>								
                            </div>	
							
				    <div class="control-group">
                                <label class="control-label" style="width:120px">KM Reading:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="km"  placeholder="" value="" required />
									
                                </div>								
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Chassis No:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="cno" id="cno" placeholder="" value="" readonly />
									
                                </div>								
                            </div>
							
							<div class="control-group">
                                <label class="control-label" style="width:120px">Engine No:</label>
                                <div class="controls" style="margin-left:128px">
								<input type="text" name="eno" id="eno"  placeholder="" value="" readonly />
									
                                </div>								
                            </div>
                         
							
							
							
							   		</div>	
									<div class="span3">
									<div class="control-group">
                                <label class="control-label" style="width:120px">Customer Name:</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" name="cusname" id="cusname"  placeholder="" value="" readonly />
									
                                </div>								
                            </div>
						
							<div class="control-group">
                                <label class="control-label" style="width:120px">Mobile Number:</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="number" name="cusph" id="cusph"  placeholder="" value="" readonly />
									
                                </div>								
                            </div>
							<div class="control-group" >
                                <label class="control-label" style="width:120px">Insurance Company</label>
                               
                                <div class="controls" id="locationCodesParent" style="margin-left:130px">
                                    <select class=" item1" name="ins_id"  id="ins"  style="width:165px;border-radius:0px"  >
                                        <option value=""></option>
                                        <?php
                    foreach($detail as $row)
                    {?>
     <option value ="<?php echo $row['com_id']; ?>"><?php echo $row['icompany_name']; ?></option>
       <?php
                     }
                     ?>
                                    </select>
                                    
                                </div>                              
                            </div>
							<div class="control-group">
                                <label class="control-label" style="width:120px">Insurance GSTIN:</label>
                                <div class="controls" style="margin-left:130px">
                                    <input type="text" id="cusgst" name="cusgst"  placeholder="" value="" readonly />
									
                                </div>								
                            </div>
							 <div class="control-group">
                                <label class="control-label" style="width:120px">Invoice Type :</label>
                             <div class="controls" style="margin-left:130px">
                                    <input type="text" name="invtype"  placeholder="" value="Cash" readonly />
									
                                </div>								
                            </div>	
									</div>

 <div class="span3">
  <div class="control-group">
                                <label class="control-label" style="width:120px">Advisor Name:</label>
                                <div class="controls" style="margin-left:128px">
								<select name="advname" id="Adviz" style="width:165px;font-size:9px;">
								<option>--Select--</option>
								</select>
                                </div>								
                            </div>
                             <div class="control-group">
                                <label class="control-label" style="width:120px">Mechanic Name:</label>
                                <div class="controls" style="margin-left:128px">
								<select class="mecha" name="mechname" id="Mechz"  style="width:165px;font-size:9px;" >
								<option>--Select--</option>
								</select>
                                </div>								
                            </div>
							<div class="control-group">
 
                                <label class="control-label" style="width:120px">Insurance Address:</label>
                                <div class="controls" style="margin-left:130px">
                        <textarea style="height:33px;resize:none;font-size:10px;" name="cusaddr" id="cusaddr" rows="4" readonly ></textarea>
								 </div>								
                            </div>
							

 <div class="control-group">
                                <label class="control-label" style="width:120px">Repair Type:</label>
                                <div class="controls" style="margin-left:130px">
									<select name="repairty"  style="width:165px;" required>
								<option value="">--Select--</option>
								
									<option value="First free service"> First free service</option>
								<option value="Second free service"> Second free service</option>
								<option value="Third free service"> Third free service</option>
								<option value="Paid service"> Paid service</option>
								<option value="Amc service"> AMC service</option>
								<option value="Accidental Repair"> Accidental Repair</option>
								<option value="Other Repairs(within warranty)"> Other Repairs (within warranty)</option>
								<option value="Other Repairs(outside warranty)">Other Repairs (outside warranty)</option>
								
								</select>
                                </div>								
                            </div>
 <div class="control-group">
                                <label class="control-label" style="width:120px">Surveyor Name:</label>
                             <div class="controls" style="margin-left:130px">
                                    <input type="text" name="surveyor"  placeholder="" value=""  />
									
                                </div>								
                            </div>
						
							
							
							
							
</div> 
		 <div class="span12" style="height:100px; width:95%;">
		 <h4>Total Payable Amount : Rs<input type="text" id="TTl" value="00.00" style="border: none;
    background: none;
    font-size: 18px;" readonly ><h4>	
		   				
					
                            <button style="float:right;margin-left:15px;" type="submit" name="print"  class="btn btn-danger" style="border-radius:60px;" onclick="return handleChange()">Print</button>
							
                       <div class="form-actions" style="">	     
							</div>
</div>		 
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
							
<div id="rezult">					
						</div>		
					 <div class="span8" style="float:right;"> 
						<div class="pdfs span1" style="    margin-left: 23px;"> <b style="padding-top:20px;">Total</b></div>
	 <div class="pdfs span1" style="margin-left:0px;" >
<input style="width:50px;" type="text" class="" name="tdisc"  id="disctotal" value="00.00"  readonly /></div>
 <div class="pdfs span2" style="margin-left:20px;" >
	 <input style="width:98px;" type="text" class="" name="ttotl"  id="taxtotal" value="00.00"  readonly /></div>
	  <div class="pdfs span2" > <input style="margin-left:76px!important;width:50px;" type="text" class="" name="sgtotal"   id="sgsttotal" value="00.00" readonly  /></div>
	    <div class="pdfs span1" > <input style="margin-left:78px!important;width:50px;" type="text"  name="gstotl"   id="gsttotal" value="00.00"  readonly /></div>
		 <div class="pdfs span2" style="margin-left:107px;" ><input style="margin-left:6px!important;width:115px;" type="text" class="" name="total"   id="netamount" value="00.00" readonly /></div>
	  </div>	
 <!--div class="span8" style="float:right;"> 
						<div class="pdfs span1" style="margin-left: 487px;"> <b style="padding-top:20px;">Deduction</b></div>
						<div class="pdfs span2" style="margin-left:38px;" >  <input style="margin-left:6px!important;width:115px;" type="text" class="" name="todedu"  id="taxdedu" value="00.00"  readonly /></div>
</div>		
<div class="span8" style="float:right;"> 
						<div class="pdfs span2" style="margin-left: 487px;"> <b style="padding-top:20px;">Grand Total</b></div>
						<div class="pdfs span2" style="margin-left:-24px;" >  <input style="margin-left:-1px!important;width:115px;" type="text" class="" name="totgra"  id="totgrato" value="00.00"  readonly /></div>
</div-->		  
						</div>
						</div>
										
							
							
                            
						
					 <div class="span11">	
                         
							</div>
							
						  <?php echo form_close(); ?>
                        </form>
		<div class="modal hide" style="border-radius:20px;" id="reg_customer" role="dialog" >
     <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header" style="background-color: #0e60c5;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add Customer</h4>
      </div>
         <div class="modal-body">
      <form class="form-horizontal" method="post">
	  <div class="span12" style="overflow: hidden!important;">
	<div class="span6 pull-left">
	    <div class="form-group">
                                <label >Registration Number :</label>
                                
                                    <input type="text" name="c_r_no" id="reg" class="form-control span11" placeholder="Registration no" id="cusregno" required />
                  <span class="text-danger"><?php echo form_error('c_r_no'); ?></span>
                                </div>                
                         
                            <div class="form-group">
                                <label >Chassis No :</label>
                               
                                    <input type="text" name="c_c_no" class="form-control span11" placeholder="Chassis no" id="cuschano" onblur="checkChasis();" required/>
                  <span class="text-danger"><?php echo form_error('c_c_no'); ?></span>
                                </div> 
                                
								<div class="form-group">
                                <label>Customer Name:</label>   
                    <input type="text"  class="form-control span11" name="c_name" id="cusname" placeholder="Customer name" required/>
                   <span class="text-danger"><?php echo form_error('c_name'); ?></span>
                                </div>                
                          
               <div class="form-group">
                                <label >Address :</label>
                  
                <textarea name="c_address" class="form-control span11"  placeholder="Customer address" id="cusadd"></textarea>
                   <span class="text-danger"><?php echo form_error('c_address'); ?></span>
                                      
                            </div>

                                       
                            <div class="form-group">
                                <label >GSTIN Number</label>
                                    <input type="text" name="c_g_no" class="form-control span11" placeholder="GSTIN" id="cusgstin" />
                  <span class="text-danger"><?php echo form_error('c_g_no'); ?></span>
                                          
                            </div>

                              </div>
								<div class="span6 pull-right">
								 <div class="form-group" id="locationCodesParent2">
                                <label>Model Name :</label>
                                    <select class="item2" id="cusmodel" name="c_m"  id="ins"  style="width:230px;border-radius:0px;margin-left:200px"  >
                                        <option value="">--Select--</option>
                                        <?php
                    foreach($model as $ros)
                    {?>
     <option value ="<?php echo $ros->mod_name; ?>"><?php echo $ros->mod_name; ?></option>
       <?php
                     }
                     ?>
                                    </select>                 
                            </div>
								
            <div class="form-group" >
                                <label >Engine No :</label>
                                    <input type="text" id="cusengno" name="c_e_no" class="form-control span11" placeholder="Engine number" required/>
                  <span class="text-danger"><?php echo form_error('c_e_no'); ?></span>          
                            </div>

            <div class="form-group" >
                                <label> Contact No :</label>     
          <input type="text" name="c_contact" class="form-control span11" id="cusconno"placeholder="contact no" required />
                  <span class="text-danger"><?php echo form_error('c_contact'); ?></span>
                                           
                            </div>

                             
                <div class="form-group">
                                <label> Date Of Sale : </label>
                                    <input type="date" name="c_sale" id="cussale" class="form-control span11" placeholder="date of sale"  />
                  <span class="text-danger"><?php echo form_error('c_sale'); ?></span>
                                </div>                
                          
                           <div class="form-group">
                                <label>Email Id :</label>
                                    <input type="email" name="c_email" id="cusemail" class="form-control span11" placeholder="Email-Id" />
                  <span class="text-danger"><?php echo form_error('c_email'); ?></span>
                            </div><br/>	
							  <div class="form-group">
                         <button type="button" class="btn btn-primary" id="chasis_stop" onclick="submitdata();">Submit</button>
                             </div>	
	</div>	
</div>
                        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div>
    </div>
       
  </div>
    </div>	
                    </div>

                </div>
         
        </div>
        </div>
    </div>
	</div>
	</div>
	
	<script type="text/javascript">
	
	function handleChange(input) {
    var x = document.getElementById("Adviz").value;
    var x1 = document.getElementById("Mechz").value;
    if (x === "" || x1 === "") {
        alert("Advisor and Mechanic Names are Required");
        return false;
    }
    return true;
}
	
     $('#ins').change(function(){

var cmp=document.getElementById("ins").value; console.log(cmp);

$.ajax({

    type:'post',
    url:'cmp_ins',
    datatype:'JSON',
    data:{cmp:cmp},
    success:function(result){

        result=JSON.parse(result);
        var gst=result.icompany_gst;
        var add=result.icompany_address;
        var BILLTO=result.icompany_name;

        document.getElementById('cusgst').value=gst;
        document.getElementById('cusaddr').value=add;
        document.getElementById('billed_to').value=BILLTO;

    }

});

 });
 
 $('.input_capital').on('input', function(evt) {
  $(this).val(function(_, val) {
    return val.toUpperCase();
  });
});

function checkChasis(){
    var chasis = $('input:text[name=c_c_no]').val();
    console.log(chasis);
    if(chasis){
    $.ajax({
        type: 'POST',
        url: 'is_chasis_unique',
        data: {chasisNo:chasis},
        success: function(result){
            res = $.parseJSON(result);
       if(res.status){
           $("#chasis_stop").prop('disabled', true);
           window.location.reload();
           alert("Chasis Number entered already exists. Please enter another one.");
		
       } 
	   }
				
            }); 
    }else{
        window.location.reload();
         alert("Failed to copy the Chasis Number.  Please try again.");
           
        }
        
}
 
</script>






<script type="text/javascript">
$("#billed_to").change(function(){

    var bill = document.getElementById("billed_to").value;


    $.ajax({

        type:'post',
        
        data:{bill:bill},
        url:'get_insure',
        success:function(res){

            
            var res=JSON.parse(res);
            var gst=res.gstn;
            var adr=res.address;
            document.getElementById ('cusgst').value=gst;
             document.getElementById ('cusaddr').value=adr;
        }

    })
})


function submitdata()
{	
 var name=$('input:text[name=c_name]').val();
 var address=$("#cusadd").val();
 var regno=$('input:text[name=c_r_no]').val();
 var chasis=$('input:text[name=c_c_no]').val();
 var gst=$('input:text[name=c_g_no]').val();
 var model=$("#cusmodel").val();
 var engine=$('input:text[name=c_e_no]').val();
 var contact=$('input:text[name=c_contact]').val();
 var saledate=$("#cussale").val();
 var email=$('#cusemail').val();

 $.ajax({
 type: 'post',
  url: 'insert_new_customer',
   data: {cus_name:name,cus_address:address,cus_regno:regno,cus_chasis:chasis,
  cus_gst:gst,cus_model:model,cus_engine:engine,cus_contact:contact,
  cus_saledate:saledate,cus_email:email
  },
  success: function (response) {

	if(response=='1'){
		var html='<div class="alert alert-danger text-center" >Some error occured... Try Later!!!...</div>';
    $("#mydiv").html(html);
	}
	else if(response=='2'){
	var html='<div class="alert alert-danger text-center"> Please fill all the fields Properly!!</div>';
    $("#mydiv").html(html);
	}
	else{
	
		$('#reg_customer').modal('hide');
	$('input:text[name=rno]').val(response);
	reg_number();
	}
   }
  });
}

</script> 





	
	
	
<script>

function reg_number() {
	var item = document.getElementById("reg").value;
	if(item){
	$('input:text[name=c_r_no]').val(item);
			$.ajax({
					type:'POST',
					dataType: 'JSON',
					url:'get_customer_detail/'+item,
					cache:false,
					success:function(re){
                    if(re){				
                    var chassis=re.c_chassis_no;
				    document.getElementById ('cno').value=chassis;
				    var engine=re.c_engine_no;
				    document.getElementById ('eno').value=engine;
					var name=re.c_name;
					document.getElementById ('cusname').value=name;
					var phone=re.c_contact_no;
					document.getElementById ('cusph').value=phone;
					var model=re.model_name;
					document.getElementById ('mdname').value=model;
					var registration=re.c_reg_no;
					document.getElementById ('reg').value=registration;
					//var ADDRES=re.c_address;
					//document.getElementById ('address').value=ADDRES;
					//var gstin=re.gstin_no;
					//document.getElementById ('gstinc').value=gstin;
					//var sldt=re.c_sales_date;
					//document.getElementById ('saledate').value=sldt;
										}
					else{	
						$('#reg_customer').modal('show');
 					document.getElementById ('cno').value='';
					document.getElementById ('eno').value='';
					document.getElementById ('cusname').value='';
					document.getElementById ('cusph').value='';
					document.getElementById ('mdname').value='';
					document.getElementById ('reg').value='';
					//document.getElementById ('address').value='';
					//document.getElementById ('gstinc').value='';
					//document.getElementById ('saledate').value='';
								
					}
					}
					}); 
		}else{
			document.getElementById ('cno').value='';
			document.getElementById ('eno').value='';
			document.getElementById ('cusname').value='';
			document.getElementById ('cusph').value='';
			document.getElementById ('mdname').value='';
			document.getElementById ('reg').value='';
			//document.getElementById ('address').value='';
			//document.getElementById ('gstinc').value='';
			//document.getElementById ('saledate').value='';
		}
					}


$(document).ready(function() {
	
		function inv(){
var branch = document.getElementById("branch").value;
		 if(branch){
            $.ajax({
                type:'POST',
                url:'getinvoiceno',
                data:{'branchno':branch},
                success:function(html){
					$('#invoiceno').val(html);
                }
			
            }); 
        }else{
            $('#invoiceno').html('<option value="">Select branch name first</option>'); 
        }
	} 
	inv();
  
	
	window.setInterval(function(){
		
  inv()
}, 1000);
	
	
	
	
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
	var count=1;
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
window.onload = addrow();	
	 $('#invoiceno').on('click',function(){
		var invoice= $(this).val();
if(invoice =='')		
{
	var html='<div id="mydiv1" class="alert alert-danger text-center"><h4>Select branch name first</h4></div>';
    $("#msg").html(html);
}	 
	 });
setTimeout(function() {
    $('#msg').fadeOut('slow');
}, 2000); // <-- time in milliseconds

	  
		  $('#branch').on('change',function(){
        var branch1 = $(this).val();
        if(branch1){
            $.ajax({
                type:'POST',
				 url:'select_mechanic',
                    dataType: "json",
                data:{'branchno1':branch1},
                success:function(datas) {
                        $('select[name="mechname"]').empty();
						 $('select[name="mechname"]').append('<option value="">---select---</option>');
                        $.each(datas, function(key, value) {
                            $('select[name="mechname"]').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                    }
            }); 
        }else{
            $('.mecha').html('<option value="">Select branch name first</option>'); 
        }
    }); 
	
	
	  $('#branch').on('change',function(){
        var branch2 = $(this).val();
        if(branch2){
            $.ajax({
                type:'POST',
				 url:'select_advisor',
                    dataType: "json",
                data:{'branchno2':branch2},
                success:function(datas1) {
                        $('select[name="advname"]').empty();
						$('select[name="advname"]').append('<option value="">---select---</option>');
                        $.each(datas1, function(key, value) {
                            $('select[name="advname"]').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                    }
            }); 
        }else{
            $('.mecha').html('<option value="">Select branch name first</option>'); 
        }
    });
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
document.getElementById("ndisc-"+k).value = parseFloat(0.00); 
 claculate_all_sums();
}
else{
    add_number(k);
}

}
function add_number(k) {
var rate = parseFloat(document.getElementById("rate-"+k).value);
if (isNaN(rate)) rate = 0;
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
var job_type = document.getElementById("jtype-"+k).value;//Change from this
if(job_type == "Expense" || job_type == "Free Service")
{
document.getElementById("taxs-"+k).value = parseFloat(0.00);
document.getElementById("utgp-"+k).value = parseFloat(0.00);
document.getElementById("utg-"+k).value = parseFloat(0.00);
document.getElementById("cgstp-"+k).value = parseFloat(0.00);
document.getElementById("cgst-"+k).value = parseFloat(0.00);
document.getElementById("total-"+k).value = parseFloat(0.00);
document.getElementById("ndisc-"+k).value = parseFloat(0.00);  
 claculate_all_sums();
}
else{
document.getElementById("taxs-"+k).value = disamt;
document.getElementById("utgp-"+k).value = utgp;
document.getElementById("utg-"+k).value = persnt;
document.getElementById("cgstp-"+k).value = utgp;
document.getElementById("cgst-"+k).value = persnt;
document.getElementById("total-"+k).value = totls;
document.getElementById("ndisc-"+k).value = ndisc;

 claculate_all_sums();
}
}
 $('#rezult').on('click', '.rem', function() {
     $(this).parent().prevUntil(".contents").remove();
     $(this).parent().remove();
claculate_all_sums();	 
 });

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
			if (isNaN(rate)) rate = 0;
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
if (isNaN(rate)) rate = 0;
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
var sum=parseFloat(0);
var utg_sum=parseFloat(0);
var cgst_sum=parseFloat(0);
var net_sum=parseFloat(0);
	for(i=1; i <=k; i++) 
{
	if(document.getElementById("taxs-"+i)===null) { continue; }
  if (document.getElementById("utg-"+i)===null) { continue; }
   if (document.getElementById("cgst-"+i)===null) { continue; }
    if (document.getElementById("total-"+i)===null){ continue; }
}
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
