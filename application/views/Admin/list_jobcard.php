
<div id="content" >
  <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#" class="current">List List JobCard</a> </div>
    </div>
<div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
  <div class="container-fluid">
<div class="row-fluid">

   <div class="span12 " style="margin-top:-45px;">
         
       <div class="widget-box span12">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>List JobCard</h5>
			<br><br>
			
       
          </div>
		   <?php $attributes = array("name" => "complete");
                               echo form_open("Report/list_custom_date", $attributes);
							   ?>
					
              		  <!--<button onclick="fun()" formtarget="_blank" value="PDF"  style="margin-left: 1193px;margin-top:22px;" class="btn btn-danger" name="pdf">PDF</button> 
	  <button onclick="fun()"  value="CSV" formtarget="_blank" style="margin-left: 1123px;margin-top:-52px;" class="btn btn-danger" name="csv">CSV</button>--> 
<button onclick="fun()" formtarget="_blank" value="EXCEL"  style="margin-left: 1223px;margin-top:-56px;" class="btn btn-danger" name="excel">EXCEL</button>
	  
		   <div class="widget-content nopadding" >
		  	 <div class="span12">
			 <div class="control-group"></div>	
			 <div class="span6 offset3">
                <div class="control-group">
                <div class="controls" style="margin-left:70px;">
                 Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<input type="text" name="defaultbranch" value="Sarathy Main Branch"readonly>-->
						 <select name="branch" class="span5" style="font-size:12px;" id="branch">
					<?php 
					if(isset($name)) { ?>
							<option value="<?php echo $id;?>"><?php echo $name.'('.$ids.')'?></option>
									 <?php
				 }
				 else{?>
				 <option value="">--Select Branch--</option>
				 <?php
				 }
					foreach($branch as $row)
					{
					?>
									<option value="<?php echo $row->b_id;?>"><?php echo $row->branch_name;?>(<?php echo $row->branch_id;?>)</option>
					<?php 
					}
				 
                    ?>
                   </select>				
                                </div>
                           
