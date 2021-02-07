<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
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
public function index()
	{
	    @date_default_timezone_set('Asia/Kolkata');
		$this->load->helper(array('form','url'));
        $this->load->view('Admin/login');
	}
public function admin_login_process()
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '*Field is required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Admin/login');
        } else {
            date_default_timezone_set("Asia/Kolkata");
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username == NULL && $password == NULL) {
                $this->load->view('Admin/login');
            } else {
                if ($this->User_model->resolve_user_login($username, $password)) {
                    
                    $user_id = $this->User_model->get_user_id_from_username($username);
                    $user    = $this->User_model->get_user($user_id);
                    $this->load->library(array(
                        'session'
                    ));
                    $this->session->set_userdata(array(
                        'login_id' => $user->login_id,
                        'username' => (string) $user->uname,
                        'logged_in' => (bool) true,
                        'role' => $user->role,
                        'role_des' => $user->role_des
                    ));
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') {
                       
             redirect('Admin/admin_home_page', 'refresh');
                    } 
          else {
                         redirect('Admin/index', 'refresh');
                    }
                } 
        else {
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Wrong Username or password!!!</div>');
            redirect('Admin/index');
                }
            }
        }
  }
public function admin_home_page()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            
            $this->load->view('Admin/header');
            $this->load->view('Admin/home');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
//---------------------------------------------------------------------------------------------------//	

//-------------------------Change Password-----------------------------------------//	
public function change_password()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            $data['title']='Change Password';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/change_password');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
public function change_admin_password()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin')
        { 
          $un=$_SESSION['username'];
		  $id=$_SESSION['login_id'];		  
		  $password = $this->input->post('oldpassword');
		  if($this->Admin_model->resolve_password($un,$password)) 
            {				
          $this->load->library('form_validation');
          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
          $this->form_validation->set_rules('newpassword','New Password','required|trim');
          $this->form_validation->set_rules('cnewpassword','Verify New Password','required|trim|matches[newpassword]');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('Admin/header');
          $this->load->view('Admin/change_password');
		   $this->load->view('Admin/footer');
        }
		else
		{
            $newpswd=$this->input->post('newpassword');
              $new_pass = $this->Admin_model->hash_password($newpswd);
            $data = array(
                  'pwd' => $new_pass
                  );
          $res = $this->Admin_model->change_adminpassword($data,$id);
		  if($res)
		  {
            $this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center">Password Updated Successfully!!!</div>');
            redirect('Admin/change_password');
		  }
		  else{
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Password is not Successfully Updated!!!</div>');
            redirect('Admin/change_password', 'refresh');
		}
           }
        }
		else{
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Failed.. Please Try Again!!!</div>');
            redirect('Admin/change_password', 'refresh');
		}
		}
        else
		{
            redirect('Admin/index', 'refresh');
          }
    }
//---------------------------------------------------------------------------------------///	
	
			
public function add_notification()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            $this->load->view('Admin/header');
            $this->load->view('Admin/add_notification');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
public function notification_process()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		 $this->load->helper('form');
            $this->load->library('form_validation');		
            $this->form_validation->set_rules('content', 'Content', 'trim|required');         
            if ($this->form_validation->run() === false) 
			{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Please Enter Valid Details </div>');
               	
            $this->load->view('Admin/header');
            $this->load->view('Admin/add_notification');
            $this->load->view('Admin/footer');
            } 
			else {
				    
					$data = array(					
					'content' =>$this->input->post('content')
					);
					
					$notification=$this->Notification_model->insert_notification($data);
					
                    if ($notification) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Added</div>');
                        redirect('Admin/add_notification');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/add_notification');
                    }
				}
            } 
			else {
            redirect('Admin/index', 'refresh');
        }
	}
public function list_notification()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['notification']=$this->Notification_model->list_notification();
            $this->load->view('Admin/header');
            $this->load->view('Admin/list_notification',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
public function delete_notification($id)
	{
		$data = $this->Notification_model->remove_notification($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed the Notification</div>');
                        redirect('Admin/list_notification');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_notification');
                    }
		
	}
//------------------------Labour----------------//	
public function labour()
{if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            $data['title']='Add Labour Code';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_labour');
            $this->load->view('Admin/footer');	
			 } else {
            redirect('Admin/index', 'refresh');
        }
}
public function add_labour()
{

        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('code', 'Labour Code', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('repair', ' Repair Type', 'trim|required');
		$this->form_validation->set_message('required', '*Field is required');

               
    if ($this->form_validation->run() === false)
     { 
                $this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Please enter Valid Details </div>');
				
                  redirect('Admin/admin_home_page');
      }
      else
        {
        $data=array(
       'labour_title'=>$this->input->post('name'),
	   'labour_code'=>$this->input->post('code'),
	   'discription'=>$this->input->post('desc'),
	   'repair_type	'=>$this->input->post('repair'),
	   'sale_price'=>$this->input->post('sale'));
   if($this->Admin_model->add_labour($data))
    {
        $this->session->set_flashdata('msg', '<div class="alert alert-success disabled color-palette text-center"> Added successfully</div>');
				
               redirect('Admin/labour');
    }
       } 
    	
}
public function list_labour()
{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['list']=$this->Admin_model->list_labour();
            $data['title']='Labour Code List';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_labour',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
}
public function edit_labour($id)
	{
			if(isset($id))
      {
		  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['one'] = $this->Admin_model->Selectbyid($id);
			$data['title']='Edit Labour Code';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_labour',$data);
            $this->load->view('Admin/footer');
			} else {
            redirect('Admin/index', 'refresh');
        }
	  }
	}
	public function update_labour()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			 $id=$this->input->post('bid');
		 
                 $data=array(
       'labour_title'=>$this->input->post('name'),
	   'labour_code'=>$this->input->post('code'),
	   'discription'=>$this->input->post('desc'),
	   'repair_type	'=>$this->input->post('repair'),
	   'sale_price'=>$this->input->post('sale'));
					 $result   = $this->Admin_model->update_labour($data,$id);
				   
                    if ($result) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Updated</div>');
                        redirect('Admin/list_labour');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_labour');
                    }
                }
			
            
			else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function delete_labour($id)
	{
		$data = $this->Admin_model->remove_labour($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed </div>');
                        redirect('Admin/list_labour');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_labour');
                    }
		
	}	
	
