<?php $pdf = new TCPDF('L', 'mm',array(300,300), true, 'UTF-8', false);
            $pdf->SetTitle('Invoice Receipt');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
			//$pdf->SetMargins(20, 10, 20, true);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
            $pdf->AddPage();
		foreach($cust as $row){
			$html1='<table cellspacing="0" cellpadding="0" border="0" width="65%">

    <tr>
        <td style="float:left;" ><address>
        			<strong style="font-size:10px;">Branch Address:</strong><br>
    					<strong style="font-size:10px;">'. $row->branch_name .'</strong><br>
    					<span style="font-size:10px;">'. str_replace(',', '<br />&nbsp;&nbsp;',$row->branch_address) .' <br>
						&nbsp;&nbsp;Kerala [State Code :32]</span>
    				</address></td>
        <td style="float:left;"><address>
        			<strong><img src="resource/images/bajaj.png" style="width:500px; height:100px;"></strong><br><br>
    					<strong style="font-size:12px;">SARATHY MOTORS</strong><br>
    					<b style="font-size:9px;">Sarathy Bajaj Pallimukku Kollam Kerala State<br>
    					&nbsp;Code: 32 Kerala [State Code :32]</b>
    				</address></td>
       
    </tr>
   
  
</table>

<table border="0" cellpadding="2" cellspacing="2" nobr="true">
  <tr>
 <br/><br/>
  <td width="35%"><p style="font-size:8px;">GSTIN:</p>
  <b style="font-size:10px;">32ABQFS6676M1ZA</b></td>
 
  <th><b style="font-size:16px;">TAX INVOICE (Labour)</b></th>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b><br/>
 </tr>
 
</table>
<table border="0" cellpadding="3" cellspacing="3" nobr="true" style="line-height:12px;">
  <tr>
  <td width="55%">
<p style="font-size:9px;"><b>Invoice No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_job_card_no.'</p>
<p style="font-size:9px;"><b>Invoice Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
</b>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_inv_date)).'</p>
<p style="font-size:9px;"><b>Billed TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_cus.'<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Mobile&nbsp;&nbsp;:&nbsp;&nbsp;'.$row->inv_pho.'<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;'.substr($row->inv_cus_addres, 0, 25).'-<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;'.substr($row->inv_cus_addres, 25).'-<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;Kerala[State Code :32] INDIA
</p>
<p style="font-size:9px;"><b>Customer GSTIN&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp; '.$row->inv_cus_gstin.'</p>
<p style="font-size:9px;"><b>Mobile No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_pho.'</p>
 <p style="font-size:9px;"><b>Delivery
 Address&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->branch_address.',</p>
<p style="font-size:9px;"><b>Advisor Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->advai.'</p>
<p style="font-size:9px;"><b>Mechanic Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->mechni.'</p>
  
  </td>
 
   <td width="40%" style="">
<p style="font-size:9px;"><span>Invoice Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</span>:&nbsp;&nbsp;'.$row->inv_type.'</p>
<p style="font-size:9px;"><span>Jobcard No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
&nbsp;</span>:&nbsp;&nbsp;'.$row->inv_job_card_no.'</p>
<p style="font-size:9px;"><span>Jobcard Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
</span>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_jcard_date)).'</p>
<p style="font-size:9px;"><span>Whether Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;'.$row->inv_taxpay.'<br/>Payable on<br/>reverse Charges</span></p>
<p style="font-size:9px;"><span>Repair Type&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->inv_repair_typ.'</p>
<p style="font-size:9px;"><span>KM Reading&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->inv_km.'</p>
<p style="font-size:9px;"><span>Registration No.&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->in_registr.'</p>
<p style="font-size:9px;"><span>Chassis No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->inv_chassis.'</p>
<p style="font-size:9px;"><span>Engine No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->in_engine.'</p>
 <p style="font-size:9px;"><span>Model Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;</span>:&nbsp;&nbsp;'.$row->inv_modl.'</p>
  </td>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b><br/>
 </tr>
 
</table><br/><br/>
<table border="0" cellpadding="2" cellspacing="2" nobr="true">
  <tr>
 <td></td>
 </tr>
 