<div class="controls" style="margin-left:70px;">
                   Service&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="span5" style="font-size:12px;" name="view_service" id="view_service">
							<option value="Paid Service"> Paid Service</option>
							<option value="Free Service">Free Service</option>
							<option value="Expense">Expense</option>-->
					 </select>
								 </div>
                 <div class="controls" style="margin-left:70px;">
                   Search Option&nbsp;&nbsp;&nbsp;<select class="span5" style="font-size:12px;" name="view_by" id="view_by">
				   <option value="">----select----</option>
							<option value="Custom Date" <?php if($view_by == "Custom Date") echo "selected"; ?> >Custom Date</option>
							<option value="Month to date" <?php if($view_by == "Month to date") echo "selected"; ?> >Month to date</option>
							<option value="Previous Month" <?php if($view_by == "Previous Month") echo "selected"; ?> >Previous Month</option>
							<option value="Year to Date" <?php if($view_by == "Year to Date") echo "selected"; ?> >Year to Date</option>
							<option value="Previous Year" <?php if($view_by == "Previous Year") echo "selected"; ?> >Previous Year</option>
				  <!-- <?php if($view_by) { ?>
							<option value="<?php echo $view_by;?>"><?php echo $view_by;?></option>
							<option value="Custom Date" >Custom Date</option>
							<option value="Month to date">Month to date</option>
							<option value="Previous Month">Previous Month</option>
							<option value="Year to Date">Year to Date</option>
							<option value="Previous Year">Previous Year</option>
					 <?php } else{?>
							<option value="">---select---</option>	
							<option value="Custom Date" >Custom Date</option>
							<option value="Month to date">Month to date</option>
							<option value="Previous Month">Previous Month</option>
							<option value="Year to Date">Year to Date</option>
							<option value="Previous Year">Previous Year</option>
				   <?php } ?>-->
                   </select>
									<span class="text-danger"><?php echo form_error('company'); ?></span>
                                </div>
                            </div>
                </div>
				</div>
				<div>
				 <div class="span12" >
							  
						 <div class="span3 offset3">
							<div class="control-group">
                                	
				
                                <div class="controls">
								Date From&nbsp;&nbsp;&nbsp;<input style="font-size:11px;"  type="date" name="from" id="fromdate" class="span6" <?php if(isset($fromdate)) { ?> value="<?php echo $fromdate?>" <?php } ?> placeholder=""  required />
									<span class="text-danger"><?php echo form_error('from'); ?></span>
                                </div>
                            </div>
							</div>
							<div class="span3">
							 <div class="control-group" >
                                <div class="controls">
								Date To&nbsp;&nbsp;&nbsp;<input  style="font-size:11px;" type="date" name="to" id="todate" class="span6" <?php if(isset($todate)) { ?> value="<?php echo $todate?>" <?php } ?> placeholder=""  required />
                                </div>
                            </div>
							
							
							</div>
							  
							
							   		</div>	
         <div class="" style="width:100%;height:400px;overflow-x:scroll;overflow-y:scroll;" >
		 
		 
		  <table   id="user_data" class="table table-bordered" >
              <thead>
                <tr>
				
				<!--<input type="hidden" name="from1" value="<?php echo $fromdate; ?>" >
				<input type="hidden" name="to1" value="<?php echo $todate; ?>" >-->
				
                  <th><input type="text" style="width:70px;font-size:11px;" name="job" value="JobCard" readonly></th>
				  <th><input type="text" style="width:70px;font-size:11px;"  name="job" value="JobCard Date" readonly></th>	
				  
				  <th>
				  <input type="text" style="width:170px;font-size:11px;" name="job5" value="Branch Name" readonly>
                   		
				  </th>
		
				<th>
                 
                <select name="mech[]" multiple class="selectpicker" style="width:120px;font-size:11px;">			
                   </select>
						
                                
                 </th>
				 
                 <th>
                 
                <select name="advisor[]" multiple class="selectpicker2"  style="width:120px;font-size:11px;">
				
							<option value="">--Select Advisor --</option>
									 
                   </select>
						
                                
                 </th>
                 
       	<th>
					<select style="width:150px;font-size:11px;"  multiple name="repair[]" id="repair_type" class="repairs">
				
								<option value="First free service"> First free service</option>
								<option value="Second free service"> Second free service</option>
								<option value="Third free service"> Third free service</option>
								<option value="Paid service"> Paid service</option>
								<option value="Amc service"> AMC service</option>
								<option value="Accidental Repair"> Accidental Repair</option>
								<option value="Other Repairs(within warranty)"> Other Repairs (within warranty)</option>
								<option value="Other Repairs(outside warranty)">Other Repairs (outside warranty)</option>
								</select></th>
 <th><select name="ins_company[]" multiple class="selectpicker4"  style="width:120px;font-size:11px;">
							<option value="">--Select Insurance Company --</option>
           </select>	</th>  
				 <th><input type="text" style="width:70px;font-size:11px;" name="job" value="Model Name:" readonly></th>
                 <th><input type="text" style="width:50px;font-size:11px;" name="job" value="HSN/SAC:" readonly></th>
                 <th><input type="text" style="width:70px;font-size:11px;" name="job" value="Invoice no:" readonly></th>	
				  <th><input type="text" style="width:70px;font-size:11px;" name="job" value="Invoice Customer:" readonly></th>	
				   <th><input type="text" name="job" style="width:70px;font-size:11px;"  value="Mobile Number" readonly></th>
				   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Invoice Date:" readonly></th>
     <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Register No:" readonly></th>	
     <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Chaissis Number" readonly></th>
     <th><input type="text" name="job"  style="width:70px;font-size:11px;" value="Engine Number" readonly></th>
	 <th><input type="text" name="job" style="width:70px;font-size:11px;" value="KM Reading" readonly></th>
	  <th><input type="text" name="job" style="width:97px;font-size:11px;" value="Insurance Serveyor" readonly></th>
       <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Paid Service Amount" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Free Service Amount" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Expense Service Amount" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Customer GSTN" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Discount" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Taxable Amount" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="SGST/UTGST(9)" readonly></th>
	   <th><input type="text" name="job" style="width:70px;font-size:11px;" value="CGST(9)" readonly></th>
	  <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Invoice Type" readonly></th>
      <th><input type="text" name="job" style="width:70px;font-size:11px;" value="Invoice Amount" readonly></th>	  
                </tr>
              </thead>
            
            </table>
		 </div>
			</div>
			</div><br>
			<div class="col-md-12">
 <div class=" col-md-3" style="margin-left:1000px;padding-top: 7px;"><b><label><b>Total CGST Amount</b></label></div><div class=" col-md-6"><input type="text" style="width:139px;margin-left:1150px;margin-top:-50px" class="form-control" id="grand_total_gst" readonly value=""></b></div>
  </div>
   <div class="col-md-12">
 <div class=" col-md-3" style="margin-left:75px;margin-top:-44px"><b><label><b>Total SGST/UTGST(9) Amount</b></label></div><div class=" col-md-6"><input type="text" style="width:139px;margin-left:278px;margin-top:-50px" class="form-control" id="grand_total_sgst" readonly value=""></b></div>
  </div>
	 <div class="col-md-12">
 <div class=" col-md-3" style="margin-left:740px;margin-top:-44px"><b><label><b>Total Discount</b></label></div><div class=" col-md-6"><input type="text" style="width:139px;margin-left:840px;margin-top:-50px" class="form-control" id="grand_totals" readonly value=""></b></div>
  </div>