//------------------------Employee----------------//	
 public function add_employee_view()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {	
	$data['branch']= $this->Admin_model->get_branch();	
            $data['title']='Add Employee';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_employee',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
public function add_employee_processing()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			
		 $this->load->helper('form');
            $this->load->library('form_validation');
			$this->form_validation->set_rules('intial', 'Intial', 'trim');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');
            	  
			$this->form_validation->set_message('required', '*Field is required');
            if ($this->form_validation->run() === false) 
			{
            $this->load->view('Admin/header');
            $this->load->view('Admin/add_employee');
            $this->load->view('Admin/footer');
            } 
			else {
				$role =$this->input->post('status');//var_dump($role); die();
				$username=$this->input->post('username');	
				$login=$this->Admin_model->login_detail($username);//var_dump($login); die();
			    if($role==user){
					if(!empty($login))
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Username already exist!!!</div>');
                        redirect('Admin/add_employee_view');
					}
					else{
				    $username=$this->input->post('username');				
                    date_default_timezone_set("Asia/Kolkata");
                    $password = $this->input->post('password');
                    $en_pass  = $this->Admin_model->hash_password($password);
					 $data1    = array(
                        'uname' =>$username,
                        'pwd' => $en_pass,
                        'role' => '2',
                        'role_des' => 'employee',
                    );
                    $id = $this->User_model->insert_login($data1);
					
                    $data = array(
				    'emp_login_id' =>$id,
				    'emp_intial' =>$this->input->post('intial'),
                    'e_first_name' =>$this->input->post('first_name'),
					'e_branch' =>$this->input->post('branch'),
			     	'e_address' =>$this->input->post('address'),
                    'e_mobile' =>$this->input->post('u_phone'),
                    'e_email' =>$this->input->post('u_email'),
                    'e_code' =>$this->input->post('e_code'),
					'e_designation' =>$this->input->post('desig'),
					'status'=>'active'
                    );	
					$result = $this->Admin_model->insert_users($data);
			}
				}
			else{
				$data = array(
				    
				 
				    'emp_intial' =>$this->input->post('intial'),
                    'e_first_name' =>$this->input->post('first_name'),
					'e_branch' =>$this->input->post('branch'),
                    
                   				   
			     	'e_address' =>$this->input->post('address'),							   
                    
                    'e_mobile' =>$this->input->post('u_phone'),
                    
                    'e_email' =>$this->input->post('u_email'),
                    'e_code' =>$this->input->post('e_code'),
					'e_designation' =>$this->input->post('desig'),
					'status'=>'active'
                    );	
					$result = $this->Admin_model->insert_users($data);
			}
                    if ($result) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Added the Employee!!!</div>');
                        redirect('Admin/add_employee_view');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">Some error occured... Try Later!!!...</div>');
                        redirect('Admin/add_employee_view');
                    }
                
			}
            } 
			else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function list_employee()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['list']=$this->Admin_model->list_user();
            $data['title']='Employee List';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_employee',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function edit_employee($id)
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['branch']= $this->Admin_model->get_branch();	
			$data['edit']=$this->Admin_model->Selectbyemployee($id);
            $data['title']='Employee List';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_employee',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function edit_employee_login($id)
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['branch']= $this->Admin_model->get_branch();	
			$data['edit']=$this->Admin_model->Selectbyemployee_login($id);//var_dump($data['edit']); die();
            $data['title']='Edit Employee';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_employee_login',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function employee_update_processing()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		
				 $id=$this->input->post('id');
				 $id1=$this->input->post('l_id');
				  $username=$this->input->post('username');		
				$login=$this->Admin_model->login_detail($username);
				 $role =$this->input->post('status');
				if($role==user){
			if(!empty($login))
					{
						$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Username already exist!!!</div>');
                        redirect('Admin/add_employee_view');
					}
			
				else{
				 $username=$this->input->post('username');				
                    date_default_timezone_set("Asia/Kolkata");
                    $password = $this->input->post('password');
                    $en_pass  = $this->Admin_model->hash_password($password);
					 $data1    = array(
                        'uname' =>$username,
                        'pwd' => $en_pass,
                        'role' => '2',
                        'role_des' => 'employee',
                    );
                    $id2 = $this->User_model->insert_login($data1);//var_dump($id2); die();
					$data = array(
				    'emp_login_id' =>$id2,
				    'emp_intial' =>$this->input->post('intial'),
                    'e_first_name' =>$this->input->post('first_name'),
					'e_branch' =>$this->input->post('branch'),
			     	'e_address' =>$this->input->post('address'),
                    'e_mobile' =>$this->input->post('u_phone'),
                    'e_email' =>$this->input->post('u_email'),
                    'e_code' =>$this->input->post('e_code'),
					'e_designation' =>$this->input->post('desig'),
					'status'=>'active'
                    );
					$result1 = $this->Admin_model->update_users($data,$id);
			}
				}
			
			else{
				$data = array(
				    
				 
				    'emp_intial' =>$this->input->post('intial'),
                    'e_first_name' =>$this->input->post('first_name'),
					'e_branch' =>$this->input->post('branch'),
                    
                   				   
			     	'e_address' =>$this->input->post('address'),							   
                    
                    'e_mobile' =>$this->input->post('u_phone'),
                    
                    'e_email' =>$this->input->post('u_email'),
                    'e_code' =>$this->input->post('e_code'),
					'e_designation' =>$this->input->post('desig'),
					'status'=>'active'
                    );	
				
					 $result1   = $this->Admin_model->update_users($data,$id);
			}
                    if ($result1) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center">Successfully Updated</div>');
                        redirect('Admin/list_employee');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_employee');
                    }
                }
			
	}
	public function employee_update_status()
	{
		
				 $id=$this->input->post('id');	
				 $lg_id=$this->input->post('lg_id');	
				 $desig=$this->input->post('desig');	
			 if($desig =="inactive"){
                 $data = array(
				    
                    'status' =>$desig,
                    'emp_login_id' =>null
                    );	
					}elseif($desig == "active") {
						$data = array(
				    
                    'status' =>$desig
                    );
					}
					if($lg_id != null && $desig =="inactive"){
						//var_dump($this->input->post('desig'));die();
						$this->Admin_model->delete_user_dtls($lg_id);
					}
						//var_dump($id);die();
					 $result   = $this->Admin_model->update_emp($data,$id);
				   
                    if ($result) {
                       
                        redirect('Admin/list_employee');
                    } else {
                       
                        redirect('Admin/list_employee');
                    }
                }
			
            
	
	public function delete_employee($id)
	{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		$data = $this->Admin_model->remove_user($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed the Employee!!</div>');
                        redirect('Admin/list_employee');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_employee');
                    }
		
	}
	else {
            redirect('Admin/index', 'refresh');
        }
	}
//---------------------------------------------------------------------------------------//
//-------------------------Add Branch-----------------------------------------//	
public function add_branch()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			
			$data['title']='Add Branch';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_branch');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
public function branch_process()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		 $this->load->helper('form');
            $this->load->library('form_validation');
			$this->form_validation->set_rules('id', 'branch_id', 'integer|required');
            $this->form_validation->set_rules('branch', 'branch_name', 'required');
				 if ($this->form_validation->run() === false) 
			{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Please enter Valid Details </div>');
				redirect('Admin/add_branch');
            } 
			else 
			{    
					
					$id =$this->input->post('id');
					$bid =$this->input->post('branch');
					
					$exist=$this->Admin_model->selectbranch($id,$bid);
					//var_dump($exist);die();
					if(!empty($exist))
					{
						foreach($exist as $row)
						{
							$a=$row->branch_id;
							$b=$row->branch_name;
						
							if($a==$id)
							{
								$this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center"> Branch Id Already Exist </div>');
				        redirect('Admin/add_branch');
							}
							elseif($b==$bid)
							{
								$this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Branch Name Already Exist </div>');
				        redirect('Admin/add_branch');
							}
							elseif($a==$id && $b==$bid){
								$this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Already Exist </div>');
				        redirect('Admin/add_branch');
							}
							
						}
					}	
					else{
						$data = array(	
					    'branch_id' =>$this->input->post('id'),
					    'branch_name' =>$this->input->post('branch'),
						'branch_address' =>$this->input->post('address'),
						'branch_ph' =>$this->input->post('phno')
					);
					$branch=$this->Admin_model->insert_branch($data);
				
                    if ($branch) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Added</div>');
                        redirect('Admin/add_branch');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/add_branch');
                    }
				}
		} 
		}
             
			else {
            redirect('Admin/index', 'refresh');
        }
	}
public function list_branch()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['list']=$this->Admin_model->list_branch();
            $data['title']='List Branch';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_branch',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
public function edit_branch($id)
	{
			if(isset($id))
      {
		  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['one'] = $this->Admin_model->Selectby($id);
			$data['title']='Edit Branch';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_branch',$data);
            $this->load->view('Admin/footer');
			} else {
            redirect('Admin/edit_branch', 'refresh');
        }
	  }
	}
	public function branch_update()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			 
			 $id=$this->input->post('bid');
			 //$bid=$this->input->post('b_id');
			 //$bname=$this->input->post('b_name');
		     
                   $data = array(
                    'branch_id' =>$this->input->post('b_id'),
                    'branch_name' =>$this->input->post('b_name'),
					'branch_address' =>$this->input->post('b_address'),
					'branch_ph' =>$this->input->post('phno')
                    );
					 $result   = $this->Admin_model->update_branch($data,$id);
				   
                    if ($result) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Updated</div>');
                        redirect('Admin/list_branch');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_branch');
                    }
				}
              
			else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function delete_branch($id)
	{
		$data = $this->Admin_model->remove_branch($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed the Branch Details</div>');
                        redirect('Admin/list_branch');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_branch');
                    }
		
	}
