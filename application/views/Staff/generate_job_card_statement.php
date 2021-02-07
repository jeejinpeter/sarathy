<!DOCTYPE html>
<html>

<head>
<style>
table, th, td {
    border: 1px solid black;
   
}
th, td {
    padding: 5px;
    text-align: left;
}

table#t01 {
    width: 100%;    
    background-color: #fff;
}
</style>
</head>

<body>
<?php if(isset($list)): ?>
        
		
		<center><u><h1>Sarathy</u></center></h1>
	 <center><h3>Job Card Statement From <?php echo @date('d-m-Y',strtotime($from)); ?> To <?php echo @date('d-m-Y',strtotime($to)); ?> </h3></center>
           <table id="t01" border="1" style="width:100%">
             <thead>
                <tr style="background-color:#C0C0C0;font-size:8px;">
	    <th align="center">Sl no.</th>
		<th>Job Card</th>
		<th>Job Card Date</th>
        <th>Branch</th>
        <th>Labour <br>Code</th>
		<th>Mechanic</th>
        <th>Advisor</th>
		<th> Repair Type</th>
		<th> Invoice <br> No</th>
		<th> Invoice <br> Customer</th>
		<th> Mobile<br> Number</th>
        <th> Invoice <br> Date</th>
		<th> Register  No</th>
	    <th>Model Name-Chaissis No- Engine No-KM Reading</th>
		<th> Insurance Company</th>
		<th> Paid Service Amount</th>
		<th> Free Service Amount</th>
		<th> Expense Service Amount</th>
		<th> Customer GSTN</th>
		<th> Discount</th>
		<th> Taxable Amount</th>
		<th>Invoice Type</th>
		<th>Invoice Amount</th>
                 </tr>
                </thead>
                <tbody>
                <?php $i=1;
				$total=0;
        if(!empty($list)){
         foreach ($list as $row)  
         { 
		  $total+=$row->lc_amount;
	      ?>
        <tr style="font-size:8px;">
        <td><?php echo $i++;?></td>
        <td class="center"><?php echo $row->inv_job_card_no;?></td>
		 <td class="center"><?php echo $row->inv_jcard_date;?></td>
		<td class="center"><?php echo $row->branch_name;?></td>
		<td class="center"><?php echo $row->lc_lb_name;?> (<?php echo $row->lc_lab_code;?>)</td>
		<td class="center"><?php echo $row->mechni; ?></td>
		<td class="center"><?php echo $row->advai; ?></td>
		<td class="center"><?php echo $row->inv_repair_typ; ?></td>
		<td class="center"><?php echo $row->inv_no;?></td>
		<td class="center"><?php echo $row->inv_cus;?></td>
		<td class="center"><?php echo $row->inv_pho; ?></td>
		<td class="center"><?php echo $row->inv_inv_date; ?></td>
	    <td><?php echo $row->in_registr; ?></td>
		<td><?php echo $row->inv_modl.'<br>-'.$row->inv_chassis.'<br>-'.$row->in_engine.'<br>-'.$row->inv_km; ?></td>
				<!--<td><?php echo $row->inv_chassis; ?></td>	
				 <td><?php echo $row->in_engine; ?></td>
				 <td><?php echo $row->inv_km; ?></td>-->
			  <td><?php echo $row->icompany_name; ?></td>
				 <td><?php if($row->lc_type=="Paid Service"){ echo $row->lc_amount; }?></td>
				 <td><?php if($row->lc_type=="Free Service"){ echo $row->lc_amount; }?></td>
				 <td><?php if($row->lc_type=="Expense"){ echo $row->lc_amount; }?></td>
			     <td><?php echo $row->inv_cus_gstin; ?></td>
				 <td><?php echo $row->lc_disc; ?></td>
				 <td><?php echo $row->lc_tax_amunt; ?></td>
				 <td><?php echo $row->inv_type; ?></td>
				 <td><?php echo $row->inv_total; ?></td>
				 </tr>
    <?php 
	 
			  }
              } 
			  
			 
               ?>
            </tbody>
          </table>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Cost&nbsp;&nbsp;:&nbsp;<?php echo $total;?>&nbsp;-/</h3>
        <?php endif; ?>
 </body>
</html>