<div class="col-md-12">
 <div class=" col-md-3" style="margin-left:437px;margin-top:-44px"><b><label><b>Total Taxable Amount</b></label></div><div class=" col-md-6"><input type="text" style="width:139px;margin-left:584px;margin-top:-50px" class="form-control" id="grand_total_tax" readonly value=""></b></div>
  </div>
 
    <div class="col-md-12">
 <div class=" col-md-3" style="margin-left:1000px;padding-top: 7px;"><b><label><b>Total Invoice Amount</b></label></div><div class=" col-md-6"><input type="text" style="width:139px;margin-left:1150px;margin-top:-50px" class="form-control" id="grand_total" readonly value=""></b></div>
  </div>
		
         <?php echo form_close(); ?>
				  
        </div>
      </div>
  </div>
  </div>
</div>
<script>


function fun()
{
	document.complete.submit();
}
var table;
$(document).ready(function() {
	function total()
	{
	var grand_total=0;
$(".lc_amt").each(function () {
grand_total += +$(this).val();
});
var grand=(grand_total).toFixed(2);
$('#grand_total').val(grand);
	}
	
 window.setInterval(function(){
total()
}, 1000);
function totals()
	{
	var grand_totals=0;
$(".lc_disc").each(function () {
grand_totals += +$(this).val();
});
var grand=(grand_totals).toFixed(2);
$('#grand_totals').val(grand);
	}
 window.setInterval(function(){
totals()
}, 1000);


function totaltax()
	{
	var grand_total_tax=0;
$(".lc_tax").each(function () {
grand_total_tax += +$(this).val();
});
var grand=(grand_total_tax).toFixed(2);
$('#grand_total_tax').val(grand);
	}
 window.setInterval(function(){
totaltax()
}, 1000);

function totalsgst()
	{
	var grand_total_sgst=0;
$(".lc_sgst").each(function () {
grand_total_sgst += +$(this).val();
});
var grand=(grand_total_sgst).toFixed(2);
$('#grand_total_sgst').val(grand);
	}
 window.setInterval(function(){
totalsgst()
}, 1000);

function totalgst()
	{
	var grand_total_gst=0;
$(".lc_gst").each(function () {
grand_total_gst += +$(this).val();
});
var grand=(grand_total_gst).toFixed(2);
$('#grand_total_gst').val(grand);
	}
 window.setInterval(function(){
totalgst()
}, 1000);


    //datatables
    table = $('#user_data').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
         "bFilter":false,
		 "ordering":false,
		 'bLengthChange': false,
		 'paging': false,
		 "bInfo" : false,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "ajax_job_list",
            "type": "POST",
			//"contentType": "application/json; charset=utf-8",
            "data": function ( data ) {
                data.branch = $('#branch').val();
				//alert(data.branch);
                data.service = $('#view_service').val(); 
				//alert( data.service);
                data.advisor = $('select[name="advisor[]"]').val();
                data.mechanic = $('select[name="mech[]"]').val();
                  data.repair = $('#repair_type').val();
                data.ins_company = $('select[name="ins_company[]"]').val();
                data.fromdate = $('#fromdate').val();
				 data.todate = $('#todate').val();
                data.view_by = $('#view_by').val();
            },
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });
            $('#branch,#view_service,#repair_type,select[name="advisor[]"],select[name="mech[]"],select[name="ins_company[]"],#fromdate,#view_by,#todate').on('change', function () 
{ //button filter event click

total();
window.setInterval(function(){
total()
}, 1000);

        table.ajax.reload();  //just reload table
  });//csv post grand total pending

        var branch1 = $('#branch').val();
		$( '.selectpicker' ).multiselect({
		  nonSelectedText:'--Select Mechanic--',
          numberDisplayed:2
		});
		$( '.selectpicker2' ).multiselect({
       nonSelectedText:'--Select Advisor--',
       numberDisplayed:2
   });
		$( '.repairs' ).multiselect(
		{
       nonSelectedText:'--Select Repair Type--',  
       numberDisplayed:2
   });	
		$( '.selectpicker4' ).multiselect({
       nonSelectedText:'--Select Insurance Company--',
       numberDisplayed:2
   });
        if(branch1){
            $.ajax({
                type:'POST',
				 url:'select_mechanic',
                    dataType: "json",
                data:{'branchno1':branch1},
                success:function(datas) {
					if(datas.length>0)
					{
						$('.selectpicker').empty();
						 $.each(datas, function(key, value) {
                            $('.selectpicker').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                     $( '.selectpicker' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker').empty();
					$( '.selectpicker' ).append('<option value="">'+'--Select Mechanic--'+'</option>');
				    $('.selectpicker').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker' ).multiselect( 'rebuild' );
				}
				}
            }); 
        }
  var branch2 = $('#branch').val();

 if(branch2){
            $.ajax({
                type:'POST',
				 url:'select_advisor',
                    dataType: "json",
                data:{'branchno2':branch2},
                success:function(datas1) {
					if(datas1.length>0)
					{
						$('.selectpicker2').empty();
						 $.each(datas1, function(key, value) {
                            $('.selectpicker2').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                     $( '.selectpicker2' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker2').empty();
					$( '.selectpicker2' ).append('<option value="">'+'--Select Advisor--'+'</option>');
				    $('.selectpicker2').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker2' ).multiselect( 'rebuild' );
				}
                        
                    }
            }); 
        }

  var branch3 = $('#branch').val();
 if(branch3){
            $.ajax({
                type:'POST',
				 url:'select_ins_company',
                    dataType: "json",
                data:{'branchno3':branch3},
                success:function(datas3) {
					if(datas3.length>0)
					{
						$('.selectpicker4').empty();
						 $.each(datas3, function(key, value) {
                            $('.selectpicker4').append('<option value="'+ value.com_id +'">'+ value.icompany_name +'</option>');
                        });
                     $( '.selectpicker4' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker4').empty();
					$( '.selectpicker4' ).append('<option value="">'+'--Select insurancy company--'+'</option>');
				    $('.selectpicker4').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker4' ).multiselect( 'rebuild' );
				}
                        
                    }
            }); 
        }


	
	  $('#branch').on('change',function(){
	  	$(".repairs").multiselect("clearSelection");
		$('.selectpicker3').val(null).trigger('change');
        var branch1 = $(this).val();
        if(branch1){
            $.ajax({
                type:'POST',
				 url:'select_mechanic',
                    dataType: "json",
                data:{'branchno1':branch1},
                success:function(datas) {
					if(datas.length>0)
					{
						$('.selectpicker').empty();
						 $.each(datas, function(key, value) {
                            $('.selectpicker').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                     $( '.selectpicker' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker').empty();
					$( '.selectpicker' ).append('<option value="">'+'--Select Mechanic--'+'</option>');
				    $('.selectpicker').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker' ).multiselect( 'rebuild' );
				}
				}
            }); 
        }
    }); 
	
	
	  $('#branch').on('change',function(){
	  	$(".repairs").multiselect("clearSelection");
		$('.selectpicker3').val(null).trigger('change');
        var branch2 = $(this).val();
        if(branch2){
            $.ajax({
                type:'POST',
				 url:'select_advisor',
                    dataType: "json",
                data:{'branchno2':branch2},
                success:function(datas1) {
					if(datas1.length>0)
					{
						$('.selectpicker2').empty();
						 $.each(datas1, function(key, value) {
                            $('.selectpicker2').append('<option value="'+ value.emp_id +'">'+ value.e_first_name + ' ['+ value.e_code +'] '+'</option>');
                        });
                     $( '.selectpicker2' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker2').empty();
					$( '.selectpicker2' ).append('<option value="">'+'--Select Advisor--'+'</option>');
				    $('.selectpicker2').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker2' ).multiselect( 'rebuild' );
				}
                  
                        
                    }
            }); 
        }
    }); 	
	
         $('#branch').on('change',function(){
	  	$(".repairs").multiselect("clearSelection");
		$('.selectpicker3').val(null).trigger('change');
       var branch3 = $(this).val();
         if(branch3){
            $.ajax({
                type:'POST',
				 url:'select_ins_company',
                    dataType: "json",
                data:{'branchno3':branch3},
                success:function(datas3) {
					if(datas3.length>0)
					{
						$('.selectpicker4').empty();
						 $.each(datas3, function(key, value) {
                            $('.selectpicker4').append('<option value="'+ value.com_id +'">'+ value.icompany_name +'</option>');
                        });
                     $( '.selectpicker4' ).multiselect( 'rebuild' );
				}
				else
				{
					$('.selectpicker4').empty();
					$( '.selectpicker4' ).append('<option value="">'+'--Select insurancy company--'+'</option>');
				    $('.selectpicker4').append('<option value="">'+'No Data Available'+'</option>');
                    $( '.selectpicker4' ).multiselect( 'rebuild' );
				}
                        
                    }
            }); 
        }

 });

 $('#view_by,#fromdate,#todate').on('change',function(){
        var view_by = $('#view_by').val();
        var fromdate = $('#fromdate').val();
		 var todate = $('#todate').val();
        if(view_by){
            $.ajax({
                type:'POST',
				 url:'jobcard_datesorting',
                 dataType: "json",
                data:{'view_by':view_by,'fromdate':fromdate,'todate':todate},
                success:function(html) {
					var from_date = html.from;
                    var to_date= html.to;
					var view=html.viewby;
					var cur_date=html.cur_date;
					if(view!='Custom Date')
					{
						$("#fromdate").prop('readonly',true);
                        $("#todate").prop('readonly',true);	
						$("#fromdate").val(from_date);
                        $("#todate").val(to_date);
                    }
					else{	
               if($("#fromdate").attr('readonly')) {
	                 $("#fromdate").prop('readonly',false);
                        $("#todate").prop('readonly',false);
						$("#fromdate").val(cur_date);
                        $("#todate").val(to_date);
                        table.ajax.reload();
						total();
window.setInterval(function(){
total()
}, 1000);
                       } 
					else{  
					$("#fromdate").val(from_date);
					$("#todate").val(to_date);	
					}	
					}
						
							
				}
            }); 
        }
    }); 		
});

</script>