//-------------------------------------------Customer---------------------------------------//
public function add_customer(){
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['model']=$this->Admin_model->get_model_details();
            $data['title']='Add Customer';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_customer',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
}

 public function customer_add(){
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('c_r_no','Registration No:','required|trim|is_unique[customer_details.c_reg_no]');
    $this->form_validation->set_rules('c_c_no','Chasis No:','required|trim|is_unique[customer_details.c_chassis_no]'); 
   if($this->form_validation->run() == FALSE){
       $data['model']=$this->Admin_model->get_model_details();
            $data['title']='Add Customer';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_customer',$data);
            $this->load->view('Admin/footer');
   }else{

            $reg=$this->input->post('c_r_no');
            $cnt=$this->Admin_model->check_reg($reg);
            $cn=$cnt->num_rows();
            if($cn>0){
                $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Registration number already exists </div>');
                        redirect('Admin/add_customer');
            }
            else{

                      $data=array( 
                          'c_name' => $this->input->post('c_name'),
                     'c_address' => $this->input->post('c_address'),
                     'c_chassis_no' => $this->input->post('c_c_no'),
                     'c_engine_no' => $this->input->post('c_e_no'),
                     'c_contact_no'=> $this->input->post('c_contact'), 
                     'c_sales_date'=>$this->input->post('c_sale'),
                     'c_email'=> $this->input->post('c_email'),
                     'gstin_no'=> $this->input->post('c_g_no'),
                     'model_name'=> $this->input->post('c_m'),
                     'c_reg_no' => $reg
                     );
          $res=$this->Admin_model->add_customer($data);  
          if($res){
            $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Customer successfully added </div>');
                        redirect('Admin/add_customer');
          }
          else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/add_customer');
                    }     

            }
}
}

public function list_customer(){


        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            //$res['list']=$this->Admin_model->list_customer();
            $data['title']='Customer List';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_customer');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }



	public function edit_customer($id){


        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {

            $res['c_list']=$this->Admin_model->edit_customer($id);
            $res['model']=$this->Admin_model->get_model_details();
            $data['title']='Edit Customer';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_customer',$res);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }

 public function customer_edit(){


            $id=$this->input->post('idd');
          $data=array( 'c_name' => $this->input->post('c_name'),
                     'c_address' => $this->input->post('c_address'),
                     'c_chassis_no' => $this->input->post('c_c_no'),
                     'c_engine_no' => $this->input->post('c_e_no'),
                     'c_contact_no'=> $this->input->post('c_contact'), 
                     'c_sales_date'=>$this->input->post('c_sale'),
                     'c_email'=> $this->input->post('c_email'),
                    'c_reg_no' => $this->input->post('c_r_no'),
                     'gstin_no'=> $this->input->post('c_g_no'),
					 'model_name'=> $this->input->post('c_m')
					 );

          $res=$this->Admin_model->customer_edit($data,$id);  
          if($res){
            $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Customer successfully Edited </div>');
                        redirect('Admin/list_customer');
          }
          else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_customer');
                    }  


    }


 public function delete_customer($id){
             $res=$this->Admin_model->customer_delete($id); 

if($res){
            $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Customer successfully Edited </div>');
                        redirect('Admin/list_customer');
          }
          else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_customer');
                    } 
    }

			
/*-------------------------------------------- INVOICE INSURANCE-------------------------------------------*/	

public function invoice_insurance()
{
	$data['model']=$this->Admin_model->get_model_details();
	$data['adv']=$this->Bill_model->Select_adviser();
	 $data['mec']=$this->Bill_model->Select_mechni();
	$data['brnch']=$this->Bill_model->Select_branch();
	$data['labour']=$this->Bill_model->Select_labour();
    $data['detail']=$this->Admin_model->get_insurance();
    $data['title']='Insurance Invoice';
     $this->load->view('Admin/header',$data);
     $this->load->view('Admin/insurance_view',$data);
     $this->load->view('Admin/footer');
}
public function list_insurance_invoice()
 {
      $data['invo'] = $this->Bill_model->list_insurance_invoice_labour();
      $data['title']='Ready for Bill List(Insurance)';
      $this->load->view('Admin/header',$data);
      $this->load->view('Admin/insurance_invoice_listt',$data);
      $this->load->view('Admin/footer');
}
public function get_customer_detail1($code)
		{
			$re=$this->Admin_model->get_customer($code);//var_dump($re);die();
				echo json_encode($re);
		
			
		}
public function invoice_insurance_pdf($id)
	{
		$data = array(
				'ready_status'=>0
				
				);
$update_readybill=$this->Bill_model->update_ready_customer($data,$id);	
	$data['cust'] = $this->Bill_model->view_invoice_customer_insurance($id);
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
	$this->load->view('Admin/tax_invoice_insurance_pdf',$data);
}		
public function get_customer_detail($code)
		{
			$re=$this->Admin_model->get_customer($code);//var_dump($re);die();
				echo json_encode($re);
		
			
		}
	public function get_insure()
		{
			$item=$_REQUEST['bill'];
			
			$re=$this->Admin_model->get_insure($item);
			
			echo json_encode($re);
		
			
		}

        public function cmp_ins(){


            $cmp=$_REQUEST['cmp'];
            $res=$this->Admin_model->select_ins_cmp($cmp);
            echo json_encode($res);


        }
		
	public function invoice_insurance_process()
	{
	$invoic=$this->input->post('invoic');
	if($invoic == null || $invoic== "404 error"){
		$data['branchname']=$this->input->post('branchname');
		$data['jno']=$this->input->post('jno');
		$data['jname']=$this->input->post('jname');
		$data['invoicedate']=$this->input->post('invoicedate');
		$data['rno']=$this->input->post('rno');
		$data['mname']=$this->input->post('mname');
		$data['km']=$this->input->post('km');
		$data['cno']=$this->input->post('cno');
		$data['eno']=$this->input->post('eno');
		$data['cusname']=$this->input->post('cusname');
		$data['cusph']=$this->input->post('cusph');
		$data['cusgst']=$this->input->post('cusgst');
	 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Please Refresh your page!!!...</div>');
     $data['model']=$this->Admin_model->get_model_details();
	$data['adv']=$this->Bill_model->Select_adviser();
	 $data['mec']=$this->Bill_model->Select_mechni();
	$data['brnch']=$this->Bill_model->Select_branch();
	$data['labour']=$this->Bill_model->Select_labour();
    $data['detail']=$this->Admin_model->get_insurance();
    $data['title']='Insurance Invoice';
     $this->load->view('Admin/header',$data);
     $this->load->view('Admin/insurance_view',$data);
     $this->load->view('Admin/footer');
	}
	else{
	$re=$this->Bill_model->checkinvoce_labour($invoic);
	if($re == null){
	$jbno=$this->input->post('jno');
	$jbre=$this->Bill_model->checjobcrd_labour($jbno);	
	if($jbre == null) {	
	$bill=$this->input->post('ready');
	if($bill)
	{
	 $reg=$this->input->post('rno');
	 $data=array(
            'inv_no'=>'',
            'inv_cus'=>$this->input->post('cusname'),
            //'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$reg,
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'insurance_id'=>$this->input->post('ins_id'),
			'insurance_serveyor'=>$this->input->post('surveyor'),
			'ready_status'=>1,
			'status'=>1,
            );
			$ans=$this->Bill_model->check_registration($reg);
			
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			
						$result1=$this->Bill_model->invoice_dtls_ready_labour($form_data,$data);
			if($result1){
				 redirect('Admin/list_insurance_invoice/'.$result);
			}

	}else{
		$reg=$this->input->post('rno');
	  $data=array(
             'inv_no'=>$this->input->post('invoic'),
            'inv_cus'=>$this->input->post('cusname'),
            //'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$reg,
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'insurance_id'=>$this->input->post('ins_id'),
			'insurance_serveyor'=>$this->input->post('surveyor'),
			'status'=>1
            );
			$ans=$this->Bill_model->check_registration($reg);
			
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls($form_data,$data);
		
			
				

	if($result){
?>
	<script type="text/javascript" language="Javascript">
	
			window.open('invoice_insurance_pdf/<?PHP echo $result ?>', '_blank');
			
			window.location.href = "invoice_insurance";
			</script>
<?php	}
	}}else{
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already add this job card number</div>');
            redirect('Admin/invoice_insurance');
	} }else{
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Success!!!</div>');
            redirect('Admin/list_insurance_invoice');
	}
	}	
	}	
///----------------------------Job Card------------------------------------------------//
public function add_job_card()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		    $this->load->view('Admin/header');
            $this->load->view('Admin/add_job_card');
            $this->load->view('Admin/footer');
        } else {
            redirect('Admin/index', 'refresh');
        }
	}
	
