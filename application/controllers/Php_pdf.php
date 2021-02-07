<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Php_pdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model('User_model');
        $this->load->model('Bill_model');
		$this->load->model('Admin_model');
		@date_default_timezone_set('Asia/Kolkata');
		
    }
    public function invoice_pdf($id)
    {
      $data['cust'] = $this->Bill_model->view_invoice_customer($id);
      $data['invo'] = $this->Bill_model->view_invoice1($id);   
        foreach($data['cust'] as $rowz){
            $valu=$rowz->inv_total;
             $current=$rowz->inv_jcard_date;
    
}
$or_dat= date('Y-m-d', strtotime($current. ' + 3 month'));
$data['nxtdat']=date("d/m/Y", strtotime($or_dat));
$number =round($valu);
$run=$valu-$number;
$diffr=round($run, 3);
$data['dffr']=$diffr;
$data['eng']= $this->convert_number($number);
$this->load->library('Pdf');
$this->load->view('Admin/tax_invoice_pdf_new',$data);
}
function convert_number($number) {
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */
        $res = "";
        if ($Gn) {
            $res .= $this->convert_number($Gn) .  "Million";
        }
        if ($kn) {
            $res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
        }
        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }
            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];
                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }
        if (empty($res)) {
            $res = "zero";
        }
        return $res;
    }
 public function check_stat($id)
    {
      $stat=$this->Bill_model->view_invoice_customer_stat($id);
       $to=$this->input->post('to');
        $subject=$this->input->post('subject');
        $message=$this->input->post('message');
       if($stat == 0)
      {
       
       $data['cust'] = $this->Bill_model->view_invoice_customer($id);
      $invo = $this->Bill_model->view_invoice1($id);   
        foreach($data['cust'] as $rowz)
        {
            $valu=$rowz->inv_total;
             $current=$rowz->inv_jcard_date;
         }
$or_dat= date('Y-m-d', strtotime($current. ' + 3 month'));
$nxtdat=date("d/m/Y", strtotime($or_dat));
$number =round($valu);
$run=$valu-$number;
$diffr=round($run, 3);
$dffr=$diffr;
$eng= $this->convert_number($number);
$this->load->library('Pdf'); 
    // create new PDF document

    $pdf = new TCPDF('L', 'mm',array(300,300), true, 'UTF-8', false);

    // set document information

    $pdf->SetCreator(PDF_CREATOR);

    //$pdf->SetAuthor('Name of Author');

    $pdf->SetTitle('Invoice Details');

    $pdf->SetSubject('Invoice');

    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    $pdf->SetDisplayMode('real', 'default');
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING);

    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetTopMargin(20);
    $pdf->SetHeaderMargin(20);
    $pdf->SetFooterMargin(20);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(TRUE);

   //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    $pdf->setFontSubsetting(true);

    $pdf->SetFont('times', '', 8, '', true);
     $pdf->setPrintHeader(false);
     //$pdf->setPrintFooter(false);
      $pdf->SetDisplayMode('fullpage', 'SinglePage', '');
    $pdf->AddPage('P', 'A4');
    
foreach($data['cust'] as $row){
            $html1='<table cellspacing="0" cellpadding="0" border="0" width="65%">

    <tr>
        <td style="float:left;" ><address>
            <strong style="font-size:9px;">Branch Address:</strong><br/>
            <strong style="font-size:8px">&nbsp;&nbsp;'. $row->branch_name .'</strong><br>
            <span style="font-size:9px">&nbsp;&nbsp;'.str_replace(',', '<br />&nbsp;&nbsp;',$row->branch_address).'<br>
            &nbsp;PH&nbsp;: '.$row->branch_ph.'</span>
                    </address></td>
        <td style=""><address>
                <strong><img src="resource/images/bajaj.png" style="width:500px; height:100px;"></strong><br><br/>
                         <strong style="font-size:10px;">&nbsp;&nbsp;SARATHY MOTORS</strong><br>
                         <b style="font-size:8px;">Sarathy Bajaj Pallimukku Kollam Kerala State<br>
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
<table border="0" cellpadding="1" cellspacing="1" nobr="true" style="line-height:12px;">
  <tr>
  <td width="65%">
<span style="font-size:9px;"><b>Invoice No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_job_card_no.'</span><br/>
<span style="font-size:9px;"><b>Invoice Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
</b>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_inv_date)).'</span><br/>
<span style="font-size:9px;"><b>Billed TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_cus.'<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;Mobile&nbsp;:&nbsp;'.$row->inv_pho.'<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;'.substr($row->inv_cus_addres, 0, 25).'
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;'.substr($row->inv_cus_addres, 25,1000).'<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;Kerala[State Code :32] INDIA
</span><br/>
<span style="font-size:9px;"><b>Customer GSTIN&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp; '.$row->inv_cus_gstin.'</span><br/>
<span style="font-size:9px;"><b>Mobile No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_pho.'</span><br/>
 <span style="font-size:9px;"><b>Delivery
 Address&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->branch_address.',</span><br/>
