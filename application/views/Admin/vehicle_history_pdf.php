<?php ob_start();?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Document</title>
</head>
<style>
#bold
{
	  font-weight: bold;
}

</style>
<body>
<h1 align="center">VEHICLE HISTORY</h1>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b>
      <table border="0" cellpadding="1" cellspacing="1" nobr="true">
     
     <td>
	 <?php
        if(!empty($invo)){
         foreach ($invo as $row)  
         { 
      ?>
     <table width="120" border="0">
  <tr>
  
    <td id="bold"style="width:135px;font-size:8px;">Selling Dealer</td>
    <td style="width:135px;font-size:8px;">&nbsp;</td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Customer Name </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_name; ?></td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Contact No </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_contact_no; ?></td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Chassis No </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_chassis_no; ?></td>
  </tr>
   <tr>
    <td id="bold"style="width:135px;font-size:8px;">Date Of Sale </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_sales_date; ?></td>
  </tr>
   
</table>


 </td>

 <td>
 <table width="120" border="0">
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Dealer Code </td>
    <td style="width:135px;font-size:8px;">:&nbsp;SARATHY MOTORS</td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Address </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_address; ?></td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Model </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->model_name; ?></td>
  </tr>
  <tr>
    <td id="bold"style="width:135px;font-size:8px;">Engine No </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_engine_no; ?></td>
  </tr>
   <tr>
    <td id="bold"style="width:135px;font-size:8px;">Reg No </td>
    <td style="width:135px;font-size:8px;">:&nbsp;<?php echo $row->c_reg_no; ?></td>
  </tr>
   <?php 
              } 
			  }
               ?>
</table>

 </td>
 </table> 
<?php $k=1;
        if(!empty($cust)){
		 foreach ($cust as $rows)  
         {
	 ?>
<b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b><br/>
 
 <br/>
<h5></h5>
<table width="200" border="0">
  <tr>
 <td id="bold" style="width:170px;height:20px;;font-size:8px;">&nbsp;Visit : &nbsp;<?php echo $k++; ?></td>
    <td id="bold" style="width:180px;font-size:8px;">&nbsp;JobCard No :&nbsp;<?php echo $rows->inv_job_card_no; ?></td>
    <td id="bold" style="width:190px;font-size:8px;">&nbsp;Invoice No :&nbsp;<?php echo $rows->	inv_no; ?></td>
		 </tr>
</table><br/>


<table width="200" border="1 " align=>	
  <tr>
    <td id="bold"style="width:110px;height:20px;;font-size:8px;">&nbsp;Date Of Visit</td>
    <td id="bold"style="width:100px;font-size:8px;">&nbsp;Kms</td>
    <td id="bold"style="width:110px;font-size:8px;">&nbsp;Job Type</td>
    <td id="bold"style="width:110px;font-size:8px;">&nbsp;Service Dealer</td>
    <td id="bold"style="width:110px;font-size:8px;">&nbsp;Dealer Code</td>
  </tr>
  <tr>
    <td style="width:110px;height:20px;;font-size:8px;">&nbsp;<?php echo $rows->inv_jcard_date; ?></td>
    <td style="width:100px;font-size:8px;">&nbsp;<?php echo $rows->inv_km; ?></td>
    <td style="width:110px;font-size:8px;">&nbsp;<?php echo $rows->inv_repair_typ; ?></td>
    <td style="width:110px;font-size:8px;">&nbsp;<?php echo $rows->branch_address; ?></td>
    <td style="width:110px;font-size:8px;">&nbsp;<?php echo $rows->branch_id; ?></td>
  </tr>
 
</table>
<h4></h4>


<h4>Services Done</h4>
<table width="200" border="1">

  <tr>
    <td id="bold" style="width:140px;height:20px;;font-size:8px;">&nbsp;Service Name</td>
    <td id="bold"style="width:100px;font-size:8px;">&nbsp;Job Type</td>
	 <td id="bold" style="width:90px;font-size:8px;">&nbsp;Taxable Amount</td>
	  <td id="bold" style="width:90px;font-size:8px;">&nbsp;Discount Amount</td>
    <td id="bold" style="width:120px;font-size:8px;">&nbsp;Amount</td>
  </tr>
  <?php $i=1; $tax=0;$disc=0;$icamt=0;
       
	$serv=$this->Bill_model->view_service_data($rows->inv_id);	 
         foreach ($serv as $rowz)  
         { 
		 $tax+=$rowz->lc_tax_amunt;
		  $disc+=$rowz->lc_disc;
		   $icamt+=$rowz->lc_amount;
      ?>
  <tr>
    <td style="width:140px;height:20px;;font-size:8px;">&nbsp;<?php echo $rowz->lc_lb_name; ?></td>
    <td style="width:100px;font-size:8px;">&nbsp;<?php echo $rowz->lc_type; ?></td>
	<td style="width:90px;font-size:8px;">&nbsp;<?php echo $rowz->lc_tax_amunt	; ?></td>
	<td style="width:90px;font-size:8px;">&nbsp;<?php echo $rowz->lc_disc; ?></td>
    <td style="width:120px;font-size:8px;">&nbsp;<?php echo $rowz->lc_amount; ?></td>
  </tr>
  <?php }
			 ?>
</table>
<h4></h4>
<table width="200" border="0">
  
  <tr>
    <td style="width:150px;height:20px;font-size:8px;">&nbsp;Total Taxable Amount </td>
    <td style="width:150px;height:20px;font-size:8px;">:&nbsp;<?php echo $tax; ?></td>
  </tr>
  <tr>
    <td style="width:150px;height:20px;font-size:8px;">&nbsp;Total Discount Amount</td>
    <td style="width:150px;height:20px;font-size:8px;">:&nbsp;<?php echo $disc; ?></td>
  </tr>
  <tr>
    <td style="width:150px;height:20px;font-size:8px;">&nbsp;Total Bill Amount </td>
    <td style="width:150px;height:20px;font-size:8px;">:&nbsp;<?php echo $icamt; ?></td>
  </tr>
 
  </table>
  <h6></h6>
  <table width="200" border="">
  <tr>
  <td style="width:265px;height:20px;font-size:8px;">&nbsp;Supervisor Name :&nbsp;<?php echo $rows->advai; ?> </td>
 <td style="width:265px;height:20px;font-size:8px;">&nbsp;Technician Name :&nbsp;<?php echo $rows->mechni; ?></td>
   
  </tr>  
</table> <?php }} 
			  
               ?>
<b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b>


</body>

