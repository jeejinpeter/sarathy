<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
  public function __construct()
   {
               parent::__construct();
   }
   public function hash_password($newpswd)
    {
		return password_hash($newpswd, PASSWORD_BCRYPT);
	}
	
	public function resolve_password($un,$password) {
        $this->db->select('pwd');
        $this->db->from('tbl_login');
        $this->db->where('uname', $un);
        $hash = $this->db->get()->row('pwd'); 
        return $this->verify_password_hash($password,$hash);
    }	
	private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash); 
    }
	
	public function change_adminpassword($data,$id)
    {
        $this->db->where('login_id',$id);
        $this->db->update('tbl_login', $data);
		 return true;
	}
	//-----------------------------report--------------------------------//
		public function list_custom_date($f_date,$t_date)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni,SUM(lc_rate) AS id_sum');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.	insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$f_date);
	$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$t_date);
	$this->db->where('tbl_invoice_labour_cost.lc_type','Paid Service');
	$this->db->group_by('ic_inv_id');
    $query = $this->db->get();
    return $query->result();
	}
public function list_custom_date_mech($from,$to,$mech,$branch,$advisor,$service)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni,SUM(lc_rate) AS id_sum');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_inv_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_inv_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		if($service)
		{	
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		}
		if($mech)
		{
		$this->db->where_in('tbl_invoice_labour.inv_mechna',$mech);
		}
		if($advisor)
		{
		$this->db->where_in('tbl_invoice_labour.inv_advisername',$advisor);
		}
	$this->db->group_by('ic_inv_id');
    $query = $this->db->get();
    return $query->result();
	}
	public function list_service()
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->like('e_branch','SARATHY MAIN WORKSHOP');
	$this->db->where('e_designation','Service Advisor');
    $query = $this->db->get();
    return $query->result();
	}
	public function list_mech()
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->like('e_branch','SARATHY MAIN WORKSHOP');
	$this->db->where('tbl_employee.e_designation','Mechanic');
    $query = $this->db->get();
    return $query->result();
	}
	//------------------------------------labour code-------------------------------//
	public function Selectbyid($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_labour_code');
	$this->db->where('tbl_labour_code.labour_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	public function add_labour($data)
	{
		  return $this->db->insert('tbl_labour_code',$data);
	}
	 public function list_labour()
	{
	$this->db->select('*');
    $this->db->from('tbl_labour_code');
    $this->db->order_by('labour_title','asc');
    $query = $this->db->get();
    return $query->result();
	}
	public function update_labour($data,$id)
	{
	$this->db->where('labour_id',$id);
	return $query = $this->db->update('tbl_labour_code',$data);
	}
  public function remove_labour($id)
    {
    $this->db->where('labour_id',$id);
    $query = $this->db->delete('tbl_labour_code');
    return $query; 
	}
	//--------------------------------branch--------------------------------------//
	public function insert_branch($data)
       {
	      $query=$this->db->insert('tbl_branch',$data);
          return $query;	
       } 
 public function list_branch()
		{
			$this->db->select('*');
			$this->db->from('tbl_branch');
			$query = $this->db->get();
			return $query->result();
		}
public function Selectby($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_branch');
	$this->db->where('tbl_branch.b_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	public function selectbranch($id,$bid)
	{
	$this->db->select('*');
    $this->db->from('tbl_branch');
	$where="(branch_id='".$id."' OR branch_name='".$bid."')";
	$this->db->where($where);
	$query = $this->db->get();
    return $query->result();
	}
  public function update_branch($data,$bid)
	{
	$this->db->where('b_id',$bid);
	return $query = $this->db->update('tbl_branch',$data);
	}
  public function remove_branch($id)
    {
    $this->db->where('b_id',$id);
    $query = $this->db->delete('tbl_branch');
    return $query; 
	}
	//------------------------------employee-------------------------------------//
	public function insert_users($data)
	{
	  return $this->db->insert('tbl_employee',$data);
	}
  public function list_user()
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->join('tbl_login', "tbl_login.login_id = tbl_employee.emp_login_id",'left');
    $query = $this->db->get();
    return $query->result();
	}
	/*public function Selectbyemployee($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->where('tbl_employee.emp_login_id',$id);
    $query = $this->db->get();
    return $query->result();
	}*/
	
public function Selectbyemployee($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->where('tbl_employee.emp_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	   public function update_users($data,$id)
	{
	$this->db->where('emp_id',$id);
	return $query = $this->db->update('tbl_employee',$data);
	}
	
	public function Selectbyemployee_login($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->join('tbl_login','tbl_employee.emp_login_id=tbl_login.login_id','left');
	$this->db->where('tbl_employee.emp_login_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	public function update_login($data,$id)
	{
	$this->db->where('login_id',$id);
	return $query = $this->db->update('tbl_login',$data);
	}
	public function update_emp($data,$id)
	{
	$this->db->where('emp_id',$id);
	return $query = $this->db->update('tbl_employee',$data);
	}
  public function remove_user($id)
    {
    $this->db->where('emp_login_id',$id);
    $query = $this->db->delete('tbl_employee'); 
	$this->db->where('login_id',$id);
    return $query1 = $this->db->delete('tbl_login'); 
	}
	public function get_branch()
		{
			$this->db->select('*'); 
            $this->db->from('tbl_branch');			
			$query = $this->db->get();
			return $query->result();	 
		}
	//-----------------------------------------Customer----------------------------------------------//
	public function add_customer($data)
  {

      $qr=$this->db->insert('customer_details',$data);
      return $qr;


  }
   public function check_reg($reg){

  	$this->db->select('*');
	$this->db->where('c_reg_no',$reg);
    $q= $this->db->get('customer_details');
	return $q;
  		 }


  public function list_customer()
  {

      $this->db->select('*');
      $this->db->from('customer_details');
      $this->db->order_by('c_id','desc');
      $this->db->limit('5000');
      return $this->db->get()->result_array();


  }

public function edit_customer($id)
  {
      $this->db->select('*');
      $this->db->from('customer_details');
 $this->db->join('tbl_model','customer_details.model_name=tbl_model.model_id','left');
      $this->db->where('c_id',$id);
      return $this->db->get()->row_array();
	  }


          public function customer_edit($data,$id){

            $this->db->where('c_id',$id);
           $query=$this->db->update('customer_details',$data);
           return $query;


          }




        public function  customer_delete($id){


          $this->db->where('c_id',$id);
          $qr=$this->db->delete('customer_details');
          return $qr;
        }




//---------------------------------JOb card-----------------------------------------//


public function insert_jobcard1($data1)
	{
	  $this->db->insert('tbl_jobcard1', $data1);
	  return $this->db->insert_id();	
		
	}
	public function insert_jobcard2($data2)
	{
	  $this->db->insert('tbl_jobcard2', $data2);
	  return $this->db->insert_id();	
		
	}
	public function insert_jobcard3($data3)
	{
	  $this->db->insert('tbl_jobcard3', $data3);
	  return $this->db->insert_id();	
		
	}
//------------------------------------------iNSURANCE------------------------------//
public function get_customer($registr)
		{
			$this->db->select('*'); 
            $this->db->from('customer_details');
			$this->db->where('c_reg_no',$registr);			
			$query = $this->db->get()->row_array();
			return $query;	 
		}
		public function get_insure($item)
		{
			
			$this->db->select('*'); 
            $this->db->from('insurance_provider');
			$this->db->where('name',$item);			
			$query = $this->db->get()->row_array();
			return $query;
					
		}
//-----------------------------------------Insurance Company---------------------------------//

 public function  insurance_company($data1)
	{
	return  $this->db->insert('tbl_insurance_company', $data1);
	}
	public function list_insurance()
  {

      $this->db->select('*');
      $this->db->from('tbl_insurance_company');
      $query = $this->db->get();
	  return $query->result();
  }
  public function Selectbyid_insurance($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_insurance_company');
	$this->db->where('tbl_insurance_company.com_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	
	public function update_insurance($data,$id)
	{
	$this->db->where('com_id',$id);
	return $query = $this->db->update('tbl_insurance_company',$data);
	}
  public function remove_insurance($id)
    {
    $this->db->where('com_id',$id);
    $query = $this->db->delete('tbl_insurance_company');
    return $query; 
	}
	
	

		public function get_insurance(){
			  $this->db->select('*');
      $this->db->from('tbl_insurance_company');
    
      $query=$this->db->get()->result_array();
      return $query;
		}


		public function select_ins_cmp($cmp){

			$this->db->select('*'); 
            $this->db->from('tbl_insurance_company');
			$this->db->where('com_id',$cmp);			
			$query = $this->db->get()->row_array();
			return $query;
		}
		public function login_detail($username)
	{
	  $this->db->select('*');
    $this->db->from('tbl_login');
	$this->db->where('tbl_login.uname',$username);
    $query = $this->db->get();
    return $query->result();
	}
	public function delete_user_dtls($lg_id)
	{
	 $this->db->where('login_id',$lg_id);
    $query = $this->db->delete('tbl_login');
    return $query;	
	}
	public function list_custom_date_mech_csv($from,$to,$mech,$branch,$code,$advisor,$service)
	{
		
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni,SUM(lc_rate) AS id_sum');
	 $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.	insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		if($mech){
		$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		$this->db->where('tbl_invoice_labour.inv_mechna',$mech);
		}
		 elseif($branch!=0)
		 {
		 $this->db->where('tbl_invoice_labour.inv_branch',$branch);
		 }
		if($code)
		{
			//echo"wwggg";die();
		$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		$this->db->where('tbl_invoice_labour_cost.lc_lab_code',$code);
		}
		if($advisor)
		{
		$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		$this->db->where('tbl_invoice_labour.inv_advisername',$advisor);
		}
	$this->db->group_by('ic_inv_id');
    $query = $this->db->get();
    return $query->result_array();
	}
	
	public function id_select($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_model');
	$this->db->where('tbl_model.model_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
	public function add_model($data)
	{
		  return $this->db->insert('tbl_model',$data);
	}
	 public function list_model()
	{
	$this->db->select('*');
    $this->db->from('tbl_model');

    $query = $this->db->get();
    return $query->result();
	}
	public function update_model($data,$id)
	{
	$this->db->where('model_id',$id);
	return $query = $this->db->update('tbl_model',$data);
	}
  public function remove_model($id)
    {
    $this->db->where('model_id',$id);
    $query = $this->db->delete('tbl_model');
    return $query; 
	}
	public function get_model_details()
	{
	$this->db->select('*'); 
    $this->db->from('tbl_model');
	$query = $this->db->get()->result();
	return $query;	
	}
public function list_job_card_statement($from,$to,$mech,$branch,$code,$advisor,$service,$repair)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
    $this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.	insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_inv_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_inv_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		if($service)
		{
			
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		}
		if($repair)
		{
		$this->db->where_in('tbl_invoice_labour.inv_repair_typ',$repair);
		}
		if($mech)
		{
		$this->db->where_in('tbl_invoice_labour.inv_mechna',$mech);
		}
		if($code)
		{
		$this->db->where_in('tbl_invoice_labour_cost.lc_lab_code',$code);
		}
		if($advisor)
		{
		$this->db->where_in('tbl_invoice_labour.inv_advisername',$advisor);
		}
	
	$query = $this->db->get();
    return $query->result();
	}
	public function list_job_card_statement_csv($from,$to,$mech,$branch,$code,$advisor,$service,$repair)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
    $this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.	insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_jcard_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_jcard_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		if($service)
		{
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		}
		if($repair)
		{
		$this->db->where_in('tbl_invoice_labour.inv_repair_typ',$repair);
		}
		if($mech)
		{
		$this->db->where_in('tbl_invoice_labour.inv_mechna',$mech);
		}
		if($code)
		{
		$this->db->where_in('tbl_invoice_labour_cost.lc_lab_code',$code);
		}
		if($advisor)
		{
		$this->db->where_in('tbl_invoice_labour.inv_advisername',$advisor);
		}
	$query = $this->db->get();
    return $query->result_array();
	}
	public function get_mech($id)
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->like('e_branch',$id);
	$this->db->where('tbl_employee.e_designation','Mechanic');
    $query = $this->db->get();
    return $query->result();
	}
	 public function get_branch_main()
		{
			$this->db->select('*');
			$this->db->from('tbl_branch');
			$this->db->like('branch_name','SARATHY MAIN WORKSHOP');
			$query = $this->db->get();
			return $query->result();
		}
		 public function get_service($id)
	{
	$this->db->select('*');
    $this->db->from('tbl_employee');
	$this->db->where('e_branch',$id);
	$this->db->where('e_designation','Service Advisor');
    $query = $this->db->get();
    return $query->result();
	}
	
public function get_branch_main_staff($bid)
		{
			$this->db->select('*');
			$this->db->from('tbl_branch');
			$this->db->where('b_id',$bid);
			//$this->db->like('branch_name','SARATHY MAIN WORKSHOP');
			$query = $this->db->get();
			return $query->result();
		}
public function list_custom_date_mech_ins($from,$to,$mech,$branch,$advisor,$service,$repair,$company)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni,SUM(lc_rate) AS id_sum');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_inv_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_inv_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		if($service)
		{	
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		}
		if($mech)
		{
		$this->db->where_in('tbl_invoice_labour.inv_mechna',$mech);
		}
		if($advisor)
		{
		$this->db->where_in('tbl_invoice_labour.inv_advisername',$advisor);
		}
		if($repair)
		{
		$this->db->where_in('tbl_invoice_labour.inv_repair_typ',$repair);
		}
	  if($company)
     	{
	  $this->db->where_in('tbl_insurance_company.com_id',$company);
	}
	$this->db->group_by('ic_inv_id');
    $query = $this->db->get();
    return $query->result();
	}		
	 public function list_job_card_statement_ins($from,$to,$mech,$branch,$code,$advisor,$service,$repair,$company)
	{
	$this->db->select('*,e1.e_first_name as advai,e2.e_first_name as mechni');
    $this->db->from('tbl_invoice_labour');
	$this->db->join('tbl_invoice_labour_cost','tbl_invoice_labour.inv_id=tbl_invoice_labour_cost.ic_inv_id','left');
	$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
    $this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
	$this->db->join('tbl_branch',
	'tbl_branch.b_id = tbl_invoice_labour.inv_branch','Left');
	$this->db->join('tbl_insurance_company','tbl_invoice_labour.	insurance_id=tbl_insurance_company.com_id','left');
	$this->db->where('tbl_invoice_labour.inv_inv_date>=',$from);
		$this->db->where('tbl_invoice_labour.inv_inv_date<=',$to);
		$this->db->where('tbl_invoice_labour.inv_branch',$branch);
		if($service)
		{
			
		$this->db->where('tbl_invoice_labour_cost.lc_type',$service);
		}
		if($repair)
		{
		$this->db->where_in('tbl_invoice_labour.inv_repair_typ',$repair);
		}
		if($mech)
		{
		$this->db->where_in('tbl_invoice_labour.inv_mechna',$mech);
		}
		if($code)
		{
		$this->db->where_in('tbl_invoice_labour_cost.lc_lab_code',$code);
		}
		if($advisor)
		{
		$this->db->where_in('tbl_invoice_labour.inv_advisername',$advisor);
		}
		if($repair)
		{
		$this->db->where_in('tbl_invoice_labour.inv_repair_typ',$repair);
		}
		if($company)
		{
		$this->db->where_in('tbl_insurance_company.com_id',$company);
		}
	
	
	$query = $this->db->get();
    return $query->result();
	}
}
?>