</table>
<table border="1"  width="94.5%" style="padding: 5px;font-size:8px;">
  <tr>
    <th><b>S. No.</b></th>
    <th><b>LABOUR CODE</b></th>
    <th width="14%">LABOUR NAME/SAC<br/>CODE</th>
    <th><b>RATE</b></th>
    <th><b>DISC</b></th>
    <th><b>TAXABLE<br/>AMOUNT</b></th>
    <th><b>SGST/U<br/>TGST(%)</b></th>
    <th><b>SGST/<br/>UTGST</b></th>
    <th><b>CGST(%)</b></th>
    <th><b>CGST</b></th>
    <th><b>AMOUNT</b></th>
  </tr>';
		}
		$html2="";$z=1;
		foreach($invo as $val){ 
		$a=$val->lc_lab_code;
		$b=$val->lc_lb_name;
		$c=$val->lc_rate;
		$d=$val->lc_units;
		$e=$val->lc_disc;
		$f=$val->lc_tax_amunt;
		$g=$val->lc_sgst_p;
		$h=$val->lc_sgst_a;
		$i=$val->lc_cgst_p;
		$j=$val->lc_cgst_a;
		$k=$val->lc_amount;
		//var_dump($invo);die();
		
			$html2 =$html2.'
  <tr>
    <td style="text-align: center;">'.$z++.'</td>
    <td>'.$a.'</td>
    <td>'.$b.'</td>
	<td style="text-align: right;">'.$c.'</td>
    <td style="text-align: right;">'.$e.'</td>
	<td style="text-align: right;">'.$f.'</td>
    <td style="text-align: right;">'.$g.'</td>
    <td style="text-align: right;">'.$h.'</td>
	<td style="text-align: right;">'.$i.'</td>
    <td style="text-align: right;">'.$j.'</td>
    <td style="text-align: right;">'.$k.'</td>
  </tr>

 '; }
 
 	foreach($cust as $rows){
 
$html3='<tr > <td colspan="5" style="text-align:right;border-width:0px;
	border-style: solid; border-color:transparent #000 transparent transparent;" ><b>TOTAL</b></td>
	<td style="text-align: right;">'.$rows->inv_taxtotal.'</td>
    <td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_sgstotal.'</td>
	<td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_gsttotal.'</td>
    <td style="text-align: right;">'.$rows->inv_total.'</td>
</tr>
<tr >

   <td colspan="5"style="text-align: right;border-width:0px;
	border-style: solid; border-color:transparent #000 transparent transparent;"></td>
	<td colspan="5"style="text-align: left;"><b>Round Off</b></td>
    <td style="text-align: left;">'.$dffr.'</td>
</tr>
<tr >
<td colspan="5"style="text-align: right;border-width:0px;
	border-style: solid; border-color:transparent #000 transparent transparent;"></td>
	<td colspan="5"style="text-align: left;"><b>Total Amount</b></td>
    <td style="text-align: left;">'.round($rows->inv_total).'.00</td>
</tr>
</table><br/><br/>
<table border="1" width="93.5%" style="padding: 5px;font-size:9.5px;">
  <tr>
 
  <td width="20%"><p style="font-size:8px;"><b style="font-size:10px;">AMOUNT IN WORDS</b></p>
  </td>
 <td width="86%"><p style="font-size:10px;">RS: '.$eng.'</p>
  </td>
 
 </tr>
 
</table>
<table border="0" cellpadding="3" >
  <tr>
 <br/>
  <td><p style="font-size:10px;" ><b>Tax amount payable on reverse charges (in Rs.) : Nil<br><br/>
</b>
  <br> 
  </p>
 <br/><br/>
  <p><hr width="60%"><span style="font-size:9px;line-height:12px;">&nbsp;&nbsp;&nbsp;&nbsp;Sign of Customer Or His Agent</span></p>
</td>
  <td width="40%">
  <br/><br/><br/><br/><br/>
  <p><b>Get your vehicle serviced at regular intervals.<br/>Next due date for service is '.$nxtdat.'<br/>Thank You & Happy Riding</b></p>
</td>
   <td><br/><br/><br/><br/>
  <p><span style="font-size:9px;line-height:15px;">&nbsp;&nbsp;&nbsp;&nbsp;SARATHY MOTORS</span><hr width="60%"><span style="font-size:9px;line-height:12px;">&nbsp;&nbsp;&nbsp;&nbsp;Authorised Signatory</span></p>
 
</td>
 </tr>

</table>
	'; }
$html=$html1.$html2.$html3;
           $pdf->writeHTML($html, true, false, true, false,'');
            ob_end_clean();     
            $pdf->Output();?>