/*--------------------------------------------LABOUR INVOICE-------------------------------------------*/	
public function getinvoiceno() 
	{	
		$branch_id= $_POST["branchno"]; 
	$cur_date=date('Y-m-d');
	$year=explode('-',$cur_date);
				 $branch = $this->Bill_model->get_branch_id($branch_id); 
				 $invoice_id=$this->Bill_model->get_mx_invoice();
				 if($invoice_id==false)
				 {
					 $auto_serial_no = "CI".$year[0].$branch."1";
					 echo $auto_serial_no;
						
				 }
				 else
				 {
					  $invoice_id2=$this->Bill_model->get_mx_invoice2($invoice_id);
					  if($invoice_id2==false)
					  {
						  echo "404 error";
					  }
					  else
					  {
						  // $auto_length=strlen($invoice_id2);
					 // $s=substr($invoice_id2,11,$auto_length);
					   $serialn=$invoice_id+1; 
					 $serialns= strlen($serialn);
					  if($serialns >4){
						  $serial=$serialn;
					  }else{
						   $serial="0".$serialn;
					  }
					  
					  $auto_serial_no = "CI".$year[0].$branch.$serial;
					  echo  $auto_serial_no;
					
					  }
					  
				 }
	   }
	   
public function get_labour_name()
    {
      $id = $_POST["id"]; 			
			$labour_details= $this->Bill_model->view_invoice_labour_details($id);
				foreach($labour_details as $row)
				{
					$name=$row->labour_title;
					$rate=$row->sale_price;
				}
				$return_value= array('name'=>$name,'rate'=>$rate);
				echo json_encode($return_value);
			
    }	   
	   
	   
public function invoice_labour()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
{
	 $data['model']=$this->Admin_model->get_model_details();
     $data['adv']=$this->Bill_model->Select_adviser();
	 $data['mec']=$this->Bill_model->Select_mechni();
	 $data['brnch']=$this->Bill_model->Select_branch();
	 $data['labour']=$this->Bill_model->Select_labour();
     $data['title']='Labour Invoice';
     $this->load->view('Admin/header',$data);
     $this->load->view('Admin/invoice_view',$data);
     $this->load->view('Admin/footer');
}
else {
    redirect('Admin/index', 'refresh');
     }
}
public function add_invoice_spare()
{
	$invoic=$this->input->post('invoic');
	if($invoic == null || $invoic== "404 error"){
		$data['branchname']=$this->input->post('branchname');
		$data['jno']=$this->input->post('jno');
		$data['jname']=$this->input->post('jname');
		$data['invoicedate']=$this->input->post('invoicedate');
		$data['rno']=$this->input->post('rno');
		$data['mname']=$this->input->post('mname');
		$data['km']=$this->input->post('km');
		$data['cno']=$this->input->post('cno');
		$data['eno']=$this->input->post('eno');
		$data['cusname']=$this->input->post('cusname');
		$data['cusph']=$this->input->post('cusph');
		$data['cusgst']=$this->input->post('cusgst');
		$data['cusaddr']=$this->input->post('cusaddr');
		$data['saledate']=$this->input->post('saledate');
		$data['model']=$this->Admin_model->get_model_details();
     $data['adv']=$this->Bill_model->Select_adviser();
	 $data['mec']=$this->Bill_model->Select_mechni();
	 $data['brnch']=$this->Bill_model->Select_branch();
	 $data['labour']=$this->Bill_model->Select_labour();
     $data['title']='Labour Invoice';
	 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Please Refresh your page!!!...</div>');
     $this->load->view('Admin/header',$data);
     $this->load->view('Admin/invoice_view',$data);
     $this->load->view('Admin/footer');
	}
	else{
	$re=$this->Bill_model->checkinvoce_labour($invoic);
	if($re == null){
	$jbno=$this->input->post('jno');
	$jbre=$this->Bill_model->checjobcrd_labour($jbno);	
	if($jbre == null) {
	$bill=$this->input->post('ready');
	if($bill)
	{
	  $reg=$this->input->post('rno');
	  $data=array(
            'inv_no'=>'',
            'inv_cus'=>$this->input->post('cusname'),
            'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$reg,
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_sale_date'=>$this->input->post('saledate'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'ready_status'=>1
            );
			$ans=$this->Bill_model->check_registration($reg);
			
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			
						$result=$this->Bill_model->invoice_dtls_ready_labour($form_data,$data);
			if($result){
				 redirect('Admin/list_invoice/'.$result);
			}

	}else{
		$reg=$this->input->post('rno');
	  $data=array(
           'inv_no'=>$this->input->post('invoic'),
            'inv_cus'=>$this->input->post('cusname'),
            'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$reg,
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_sale_date'=>$this->input->post('saledate'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total')
            );
			$ans=$this->Bill_model->check_registration($reg);
			
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls($form_data,$data);
		
			
				

	if($result){
?>
	<script type="text/javascript" language="Javascript">
	
			window.open('invoice_pdf/<?PHP echo $result ?>', '_blank');
			
			window.location.href = "invoice_labour";
			</script>
<?php	}
	}}else{
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already add this job card number</div>');
            redirect('Admin/invoice_labour');
	} }else{
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Success!!!</div>');
            redirect('Admin/list_invoice');
		
	}
	}
}
public function list_invoice()
 {
      $data['invo'] = $this->Bill_model->list_invoice_ready_labour();
      $data['title']='Ready for Bill List(Labour)';
      $this->load->view('Admin/header',$data);
      $this->load->view('Admin/invoice_listt',$data);
      $this->load->view('Admin/footer');
}
public function edit_invoice()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
			{
$id=$this->input->post('inv_id');
$data['cust'] = $this->Bill_model->view_invoice_customer_ready($id);
$data['invo'] = $this->Bill_model->view_invoice($id);
$data['labour']=$this->Bill_model->Select_labour();
		  $data['title']='Labour Invoice Ready for Bill';
      $this->load->view('Admin/header',$data);
		  $this->load->view('Admin/invoice_edit_view',$data);
		  $this->load->view('Admin/footer');
	} else {
				redirect('Admin/index', 'refresh');
			}
}	
public function invoice_pdf($id)
{
$data = array(
				'ready_status'=>0
				
				);
$update_readybill=$this->Bill_model->update_ready_customer($data,$id);	
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
$this->load->view('Admin/tax_invoice_pdf1',$data);
}
public function invoice_pdf_ready()
{
	$print=$this->input->post('print');
	 $ids=$this->input->post('id');	
$exist=$this->Bill_model->check_exist_labour_ready($ids);	
if($exist==null){
	if($print)
{
	 $jbno=$this->input->post('jno');
   $query = $this->db->select('*')->from('tbl_invoice_labour')->where('inv_job_card_no',$jbno)->get()->result();
	if($query == null){
	$branch_id= $this->input->post('branchname'); 
	$cur_date=date('Y-m-d');
	$year=explode('-',$cur_date);
				 $branch = $this->Bill_model->get_branch_id($branch_id); 
				 $invoice_id=$this->Bill_model->get_mx_invoice();
				 if($invoice_id==false)
				 {
					 $auto_serial_no = "CI".$year[0].$branch."1";
				}
				 else
				 {
					  $invoice_id2=$this->Bill_model->get_mx_invoice2($invoice_id);
					  if($invoice_id2==false)
					  {
					 }
					  else
					  {
					   $serialn=$invoice_id+1; 
					 $serialns= strlen($serialn);
					  if($serialns >4){
						  $serial=$serialn;
					  }else{
						   $serial="0".$serialn;
					  }
					   $auto_serial_no = "CI".$year[0].$branch.$serial;
					  }
				}  	
$upd_data=array(
            'inv_no'=>$auto_serial_no,
            'inv_cus'=>$this->input->post('cusname'),
            'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$this->input->post('rno'),
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_sale_date'=>$this->input->post('saledate'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'ready_status'=>0
            );	
$id=$this->Bill_model->insert_inv_ready($upd_data);			
$form_data=  $this->input->post();		
$result1=$this->Bill_model->invoice_dtls_insert($form_data,$id);
$data = array(
				'ready_status'=>0
				);
				$ids=$this->input->post('id');	
$update_readybill=$this->Bill_model->update_ready_customer_ready($data,$ids);
redirect('Admin/pdf_for_ready_bill/'.$id);
}else{
$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">Job card number is already entered. Please enter a new Job card number.  </div>');
		 redirect('Report/list_previous_bill','refresh');	
}
}
else{

	 $jbno=$this->input->post('jno');
	  $jbnoss=$this->input->post('jnoss');
	 if($jbno == $jbnoss) {
		$existjcno = null;
		}
	 else{
	$existjcno = $this->db->select('*')->from('tbl_readyfor_labour')->where('inv_job_card_no',$jbno)->get()->result();	 
	 }
	if($existjcno == null) {
	  $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');
	  $data['invid']=$invid;
	  $data=array(
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'inv_job_card_no'=>$this->input->post('jno'),
			'inv_km'=>$this->input->post('km'),
			'inv_pho'=>$this->input->post('cusph'),	
			'inv_repair_typ'=>$this->input->post('repairty'),
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>1
            );
			$ans=$this->Bill_model->check_registration($reg);
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_labour($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				 redirect('Admin/list_invoice/'.$result);
			}
		}else{
$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">Job card number is already entered. Please enter a new Job card number.  </div>');
		 redirect('Report/list_invoice','refresh');	
}	
}
}
else{
 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">You have already Generated the bill,this is available in previous bill section  </div>');
		 redirect('Report/list_previous_bill','refresh');
}
}
public function pdf_for_ready_bill($id)
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
$this->load->view('Admin/tax_invoice_pdf1',$data);
}