<span style="font-size:9px;"><b>Advisor Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->advai.'</span><br/>
<span style="font-size:9px;"><b>Mechanic Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->mechni.'</span><br/>
  
  </td>
 
   <td width="40%" style="">
<span style="font-size:9px;"><b>Invoice Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_type.'</span><br/>
<span style="font-size:9px;"><b>Jobcard No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_job_card_no.'</span><br/>
<span style="font-size:9px;"><b>Jobcard Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
</b>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_jcard_date)).'</span><br/>
<span style="font-size:9px;"><b>Whether Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_taxpay.'<br/><b>Payable on<br/>reverse Charges</b></span><br/>
<span style="font-size:9px;"><b>Repair Type&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_repair_typ.'</span><br/>
<span style="font-size:9px;"><b>KM Reading&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_km.'</span><br/>
<span style="font-size:9px;"><b>Registration No.&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->in_registr.'</span><br/>
<span style="font-size:9px;"><b>Chassis No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_chassis.'</span><br/>
<span style="font-size:9px;"><b>Engine No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->in_engine.'</span><br/>
 <span style="font-size:9px;"><b>Model Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;</b>:&nbsp;&nbsp;'.$row->inv_modl.'</span>
  </td>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b>
 </tr><br/></table><table border="0" cellpadding="2" cellspacing="2" nobr="true">
  <tr>
 <td></td>
 </tr>
 </table>
