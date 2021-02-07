<?php
/* @property phpword_model $phpword_model */
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
include_once(APPPATH."core/Front_end.php");

use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
Autoloader::register();
Settings::loadConfig();
class Phpword extends Front_end {

	function __construct()
	{
	  parent::__construct();
		$this->load->model('Bill_model');
        $this->load->model('Staff_model');
        @date_default_timezone_set('Asia/Kolkata');

    }
/*
	function index()
	{
		$data['news'] = $this->phpword_model->get_news();
		$this->view('content/phpword', $data);
	}
*/
	public function download_word($id) 
	 {
        //$this->load->library('Phpword');

        $news = $this->Staff_model->view_jobcard_invoice_word($id);
        $news1 = $this->Staff_model->view_tax_invoice_word($id);
       
        //  create new file and remove Compatibility mode from word title

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getCompatibility()->setOoxmlVersion(14);
        $phpWord->getCompatibility()->setOoxmlVersion(15);

        $targetFile = "./resource/uploads/";
        $filename = 'example.docx';

        // add style settings for the title and paragraph
        
            $section = $phpWord->addSection();
            //$header = $section->addHeader();
           
          /*  $sectionStyle = array(
                            'orientation' => 'landscape',
                             'marginTop' => 400,
                             'colsNum' => 2,
                                             );   */
$styleTable = array('borderSize' => 5, 'borderColor' => 'ffffff');
$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
$table = $section->addTable('Colspan Rowspan');
$row = $table->addRow();
 $row1=$row->addCell(5000, array('vMerge' => 'restart'));
 $row1->addText("Branch Address :",array('bold' => true,'name'=> 'times new roman','size' => 11));
 $row1->addText("SARATHY MAIN WORKSHOP",array('bold' => true,'name'=> 'times new roman','size' => 8));
  $row1->addText("Sarathy Bajaj",array('bold' => true,'name'=> 'times new roman','size' => 9));
  $row1->addText("Pallimukku",array('bold' => true,'name'=> 'times new roman','size' => 9));
  $row1->addText("Kollam-10,",array('bold' => true,'name'=> 'times new roman','size' => 9));
  $row1->addText("Kerala[State Code:32]",array('bold' => true,'name'=> 'times new roman','size' => 9));

 $row2=$row->addCell(6000, array('vMerge' => 'restart', 'gridSpan' => 3));
 $row2->addImage($targetFile.'bajaj.png', array('width'=>170, 'height'=>70));
 $row2->addText("SARATHY MOTORS", array('bold' => true,'name'=> 'times new roman','size' => 12));
 $row2->addText("Sarathy Bajaj Pallimukku Kollam Kerala State", array('bold' => true,'name'=> 'times new roman','size' => 9));
  $row2->addText("Code:32 Kerala[State Code:32]", array('bold' => true,'name'=> 'times new roman','size' => 9));
//$row->addCell(1000, array('gridSpan' => 3, 'vMerge' => 'restart'))->addText('B');
//$row->addCell(1000)->addText('1');
$row = $table->addRow();
$row->addCell(5000, array('vMerge' => 'continue'));
$row->addCell(6000, array('vMerge' => 'continue', 'gridSpan' => 3));

$row = $table->addRow();
$row->addCell(5000, array('vMerge' => 'continue'));
$row->addCell(6000, array('vMerge' => 'continue', 'gridSpan' => 3));
$table=$section->endTable('Colspan Rowspan');
//$row->addCell(1000)->addText('2');
/*
$row = $table->addRow();
$row3=$row->addCell(5000);
$row3->addText("");
$row4=$row->addCell(6000, array( 'gridSpan' => 3));
$row4->addText("");

//$row->addCell(1000)->addText('2');
$row = $table->addRow();
$row5=$row->addCell(5000);
$row5->addText("GSTIN:", array('bold' => true,'name'=> 'times new roman','size' => 9));
$row5->addText("32ABQFS6676M1ZA:", array('bold' => true,'name'=> 'times new roman','size' => 9));

$row6=$row->addCell(6000, array( 'gridSpan' => 3));
$row6->addText("Tax Invoice(Labour)",array('bold' => true,'underline'=>'','name'=> 'arial','size' => 21));
*/ //$section->addTextBreak(1);
 $section->addText("GSTIN : 32ABQFS6676M1ZA", array('bold' => true,'name'=> 'times new roman','size' => 9,'color' =>'','align' => 'left','lineHeight' =>1));
  //$section->addTextBreak(1);
 $section->addText("Tax Invoice (Labour)", array('bold' => true,'underline' => '','name'=> 'arial','size' => 21),array('align' => 'center','color' =>'black' ));


$lineStyle = array('weight'=>1,'width' =>590,'height' => 0,'align'=>'left','color' => 'black');
         $section->addLine($lineStyle);
               
    
         foreach($news as $n)
         {
      $styleTable1 = array('borderSize' => 0, 'borderColor' => 'ffffff');
$phpWord->addTableStyle('Colspan Rowspan', $styleTable1);
$table = $section->addTable('Colspan Rowspan');

$row = $table->addRow();
$row->addCell(3500)->addText("Invoice No"."          : ",array('align' => 'center','bold' => true),array('name'=>'arial','size' =>9));
$row->addCell(3500)->addText($n['inv_no'],array('align' => 'left'),array('name'=>'arial','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Invoice Date"."   : ",array('bold' => true,'align' => 'center'), array('name'=> 'arial','size' => 9));
$row->addCell(3500)->addText(date('d-m-Y', strtotime($n['inv_inv_date'])),array('align' => 'left'), array('name'=> 'arial','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Jobcard No"."           : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['inv_job_card_no'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Jobcard Date"."     : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText(date('d-m-Y', strtotime($n['inv_jcard_date'])), array('name'=> 'arial','align'=>'left','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Customer Name"."    : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['inv_cus'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Mobile No"."           : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText($n['inv_pho'], array('name'=> 'arial','align'=>'left','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Customer GSTIN"."   : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['inv_cus_gstin'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Repair Type"."        : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText($n['inv_repair_typ'], array('name'=> 'arial','align'=>'left','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Model Name"."          : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['inv_modl'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("KM Reading"."        : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText($n['inv_km'], array('name'=> 'arial','align'=>'left','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Registration No"."    : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['in_registr'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Adviser Name"."      : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText($n['adviser'], array('name'=> 'arial','align'=>'left','size' => 9));

$row = $table->addRow();
$row->addCell(3500)->addText("Mechanic Name"."    : ",array('bold' => true,'name'=>'arial','align'=>'center','size' =>9));
$row->addCell(3500)->addText($n['mechanic'],array('name'=>'arial','align'=>'left','size' =>9));
$row->addCell(2000, array( 'vMerge' => 'restart'))->addText('');
$row->addCell(3500)->addText("Branch Name"."       : ", array('bold' => true,'name'=> 'arial','align'=>'center','size' => 9));
$row->addCell(3500)->addText($n['branch_name'], array('name'=> 'arial','align'=>'left','size' => 9));

  }
       
       $section->addTextBreak(1);    
$section->addText("Tax Invoice",array('bold'=>true,'name'=>'arial','size' =>19),array('align' =>'center'));
           //$header1 = array('size' => 16,'valign' =>'center' ,'bold' => true);
           //$section->addText('Tax Invoice', $header1);

$styleTable2 = array('borderSize' => 15, 'borderColor' => '000000');

$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
$cellHCentered = array('align' => 'center','size' => 9);
$cellVCentered = array('valign' => 'center','bold' => true);
$cellRCentered = array('align' => 'right','size' => 9);
$cellLCentered = array('align' => 'left','size' => 9);
$spanTableStyleName1 = 'Colspan Rowspan';
$phpWord->addTableStyle($spanTableStyleName1,$styleTable2);


$table1 = $section->addTable($spanTableStyleName1);
 
 $row = $table1->addRow();
//$cell1 = $table1->addCell(850);
//$textrun1 = $cell1->addTextRun($cellHCentered);
//$textrun1->addText('Sl NO:',array('bold' => true));
//$textrun1->addFootnote()->addText('Row span');
$row->addCell(850,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999','width'=>50))->addTextRun($cellHCentered,$cellVCentered)->addText('Sl NO:',array('bold' => true,'size' => 8));
//$cell2 = $table1->addCell(850);
//$textrun2 = $cell2->addTextRun($cellHCentered);
//$textrun2->addText('LABOUR NAME/SAC
//CODE',array('bold' => true));

$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999','width'=>50))->addTextRun($cellHCentered,$cellVCentered)->addText('LABOUR NAME/SAC
CODE',array('bold' => true,'size' => 8));

//$cell3 = $table1->addCell(850);
//$textrun3 = $cell3->addTextRun($cellHCentered);
//$textrun3->addText('Labour Name',array('bold' => true));
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999','width'=>50))->addTextRun($cellHCentered,$cellVCentered)->addText('LABOUR NAME',array('bold' => true,'size' => 8));


/*  $cell4 = $table1->addCell(850);
$textrun4 = $cell4->addTextRun($cellHCentered);
$textrun4->addText('Rate',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered,$cellVCentered)->addText('RATE ',array('bold' => true,'size' => 8));
/*

$cell4a = $table1->addCell(850);
$textrun4a = $cell4a->addTextRun($cellHCentered);
$textrun4a->addText('Discount',array('bold' => true)); */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered,$cellVCentered)->addText('DISCOUNT ',array('bold' => true,'size' => 8));

/*
$cell5 = $table1->addCell(850);
$textrun5 = $cell5->addTextRun($cellHCentered);
$textrun5->addText('Tax Amount',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered,$cellVCentered)->addText('TAX AMOUNT ',array('bold' => true,'size' => 8));

/*
$cell6 = $table1->addCell(850);
$textrun6 = $cell6->addTextRun($cellHCentered);
$textrun6->addText('SGST/U
TGST(%)',array('bold' => true));  */

$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered,$cellVCentered)->addText('SGST/U
TGST(%)',array('bold' => true,'size' => 8));
/*
$cell7 = $table1->addCell(850);
$textrun7 = $cell7->addTextRun($cellHCentered);
$textrun7->addText('SGST/
UTGST',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered,$cellVCentered)->addText('SGST/
UTGST',array('bold' => true,'size' => 8));

/*
$cell8 = $table1->addCell(850);
$textrun8 = $cell8->addTextRun($cellHCentered);
$textrun8->addText('CGST(%)',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addText('CGST(%)',array('bold' => true,'size' => 8));

/*
$cell9 = $table1->addCell(850);
$textrun9 = $cell9->addTextRun($cellHCentered);
$textrun9->addText('CGST',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addText('CGST',array('bold' => true,'size' => 8));

/*
$cell10 = $table1->addCell(850);
$textrun10 = $cell10->addTextRun($cellHCentered);
$textrun10->addText('AMOUNT',array('bold' => true));  */
$row->addCell(900,array('align' => 'center', 'borderSize' => 13, 'borderColor' => '999999'))->addText('AMOUNT',array('bold' => true,'size' => 8));

//$textrun2->addFootnote()->addText('Column span');
//$table->addCell(800)->addText('E', null, $cellHCentered);

$i=0;
foreach($news1 as $n1)
{ $i++;
   
 $row = $table1->addRow();
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($i);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_lab_code'], $cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_lb_name'],  $cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_rate'], $cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_disc'], $cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_tax_amunt'],$cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_sgst_p'],$cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_sgst_a'], $cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_cgst_p'],$cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_cgst_a'],$cellHCentered);
$row->addCell(900,array('borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellHCentered)->addText($n1['lc_amount'], $cellHCentered);
//\PhpOffice\PhpWord\SimpleType\Jc::CENTER
 }
$row = $table1->addRow();

$row->addCell(850,array('gridSpan'=>5,'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellRCentered)->addText('Total',$cellVCentered);

foreach($news as $n)
{
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText($n['inv_taxtotal'],$cellHCentered,array('bold' => true));
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText();
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText($n['inv_sgstotal'],$cellHCentered,array('bold' => true));
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText();
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText($n['inv_gsttotal'],$cellHCentered,array('bold' => true));
  $row->addCell(850,array('borderSize' => 13, 'borderColor' => '999999'))->addText($n['inv_total'],$cellHCentered,array('bold' => true));
 }  

 $row = $table1->addRow();

  $row->addCell(850,array('gridSpan'=>6,'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellRCentered)->addText('TotalAmount',array('bold' => true));
  foreach($news as $n)
{
   
  $row->addCell(850,array('gridSpan'=>5,'borderSize' => 13, 'borderColor' => '999999'))->addTextRun($cellRCentered)->addText(round($n['inv_total']),array('align'=>'right','bold' => true));
}
 $section->addTextBreak(1);
  $section->addText('Tax amount payable on reverse charges (in Rs.) : Nil',array('bold' =>true,'size'=>9));
   $section->addTextBreak(2);
   $lineStyle1 = array('weight'=>1,'width' =>180,'height' => 0,'align'=>'left','color' => 'black');
    
   $table = $section->addTable();
   $row = $table->addRow(array('exactHeight'=>'atleast'));
   $row->addCell(7000,array('vMerge'=>'restart'));
    $row->addCell(7000,array())->addTextRun($cellRCentered)->addText('SARATHY MOTORS',array());     

    $row = $table->addRow(array('exactHeight'=>'atleast'));
   $row->addCell(7000)->addTextRun($cellLCentered)->addLine($lineStyle1);
    $row->addCell(7000)->addTextRun($cellRCentered)->addLine($lineStyle1);  

    $row = $table->addRow(array('exactHeight'=>'atleast'));
   $row->addCell(7000)->addTextRun($cellLCentered)->addText('Sign of Customer Or His Agent');
    $row->addCell(7000)->addTextRun($cellRCentered)->addText('Sign of Customer Or His Agent');   

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);
       

        // send results to browser to download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');  
        header('Content-Length: ' . filesize($filename));
        flush();
        readfile($filename);
        unlink($filename); // deletes the temporary file
        exit;
    }

   
      
} 