public function invoice_insurance_pdf_ready()
{
	$ids=$this->input->post('id');
	$idss=$this->input->post('cusgst');
$exist=$this->Bill_model->check_exist_labour_ready($ids);	
if($exist==null){
	$print=$this->input->post('print');
	if($print)
	{
	$jbno=$this->input->post('jno');	
	$query = $this->db->select('*')->from('tbl_invoice_labour')->where('inv_job_card_no',$jbno)->get()->result();
	if($query == null){	
$branch_id= $this->input->post('branchname'); 
	$cur_date=date('Y-m-d');
	$year=explode('-',$cur_date);
				 $branch = $this->Bill_model->get_branch_id($branch_id); 
				 $invoice_id=$this->Bill_model->get_mx_invoice();
				 if($invoice_id==false)
				 {
					 $auto_serial_no = "CI".$year[0].$branch."1";
				 }
				 else
				 {
					  $invoice_id2=$this->Bill_model->get_mx_invoice2($invoice_id);
					  if($invoice_id2==false)
					  {
					 }
					  else
					  {
					 $serialn=$invoice_id+1; 
					 $serialns= strlen($serialn);
					  if($serialns >4){
						  $serial=$serialn;
					  }else{
						   $serial="0".$serialn;
					  }
					   $auto_serial_no = "CI".$year[0].$branch.$serial;
					   }
					 }  
 $upd_data=array(
            'inv_no'=>$auto_serial_no,
            'inv_cus'=>$this->input->post('cusname'),
            //'inv_cus_addres'=>$this->input->post('cusaddr'),
            'inv_pho'=>$this->input->post('cusph'),
            'inv_cus_gstin'=>$this->input->post('cusgst'),
            'inv_inv_date'=>$this->input->post('invoicedate'),
            'inv_type'=>$this->input->post('invtype'),
            'inv_job_card_no'=>$this->input->post('jno'),
            'inv_jcard_date'=>$this->input->post('jname'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_km'=>$this->input->post('km'),
            'in_registr'=>$this->input->post('rno'),
            'inv_chassis'=>$this->input->post('cno'),
            'in_engine'=>$this->input->post('eno'),
            'inv_modl'=>$this->input->post('mname'),
            'inv_taxpay'=>"No",
            'inv_advisername'=>$this->input->post('advname'),
            'inv_mechna'=>$this->input->post('mechname'),
            'inv_branch'=>$this->input->post('branchname'),
            'inv_disc_total'=>$this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'insurance_id'=>$this->input->post('ins_id'),
			'insurance_serveyor'=>$this->input->post('surveyor'),
			'ready_status'=>0,
			'status'=>1,
            );
$id=$this->Bill_model->insert_inv_ready($upd_data);				
$form_data=  $this->input->post();		
$result1=$this->Bill_model->invoice_dtls_insert($form_data,$id);
$data = array(
				'ready_status'=>0
				);
				$ids=$this->input->post('id');
$update_readybill=$this->Bill_model->update_ready_customer_ready($data,$ids);		
redirect('Admin/invoice_insurance_pdf_ready_for_bill/'.$id);
	}else{
$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">Job card number is already entered. Please enter a new Job card number.  </div>');
		 redirect('Report/list_previous_bill_insurance','refresh');	
}
}
else{
	$jbno=$this->input->post('jno');
	  $jbnoss=$this->input->post('jnoss');
	 if($jbno == $jbnoss) {
		$existjcno = null;
		}
	 else{
	$existjcno = $this->db->select('*')->from('tbl_readyfor_labour')->where('inv_job_card_no',$jbno)->get()->result();	 
	 }
	if($existjcno == null) {
	  $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');
	  $data['invid']=$invid;
	  $data=array(
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'inv_job_card_no'=>$this->input->post('jno'),
			 'inv_km'=>$this->input->post('km'),
                'inv_repair_typ'=>$this->input->post('repairty'),
                'inv_pho'=>$this->input->post('cusph'), 
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>1
            );
			$ans=$this->Bill_model->check_registration($reg);
			
			if($ans == null){
				$cust = array(
				'c_name'=>$this->input->post('cusname'),
				'c_address'=>$this->input->post('cusaddr'),
				'gstin_no'=>$this->input->post('cusgst'),
				'c_contact_no'=>$this->input->post('cusph'),
				'c_reg_no'=>$reg,
				'c_chassis_no'=>$this->input->post('cno'),
				'c_engine_no'=>$this->input->post('eno'),
				'model_name'=>$this->input->post('mname')
				);
				$result=$this->Bill_model->insert_customer_dtls($cust);
			}
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_labour($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				redirect('Admin/list_insurance_invoice/'.$result);
			}
}else{
$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">Job card number is already entered. Please enter a new Job card number.  </div>');
		 redirect('Report/list_insurance_invoice','refresh');	
}				
}}
else{
 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">You have already Generated the bill,this is available in previous bill section  </div>');
		 redirect('Report/list_previous_bill_insurance','refresh');
}
}
public function checjobcrd_labour()
 {
	  $jbno = $_POST['id'];
$this->db->select('*');
$this->db->from('tbl_readyfor_labour');
$this->db->where('inv_job_card_no',$jbno);
$query = $this->db->get()->result();
if($query == True){
			  $result['status'] = true;
		   } else{
			  $result['status'] = false;
		   }
echo json_encode($result);		   
 }
 
 public function is_chasis_unique()
 {
	  $cno = $_POST['chasisNo'];
$query = $this->db->select('*')->from('customer_details')->where('c_chassis_no',$cno)->get()->result();
if($query == True){
			  $result['status'] = true;
		   } else{
			  $result['status'] = false;
		   }
echo json_encode($result);		   
 }
 
public function invoice_insurance_pdf_ready_for_bill($id)
{
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
$this->load->library('Pdf');
$this->load->view('Admin/insurance_invoice_pdf1',$data);
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
public function edit_invoice_single()
	{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
	{
	$id=$this->input->post('inv_id');
	$data['invoice'] = $this->Bill_model->list_invoice();
	$data['cust'] = $this->Bill_model->view_invoice_customer($id);
	$data['invo'] = $this->Bill_model->view_invoice($id);
	$this->load->view('Admin/header');
	$this->load->view('Admin/invoice_listt',$data);
	$this->load->view('Admin/footer');
	} 
	else{
	redirect('Admin/index', 'refresh');
	}
	}
//----------------------------------INSURANCE COMPANY----------------------------------------//

public function insurance_company()
{
     $data['title']='Add Insurance Company';
	 $this->load->view('Admin/header',$data);
     $this->load->view('Admin/add_insurance_company');
     $this->load->view('Admin/footer');
}
public function add_insurance_company()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('company_name', 'Insurance Company Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('gst', 'GST IN', 'required');
	    $this->form_validation->set_message('required', '*Field is required');
 if ($this->form_validation->run() === false)
     { 
                $this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Please enter Valid Details </div>');
				
                  redirect('Admin/admin_home_page');
      }
      else
        {
        $data=array(
       'icompany_name'=>$this->input->post('company_name'),
	   'icompany_address'=>$this->input->post('address'),
	   'icompany_gst'=>$this->input->post('gst')
		);
   if($this->Admin_model->insurance_company($data))
    {
        $this->session->set_flashdata('msg', '<div class="alert alert-success disabled color-palette text-center"> Added successfully</div>');
				
               redirect('Admin/insurance_company');
    }
       } 
    	} else {
            redirect('Admin/index', 'refresh');
        }
}
public function list_insurance_company()
 {
      $data['list_ins'] = $this->Admin_model->list_insurance();
      $data['title']='List Insurance Company';
	 $this->load->view('Admin/header',$data);
      $this->load->view('Admin/list_insurance_company',$data);
      $this->load->view('Admin/footer');
}
public function edit_insurance_company($id)
	{
			if(isset($id))
      {
		  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['one'] = $this->Admin_model->Selectbyid_insurance($id);
			$data['title']='Edit Insurance Company';
	 $this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_insurance_company',$data);
            $this->load->view('Admin/footer');
			} else {
            redirect('Admin/index', 'refresh');
        }
	  }
	}
	public function update_insurance_company()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			 $id=$this->input->post('bid');
		 
                $data=array(
       'icompany_name'=>$this->input->post('company_name'),
	   'icompany_address'=>$this->input->post('address'),
	   'icompany_gst'=>$this->input->post('gst')
		);
					 $result   = $this->Admin_model->update_insurance($data,$id);
				   
                    if ($result) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Updated</div>');
                        redirect('Admin/list_insurance_company');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_insurance_company');
                    }
                }
			
            
			else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function delete_insurance_company($id)
	{
		$data = $this->Admin_model->remove_insurance($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed </div>');
                        redirect('Admin/list_insurance_company');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_insurance_company');
                    }
		
	}
   public function edit_jobcard($id)
{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
$data['cust'] = $this->Bill_model->view_invoice_customer($id);
$data['invo'] = $this->Bill_model->view_invoice1($id);
$data['title']='Summary Details';
$this->load->view('Admin/header',$data);
$this->load->view('Admin/jobcard_edit_view',$data);
$this->load->view('Admin/footer');
 
 } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_employee');
                    }}
