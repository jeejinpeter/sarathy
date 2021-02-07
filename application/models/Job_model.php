<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Job_model extends CI_Model {
	var $table = 'tbl_invoice_labour a';
	var $column_order = array(null,"a.inv_job_card_no", "a.inv_jcard_date","tbl_branch.branch_name","b.lc_lb_name","c.e_first_name AS mech_name","d.e_first_name AS adv_name","a.inv_modl","","a.inv_no","a.inv_cus","a.inv_pho","a.inv_inv_date", "a.in_registr", "a.inv_chassis","a.in_engine","a.inv_km","tbl_insurance_company.icompany_name","b.lc_amount","b.lc_amount","b.lc_amount","a.inv_cus_gstin","b.lc_disc","b.lc_tax_amunt","a.inv_type","a.inv_total"); //set column field database for datatable orderable
	var $column_search = array("a.inv_id", "a.inv_job_card_no", "a.inv_jcard_date","tbl_branch.branch_name","b.lc_lb_name","c.e_first_name AS mech_name","d.e_first_name AS adv_name","a.inv_modl","","a.inv_no","a.inv_cus","a.inv_pho","a.inv_inv_date", "a.in_registr", "a.inv_chassis","a.in_engine","a.inv_km","tbl_insurance_company.icompany_name","b.lc_amount","b.lc_amount","b.lc_amount","a.inv_cus_gstin","b.lc_disc","b.lc_tax_amunt","a.inv_type","a.inv_total"); //set column field database for datatable searchable 
	var $order = array('a.inv_id' => 'asc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

public function get_count_lcode()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		$q= $query->result();
		$arr=array();
		foreach($q as $row)
		{
			if(in_array($row->lc_lab_code,$arr))
			   {
				   
			   }
			   else{
				   array_push($arr,$row->lc_lab_code);
			   }
		}
		return count($arr);
	}

	private function _get_datatables_query()
	{	
	$this->db->join('tbl_invoice_labour_cost b','b.ic_inv_id=a.inv_id','LEFT');
	$this->db->join('tbl_employee c', "c.emp_id = a.inv_advisername",'LEFT');
    $this->db->join('tbl_employee d', "d.emp_id = a.inv_mechna",'LEFT');
	$this->db->join('tbl_branch','a.inv_branch=tbl_branch.b_id','LEFT');
	$this->db->join('tbl_insurance_company','a.insurance_id=tbl_insurance_company.com_id','LEFT');
		$view_by=$this->input->post('view_by');
		if($view_by=='Custom Date'){
			$from=$this->input->post('fromdate');
			$to=$this->input->post('todate');
			 }
			 elseif($view_by=='Month to date')
			 {
			 $from=date('Y-m-01');
			 $to=date('Y-m-d');
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
			 }
			  elseif($view_by=='Previous Year')
			 {
			 $from1 = date('Y', strtotime('-1 years'));
			 $to=$from1.'-12-31';
			 $from=$from1.'-01-01';
			 
			 }
			 elseif($view_by=='Year to Date')
			 {
			 $from=date('Y-01-01');
			 $to=date('Y-m-d');
			 }
			else
			{
			$from=date('Y-m-d');
			$to=date('Y-m-d');
			}
	    $this->db->where('a.inv_inv_date>=',$from);
		$this->db->where('a.inv_inv_date<=',$to);
		//add custom filter here
		if($this->input->post('branch'))
		{
		$this->db->where('a.inv_branch', $this->input->post('branch'));
		}
		if($this->input->post('service'))
		{
		 $this->db->where('b.lc_type', $this->input->post('service'));
		}
		if($this->input->post('labourcode'))
		{
			$this->db->where_in('b.lc_lab_code', $this->input->post('labourcode'));
		}
		if($this->input->post('repair'))
		{
		   $this->db->where_in('a.inv_repair_typ', $this->input->post('repair'));
		}
		 if($this->input->post('advisor'))
		{
			$this->db->where_in('a.inv_advisername', $this->input->post('advisor'));
		 }
		if($this->input->post('mechanic'))
		{
		 $this->db->where_in('a.inv_mechna', $this->input->post('mechanic'));
		 }
		 if($this->input->post('ins_company'))
		{
		   $this->db->where_in('com_id', $this->input->post('ins_company'));
		}
		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
    public function get_name($name)
    {        
        $this->db->select('e_first_name');
        $this->db->from('tbl_employee');
        $this->db->where('emp_id',$name);
      $query = $this->db->get()->result();
	  if($query[0]->e_first_name)
	  {
		  $p=$query[0]->e_first_name; 
		 
		  return $p;
	  }
	  else
	  {
		  return false;
  }

}
}