<table border="1"  width="94.5%" style="padding: 5px;font-size:8px;">
  <table border="1" width="95.5%" style="font-size:8px;">
  <tr>
    <th><b>S. No.</b></th>
    <th><b>LABOUR CODE</b></th>
    <th width="14%"><b>LABOUR NAME/SAC<br/>CODE</b></th>
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
        $L=$val->lc_type;
        $c=$val->lc_rate;
        //$d=$val->lc_units;
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
    foreach($data['cust'] as $rows){
 
$html3='<tr > <td colspan="4" style="text-align:right;border-width:0px;
    border-style: solid; border-color:transparent #000 transparent transparent;" ><b>TOTAL</b></td>
  <td style="text-align: right;">'.$rows->inv_disc_total.'</td>
    <td style="text-align: right;">'.$rows->inv_taxtotal.'</td>
    <td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_sgstotal.'</td>
    <td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_gsttotal.'</td>
    <td style="text-align: right;">'.$rows->inv_total.'</td>
</tr>
<tr >

   <td colspan="4"style="text-align: right;border-width:0px;
    border-style: solid; border-color:transparent #000 transparent transparent;"></td>
    <td colspan="6"style="text-align: left;"><b>Round Off</b></td>
    <td style="text-align: right;">'.$dffr.'</td>
</tr>
<tr >
<td colspan="4"style="text-align: right;border-width:0px;
    border-style: solid; border-color:transparent #000 transparent transparent;"></td>
    <td colspan="6"style="text-align: left;"><b>Total Amount</b></td>
    <td style="text-align: right;">'.round($rows->inv_total).'.00</td>
</tr>
</table><br/><br/><br/>
<table border="1" height="25" width="94.5%" style="padding: 5px;font-size:9.5px;">
  <tr>
 <td width="28%"><p style="font-size:8px;"><b style="font-size:10px;">AMOUNT IN WORDS</b></p>
  </td>
 <td width="78%"><p style="font-size:10px;">RS: '.$eng.'</p>
  </td>
 </tr> 
</table>
<table border="0" height="455" cellpadding="3" >
  <tr>
 <td colspan="3" width="80%"><p style="font-size:10px" ><b>Tax amount payable on reverse charges (in Rs.) : Nil</b>
  </p></td></tr><br/><br/><br/>
  <p></p>
  <p></p>
  <tr height="100"><td align="left" >
  <p><hr width="70%"><span style="font-size:9px">&nbsp;Sign of Customer Or His Agent</span></p></td>
  <td width="40%" align="center">
 <p style="font-size:10px"><b>Get your vehicle serviced at regular intervals.<br/>Next due date for service is '.$nxtdat.'<br/>Thank You & Happy Riding</b></p></td>
<td align="right"><p><br/>
  <span style="font-size:9px">&nbsp;&nbsp;&nbsp;&nbsp;SARATHY MOTORS</span><hr width="75%"><span style="font-size:9px">&nbsp;&nbsp;&nbsp;&nbsp;Authorised Signatory</span></p>
 
</td>
 </tr>
 </table>
    '; }

$html=$html1.$html2.$html3;
$pdf->writeHTML($html, true, false, true, false,'');
 ob_clean(); 
$FileNamePath ='Invoice'.date('Y-m-dHis').'.pdf';
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'bajajservices/resource/invoice_pdfs/'.$FileNamePath, 'F');
//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'sarathy11/resource/invoice_pdfs/'.$FileNamePath, 'D');
//die();
$EmailAddress = "admin@sarathygroup.com";       

if(!empty($FileNamePath)){
        $this->sendemail($EmailAddress,$FileNamePath,$id,$to,$subject,$message);
    }
    else{
        print_r('Could not trace file path');
    }        

    }

      
      else if($stat==1){
       
        $data['cust'] = $this->Bill_model->view_invoice_customer_insurance($id);
    $invo = $this->Bill_model->view_invoice1($id);  
  foreach($data['cust'] as $rowz){
  $valu=$rowz->inv_total;
  $current=$rowz->inv_jcard_date;
  }
  $or_dat= date('Y-m-d', strtotime($current. ' + 3 month'));
  $data['nxtdat']=date("d/m/Y", strtotime($or_dat));
  $number =round($valu);
  $run=$valu-$number;
  $diffr=round($run, 3);
  $dffr=$diffr;
  $data['eng']= $this->convert_number($number);
  $this->load->library('Pdf');
 
    $pdf = new TCPDF('L', 'mm',array(300,300), true, 'UTF-8', false);
            $pdf->SetTitle('Invoice Receipt');
            $pdf->SetHeaderMargin(17);
            $pdf->SetTopMargin(17);
            $pdf->setFooterMargin(15);
      //$pdf->SetMargins(20, 10, 20, true);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
             $pdf->SetFont('times',7);
      $pdf->setPrintHeader(false);
     // $pdf->setPrintFooter(false);
            $pdf->AddPage('P', 'A4');
    foreach($data['cust'] as $row){
      $html1='<table cellspacing="0" cellpadding="0" border="0" width="65%">

    <tr>
        <td style="float:left;" ><address>
              <strong style="font-size:10px;">Branch Address:</strong><br>
              <strong style="font-size:10px;">'. $row->branch_name .'</strong><br>
              <span style="font-size:10px;">'. str_replace(',', '<br />&nbsp;&nbsp;',$row->branch_address) .' <br>
            &nbsp;PH&nbsp;: '.$row->branch_ph.'</span>
            </address></td>
        <td style="float:left;"><address>
              <strong><img src="resource/images/bajaj.png" style="width:500px; height:100px;"></strong><br>
              <strong style="font-size:12px;">SARATHY MOTORS</strong><br>
              <b style="font-size:9px;">Sarathy Bajaj Pallimukku Kollam Kerala State<br>
              &nbsp;Code: 32 Kerala [State Code :32]</b>
            </address></td>
        </tr>
   </table>
<table border="0" cellpadding="1" cellspacing="1" nobr="true">
  <tr>
  <td width="35%"><p style="font-size:8px;">&nbsp;&nbsp;&nbsp;GSTIN:</p>
  <b style="font-size:10px;">&nbsp;&nbsp;&nbsp;32ABQFS6676M1ZA</b></td>
 
  <th><b style="font-size:16px;">Tax Invoice Insurance Copy-Labour</b></th>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b><br/>
 </tr>
 
</table>
<table border="0" cellpadding="1" cellspacing="1" nobr="true" style="line-height:12px;">
  <tr>
  <td width="60%"><br/>
<p style="font-size:9px;"><b>Invoice No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_no.'</p>
<p style="font-size:9px;"><b>Invoice Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
</b>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_inv_date)).'</p>
<p style="font-size:9px;"><b>Billed TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->icompany_name.'
</p>
<p style="font-size:9px;"><b>Customer Name.&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_cus.'</p>
<p style="font-size:9px;"><b>Insurance GSTIN No
</b>:&nbsp;'.$row->icompany_gst.'</p>
<p style="font-size:9px;"><b>Mobile No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->inv_pho.'</p>
 <p style="font-size:9px;"><b>Delivery
 Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->branch_address.',</p>