public function employee_login_update_processing()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
		
				 $id=$this->input->post('id');
				 $id1=$this->input->post('l_id');
				 //$login=$this->Admin_model->login_detail($id1);
				 $role =$this->input->post('status');
				
				
				   $username=$this->input->post('username');				
                    date_default_timezone_set("Asia/Kolkata");
                    $password = $this->input->post('password');
                    $en_pass  = $this->Admin_model->hash_password($password);
					 $data1    = array(
                        'uname' =>$username,
                        'pwd' => $en_pass,
                        'role' => '2',
                        'role_des' => 'employee',
                    );
                    $id2 = $this->Admin_model->update_login($data1,$id1);
					$data = array(
				    
				    'emp_intial' =>$this->input->post('intial'),
                    'e_first_name' =>$this->input->post('first_name'),
					'e_branch' =>$this->input->post('branch'),
			     	'e_address' =>$this->input->post('address'),
                    'e_mobile' =>$this->input->post('u_phone'),
                    'e_email' =>$this->input->post('u_email'),
                    'e_code' =>$this->input->post('e_code'),
					'e_designation' =>$this->input->post('desig'),
					'status'=>'active'
                    );
					$result1 = $this->Admin_model->update_users($data,$id);
			}
				
					 
                    if ($result1) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center">Successfully Updated</div>');
                        redirect('Admin/list_employee');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_employee');
                    }
                
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
		 public function remove_invoice_row(){

    $inv_id=$_POST['inv_id'];
    $lc_id=$_POST['inc_id'];

    $cost=$this->Bill_model->sub_invoice_cost($lc_id);
    $res=$this->Bill_model->sub_inv($inv_id);

    $total_diff=$res['inv_total']-$cost['lc_amount'];
    $cgst_diff=$res['inv_gsttotal']-$cost['lc_cgst_a'];
    $utg_diff=$res['inv_sgstotal']-$cost['lc_sgst_a'];
    $taxs_diff=$res['inv_taxtotal']-$cost['lc_tax_amunt'];
    $upd_data=array('inv_total' => $total_diff,
                    'inv_gsttotal' => $cgst_diff,
                    'inv_sgstotal' => $utg_diff,
                    'inv_taxtotal' => $taxs_diff,
                    'inv_id' => $inv_id);
    
    $this->Bill_model->update_inv($upd_data);
    $this->Bill_model->delete_inv($lc_id);

}
public function edit_insurance_invoice()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
			{
		$id=$this->input->post('inv_id');		
	$data['cust'] = $this->Bill_model->view_invoice_customer_insurance_ready($id);
$data['invo'] = $this->Bill_model->view_invoice($id);
$data['labour']=$this->Bill_model->Select_labour();
		  $data['title']='Edit Insurance Invoice';
			$this->load->view('Admin/header',$data);
		  $this->load->view('Admin/insurance_invoice_edit',$data);
		  $this->load->view('Admin/footer');
	} else {
				redirect('Admin/index', 'refresh');
			}
}
public function insure_invoice_pdf($id)
{
$data = array(
				'ready_status'=>0
				
				);
$update_readybill=$this->Bill_model->update_ready_customer($data,$id);	
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
$this->load->library('Pdf');
$this->load->view('Admin/insurance_invoice_pdf1',$data);
}
public function model()
{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
            $data['title']='Add Model';
	 $this->load->view('Admin/header',$data);
            $this->load->view('Admin/add_model');
            $this->load->view('Admin/footer');	
			 } else {
            redirect('Admin/index', 'refresh');
        }
}
public function add_model()
{
 $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('model', 'Model', 'trim|required');
            
    if ($this->form_validation->run() === false)
     { 
                $this->session->set_flashdata('msg', '<div class="alert alert-danger disabled color-palette text-center">Please enter Valid Details </div>');
				
                  redirect('Admin/admin_home_page');
      }
      else
        {
        $data=array(
       'mod_name'=>$this->input->post('model'),
       'mod_code'=>$this->input->post('code')
	      );
   if($this->Admin_model->add_model($data))
    {
        $this->session->set_flashdata('msg', '<div class="alert alert-success disabled color-palette text-center"> Added successfully</div>');
				
               redirect('Admin/model');
    }
       } 
    	
}
public function list_model()
{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['list']=$this->Admin_model->list_model();
           $data['title']='List Model';
	 $this->load->view('Admin/header',$data);
            $this->load->view('Admin/list_model',$data);
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
}
public function edit_model($id)
	{
			if(isset($id))
      {
		  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			$data['one'] = $this->Admin_model->id_select($id);
			$data['title']='Edit Model';
	 $this->load->view('Admin/header',$data);
            $this->load->view('Admin/edit_model',$data);
            $this->load->view('Admin/footer');
			} else {
            redirect('Admin/index', 'refresh');
        }
	  }
	}
	public function update_model()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			 $id=$this->input->post('mid');
		 
                 $data=array(
       'mod_name'=>$this->input->post('model'),
       'mod_code'=>$this->input->post('mcode')
	   );
					 $result   = $this->Admin_model->update_model($data,$id);
				   
                    if ($result) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Updated</div>');
                        redirect('Admin/list_model');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_model');
                    }
                }
			
            
			else {
            redirect('Admin/index', 'refresh');
        }
	}
	public function delete_model($id)
	{
		$data = $this->Admin_model->remove_model($id);
		if($data){
			$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Successfully Removed </div>');
                        redirect('Admin/list_model');
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_model');
                    }
		
	}	
