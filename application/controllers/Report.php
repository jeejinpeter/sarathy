<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller
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
		$this->load->model('Job_model');
		$this->load->model('Jobcard_model');
		
    }



public function list_job_card()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$main_branch= $this->Admin_model->get_branch_main();
			foreach($main_branch as $row)
			{
				$data['id']=$row->b_id;
				$data['name']=$row->branch_name;
				$data['ids']=$row->branch_id;
			}
			$data['branch']= $this->Admin_model->get_branch();
	        $data['labour']= $this->Admin_model->list_labour();
			$data['vehicle_model']= $this->Admin_model->list_customer();
			$from=date('Y-m-d');
			 $data['fromdate']=$from;
			 $to=date('Y-m-d');
			 $data['todate']=$to;
			 $view_by="Custom Date";
			 $data['view_by']=$view_by;
			 $mech=0;
			 $branch=0;
			 $code=0;
			 $advisor=0;
			 $service=0;
			 $data['custom']= $this->Admin_model->list_custom_date_mech($from,$to,$mech,$data['id'],$code,$advisor,$service);
			$data['title']='List JobCard Summary';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_jobcard',$data);
            $this->load->view('Admin/footer');
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
public function list_custom_date()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			  $excel=$this->input->post('excel');
			 $view_by=$this->input->post('view_by');
			 $data['view_by']=$view_by;
			 $mech=$this->input->post('mech');
			 $from=$this->input->post('from');
			 $to=$this->input->post('to');
			$data['fromdate']=$from;
			 $data['todate']=$to;
			$branch=$this->input->post('branch');
			$service=$this->input->post('view_service');
		    $advisor=$this->input->post('advisor');
		    $repair=$this->input->post('repair');
 $ins_company=$this->input->post('ins_company');
	if($excel='EXCEL')
		{
		$this->load->library('excel');	
  $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Jobcard Detailed Report');
           $this->excel->getActiveSheet()->SetCellValue('A3', 'Sl:NO');
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

            $this->excel->getActiveSheet()->mergeCells('B3:C3');
           $this->excel->getActiveSheet()->SetCellValue('B3', 'JOBCARD NO');
            $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);

           $this->excel->getActiveSheet()->SetCellValue('D3', 'JOBCARD DATE');
            $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('F3', 'BRANCH');
            $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('H3', 'MECHANIC');
            $this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('J3', 'ADVISOR');
            $this->excel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('L3', 'MODEL NAME');
            $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('O3', 'HSN/SAC');
            $this->excel->getActiveSheet()->getStyle('O3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Q3', 'REPAIR TYPE');
            $this->excel->getActiveSheet()->getStyle('Q3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('S3', 'INVOICE NUMBER');
            $this->excel->getActiveSheet()->getStyle('S3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('U3', 'INVOICE CUSTOMER');
            $this->excel->getActiveSheet()->getStyle('U3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('W3', 'MOBILE NUMBER');
            $this->excel->getActiveSheet()->getStyle('W3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Y3', 'INVOICE DATE');
            $this->excel->getActiveSheet()->getStyle('Y3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AA3', 'REGISTER NUMBER');
            $this->excel->getActiveSheet()->getStyle('AA3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AC3', 'CHASSIS NUMBER');
            $this->excel->getActiveSheet()->getStyle('AC3')->getFont()->setBold(true);

              $this->excel->getActiveSheet()->SetCellValue('AE3', 'ENGINE NUMBER');
            $this->excel->getActiveSheet()->getStyle('AE3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AG3', 'KM READING');
            $this->excel->getActiveSheet()->getStyle('AG3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AI3', 'INSURANCE COMPANY');
            $this->excel->getActiveSheet()->getStyle('AI3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AL3', 'INSURANCE SERVEYOR');
            $this->excel->getActiveSheet()->getStyle('AL3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AN3', 'PAID SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AN3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AQ3', 'FREE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AQ3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AT3', 'EXPENSE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AT3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AW3', 'CUSTOMER GSTN');
            $this->excel->getActiveSheet()->getStyle('AW3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AY3', 'DISCOUNT');
            $this->excel->getActiveSheet()->getStyle('AY3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AZ3', 'TAXABLE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AZ3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BB3', 'SGST/UGST');
            $this->excel->getActiveSheet()->getStyle('BB3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BD3', 'CGST');
            $this->excel->getActiveSheet()->getStyle('BD3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BE3', 'INVOICE TYPE');
            $this->excel->getActiveSheet()->getStyle('BE3')->getFont()->setBold(true);
			 $this->excel->getActiveSheet()->SetCellValue('BG3', 'INVOICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('BG3')->getFont()->setBold(true);
  $data['list'] = $this->Admin_model->list_custom_date_mech_ins($from,$to,$mech,$branch,$advisor,$service,$repair,$ins_company);
// var_dump($data['list']);die();
$row = 4; // 1-based index
$col = 0;

        $no = 1;
     $hsn=998729;
   $total=0;
    foreach($data['list'] as $key=>$value) {
                   
                       // echo $row . ", ". $col . "<br>";
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$no);
                        $col++;
                       	$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_job_card_no);
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_jcard_date);
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->branch_name);
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->mechni);
                        $col++;$col++;
	$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->advai);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_modl);
                        $col++;$col++;$col++;