<p style="font-size:9px;"><b>Insurance
 Address&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;'.$row->icompany_address.',</p>
   <p style="font-size:9px;"><b>Advisor Name.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;&nbsp;&nbsp;'.$row->advai.'</p> 
<p style="font-size:9px;"><b>Mechanic Name.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</b>:&nbsp;&nbsp;&nbsp;&nbsp;'.$row->mechni.'</p>
  </td>
 
   <td width="40%" style=""><br/>
<p style="font-size:9px;"><span><b>Invoice Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;</b>
</span>:&nbsp;&nbsp;'.$row->inv_type.'</p>
<p style="font-size:9px;"><span><b>Jobcard No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;</b></span>:&nbsp;&nbsp;'.$row->inv_job_card_no.'</p>
<p style="font-size:9px;"><span><b>Jobcard Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;</b>
</span>:&nbsp;&nbsp;'.date("d/m/Y", strtotime($row->inv_jcard_date)).'</p>
<p style="font-size:9px;"><span><b>Whether Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b>'.$row->inv_taxpay.'<br/><b>Payable on<br/>reverse Charges</b></span></p>
<p style="font-size:9px;"><span><b>Repair Type&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->inv_repair_typ.'</p>
<p style="font-size:9px;"><span><b>KM Reading&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->inv_km.'</p>
<p style="font-size:9px;"><span><b>Registration No.&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->in_registr.'</p>
<p style="font-size:9px;"><span><b>Chassis No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->inv_chassis.'</p>
<p style="font-size:9px;"><span><b>Engine No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->in_engine.'</p>
 <p style="font-size:9px;"><span><b>Model Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;</b></span>:&nbsp;&nbsp;'.$row->inv_modl.'</p>
  </td>
  <b style=" border-bottom-style: solid;
     border-bottom-width: medium;"><hr></b><br/>
 </tr>
 
</table>
<table border="0" cellpadding="0" cellspacing="2" nobr="true">
  <tr>
 <td></td>
 </tr>
 </table>