public function insert_new_customer()
{
	$cus_name=$this->input->post('cus_name');
	$cus_reg=$this->input->post('cus_regno');
	$cus_chasis=$this->input->post('cus_chasis');
	$cus_engine=$this->input->post('cus_engine');
	$cus_contact=$this->input->post('cus_contact');
	if($cus_name AND $cus_reg)
	{
					$data=array( 
					  'c_name' => $cus_name,
                     'c_address' => $this->input->post('cus_address'),
                     'c_chassis_no' => $this->input->post('cus_chasis'),
                     'c_engine_no' => $this->input->post('cus_engine'),
                     'c_contact_no'=> $this->input->post('cus_contact'), 
                     'c_sales_date'=>$this->input->post('cus_saledate'),
                     'c_email'=> $this->input->post('cus_email'),
                     'gstin_no'=> $this->input->post('cus_gst'),
                     'c_reg_no' =>$this->input->post('cus_regno'),
                     'model_name' =>$this->input->post('cus_model')
					 );
	  $res=$this->Admin_model->add_customer($data);
     if($res){
		echo $cus_reg;
            //$this->session->set_flashdata('msg', '<div class="alert alert-success  text-center" > Customer successfully added </div>');
			// $this->session->set_flashdata('reg',$cus_reg);
            //redirect('Admin/invoice_labour');
			
          }
          else {
			  echo '1';
          //$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center" >Some error occured... Try Later!!!...</div>');
              //redirect('Admin/invoice_labour');
                    } 	
	}else
	{
		echo'2';
	  //$this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Please fill all the fields Properly!!</div>');
            //redirect('Admin/invoice_labour');	
	}					
}
public function insert_new_customer_insurance()
{
	$cus_name=$this->input->post('cus_name');
	$cus_reg=$this->input->post('cus_regno');
	$cus_chasis=$this->input->post('cus_chasis');
	$cus_engine=$this->input->post('cus_engine');
	$cus_contact=$this->input->post('cus_contact');
	if($cus_name AND $cus_reg)
	{
					$data=array( 'c_name' => $this->input->post('cus_name'),
                     'c_address' => $this->input->post('cus_address'),
                     'c_chassis_no' => $this->input->post('cus_chasis'),
                     'c_engine_no' => $this->input->post('cus_engine'),
                     'c_contact_no'=> $this->input->post('cus_contact'), 
                     'c_sales_date'=>$this->input->post('cus_saledate'),
                     'c_email'=> $this->input->post('cus_email'),
                     'gstin_no'=> $this->input->post('cus_gst'),
                     'c_reg_no' =>$this->input->post('cus_regno'),
                     'model_name' =>$this->input->post('cus_model')
					 );
	  $res=$this->Admin_model->add_customer($data);
     if($res){
            $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center" id="msg"> Customer successfully added </div>');
			 $this->session->set_flashdata('reg',$cus_reg);
            redirect('Admin/invoice_insurance');
			
          }
          else {
              $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center" id="msg">Some error occured... Try Later!!!...</div>');
              redirect('Admin/invoice_insurance');
                    } 	
	}else
	{
	  $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center" id="msg"> Please fill all the fields Properly!!</div>');
            redirect('Admin/invoice_insurance');	
	}					
}
function fetch_user(){ 
		   $this->load->model("crud_model");  
           $fetch_data = $this->crud_model->make_datatables();  
           $data = array(); 
		    $i=1;
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';  
                $sub_array[] = $i++;  
                $sub_array[] = $row->c_name;  
                $sub_array[] = $row->c_address;  
                $sub_array[] = $row->c_reg_no; 
				$sub_array[] = $row->c_chassis_no;  
                $sub_array[] = $row->c_engine_no;  
                $sub_array[] = $row->model_name;  
				$sub_array[] = $row->c_contact_no;  
                $sub_array[] = $row->gstin_no;  
                $sub_array[] = $row->c_sales_date;  				
                $sub_array[] = $row->c_email;
 $sub_array[] ='<div class="btn-group">
		<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		Action<span class="caret" ></span>
		</button>
		 <ul class="dropdown-menu" role="menu">
		 <li><a href="'.base_url().'Admin/edit_customer/'.$row->c_id.'" style="border-radius:10px; margin-left:8px;">Edit</a></li>
		<li><a  data-toggle="modal" data-target="#delete-'.$row->c_id.'" href="#" style="border-radius:10px; margin-left:8px;">Delete</a></li>
		
	</ul>
	</div> 
	<div class="modal hide" style="border-radius:20px;" id="delete-'.$row->c_id.'" role="dialog" >
     <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete This Entry</h4>
      </div>
         <div class="modal-body">
       <div class="alert alert-default"><span class="glyphicon glyphicon-warning-sign"></span> Are you Sure you Want to Delete this Customer?</div>   
      </div>
        <div class="modal-footer ">
         <a href="'.base_url().'Admin/delete_customer/'.$row->c_id.'"><button name="save" class="btn btn-primary" ><span class="glyphicon 
    glyphicon-ok-sign"></span>Yes</button></a>
  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
      </div> 
  </div>
    </div>  
</div> 
	'; 				
               // $sub_array[] = '<button type="button" name="update" id="'.$row->c_id.'" class="btn btn-warning btn-xs">Update</button>';  
                //$sub_array[] = '<button type="button" name="delete" id="'.$row->c_id.'" class="btn btn-danger btn-xs">Delete</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->crud_model->get_all_data(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);  
      } 
	  public function edit_jobcard_statement($id)
{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
$data['cust'] = $this->Bill_model->view_invoice_customer($id);
$data['invo'] = $this->Bill_model->view_invoice1($id);
$data['title']='Statement Details';
$this->load->view('Admin/header',$data);
$this->load->view('Admin/jobcard_edit_view',$data);
$this->load->view('Admin/footer');
 
 } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Admin/list_employee');
                    }}
                    
                    public function edit_invoice_prev()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
			{
$id=$this->input->post('inv_id');
$data['cust'] = $this->Bill_model->view_invoice_customer($id);
$data['invo'] = $this->Bill_model->view_invoice_listing_prev($id);
$data['labour']=$this->Bill_model->Select_labour();
		  $data['title']='Labour Invoice Ready for Bill';
      $this->load->view('Admin/header',$data);
	  $this->load->view('Admin/invoice_edit_view_previous',$data);
	  $this->load->view('Admin/footer');
	} else {
				redirect('Admin/index', 'refresh');
			}
}