$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$hsn);
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->inv_repair_typ);
					    $col++;$col++;
                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_no);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_cus);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_pho);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_inv_date);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->in_registr);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_chassis);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->in_engine);
                        $col++;$col++;
 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_km);
                        $col++;$col++;
$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->icompany_name);
                      $col++;$col++;$col++;
					   $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->insurance_serveyor);
					    $col++;$col++;
                        if($value->lc_type=="Paid Service"){
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_total);
                       $col++;$col++;$col++;$col++;$col++;$col++;$col++;$col++;$col++;
                      }

                      if($value->lc_type=="Free Service"){
						  $col++;$col++;$col++;
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->id_sum);
                       $col++;$col++;$col++;$col++;$col++;$col++;
                      }

                      if($value->lc_type=="Expense"){
						  $col++;$col++;$col++;$col++;$col++;$col++;
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->id_sum);
						 $col++;$col++;$col++;
                      }
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_cus_gstin);
                       $col++;$col++;
				 if($value->lc_type=="Paid Service"){
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_disc_total);
                       $col++;$col++;
				 }else{
					 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,'0');
                     $col++;$col++; 
				 }
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_taxtotal);
                       $col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_sgstotal);
                       $col++;$col++;

                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_gsttotal);
                       $col++;

                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_type);
                       $col++;$col++;
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_total);
                        $row++;$col++;
                        
					//	echo $row . ", ". $col . "<br>";
                        $col = 0;
     $no++;
     
    
      if($value->lc_type=="Paid Service"){
          
				$total+=$value->inv_total;	
				 }else
				 {
				    
					  $total+=$value->id_sum;
				 }
	                  $space="                                                            ";
					  $sum=$space.$space.$space.$space.$space.'Total Invoice Amount:-'.$total.'/-';
                     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$sum);
					 $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
                     $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getFont()->setSize(11);
    }
   	$filename='sarathy_'.mt_rand(1,100000).'.xls';
    if (ob_get_length() > 0) { ob_end_clean(); }
    ob_start(); 
  header('Content-type: application/vnd.ms-excel; charset=UTF-8' ); 
  header('Content-Disposition: attachment;filename="'.$filename.'"');
  header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel,'Excel5');
    $objWriter->save('php://output');
		}
	}
		else {
            redirect('Admin/index', 'refresh');
        }
}
	public function list_previous_bill()
 {
     $data['invo'] = $this->Bill_model->list_invoice_previous();
      $data['title']='Previous Bill(Labour)';
     $this->load->view('Admin/header',$data);
      $this->load->view('Admin/invoice_listt_previous',$data);
      $this->load->view('Admin/footer');
}
public function invoice_pdf($id)
{
$this->load->library('Pdf');	
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

$this->load->view('Staff/tax_previous_bill_pdf',$data);
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
public function list_job_card_statement()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$main_branch= $this->Admin_model->get_branch_main();
			foreach($main_branch as $row)
			{
				$data['id']=$row->b_id;
				$data['name']=$row->branch_name;
				$data['ids']=$row->branch_id;
			}
			 $data['branch']= $this->Admin_model->get_branch();
	         $data['labour']= $this->Admin_model->list_labour();
			 $data['vehicle_model']= $this->Admin_model->list_customer();
			 $from=date('Y-m-d');
			 $data['fromdate']=$from;
			 $to=date('Y-m-d');
			 $data['todate']=$to;
			 $view_by="Custom Date";
			 $data['view_by']=$view_by;
			 $mech=0;
			 $branch=0;
			 $code=0;
			 $advisor=0;
			 $service=0;
			 $repair=0;
			 $data['custom']= $this->Admin_model->list_job_card_statement($from,$to,$mech,$data['id'],$code,$advisor,$service,$repair);
			 $data['title']='Job Card Bill Statement';
            $this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_jobcard_statement',$data);
            $this->load->view('Admin/footer');
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
public function list_job_card_statement_proccessing()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$excel=$this->input->post('excel');
			$mech=$this->input->post('mech');
			$repair=$this->input->post('repair');
			$branch=$this->input->post('branch');
			$service=$this->input->post('view_service');
			$ins_company=$this->input->post('ins_company');
			$code=$this->input->post('code');
		    $advisor=$this->input->post('advisor');
			$from = $this->input->post('from');
            $to = $this->input->post('to');
			$data['fromdate']=$from;
			$data['todate']=$to;
		if($excel='EXCEL')
		{
		$this->load->library('excel');
  $this->excel->setActiveSheetIndex(0);
           $this->excel->getActiveSheet()->setTitle('Jobcard Detailed Report');
           $this->excel->getActiveSheet()->SetCellValue('A3', 'Sl:NO');
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

            $this->excel->getActiveSheet()->mergeCells('B3:C3');
           $this->excel->getActiveSheet()->SetCellValue('B3', 'JOBCARD NO');
            $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);

           $this->excel->getActiveSheet()->SetCellValue('D3', 'JOBCARD DATE');
            $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(11);
           $this->excel->getActiveSheet()->SetCellValue('F3', 'BRANCH');
            $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('H3', 'LABOUR CODE');
            $this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('J3', 'MECHANIC');
            $this->excel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
			
           $this->excel->getActiveSheet()->SetCellValue('L3', 'ADVISOR');
            $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);	
           $this->excel->getActiveSheet()->SetCellValue('N3', 'HSN/SAC');
            $this->excel->getActiveSheet()->getStyle('N3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('O3', 'MODEL NAME');
            $this->excel->getActiveSheet()->getStyle('O3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Q3', 'INVOICE NUMBER');
            $this->excel->getActiveSheet()->getStyle('Q3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('S3', 'INVOICE CUSTOMER');
            $this->excel->getActiveSheet()->getStyle('S3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('U3', 'MOBILE NUMBER');
            $this->excel->getActiveSheet()->getStyle('U3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('W3', 'INVOICE DATE');
            $this->excel->getActiveSheet()->getStyle('W3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('Y3', 'REGISTER NUMBER');
            $this->excel->getActiveSheet()->getStyle('Y3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AA3', 'CHASSIS NUMBER');
            $this->excel->getActiveSheet()->getStyle('AA3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->SetCellValue('AC3', 'ENGINE NUMBER');
            $this->excel->getActiveSheet()->getStyle('AC3')->getFont()->setBold(true);

              $this->excel->getActiveSheet()->SetCellValue('AE3', 'KM READING');
            $this->excel->getActiveSheet()->getStyle('AE3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AG3', 'REPAIR TYPE');
            $this->excel->getActiveSheet()->getStyle('AG3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AI3', 'BILL TYPE');
            $this->excel->getActiveSheet()->getStyle('AI3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AJ3', 'INSURANCE COMPANY');
            $this->excel->getActiveSheet()->getStyle('AJ3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AM3', 'PAID SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AM3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AP3', 'FREE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AP3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AS3', 'EXPENSE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AS3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AV3', 'CUSTOMER GSTN');
            $this->excel->getActiveSheet()->getStyle('AV3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AX3', 'DISCOUNT');
            $this->excel->getActiveSheet()->getStyle('AX3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AY3', 'TAXABLE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AY3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BA3', 'INVOICE TYPE');
            $this->excel->getActiveSheet()->getStyle('BA3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BB3', 'INVOICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('BB3')->getFont()->setBold(true);
 
  $data['list'] = $this->Admin_model->list_job_card_statement_ins($from,$to,$mech,$branch,$code,$advisor,$service,$repair,$ins_company);
$row = 4; // 1-based index
$col = 0;
$no = 1;  
$count = 0;
$lcdisc=0;
$taxtot=0;
$total=0;
    foreach($data['list'] as $key=>$value) {
        $count+=1;
   $lcdisc+=$value->lc_disc;
		    $taxtot+=$value->lc_tax_amunt;
                   
                       // echo $row . ", ". $col . "<br>";
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$no);
                        $col++;
               
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_job_card_no);
                        
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_jcard_date);
                        $col++;$col++;
						
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->branch_name);
                        $col++;$col++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_lb_name);
                        $col++;$col++;

                       	$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->mechni);
                        $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->advai);
                        $col++;$col++;

                     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,'998729');
                         $col++;
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_modl);
                        $col++;$col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_no);
                        $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_cus);
                        $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_pho);
                        $col++;$col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_inv_date);
                        $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->in_registr);
                        $col++;$col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_chassis);
                        $col++;$col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->in_engine);
                        $col++;$col++;


                          $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_km);
                        $col++;$col++; 

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_repair_typ);
                        $col++;$col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_type);
                         $col++;

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->icompany_name);
                      $col++;$col++; $col++;
		$status = ($value->lc_type== 'Paid Service')?	$value->lc_amount:'0';
		$status1 = ($value->lc_type== 'Free Service')?	$value->lc_rate:'0';
		$status2 = ($value->lc_type== 'Expense')?	$value->lc_rate:'0';
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status);
                        $col++; $col++;$col++;
						 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status1);
                         $col++; $col++; $col++;
						 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status2);
                         $col++;$col++; $col++;
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_cus_gstin);
                       $col++;$col++;

                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_disc);
                       $col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_tax_amunt);
                       $col++;$col++;

                       
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_type);
                       $col++;


                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_amount);
                       $row++;$col++;
 
                      //  echo $row . ", ". $col . "<br>";
                        $col = 0;
						
     $no++;
	 if($value->lc_type=="Paid Service"){
				$total+=$value->lc_amount;	
				 }else
				 {
					  $total+=$value->lc_rate;
				 }
    }
	                  $space="                                                            ";
					  $sums=$space.$space.$space.'No.of Labour Codes:-'.$count.'';
					   $sumtax=$space.$space.$space.'Total Taxable Amount:-'.$taxtot.'/-';
					    $sumdisc=$space.$space.$space.'Total Discount Amount:-'.$lcdisc.'/-';
						 $sum=$space.$space.$space.'Total Invoice Amount:-'.$total.'/-';
                     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $sumdisc);
					 $row++;
					 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$sums);
					 $row++;
					 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$sumtax);
					 $row++;
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$sum);
					 $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
                     $this->excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getFont()->setSize(11);

                      

	  
   		$filename='sarathy_'.mt_rand(1,100000).'.xls'; //just some random filename
        if (ob_get_length() > 0) { ob_end_clean(); }
    ob_start(); 
  header('Content-type: application/vnd.ms-excel; charset=UTF-8' ); 
  header('Content-Disposition: attachment;filename="'.$filename.'"');
  header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel,'Excel5');
    $objWriter->save('php://output');
		}
	}
		else {
            redirect('Admin/index', 'refresh');
        }
}
public function list_previous_bill_insurance()
 {
      $data['invo'] = $this->Bill_model->list_invoice_previous_insurance();
       $data['title']='Previous Bill(Insurance)';
     $this->load->view('Admin/header',$data);
      $this->load->view('Admin/invoice_listt_previous_insurance',$data);
      $this->load->view('Admin/footer');
}	
public function invoice_pdf_insurance($id)
{
$this->load->library('Pdf');	
$data['cust'] = $this->Bill_model->view_invoice_customer_insurance_query($id);
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

$this->load->view('Staff/tax_invo_prev_insur_bill_pdf',$data);
}
public function select_mechanic()
	   {
		   $branch_id= $_POST["branchno1"]; 
		   $branch = $this->Bill_model->select_mech_by_brnch($branch_id);		   
		   echo json_encode($branch);
		 
		 }
		  public function select_advisor()
	   {
		   $branch_id= $_POST["branchno2"]; 
		   $branch = $this->Bill_model->select_advi_by_brnch($branch_id);	   
		  echo json_encode($branch);
		 
		 }
	 public function jobcard_datesorting()
	   {
		   $view_by= $_POST["view_by"]; 
		   $fromdate= $_POST["fromdate"];	   
		   $fromdate1= date('Y-m-d');	   
		   	 if($view_by=='Custom Date'){
				$data['fromdate']=$fromdate;
			$data['todate']=$_POST["todate"];
			$data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			$from=$data['fromdate'];
			$to=$data['todate'];
			 }
			 elseif($view_by=='Month to date')
			 {
			 $data['fromdate']=date('Y-m-01');
			 $data['todate']=date('Y-m-d'); 
			 $from=$data['fromdate'];
			 $to=$data['todate'];
			$data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			 }
			  elseif($view_by=='Previous Month')
			 {
				$to=date('Y-m-d');
$to1=date('Y-m-01', strtotime('-1 month'));
$to2=explode('-',$to1);
if($to2[1]=='01')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='02')
{
    $to=date('Y-m-28', strtotime('-1 month'));
}
elseif($to2[1]=='03')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='04')
{
    $to=date('Y-m-30', strtotime('-1 month'));
}
elseif($to2[1]=='05')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='06')
{
    $to=date('Y-m-30', strtotime('-1 month'));
}
elseif($to2[1]=='07')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='08')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='09')
{
    $to=date('Y-m-30', strtotime('-1 month'));
}
elseif($to2[1]=='10')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
elseif($to2[1]=='11')
{
    $to=date('Y-m-30', strtotime('-1 month'));
}
elseif($to2[1]=='12')
{
    $to=date('Y-m-31', strtotime('-1 month'));
}
             	$from=date('Y-m-01', strtotime('-1 month'));
              $data['fromdate']=$from;
		     $data['todate']=$to;
			 $data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			 }
			  elseif($view_by=='Previous Year')
			 {
			 $from1 = date('Y', strtotime('-1 years'));
			 $to=$from1.'-12-31';
			 $from=$from1.'-01-01';
			 $data['todate']=$to;
			 $data['fromdate'] = $from;
			 $data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			 }
			 elseif($view_by=='Year to Date')
			 {
			 $data['fromdate']=date('Y-01-01');
			 $data['todate']=date('Y-m-d'); 
			 $from=$data['fromdate'];
			 $to=$data['todate'];
			 $data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			 }
			else
			{
			$from=date('Y-m-d');
			$data['fromdate']=$from;
			$to=date('Y-m-d');
			$data['todate']=$to;
			$data['view']=$view_by;
			$data['cur_date']=$fromdate1;
			}
			$return_value= array('from'=>$data['fromdate'],'to'=>$data['todate'],'viewby'=>$data['view'],'cur_date'=>$data['cur_date']);
			echo json_encode($return_value);

		 }
	 public function ajax_list()
	{
		$list = $this->Job_model->get_datatables();
		//$count = $this->Job_model->get_count_lcode();
		$count = $this->Job_model->count_filtered();
		$data = array();
		$no = $_POST['start'];
		$a = array();
		 foreach($list as $row)  
           {  
                $sub_array = array();
				if($row->lc_type=="Paid Service"){
				$total=$row->lc_amount;	
				 }else
				 {
					  $total=$row->lc_rate;
				 }
	$totals=$row->lc_disc;
	$totaltax=$row->lc_tax_amunt;
 $sub_array[]='<input type="hidden" class="lc_code" value="'.$count.'"><input type="hidden" class="lc_amt" value="'.$total.'"><input type="hidden" class="lc_disc" value="'.$totals.'"><input type="hidden" class="lc_tax" value="'.$totaltax.'"><a style="font-size:11px;" href="'.base_url().'Admin/edit_jobcard/'.$row->inv_id.'">'.$row->inv_job_card_no.'</a>';						
                //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';
						
                $sub_array[] = $row->inv_jcard_date;  
                $sub_array[] = $row->branch_name.'('.$row->branch_id.')';  
				$sub_array[] = $row->lc_lb_name.'('.$row->lc_lab_code.')'; 
				$mech_id= $row->inv_mechna;
				if(!empty($mech_id))
				{
				$mech_name= $this->Job_model->get_name($mech_id);
				$sub_array[]=$mech_name;	
				}					
				else{
				$sub_array[]='';	
				}
                $adv_id = $row->inv_advisername;
				if(!empty($adv_id))
				{
				$adv_name= $this->Job_model->get_name($adv_id);
				$sub_array[]=$adv_name;	
				}					
				else{
				$sub_array[]='';	
				}
                $sub_array[] = $row->inv_repair_typ;  
                $sub_array[] = $row->icompany_name;  
				$sub_array[] = $row->inv_modl; 
				$sub_array[] = '998729'; 
                $sub_array[] = $row->inv_no;  
                $sub_array[] = $row->inv_cus;  
                $sub_array[] = $row->inv_pho;  
				$sub_array[] = $row->inv_inv_date; 
				$sub_array[] = $row->in_registr;  
				$sub_array[] = $row->inv_chassis;  
				$sub_array[] = $row->in_engine; 
				$sub_array[] = $row->inv_km;  
                $sub_array[] =($row->lc_type== 'Paid Service')?	$row->lc_amount:'0';
				$sub_array[] =($row->lc_type== 'Free Service')?	$row->lc_rate:'0';  
				$sub_array[] =($row->lc_type == 'Expense')? $row->lc_rate:'0'; 				
                $sub_array[] = $row->inv_cus_gstin;  
				$sub_array[] = $row->lc_disc;  
                $sub_array[] = $row->lc_tax_amunt;  
                $sub_array[] = $row->inv_type;  				
                $sub_array[] = $row->lc_amount;  				
                $data[] = $sub_array;  
           } 
		   
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Job_model->count_all(),
						"recordsFiltered" => $this->Job_model->count_filtered(),
						"data" => $data
				);
		//output to json format
		
		echo json_encode($output);
		
	} 
