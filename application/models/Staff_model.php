<?php
class Staff_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

  public function view_invoice_customer($id)
 {
$this->db->select('*,e1.e_first_name as adviser,e2.e_first_name as mechanic');
$this->db->from('tbl_invoice_labour');
$this->db->join('tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join('tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
$this->db->join('tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->where('inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }

 public function view_invoice_details($id)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }
  
 public function view_invoice_customer_pdf($id)
 {
$this->db->select('*, e1.e_first_name AS adviser, e2.e_first_name AS mechanic', false);
$this->db->from('tbl_invoice_labour');
$this->db->join(' tbl_branch', "tbl_branch.b_id = tbl_invoice_labour.inv_branch",'left');
$this->db->join(' tbl_employee e1', "e1.emp_id = tbl_invoice_labour.inv_advisername",'left');
	   $this->db->join(' tbl_employee e2', "e2.emp_id = tbl_invoice_labour.inv_mechna",'left');
$this->db->where('inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }
public function view_invoice_pdf($id)
 {
$this->db->select('*');
$this->db->from('tbl_invoice_labour_cost');
$this->db->where('ic_inv_id',$id);
$query = $this->db->get()->result();
return $query;	 
 }

  public function view_jobcard_invoice_word($id) 
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
    public function view_tax_invoice_word($id)
 {
    $this->db->select('*');
    $this->db->from('tbl_invoice_labour_cost');
    $this->db->where('ic_inv_id',$id);
     $query = $this->db->get()->result_array();
     return $query;	 
 }



}