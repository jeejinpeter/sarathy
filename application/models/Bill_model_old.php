<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bill_model extends CI_Model {
  public function __construct()
   {
               parent::__construct();
   }
   
   public function view_invoice_listing_prev($id)
 {
     $this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result_array();
return $query;
 }
   	public function invoice_dtls_ready_new_previous($form_data,$data,$invid)
 {
		$this->db->where('inv_id',$invid);
	    $res = $this->db->update('tbl_invoice_labour',$data);	
		if($res){
			$last_id = $invid;
			$lab_code=$form_data['lc'];
			$lab_name=$form_data['lna'];
			$lab_rate=$form_data['lrate'];
			$jb_type=$form_data['jb_ty'];
			$disc=$form_data['ldisc'];
			$discp=$form_data['ldis'];
			$tax=$form_data['ltax'];
			$sgstp=$form_data['lugstp'];
			$sgst=$form_data['lugst'];
			$cgstp=$form_data['lcgstp'];
			$cgst=$form_data['lcgst'];
			$amt=$form_data['lamt'];
			$sacode=$form_data['sacd'];
			 $insert_invoic=[];
			 $result = array_filter($lab_code); 
			foreach($result as $key => $value)
			{
			$insert_invoic[$key]=
				array(
				'ic_inv_id'=>$last_id,
				'lc_lab_code'=>$lab_code[$key],
				'lc_lb_name'=>$lab_name[$key], 
				'lc_rate'=>$lab_rate[$key],
				'lc_type'=>$jb_type[$key],
				'lc_disc_p'=>$discp[$key],
				'lc_disc'=>$disc[$key],
				'lc_tax_amunt'=>$tax[$key],
				'lc_sgst_p'=>$sgstp[$key],
				'lc_sgst_a'=>$sgst[$key],
				'lc_cgst_p'=>$cgstp[$key],
				'lc_cgst_a'=>$cgst[$key],
				'lc_amount'=>$amt[$key],
				'lc_sacode'=>$sacode[$key]
			);	
			
   }
     $this->db->where('ic_inv_id',$invid);
 	 $query1=$this->db->delete('tbl_invoice_labour_cost');	
   	 $query=$this->db->insert_batch('tbl_invoice_labour_cost', $insert_invoic);
		if($query)
		{
			return $last_id;
		}
			
		}
 }
    public function invoice_dtls_ready($form_data,$data)
 {
	 	$res=$this->db->insert('tbl_invoice_labour', $data);	
		if($res){
			$last_id = $this->db->insert_id();
			$lab_code=$form_data['lc'];
			$lab_name=$form_data['lna'];
			$lab_rate=$form_data['lrate'];
			$jb_type=$form_data['jb_ty'];
			$disc=$form_data['ldisc'];
			$discp=$form_data['ldis'];
			$tax=$form_data['ltax'];
			$sgstp=$form_data['lugstp'];
			$sgst=$form_data['lugst'];
			$cgstp=$form_data['lcgstp'];
			$cgst=$form_data['lcgst'];
			$amt=$form_data['lamt'];
			$sacode=$form_data['sacd'];
			 $insert_invoic=[];
			 $result = array_filter($lab_code); 
			
			
			foreach($result as $key => $value)
			{
			$insert_invoic[$key]=
				array(
				'ic_inv_id'=>$last_id,
				'lc_lab_code'=>$lab_code[$key],
				'lc_lb_name'=>$lab_name[$key], 
				'lc_rate'=>$lab_rate[$key],
				'lc_type'=>$jb_type[$key],
				'lc_disc_p'=>$discp[$key],
				'lc_disc'=>$disc[$key],
				'lc_tax_amunt'=>$tax[$key],
				'lc_sgst_p'=>$sgstp[$key],
				'lc_sgst_a'=>$sgst[$key],
				'lc_cgst_p'=>$cgstp[$key],
				'lc_cgst_a'=>$cgst[$key],
				'lc_amount'=>$amt[$key],
				'lc_sacode'=>$sacode[$key]
			);	
			
   }
 
		
		
   	$query=$this->db->insert_batch('tbl_readyfor_bill', $insert_invoic);
		if($query)
		{
			return $last_id;
		}
			
		}
 }
 public function Select_labour()
 {
$this->db->select('*');
$this->db->from('tbl_labour_code');
$query = $this->db->get()->result_array();
return $query;	 
 } 
 public function invoice_dtls($form_data,$data)
 {
	 	$res=$this->db->insert('tbl_invoice_labour', $data);	
		if($res){
			$last_id = $this->db->insert_id();
			$lab_code=$form_data['lc'];
			$lab_name=$form_data['lna'];
			$lab_rate=$form_data['lrate'];
			$jb_type=$form_data['jb_ty'];
			$disc=$form_data['ldisc'];
			$discp=$form_data['ldis'];
			$tax=$form_data['ltax'];
			$sgstp=$form_data['lugstp'];
			$sgst=$form_data['lugst'];
			$cgstp=$form_data['lcgstp'];
			$cgst=$form_data['lcgst'];
			$amt=$form_data['lamt'];
			$sacode=$form_data['sacd'];
			 $insert_invoic=[];
			 $result = array_filter($lab_code); 
			
			
			foreach($result as $key => $value)
			{
			$insert_invoic[$key]=
				array(
				'ic_inv_id'=>$last_id,
				'lc_lab_code'=>$lab_code[$key],
				'lc_lb_name'=>$lab_name[$key], 
				'lc_rate'=>$lab_rate[$key],
				'lc_type'=>$jb_type[$key],
				'lc_disc_p'=>$discp[$key],
				'lc_disc'=>$disc[$key],
				'lc_tax_amunt'=>$tax[$key],
				'lc_sgst_p'=>$sgstp[$key],
				'lc_sgst_a'=>$sgst[$key],
				'lc_cgst_p'=>$cgstp[$key],
				'lc_cgst_a'=>$cgst[$key],
				'lc_amount'=>$amt[$key],
				'lc_sacode'=>$sacode[$key]
			);	
			
   }
   	$query=$this->db->insert_batch('tbl_invoice_labour_cost', $insert_invoic);
		if($query)
		{
			return $last_id;
		}
			
		}
 }
 public function list_invoice(){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.ready_status',1);
$this->db->where('tbl_invoice_labour.status',0);
$query = $this->db->get()->result();
return $query;		
 }
 public function list_jobcard()
 {
 	$this->db->select('*, e1.e_first_name AS adviser, e2.e_first_name AS mechanic', false);
    $this->db->from('tbl_invoice_labour');
    $this->db->join(' tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
	   $this->db->join(' tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
    $query = $this->db->get()->result();
      return $query;	
 }

  public function list_jobcard_invoice()
  {
	$this->db->select('*, e1.e_first_name AS adviser, e2.e_first_name AS mechanic', false);
	 $this->db->from('tbl_invoice_labour');
	 $this->db->join(' tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
	   $this->db->join(' tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
     $query = $this->db->get()->result();
      return $query;

  } 
 
 
 
 
 public function view_invoice($id)
 {
 
$this->db->select('*');
$this->db->from('tbl_readyfor_bill');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result_array();
return $query;
 }
  public function view_invoice1($id)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$this->db->where('lc_type',"Paid Service");
$query = $this->db->get()->result();
return $query;	 
 }
 public function view_invoice_listing($id)
 {
     $this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result();
return $query;
 }
  public function view_invoice_customer($id)
 {
$this->db->select('*,b1.*,e1.e_first_name as advai,e2.e_first_name as mechni,e1.emp_id as advai_id,e2.emp_id as mechni_id');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch b1', "b1.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->where('inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }
 
   public function view_invoice_labour_details($id)
 {
$this->db->select('*');
$this->db->from('tbl_labour_code');
$this->db->where('labour_code',$id);
$query = $this->db->get()->result();
return $query;	 
 }
 public function Select_adviser()
 {
$this->db->select('*');
$this->db->from('tbl_employee');
$this->db->where('e_designation',"Service Advisor");
$query = $this->db->get()->result();
return $query;	 
 }
  public function Select_mechni()
 {
$this->db->select('*');
$this->db->from('tbl_employee');
$this->db->where('e_designation',"Mechanic");
$query = $this->db->get()->result();
return $query;	 
 }
 public function Select_branch()
 {
	$this->db->select('*');
$this->db->from('tbl_branch');
$query = $this->db->get()->result();
return $query; 
 }
  public function get_last_autoserial()
    {        
        $this->db->select_max('inv_no');
        $this->db->from('tbl_invoice_labour');
      $query = $this->db->get()->result();
	  if($query[0]->inv_no)
	  {
		  $p=$query[0]->inv_no; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  }
    
    }
	public function get_mx_invoice()
    {        
        $this->db->select_max('inv_id');
        $this->db->from('tbl_invoice_labour');
      $query = $this->db->get()->result();
	  if($query[0]->inv_id)
	  {
		  $p=$query[0]->inv_id; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  }
    
    }
	public function get_mx_invoice2($id)
    {        
        $this->db->select('inv_no');
        $this->db->from('tbl_invoice_labour');
		$this->db->where('inv_id',$id);
      $query = $this->db->get()->result();
	  if($query[0]->inv_no)
	  {
		  $p=$query[0]->inv_no; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  }
    
    }
 	 public function get_branch_id($id)
 {
  $this->db->select('branch_id');
        $this->db->from('tbl_branch');
		$this->db->where('b_id',$id);
      $query = $this->db->get()->result();
	  if($query[0]->branch_id)
	  {
		  $p=$query[0]->branch_id; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  } 
 }
public function check_registration($reg){

  	$this->db->select('*');
	$this->db->where('c_reg_no',$reg);
    $q= $this->db->get('customer_details');
	return  $q->result_array();
	
  		 }
public function insert_customer_dtls($cust)
{
	return $this->db->insert('customer_details',$cust);
}
public function get_staff_branch()
{
	$this->db->select('*');
	$this->db->where('emp_login_id',$_SESSION['login_id']);
    $this->db->join('tbl_branch', "tbl_branch.branch_name = tbl_employee.e_branch",'left');
    $query= $this->db->get('tbl_employee')->result();
	
	 if($query)
	  {
		  $p=$query[0]->branch_id; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  } 
}
public function branch_name_select()
{
	$this->db->select('*');
	$this->db->where('emp_login_id',$_SESSION['login_id']);
    $query= $this->db->get('tbl_employee')->result();
	if($query)
	  {
		  $p=$query[0]->e_branch; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  } 
}
public function branch_name_select_id()
{
	$this->db->select('*');
	$this->db->where('emp_login_id',$_SESSION['login_id']);
	$this->db->join('tbl_branch', "tbl_branch.branch_name = tbl_employee.e_branch",'left');
    $query= $this->db->get('tbl_employee')->result();
	if($query)
	  {
		  $p=$query[0]->b_id; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  } 
}
public function Select_adviser_branch($data)
 {
	 
$this->db->select('*');
$this->db->from('tbl_employee');
$this->db->where('e_branch',$data);
$this->db->where('e_designation',"Service Advisor");
$query = $this->db->get()->result();
return $query;	 
 }
  public function Select_mechni_branch($data)
 {
$this->db->select('*');
$this->db->from('tbl_employee');
$this->db->where('e_branch',$data);
$this->db->where('e_designation',"Mechanic");
$query = $this->db->get()->result();
return $query;	 
 }
  public function view_invoice_customer_insurance($id)
 {
$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni,e1.emp_id as advai_id,e2.emp_id as mechni_id');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->join('tbl_insurance_company', "tbl_insurance_company.com_id = tbl_invoice_labour.insurance_id",'left');
$this->db->where('tbl_invoice_labour.status',1);
$this->db->where('inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }
public function view_jobcard_excel($id)
 {
$this->db->select('*, e1.e_first_name AS adviser, e2.e_first_name AS mechanic', false);
$this->db->from('tbl_invoice_labour');
$this->db->join(' tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join(' tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
	   $this->db->join(' tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->where('inv_id',$id);
$query = $this->db->get();
 return $query->result_array();	 
 }
 public function view_tax_excel($id)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result_array();
return $query;	 
 } 
 public function view_jobcard_word($id) 
   {
       $this->db->select('*, e1.e_first_name AS adviser, e2.e_first_name AS mechanic', false);
       $this->db->from('tbl_invoice_labour');
       $this->db->join(' tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
      $this->db->join(' tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
	   $this->db->join(' tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
      $this->db->where('inv_id',$id);
      $query = $this->db->get();
      return $query->result_array();	 
    }
 public function view_tax_word($id)
 {
    $this->db->select('*');
    $this->db->from('tbl_invoice_labour_cost');
    $this->db->where('ic_inv_id',$id);
     $query = $this->db->get()->result_array();
     return $query;	 
 }
  public function update_ready_customer($data,$id)
	{
	$this->db->where('inv_id',$id);
	return $query = $this->db->update('tbl_invoice_labour',$data);
	}
public function select_mech_by_brnch($branch_id)
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
    $this->db->join('tbl_branch', "tbl_branch.branch_name = tbl_employee.e_branch",'left');
	$this->db->where('tbl_branch.b_id',$branch_id);
	$this->db->where('tbl_employee.e_designation',"Mechanic");
	$this->db->where('tbl_employee.status',"active");
    $query = $this->db->get()->result();
	return $query;	 
	}
	public function select_advi_by_brnch($branch_id)
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
    $this->db->join('tbl_branch', "tbl_branch.branch_name = tbl_employee.e_branch",'left');
	$this->db->where('tbl_branch.b_id',$branch_id);
	$this->db->where('tbl_employee.e_designation',"Service Advisor");
	$this->db->where('tbl_employee.status',"active");
    $query = $this->db->get()->result();
	return $query;	
	}
public function list_invoice_staff($brancid)
{
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.inv_branch',$brancid);
$this->db->where('tbl_invoice_labour.status',0);
$this->db->where('tbl_invoice_labour.ready_status',1);
$query = $this->db->get()->result();
return $query;		
}
 public function sub_inv($inv_id){

$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->where('inv_id',$inv_id);
$query = $this->db->get()->row_array();
return $query;

 } public function sub_invoice_cost($lc_id)
 {
$this->db->select('*');
$this->db->from('tbl_readyfor_bill');
$this->db->where('lcr_id',$lc_id);
$query = $this->db->get()->row_array();
return $query;

 }
 public function update_inv($upd_data)
 {
 	$inv_id=$upd_data['inv_id'];
 	$this->db->where('inv_id',$upd_data['inv_id']);
 	$query=$this->db->update('tbl_invoice_labour',$upd_data);
	return $query;
 }

 public function delete_inv($lc_id)
 {
 	$this->db->where('lcr_id',$lc_id);
 	$this->db->delete('tbl_readyfor_bill');
 }
 public function invoice_dtls_insert($form_data,$id)
 {	
		if($id){
			$last_id = $id;
			$lab_code=$form_data['lc'];
			$lab_name=$form_data['lna'];
			$lab_rate=$form_data['lrate'];
			$jb_type=$form_data['jb_ty'];
			$disc=$form_data['ldisc'];
			$discp=$form_data['ldis'];
			$tax=$form_data['ltax'];
			$sgstp=$form_data['lugstp'];
			$sgst=$form_data['lugst'];
			$cgstp=$form_data['lcgstp'];
			$cgst=$form_data['lcgst'];
			$amt=$form_data['lamt'];
			 $insert_invoic=[];
			 $result = array_filter($lab_code); 
			
			
			foreach($result as $key => $value)
			{
			$insert_invoic[$key]=
				array(
				'ic_inv_id'=>$last_id,
				'lc_lab_code'=>$lab_code[$key],
				'lc_lb_name'=>$lab_name[$key], 
				'lc_rate'=>$lab_rate[$key],
				'lc_type'=>$jb_type[$key],
				'lc_disc_p'=>$discp[$key],
				'lc_disc'=>$disc[$key],
				'lc_tax_amunt'=>$tax[$key],
				'lc_sgst_p'=>$sgstp[$key],
				'lc_sgst_a'=>$sgst[$key],
				'lc_cgst_p'=>$cgstp[$key],
				'lc_cgst_a'=>$cgst[$key],
				'lc_amount'=>$amt[$key]
			);	
			
   }
   	$query=$this->db->insert_batch('tbl_invoice_labour_cost', $insert_invoic);
		if($query)
		{
			return $last_id;
		}
			
		}
 }
  public function list_invoice_previous(){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.ready_status',0);
$this->db->where('tbl_invoice_labour.status',0);
$query = $this->db->get()->result();
return $query;		
 }
   public function list_insurance_invoice(){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.ready_status',1);
$this->db->where('tbl_invoice_labour.status',1);
$query = $this->db->get()->result();
return $query;		
 }
   public function view_invoice_customer_insurance_query($id)
 {
$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->join('tbl_insurance_company', "tbl_insurance_company.com_id = tbl_invoice_labour.insurance_id",'left');
$this->db->where('inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }
 	public function invoice_dtls_ready_new($form_data,$data,$invid)
 {
		$this->db->where('inv_id',$invid);
	    $res = $this->db->update('tbl_invoice_labour',$data);	
		if($res){
			$last_id = $invid;
			$lab_code=$form_data['lc'];
			$lab_name=$form_data['lna'];
			$lab_rate=$form_data['lrate'];
			$jb_type=$form_data['jb_ty'];
			$disc=$form_data['ldisc'];
			$discp=$form_data['ldis'];
			$tax=$form_data['ltax'];
			$sgstp=$form_data['lugstp'];
			$sgst=$form_data['lugst'];
			$cgstp=$form_data['lcgstp'];
			$cgst=$form_data['lcgst'];
			$amt=$form_data['lamt'];
			$sacode=$form_data['sacd'];
			 $insert_invoic=[];
			 $result = array_filter($lab_code); 
			foreach($result as $key => $value)
			{
			$insert_invoic[$key]=
				array(
				'ic_inv_id'=>$last_id,
				'lc_lab_code'=>$lab_code[$key],
				'lc_lb_name'=>$lab_name[$key], 
				'lc_rate'=>$lab_rate[$key],
				'lc_type'=>$jb_type[$key],
				'lc_disc_p'=>$discp[$key],
				'lc_disc'=>$disc[$key],
				'lc_tax_amunt'=>$tax[$key],
				'lc_sgst_p'=>$sgstp[$key],
				'lc_sgst_a'=>$sgst[$key],
				'lc_cgst_p'=>$cgstp[$key],
				'lc_cgst_a'=>$cgst[$key],
				'lc_amount'=>$amt[$key],
				'lc_sacode'=>$sacode[$key]
			);	
			
   }
     $this->db->where('ic_inv_id',$invid);
 	 $query1=$this->db->delete('tbl_readyfor_bill');	
   	 $query=$this->db->insert_batch('tbl_readyfor_bill', $insert_invoic);
		if($query)
		{
			return $last_id;
		}
			
		}
 }
 public function list_invoice_previous_insurance(){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.ready_status',0);
$this->db->where('tbl_invoice_labour.status',1);
$query = $this->db->get()->result();
return $query;		
 }
 
  public function list_invoice_previous_staff_insur($brancid){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.inv_branch',$brancid);
$this->db->where('tbl_invoice_labour.ready_status',0);
$this->db->where('tbl_invoice_labour.status',1);
$query = $this->db->get()->result();
return $query;		
 }
  public function list_insurance_invoice_staff($branch_id)
{
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.ready_status',1);
$this->db->where('tbl_invoice_labour.status',1);
$this->db->where('tbl_invoice_labour.inv_branch',$branch_id);
$query = $this->db->get()->result();
return $query;		
}
    public function list_invoice_previous_staff($brancid){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->where('tbl_invoice_labour.inv_branch',$brancid);
$this->db->where('tbl_invoice_labour.ready_status',0);
$this->db->where('tbl_invoice_labour.status',0);
$query = $this->db->get()->result();
return $query;		
 }
public function view_invoice_customer_stat($id)
{
  $this->db->select('status');
  $this->db->from('tbl_invoice_labour');
  $this->db->where('inv_id',$id);
  $query = $this->db->get()->result();
      if($query[0]->status)
	  {
		  $p=$query[0]->status; 
		 
		  return $p;
	  }
	  else
	  {
		 return false;
		}
}
public function check_exist_labour($id){
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->where('tbl_invoice_labour.inv_id',$id);
$this->db->where('tbl_invoice_labour.ready_status',0);
$query = $this->db->get()->result();
return $query;		
 }
 public function checkinvoce($invoic)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->where('inv_no',$invoic);
$query = $this->db->get()->result();
return $query;		
 }
 public function checjobcrd($jbno)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour');
$this->db->where('inv_job_card_no',$jbno);
$query = $this->db->get()->result();
return $query;		
 }
}
?>