public function ajax_job_list()
	{
		$list = $this->Jobcard_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=0;
		 foreach($list as $index=>$row)  
           {  
		   $id_sum = $this->Jobcard_model->get_datatables2();
                $sub_array = array();
				 if($row->lc_type=="Paid Service"){
				 $total=$row->inv_total;
				 }
				 else
				 {
					  $total=$id_sum[$i]['id_sum'];
				 }
				  if($row->lc_type=="Paid Service"){
				$totals=$row->inv_disc_total;	
				 }
				 else
				 {
					  $totals=0;
				 }
	$totaltax=$row->inv_taxtotal;
	$totalsgst=$row->inv_sgstotal;
	$totalgst=$row->inv_gsttotal;
 $sub_array[]='<input type="hidden" class="lc_amt" value="'.$total.'"><input type="hidden" class="lc_disc" value="'.$totals.'"><input type="hidden" class="lc_tax" value="'.$totaltax.'"><input type="hidden" class="lc_sgst" value="'.$totalsgst.'"><input type="hidden" class="lc_gst" value="'.$totalgst.'"><a style="font-size:11px;" href="'.base_url().'Admin/edit_jobcard/'.$row->inv_id.'">'.$row->inv_job_card_no.'</a>';

                //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';
						
                $sub_array[] = $row->inv_jcard_date;  
                $sub_array[] = $row->branch_name.'('.$row->branch_id.')';  
				$mech_id= $row->inv_mechna;
				if(!empty($mech_id))
				{
				$mech_name= $this->Jobcard_model->get_name($mech_id);
				$sub_array[]=$mech_name;	
				}					
				else{
				$sub_array[]='';	
				}
                $adv_id = $row->inv_advisername;
				if(!empty($adv_id))
				{
				$adv_name= $this->Jobcard_model->get_name($adv_id);
				$sub_array[]=$adv_name;	
				}					
				else{
				$sub_array[]='';	
				}
				$sub_array[] = $row->inv_repair_typ;
				$sub_array[] = $row->icompany_name;  
				$sub_array[] = $row->inv_modl; 
				$sub_array[] = '998729'; 
				 $sub_array[] = $row->inv_no;  
                $sub_array[] = $row->inv_cus;  
                $sub_array[] = $row->inv_pho;  
				$sub_array[] = $row->inv_inv_date; 
				$sub_array[] = $row->in_registr;  
				$sub_array[] = $row->inv_chassis;  
				$sub_array[] = $row->in_engine; 
				$sub_array[] = $row->inv_km;  
                $sub_array[] = $row->insurance_serveyor;  
                $sub_array[] =($row->lc_type== 'Paid Service')?	$row->inv_total:'0';
				$sub_array[] =($row->lc_type== 'Free Service')?	$id_sum[$i]['id_sum']:'0';  
				$sub_array[] =($row->lc_type == 'Expense')? 	$id_sum[$i]['id_sum']:'0';	
                $sub_array[] = $row->inv_cus_gstin;  
				$sub_array[] = ($row->lc_type== 'Paid Service')?	$row->inv_disc_total:'0';;  
                $sub_array[] = $row->inv_taxtotal;  
                $sub_array[] = $row->inv_sgstotal;  
                $sub_array[] = $row->inv_gsttotal;  
                $sub_array[] = $row->inv_type;  				
                $sub_array[] = $row->inv_total;
                $data[] = $sub_array; 
                $i++;  					
           } 
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Job_model->count_all(),
						"recordsFiltered" => $this->Job_model->count_filtered(),
						"data" => $data
				);
		//output to json format
	
		echo json_encode($output);
		
	}
	public function select_ins_company()
     {
       $branch_id= $_POST["branchno3"]; 
       $branch = $this->Bill_model->select_company_by_brnch($branch_id);    
       //var_dump( $branch);die();
      echo json_encode($branch);
     
     }
	
}