public function invoice_pdf_ready_previous()
{
	$id=$this->input->post('id');	
    $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');
	  $data['invid']=$invid;
	  $inv_km=$this->input->post('km');
	  $jbno=$this->input->post('jno');
	   $jbnoss=$this->input->post('jnoss');
	if($jbno == $jbnoss) {
	  $data=array(
	        'inv_job_card_no' =>  $this->input->post('jno'),
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'inv_cus'=>$this->input->post('cusname'),
			'inv_cus_addres'=>$this->input->post('cusaddr'),
			'inv_cus_gstin'=>$this->input->post('cusgst'),
			'inv_km'=> $inv_km,
			'in_registr'=>$this->input->post('rno'),
			'inv_chassis'=>$this->input->post('cno'),
			'in_engine'=>$this->input->post('eno'),
			'inv_modl'=>$this->input->post('mname'),
			'inv_sale_date'=>$this->input->post('saledate'),
			'inv_pho'=>$this->input->post('cusph'),	
			'inv_repair_typ'=>$this->input->post('repairty'),
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>0
            );	
			
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_previous($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				 redirect('Report/list_previous_bill/'.$result);
			}
	}
	else{
$jbno=$this->input->post('jno');
	$jbre=$this->Bill_model->checjobcrd($jbno);	
	if($jbre == null){
	$data=array(
	        'inv_job_card_no' =>  $this->input->post('jno'),
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'inv_cus'=>$this->input->post('cusname'),
			'inv_cus_addres'=>$this->input->post('cusaddr'),
			'inv_cus_gstin'=>$this->input->post('cusgst'),
			'inv_km'=> $inv_km,
			'in_registr'=>$this->input->post('rno'),
			'inv_chassis'=>$this->input->post('cno'),
			'in_engine'=>$this->input->post('eno'),
			'inv_modl'=>$this->input->post('mname'),
			'inv_sale_date'=>$this->input->post('saledate'),
			'inv_pho'=>$this->input->post('cusph'),	
			'inv_repair_typ'=>$this->input->post('repairty'),
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>0
            );	
			
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_previous($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				 redirect('Report/list_previous_bill/'.$result);
			}	
	}else{
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already add this job card number</div>');
            redirect('Report/list_previous_bill');
	}
}
}							
					
					
public function edit_insurance_previous()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
			{
		$id=$this->input->post('inv_id');		
	$data['cust'] = $this->Bill_model->view_invoice_customer_insurance($id);
$data['invo'] = $this->Bill_model->view_invoice_listing_prev($id);
$data['labour']=$this->Bill_model->Select_labour();
$data['detail']=$this->Admin_model->get_insurance();
		  $data['title']='Edit Insurance Invoice';
		  $this->load->view('Admin/header',$data);
		  $this->load->view('Admin/insurance_invoice_edit_previous',$data);
		  $this->load->view('Admin/footer');
	} else {
				redirect('Admin/index', 'refresh');
			}
}	
public function invoice_insurance_editprevious()
{
    $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');
	  $data['invid']=$invid;
	  $jbno=$this->input->post('jno');
	   $jbnoss=$this->input->post('jnoss');
	if($jbno == $jbnoss) {
	  $data=array(
	        'inv_job_card_no' =>  $this->input->post('jno'),
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'in_registr'=>$this->input->post('rno'),
			'inv_km'=>$this->input->post('km'),
			'inv_cus'=>$this->input->post('cusname'),
			'inv_chassis'=>$this->input->post('cno'),
			'in_engine'=>$this->input->post('eno'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_pho'=>$this->input->post('cusph'), 
		    'inv_modl'=>$this->input->post('mname'),
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'insurance_id'=>$this->input->post('ins_id'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>0
            );
			
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_previous($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				redirect('Report/list_previous_bill_insurance/'.$result);
			}	
}
else{
$jbno=$this->input->post('jno');
	$jbre=$this->Bill_model->checjobcrd($jbno);	
	if($jbre == null){
		$data=array(
	        'inv_job_card_no' =>  $this->input->post('jno'),
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
			'in_registr'=>$this->input->post('rno'),
			'inv_km'=>$this->input->post('km'),
			'inv_cus'=>$this->input->post('cusname'),
			'inv_chassis'=>$this->input->post('cno'),
			'in_engine'=>$this->input->post('eno'),
            'inv_repair_typ'=>$this->input->post('repairty'),
            'inv_pho'=>$this->input->post('cusph'), 
		    'inv_modl'=>$this->input->post('mname'),
			'inv_advisername' =>  $this->input->post('advname'),
			'inv_mechna' =>  $this->input->post('mechname'),
			'insurance_id'=>$this->input->post('ins_id'),
			'inv_inv_date' =>  $this->input->post('invoicedate'),
			'ready_status'=>0
            );
			
			$form_data=  $this->input->post();
			$result=$this->Bill_model->invoice_dtls_ready_new_previous($form_data,$data,$invid);
			if($result){
				$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> Updated successfully</div></center>');
				redirect('Report/list_previous_bill_insurance/'.$result);
			}
	}else{
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already add this job card number</div>');
            redirect('Report/list_previous_bill_insurance');
	}
}
}					
public function vehicle_history()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' && $_SESSION['role_des'] === 'admin') 
        {
			
			$data['title']='Vehicle History';
			$this->load->view('Admin/header',$data);
            $this->load->view('Admin/vehicle_history_view');
            $this->load->view('Admin/footer');
           
        } else {
            redirect('Admin/index', 'refresh');
        }
    }
public function vehicle_history_pdf()
{
	$this->load->library('Pdf');
    $pdf = new TCPDF('P', 'mm','A4', true, 'UTF-8', false);
    $pdf->SetTitle('Vehicle History');
    $pdf->SetHeaderMargin(20);
    $pdf->SetTopMargin(10);
    //$pdf->setFooterMargin(10);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
		$no=$this->input->post('id');	
$data['cust'] = $this->Bill_model->view_vehicle_history($no);
if($data['cust']){
$data['invo'] = $this->Bill_model->view_customer_data($no);	
foreach($data['cust'] as $rowz){
	$valu=$rowz->inv_total;
	$current=$rowz->inv_jcard_date;
	$inv_id=$rowz->inv_id;
}
//$data['serv'] = $this->Bill_model->view_service_data($inv_id);	
$or_dat= date('Y-m-d', strtotime($current. ' + 3 month'));
$data['nxtdat']=date("d/m/Y", strtotime($or_dat));
$number =round($valu);
$run=$valu-$number;
$diffr=round($run, 3);
$data['dffr']=$diffr;
$data['eng']= $this->convert_number($number);
}else{
	$this->session->set_flashdata('msg', '<center><div class="alert alert-success disabled color-palette text-center" style="width:500px;"> No Details Available</div></center>');
				redirect('Admin/vehicle_history');
}
        $html = $this->load->view('Admin/vehicle_history_pdf',$data,true);
    $pdf->writeHTML($html, true, false, true, false, '');
    ob_end_clean();     
    $pdf->Output();
}		
/*---------------------------------------------------------------------------------------------------*/
public function logout()
{
        $data = new stdClass();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect('Admin/index', 'refresh');
        } else {
            redirect('/');
        }
    }
}
?>