<table border="1"  width="94.5%" style="padding: 5px;font-size:8px;">
  <tr>
    <th><b>S. No.</b></th>
    <th><b>LABOUR CODE</b></th>
    <th width="14%"><b>LABOUR NAME/SAC<br/>CODE</b></th>
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
    //$d=$val->lc_units;
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
 
  foreach($data['cust'] as $rows){
 
$html3='<tr > <td colspan="4" style="text-align:right;border-width:0px;
  border-style: solid; border-color:transparent #000 transparent transparent;" ><b>TOTAL</b></td>
  <td style="text-align: right;">'.$rows->inv_disc_total.'</td>
  <td style="text-align: right;">'.$rows->inv_taxtotal.'</td>
    <td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_sgstotal.'</td>
  <td style="text-align: right;"></td>
    <td style="text-align: right;">'.$rows->inv_gsttotal.'</td>
    <td style="text-align: right;">'.$rows->inv_total.'</td>
</tr>
<tr >

   <td colspan="4"style="text-align: right;border-width:0px;
  border-style: solid; border-color:transparent #000 transparent transparent;"></td>
  <td colspan="6"style="text-align: left;"><b>Round Off</b></td>
    <td style="text-align: left;">'.$dffr.'</td>
</tr>
<tr >
<td colspan="4"style="text-align: right;border-width:0px;
  border-style: solid; border-color:transparent #000 transparent transparent;"></td>
  <td colspan="6"style="text-align: left;"><b>Total Amount</b></td>
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
 </table><br/>
<table border="0" height="455" cellpadding="1" >
  <tr><br/>
 <td colspan="3" width="80%"><p style="font-size:11px" ><b>Tax amount payable on reverse charges (in Rs.) : Nil</b>
  </p></td></tr><br/><br/>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <p></p>
  <tr height="90"><td align="left">
  <p><hr width="70%"><span style="font-size:9px">&nbsp;Sign of Customer Or His Agent</span></p></td>
  <td width="40%" align="center">
 <p style="font-size:11px"><b>Get your vehicle serviced at regular intervals.<br/>Next due date for service is '.$nxtdat.'<br/>Thank You & Happy Riding</b></p></td>
<td align="right"><p><br/>
  <span style="font-size:9px">&nbsp;&nbsp;&nbsp;&nbsp;SARATHY MOTORS</span><hr width="75%"><span style="font-size:9px">&nbsp;&nbsp;&nbsp;&nbsp;Authorised Signatory</span></p>
 
</td>
 </tr>

</table>
  '; }
$html=$html1.$html2.$html3;
           $pdf->writeHTML($html, true, false, true, false,'');
           ob_clean(); 
$FileNamePath ='Invoice'.date('Y-m-dHis').'.pdf';
$pdf->Output($_SERVER['DOCUMENT_ROOT'].'bajajservices/resource/invoice_pdfs/'.$FileNamePath, 'F');
//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'sarathy11/resource/invoice_pdfs/'.$FileNamePath, 'D');
//die();
$EmailAddress = "admin@sarathygroup.com";       

if(!empty($FileNamePath)){
        $this->sendemail($EmailAddress,$FileNamePath,$id,$to,$subject,$message);
    }
    else{
        print_r('Could not trace file path');
    }        
}
	}   
function sendemail($EmailAddress,$FileNamePath,$id,$to,$subject,$message){
     $this->load->library('email');
     $this->load->helper('path');
     $config['mailtype'] = 'html';
    $this->email->initialize($config);       
    $this->email->set_newline("\r\n");
    $this->email->from($EmailAddress,'SARATHY MOTORS - ADMIN');
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);
    $path = set_realpath($_SERVER['DOCUMENT_ROOT'].'bajajservices/resource/invoice_pdfs/'.$FileNamePath);
    $this->email->attach($path);
     if($this->email->send()){
         $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center">Successfully sent your mail.</div>');
        redirect('Admin/edit_jobcard/'.$id,'refresh');
        

    }else{
        print_r($this->email->print_debugger());
    }

}



}