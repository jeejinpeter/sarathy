<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * hash_password function.
     * 
     * @access private
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    public function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    /**
     * resolve_user_login function.
     * 
     * @access public
     * @param mixed $username
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    public function resolve_user_login($username, $password)
    {       
        $this->db->select('pwd');
        $this->db->from('tbl_login');
        $this->db->where('uname', $username);
        $hash = $this->db->get()->row('pwd');
        return $this->verify_password_hash($password, $hash);
    }
    private function verify_password_hash($password, $hash)
    {
        
        return password_verify($password, $hash);
        
    }
    /**
     * get_user_id_from_username function.
     * 
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($username)
    {
        $this->db->select('uname');
        $this->db->from('tbl_login');
        $this->db->where('uname', $username);
        return $this->db->get()->row('uname');
    }
    /**
     * get_user function.
     * 
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
public function change_userpassword($data,$id)
    {
        $this->db->where('login_id',$id);
        $this->db->update('tbl_login', $data);
		 return true;
	}	 
    public function get_user($user_id)
    {
        $this->db->from('tbl_login');
        $this->db->where('uname', $user_id);
        return $this->db->get()->row();       
    }
public function insert_users($data)
	{
	  return $this->db->insert('tbl_users',$data);
	}
  public function list_user()
	{
	$this->db->select('*');
    $this->db->from('tbl_users');
	$this->db->join('tbl_login', "tbl_login.login_id = tbl_users.u_login_id",'left');
    $query = $this->db->get();
    return $query->result();
	}
  public function Selectby($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_users');
	$this->db->join('tbl_login', "tbl_login.login_id = tbl_users.u_login_id",'left');
	$this->db->where('tbl_users.u_id',$id);
    $query = $this->db->get();
    return $query->result();
	}
  public function update_users($data,$id)
	{
	$this->db->where('u_id',$id);
	return $query = $this->db->update('tbl_users',$data);
	}
  public function remove_user($id)
    {
    $this->db->where('u_login_id',$id);
    $query = $this->db->delete('tbl_users'); 
	$this->db->where('login_id',$id);
    return $query1 = $this->db->delete('tbl_login'); 
	}
	 public function Selectbyre($id)
	{
	  $this->db->select('*');
    $this->db->from('tbl_users');
	$this->db->join('tbl_login', "tbl_login.login_id = tbl_users.u_login_id",'left');
	$this->db->where('tbl_users.u_login_id',$id);
    $query = $this->db->get();
    return $query->result();
	}  
 public function updatestate($id,$dat)
   {
	 $this->db->where('u_login_id',$id);
        $this->db->update('tbl_users',$dat);
		 return true;   
   } 
  public function get_last_userid()
    {        
        $this->db->select_max('uname');
        $this->db->from('tbl_login');
      $query = $this->db->get()->result();
	  if($query[0]->uname){
    return $query[0]->uname; 
	  }else{return false;}
    } 
public function insert_login($data1)
        {
			  $this->db->insert('tbl_login',$data1);
              $insert_id = $this->db->insert_id();
			  return  $insert_id;			  
	    }  
public function get_full_name($uflgid)
    {   
	    $this->db->select('u_name');
        $this->db->from('tbl_users');
        $this->db->where('u_login_id', $uflgid);
        $query = $this->db->get()->result();
        return $query[0]->u_name;     
    }
public function get_wallet_balance($buid)
    {   
	    $this->db->select('uw_amount');
        $this->db->from('tbl_user_wallet');
        $this->db->where('uw_username', $buid);
        $query = $this->db->get()->result();
        return $query[0]->uw_amount;     
    }
public function get_service_charge($lid)
    {   
	    $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('u_login_id', $lid);
        $query = $this->db->get()->result();
        return $query;     
    }
 public function get_debit_process($from,$to,$uid)
   {  
     $this->db->select('*');
	 $this->db->from('tbl_user_debits');
	 $this->db->where('DATE(debit_timestamp)  >= ', $from);
	 $this->db->where('DATE(debit_timestamp) <= ', $to);
     $this->db->where('debit_user',$uid);
	 $this->db->order_by('id','DESC');
	 $query = $this->db->get()->result();
	 return $query;
   }
public function get_credit_process($from,$to,$uid)
	   {  
		 $this->db->select('*');
		 $this->db->from('tbl_credit');
		 $this->db->where('DATE(c_date)  >= ', $from);
		 $this->db->where('DATE(c_date) <= ', $to);
		 $this->db->where('c_amt!=','0');
		 $this->db->where('c_username',$uid);
		 $this->db->order_by('c_id','DESC');
		 $query = $this->db->get()->result();
		 return $query;
}   
public function get_last_login($login_id)
    {
        $this->db->from('tbl_login');
        $this->db->where('login_id', $login_id);
        return $this->db->get()->row();
        
    }
	 public function login_time($data,$id)
	{
	$this->db->where('login_id',$id);
	return $query = $this->db->update('tbl_login',$data);
	}
	 public function select_login_time($login_id)
    {
        $this->db->from('tbl_login');
        $this->db->where('login_id', $login_id);
        return $this->db->get()->row();
        
    }
	public function insert_attempt($data)
	{
		  return $this->db->insert('tbl_attempt',$data);
	}
	public function select_attempt_count($username)
    {
        $this->db->from('tbl_attempt');
        $this->db->where('a_username', $username);
        return $this->db->get()->row();
        
    }
	public function update_attempt_count($data,$username)
	{
		$this->db->where('a_username',$username);
		return $query = $this->db->update('tbl_attempt',$data);
	}
	public function update_flag($data,$username)
	{
		$this->db->where('uname',$username);
		return $query = $this->db->update('tbl_login',$data);
	}
	public function list_blocked_users()
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->join('tbl_login', "tbl_login.login_id = tbl_users.u_login_id",'left');
		$this->db->where('tbl_login.login_flag','0');
		$query = $this->db->get();
		return $query->result();
	}
	 public function reset_account($data,$login_id)
	{
	$this->db->where('login_id',$login_id);
	return $query = $this->db->update('tbl_login',$data);
	}
	/*-------Reset Password----------*/
  public function reset_user_password($login_id,$data)
	{
	$this->db->where('login_id',$login_id);
	return $query = $this->db->update('tbl_login',$data);
	}
	/*---------Wallet Insert-----*/	
	public function insert_wallet($data1)
        {
			  return $query= $this->db->insert('tbl_user_wallet',$data1);
	    }
		public function select_bal($user)
		{
			$this->db->select('*');
			$this->db->from('tbl_user_wallet');
			$this->db->where('uw_username',$user);
			$query=$this->db->get()->result();
			return $query;
		}
		public function update_wallet($data,$user)
		{
			$this->db->where('uw_username',$user);
			return $query = $this->db->update('tbl_user_wallet',$data);
		}
public function get_user_location($un)
    {   
	    $this->db->select('u_location');
        $this->db->from('tbl_users');
        $this->db->where('u_login_id', $un);
        $query = $this->db->get()->result();
        return $query[0]->u_location;     
    }		
}
?>