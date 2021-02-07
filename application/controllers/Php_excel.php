<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Php_excel extends CI_Controller
{
    public function __construct()
    {
        @date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model('User_model');
        $this->load->model('Bill_model');
    $this->load->model('Admin_model');
    
    }
     public function candidate_excel($id)
         {
              //var_dump($id); die();
           $this->load->library('Excel');
             //$result = $this->Candidate_model->getCandidate_excel($id);
           $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Jobcard Details');
           $this->excel->getActiveSheet()->SetCellValue('A3', 'Sl:NO');
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('B3', 'JOBCARD NO');
            $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('D3', 'JOBCARD DATE');
            $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('F3', 'INVOICE NO');
            $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('H3', 'INVOICE DATE');
            $this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('J3', 'REGISTRATION NO');
            $this->excel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('L3', 'CUSTOMER NAME');
            $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('O3', 'MOBILE NO');
            $this->excel->getActiveSheet()->getStyle('O3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Q3', 'CUSTOMER GSTIN');
            $this->excel->getActiveSheet()->getStyle('Q3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('S3', 'MODEL NAME');
            $this->excel->getActiveSheet()->getStyle('S3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('U3', 'KM READING');
            $this->excel->getActiveSheet()->getStyle('U3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('W3', 'REPAIR TYPE');
            $this->excel->getActiveSheet()->getStyle('W3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Y3', 'ADVISOR NAME');
            $this->excel->getActiveSheet()->getStyle('Y3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AA3', 'MECHANIC NAME');
            $this->excel->getActiveSheet()->getStyle('AA3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AC3', 'BRANCH NAME');
            $this->excel->getActiveSheet()->getStyle('AC3')->getFont()->setBold(true);

           $this->excel->getActiveSheet()->setCellValue('H1','Jobcard & Invoice Details');
              $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(19);
              $this->excel->getActiveSheet()->getStyle('H1')->getFill()->getStartColor()->setARGB('#333');

              $this->excel->getActiveSheet()->SetCellValue('A11', 'Sl:NO');
            $this->excel->getActiveSheet()->getStyle('A11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('B11', 'LABOUR CODE');
            $this->excel->getActiveSheet()->getStyle('B11')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('B11')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('D11', 'LABOUR NAME');
            $this->excel->getActiveSheet()->getStyle('D11')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('D11')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('F11', 'RATE');
            $this->excel->getActiveSheet()->getStyle('F11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('G11', 'DISCOUNT');
            $this->excel->getActiveSheet()->getStyle('G11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('H11', 'TAX');
            $this->excel->getActiveSheet()->getStyle('H11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('I11', 'UTGST(%)');
            $this->excel->getActiveSheet()->getStyle('I11')->getFont()->setBold(true);
             $this->excel->getActiveSheet()->SetCellValue('J11', 'UTGST');
            $this->excel->getActiveSheet()->getStyle('J11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('K11', 'CGST(%)');
            $this->excel->getActiveSheet()->getStyle('K11')->getFont()->setBold(true);
             $this->excel->getActiveSheet()->SetCellValue('L11', 'CTGST');
            $this->excel->getActiveSheet()->getStyle('L11')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('M11', 'AMOUNT');
            $this->excel->getActiveSheet()->getStyle('M11')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->SetCellValue('G16', 'TOTAL');
            $this->excel->getActiveSheet()->getStyle('G16')->getFont()->setBold(true);
           
              $this->excel->getActiveSheet()->setCellValue('H9','Tax Invoice');
              $this->excel->getActiveSheet()->getStyle('H9')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('H9')->getFont()->setSize(19);
              $this->excel->getActiveSheet()->getStyle('H9')->getFill()->getStartColor()->setARGB('#333');
        $rs=$this->Bill_model->view_jobcard_excel($id);
        $row = 5;
$col = 0;
$no = 1;  $i=1; 
        foreach($rs as $value) 
        {
          
          //echo $row . ", ". $col . "<br>";
            //$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$no);
                       // $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $i++);
                        $col++;
                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_job_card_no']);
                        $col++; $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_jcard_date']);
                        $col++; $col++;
          $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value['inv_no']);
                        $col++;$col++; 
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_inv_date']);
                        $col++; $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['in_registr']);
                       $col++; $col++;
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_cus']);
                        $col++; $col++; $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_pho']);
                        $col++; $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_cus_gstin']);
                        $col++; $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_modl']);
                        $col++; $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_km']);
                        $col++;$col++; 
          $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['inv_repair_typ']);
                        $col++; $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['adviser']);
                        $col++;$col++;  
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['mechanic']);
                        $col++; $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['branch_name']);
                        $col++; $col++;

        }
         $rs1=$this->Bill_model->view_tax_excel($id);


          $row = 13;

$no = 1;  $i=1; $a=0;$b=0;$c=0;$d=0;
        foreach($rs1 as $val) 
        {
          $col = 0;
          $a+=$val['lc_tax_amunt'];
          $b+=$val['lc_sgst_a'];
          $c+=$val['lc_cgst_a'];
          $d+=$val['lc_amount'];
          //echo $row . ", ". $col . "<br>";
            //$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$no);
                       // $col++;
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $i++);
                        $col++;
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_lab_code']);
                        $col++; $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_lb_name']);
                        $col++; $col++;
          $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$val['lc_rate']);
                        $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_disc']);
                        $col++; 
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_tax_amunt']);
                       $col++; 
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_sgst_p']);
                        $col++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_sgst_a']);
                        $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_cgst_p']);
                        $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_cgst_a']);
                        $col++;
         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val['lc_amount']);
                        $col++;
          $row++;

        }
       $this->excel->getActiveSheet()->setCellValue('H16',$a);
        $this->excel->getActiveSheet()->getStyle('H16')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->setCellValue('J16',$b);
        $this->excel->getActiveSheet()->getStyle('J16')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->setCellValue('L16',$c);
        $this->excel->getActiveSheet()->getStyle('L16')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('M16',$d);
        $this->excel->getActiveSheet()->getStyle('M16')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $this->excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle('Y5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $filename=mt_rand(1,100000).'.xls'; //just some random filename
        ob_clean();
    ob_start(); 
  header('Content-type: application/vnd.ms-excel; charset=UTF-8' ); 
  header('Content-Disposition: attachment;filename="'.$filename.'"');
  header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel,'Excel5');
    $objWriter->save('php://output');
  }


}