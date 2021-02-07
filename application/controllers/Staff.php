<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends CI_Controller
{
	public function __construct()
    {
        @date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session','form_validation','email'));
        $this->load->model('User_model');
		$this->load->model('Staff_model');
        $this->load->model('Admin_model');
        $this->load->model('Bill_model');
		$this->load->model('Job_model');
		$this->load->model('Jobcard_model');
    }
public function index()
	{
	    @date_default_timezone_set('Asia/Kolkata');
		$this->load->helper(array('form','url'));
        $this->load->view('Staff/login');
	}
public function staff_login_process()
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
            $this->load->view('Staff/login');
        } else {
            date_default_timezone_set("Asia/Kolkata");
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($username == NULL && $password == NULL) {
                $this->load->view('Staff/login');
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
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') {
                       
             redirect('Staff/staff_home_page', 'refresh');
                    } 
          else {
                         redirect('Staff/index', 'refresh');
                    }
                } 
        else {
                    $this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Wrong Username or password!!!</div>');
            redirect('Staff/index');
                }
            }
        }
  }
public function staff_home_page()
    {
         if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee')
        {
            $this->load->view('Staff/header');
            $this->load->view('Staff/home');
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
        }
}


//-----------------------ChangePassword------------------------------------//   
public function change_password()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
            $data['title']='Change Password';
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/change_password');
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
        }
    }
public function change_staff_password()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee')
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
            $this->load->view('Staff/header');
           $this->load->view('Staff/change_password');
           $this->load->view('Staff/footer');
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
            redirect('Staff/change_password');
          }
          else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Password is not Successfully Updated!!!</div>');
            redirect('Staff/change_password', 'refresh');
        }
           }
        }
        else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Failed to enter old password correctly.. Please Try Again!!!</div>');
            redirect('Staff/change_password', 'refresh');
        }
        }
        else
        {
            redirect('Staff/index', 'refresh');
          }
    }

	//-------------------------------------------Customer------------------------------//
	
public function add_customer(){


        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
			
           $data['model']=$this->Admin_model->get_model_details();
            $data['title']='Add Customer';
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/add_customer',$data);
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
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
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/add_customer',$data);
            $this->load->view('Staff/footer');
   }else{
         $reg=$this->input->post('c_r_no');
            $cnt=$this->Admin_model->check_reg($reg);
            $cn=$cnt->num_rows();
           
            if($cn>0){
                $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Registration number already exists </div>');
                        redirect('Staff/add_customer');
            }
            else{

                      $data=array( 'c_name' => $this->input->post('c_name'),
                     'c_address' => $this->input->post('c_address'),
                     'c_chassis_no' => $this->input->post('c_c_no'),
                     'c_engine_no' => $this->input->post('c_e_no'),
                     'c_contact_no'=> $this->input->post('c_contact'), 
                     'c_sales_date'=>$this->input->post('c_sale'),
                     'c_email'=> $this->input->post('c_email'),
                     'gstin_no'=> $this->input->post('c_g_no'),
					           'model_name'=> $this->input->post('c_m'),
                     'c_reg_no' => $reg);

          $res=$this->Admin_model->add_customer($data);  
          if($res){
            $this->session->set_flashdata('msg', '<div class="alert alert-success  text-center"> Customer successfully added </div>');
                        redirect('Staff/add_customer');
          }
          else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Staff/add_customer');
                    }    
            }

    }
}
public function list_customer(){


        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
            $data['title']='List Customer';
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/list_customer');
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
        }
    }
public function getinvoiceno() 
	{	
		$branch=$this->Bill_model->get_staff_branch();
		
	$cur_date=date('Y-m-d');
	$year=explode('-',$cur_date);
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
	   
	public function insert_new_customer()
{
	$cus_name=$this->input->post('cus_name');
	$cus_reg=$this->input->post('cus_regno');
	$cus_chasis=$this->input->post('cus_chasis');
	$cus_engine=$this->input->post('cus_engine');
	$cus_contact=$this->input->post('cus_contact');
	if($cus_name AND $cus_reg )
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
public function invoice_labour()
{
     if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
	$data['model']=$this->Admin_model->get_model_details();
	
	$data['branchname']= $this->Bill_model->branch_name_select();
	$data['brancid']= $this->Bill_model->branch_name_select_id();
    $data['adv']=$this->Bill_model->Select_adviser_branch($data['branchname']);
	$data['mec']=$this->Bill_model->Select_mechni_branch($data['branchname']);
	$data['brnch']=$this->Bill_model->Select_branch();
	$data['labour']=$this->Bill_model->Select_labour();
     $data['title']='Labour Invoice';
     $this->load->view('Staff/header',$data);
     $this->load->view('Staff/invoice_view',$data);
     $this->load->view('Staff/footer');
}
else {
            redirect('staff/index', 'refresh');
     }
}
public function get_customer_detail($code)
		{
			$re=$this->Admin_model->get_customer($code);//var_dump($re);die();
				echo json_encode($re);
		
			
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
	 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Please Refresh your page!!!...</div>');
	$data['branchname']= $this->Bill_model->branch_name_select();
	$data['brancid']= $this->Bill_model->branch_name_select_id();
    $data['adv']=$this->Bill_model->Select_adviser_branch($data['branchname']);
	$data['mec']=$this->Bill_model->Select_mechni_branch($data['branchname']);
	$data['brnch']=$this->Bill_model->Select_branch();
	$data['labour']=$this->Bill_model->Select_labour();
     $data['title']='Labour Invoice';
     $this->load->view('Staff/header',$data);
     $this->load->view('Staff/invoice_view',$data);
     $this->load->view('Staff/footer');
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
				 redirect('Staff/list_invoice/'.$result);
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
		if($result)
		{
?>
	<script type="text/javascript" language="Javascript">
	
			window.open('invoice_pdf/<?PHP echo $result ?>', '_blank');
			
			window.location.href = "invoice_labour";
			</script>
<?php	}
	} }else{
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already added this job card number</div>');
            redirect('Staff/invoice_labour');
	} }else{
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Success!!!</div>');
            redirect('Staff/list_invoice');
	}
	}
}
public function list_invoice()
 {
	 $brancid= $this->Bill_model->branch_name_select_id();
	 $data['invo'] = $this->Bill_model->list_invoice_staff_labour($brancid);
     $data['title']='Ready for Bill List(Labour)';
	 $this->load->view('Staff/header',$data);
     $this->load->view('Staff/invoice_listt',$data);
     $this->load->view('Staff/footer');
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
				 redirect('Staff/list_insurance_invoice/'.$result);
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
		
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Already added this job card number</div>');
            redirect('Staff/invoice_insurance');
	} }else{
		$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Success!!!</div>');
            redirect('Staff/list_insurance_invoice ');
	}
	}
	}
public function invoice_insurance_pdf($id)
	{
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
	$this->load->view('Staff/tax_invoice_insurance_pdf',$data);
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
$this->load->view('Admin/tax_invoice_pdf1',$data);
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

public function invoice_insurance()
{
	 $data['branchname']= $this->Bill_model->branch_name_select();
	 $data['brancid']= $this->Bill_model->branch_name_select_id();
     $data['detail']=$this->Admin_model->get_insurance();
	 $data['brnch']=$this->Bill_model->Select_branch();
	 $data['labour']=$this->Bill_model->Select_labour();
	 $data['model']=$this->Admin_model->get_model_details();
     $data['adv']=$this->Bill_model->Select_adviser_branch($data['branchname']);
     $data['mec']=$this->Bill_model->Select_mechni_branch($data['branchname']);
   	 $data['detail']=$this->Admin_model->get_insurance();
	 $data['title']='Insurance Invoice';
	 $this->load->view('Staff/header',$data);
     $this->load->view('Staff/insurance_view',$data);
     $this->load->view('Staff/footer');
}
public function cmp_ins(){
$cmp=$_REQUEST['cmp'];
$res=$this->Admin_model->select_ins_cmp($cmp);
echo json_encode($res);
 }
 
 public function edit_invoice()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
			{
$id=$this->input->post('inv_id');
$data['cust'] = $this->Bill_model->view_invoice_customer_ready($id);
$data['invo'] = $this->Bill_model->view_invoice($id);
$data['labour']=$this->Bill_model->Select_labour();
			$data['title']='Labour Invoice Edit';
			$this->load->view('Staff/header',$data);
			$this->load->view('Staff/invoice_edit_view',$data);
			$this->load->view('Staff/footer');
	} else {
				redirect('Staff/index', 'refresh');
			}
}

 public function list_previous_bill_staff()
 {
	  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
			
	  $brancid= $this->Bill_model->branch_name_select_id();
	  $data['invo'] = $this->Bill_model->list_invoice_previous_staff($brancid);
	  $data['title']='Previous Bill(Labour)';
			$this->load->view('Staff/header',$data);
      $this->load->view('Staff/invoice_listt_previous_staff',$data);
      $this->load->view('Staff/footer');
	  } else {
            redirect('Staff/index', 'refresh');
        }
}
public function invoice_pdf_prev_bill($id)
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
public function invoice_pdf_prev_bill_insura($id)
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

$this->load->view('Staff/tax_invo_prev_insur_bill_pdf',$data);
}

 public function list_previous_bill_insurances()
 {
	  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
	 $brancid= $this->Bill_model->branch_name_select_id();
	  $data['invo'] = $this->Bill_model->list_invoice_previous_staff_insur($brancid);
	  $data['title']='Previous Bill(Insurance)';
	  $this->load->view('Staff/header',$data);
      $this->load->view('Staff/invoice_previous_insurance_bill',$data);
      $this->load->view('Staff/footer');
	  } else {
             redirect('Staff/index', 'refresh');
        }
}

public function list_job_card_staff()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
			 $bid= $this->Bill_model->branch_name_select_id();
			$main_branch= $this->Admin_model->get_branch_main_staff($bid);
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
			$this->load->view('Staff/header');
            $this->load->view('Staff/list_jobcard_staff',$data);
            $this->load->view('Staff/footer');
        } else {
             redirect('Staff/index', 'refresh');
        }
	}
public function list_custom_date_staff()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
		 $excel=$this->input->post('excel');
			 $view_by=$this->input->post('view_by');
			 $data['view_by']=$view_by;
			 $mech=$this->input->post('mech');
			 $repair=$this->input->post('repair');  
             $ins_company=$this->input->post('ins_company');
			 $from=$this->input->post('from');
			 $to=$this->input->post('to');
			$data['fromdate']=$from;
			 $data['todate']=$to;
			$branch=$this->input->post('branch');
			$service=$this->input->post('view_service');
		    $advisor=$this->input->post('advisor');
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

             $this->excel->getActiveSheet()->SetCellValue('AK3', 'INSURANCE SERVEYOR');
            $this->excel->getActiveSheet()->getStyle('AK3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AM3', 'PAID SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AM3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AO3', 'FREE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AO3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AQ3', 'EXPENSE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AQ3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AS3', 'CUSTOMER GSTN');
            $this->excel->getActiveSheet()->getStyle('AS3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AU3', 'DISCOUNT');
            $this->excel->getActiveSheet()->getStyle('AU3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AW3', 'TAXABLE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AW3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AY3', 'SGST/UGST');
            $this->excel->getActiveSheet()->getStyle('AY3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BA3', 'CGST');
            $this->excel->getActiveSheet()->getStyle('BA3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('BC3', 'INVOICE TYPE');
            $this->excel->getActiveSheet()->getStyle('BC3')->getFont()->setBold(true);
			 $this->excel->getActiveSheet()->SetCellValue('BE3', 'INVOICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('BE3')->getFont()->setBold(true);
  $data['list'] = $this->Admin_model->list_custom_date_mech_ins($from,$to,$mech,$branch,$advisor,$service,$repair,$ins_company);

$row = 4; // 1-based index
$col = 0;
$total=0;
        $no = 1;
     $hsn=998729;
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
                      $col++;$col++;
					   $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->insurance_serveyor);
					    $col++;$col++;
                        if($value->lc_type=="Paid Service"){
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_total);
                       $col++;$col++;$col++;$col++;$col++;$col++;
                      }

                      if($value->lc_type=="Free Service"){
						  $col++;$col++;
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->id_sum);
                       $col++;$col++;$col++;$col++;
                      }

                      if($value->lc_type=="Expense"){
						  $col++;$col++;$col++;$col++;
                      	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->id_sum);
						 $col++;$col++;
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
                       $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_sgstotal);
                       $col++;$col++;

                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_gsttotal);
                       $col++;$col++;

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
             redirect('Staff/index', 'refresh');
        }
}
	

public function list_job_card_statement()
	{
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 	
        {  
	        $bid= $this->Bill_model->branch_name_select_id();
			$main_branch= $this->Admin_model->get_branch_main_staff($bid);
			foreach($main_branch as $row)
			{
				$data['id']=$row->b_id;
				$data['name']=$row->branch_name;
				$data['ids']=$row->branch_id;
			}
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
            $this->load->view('Staff/header',$data);
            $this->load->view('Staff/list_jobcard_statement',$data);
            $this->load->view('Staff/footer');
        } else {
			redirect('Staff/index','refresh');
           }
	}
public function list_job_card_statement_proccessing()
	{
		 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
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

             $this->excel->getActiveSheet()->SetCellValue('AG3', 'BILL TYPE');
            $this->excel->getActiveSheet()->getStyle('AG3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AH3', 'INSURANCE COMPANY');
            $this->excel->getActiveSheet()->getStyle('AH3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AK3', 'PAID SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AK3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AM3', 'FREE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AM3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AO3', 'EXPENSE SERVICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AO3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AQ3', 'CUSTOMER GSTN');
            $this->excel->getActiveSheet()->getStyle('AQ3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AS3', 'DISCOUNT');
            $this->excel->getActiveSheet()->getStyle('AS3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AU3', 'TAXABLE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AU3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AW3', 'INVOICE TYPE');
            $this->excel->getActiveSheet()->getStyle('AW3')->getFont()->setBold(true);

             $this->excel->getActiveSheet()->SetCellValue('AY3', 'INVOICE AMOUNT');
            $this->excel->getActiveSheet()->getStyle('AY3')->getFont()->setBold(true);

 $data['list']= $this->Admin_model->list_job_card_statement_ins($from,$to,$mech,$branch,$code,$advisor,$service,$repair,$ins_company);

$row = 4; // 1-based index
$col = 0;
$total=0;
$count = 0;
$lcdisc=0;
$taxtot=0;
        $no = 1;
     
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

                         $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_type);
                      $col++;
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->icompany_name);
                      $col++;$col++; $col++;
		$status = ($value->lc_type== 'Paid Service')?	$value->lc_amount:'0';
		$status1 = ($value->lc_type== 'Free Service')?	$value->lc_rate:'0';
		$status2 = ($value->lc_type== 'Expense')?	$value->lc_rate:'0';
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status);
                        $col++; $col++;
						 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status1);
                         $col++; $col++;
						 $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $status2);
                         $col++;$col++;
                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_cus_gstin);
                       $col++;$col++;

                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_disc);
                       $col++;$col++;

                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_tax_amunt);
                       $col++;$col++;

                       
                       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->inv_type);
                       $col++;$col++;


                        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->lc_amount);
                       $row++;$col++;

                        
						
                       // echo $row . ", ". $col . "<br>";
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
            redirect('Staff/index','refresh');
        }
}
public function invoice_pdf_ready()
{ 
$ids=$this->input->post('id');	
$exist=$this->Bill_model->check_exist_labour_ready($ids);	
if($exist==null){
	$print=$this->input->post('print');
if($print)
	{
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
}
else{
	  $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');//var_dump($invid);die();
	  $data['invid']=$invid;
	  $data=array(
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
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
				 redirect('Staff/list_invoice/'.$result);
			}	
}}
else{
 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">You have already Generated the bill,this is available in previous bill section. </div>');
		 redirect('Staff/list_previous_bill_staff','refresh');
}
}
public function vehicle_history_staff()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
        {
			
			$data['title']='Vehicle History';
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/vehicle_history_view_staff');
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
        }
    }
public function vehicle_history_pdf_staff()
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
				redirect('Staff/vehicle_history_staff');
}
        $html = $this->load->view('Admin/vehicle_history_pdf',$data,true);
    $pdf->writeHTML($html, true, false, true, false, '');
    ob_end_clean();     
    $pdf->Output();
}	
public function list_insurance_invoice()
 {
	  $brancid= $this->Bill_model->branch_name_select_id();
      $data['invo'] = $this->Bill_model->list_insurance_invoice_staff_ready($brancid);
      $data['title']='Ready for Bill List(Insurance)';
	  $this->load->view('Staff/header',$data);
      $this->load->view('Staff/insurance_invoice_listt',$data);
      $this->load->view('Staff/footer');
}
public function edit_insurance_invoice()
{
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
			{
	$id=$this->input->post('inv_id');
	$data['cust'] = $this->Bill_model->view_invoice_customer_insurance_staff($id);
$data['invo'] = $this->Bill_model->view_invoice($id);
$data['labour']=$this->Bill_model->Select_labour();
		$data['title']='Insurance Invoice edite)';
	    $this->load->view('Staff/header',$data);
		  $this->load->view('Staff/insurance_invoice_edit',$data);
		  $this->load->view('Staff/footer');
	} else {
				redirect('Staff/index', 'refresh');
			}
}
public function invoice_insurance_pdf_ready()
{
	$ids=$this->input->post('id');
	$exist=$this->Bill_model->check_exist_labour_ready($ids);	
if($exist==null){
	$print=$this->input->post('print');
	if($print)
	{
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
}
else{
	  $reg=$this->input->post('rno');
	  $invid=$this->input->post('id');
	  $data['invid']=$invid;
	  $data=array(
			'inv_disc_total' =>  $this->input->post('tdisc'),
            'inv_taxtotal'=>$this->input->post('ttotl'),
            'inv_sgstotal'=>$this->input->post('sgtotal'),
            'inv_gsttotal'=>$this->input->post('gstotl'),
            'inv_total'=>$this->input->post('total'),
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
				redirect('Staff/list_insurance_invoice/'.$result);
			}	
}}
else{
 $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center">You have already Generated the bill,this is available in previous bill section</div>');
		 redirect('Staff/list_previous_bill_insurances','refresh');
}
}
public function insert_new_customer_insurance()
{
  $cus_name=$this->input->post('cus_name');
  $cus_reg=$this->input->post('cus_regno');
  $cus_chasis=$this->input->post('cus_chasis');
  $cus_engine=$this->input->post('cus_engine');
  $cus_contact=$this->input->post('cus_contact');
  if($cus_name AND $cus_reg AND $cus_chasis AND $cus_engine AND $cus_contact)
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
   public function edit_jobcard($id)
{

$data['cust'] = $this->Bill_model->view_invoice_customer($id);
$data['invo'] = $this->Bill_model->view_invoice_listing($id);
$data['title']='Summary Details';
$this->load->view('Staff/header',$data);
$this->load->view('Admin/jobcard_edit_view',$data);
$this->load->view('Staff/footer');
}

public function fetch_user(){ 
		     
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
				
               $sub_array[] = '<div class="btn-group">
		<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
		Action<span class="caret" ></span>
		</button>
		 <ul class="dropdown-menu" role="menu">
		 <li><a href="'.base_url().'Staff/edit_customer/'.$row->c_id.'" style="border-radius:10px; margin-left:8px;">Edit</a></li>
		</ul>
	</div> ';
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"               =>     intval($_POST["draw"]),  
                "recordsTotal"       =>     $this->crud_model->get_all_data(),  
                "recordsFiltered"    =>     $this->crud_model->get_filtered_data(),  
                "data"               =>     $data  
           );  
           echo json_encode($output);  
      } 
	  public function edit_jobcard_statement($id)
{

$data['cust'] = $this->Bill_model->view_invoice_customer($id);
$data['invo'] = $this->Bill_model->view_invoice_listing($id);
$data['title']='Statement Details';
$this->load->view('Staff/header',$data);
$this->load->view('Admin/jobcard_edit_view',$data);
$this->load->view('Staff/footer');
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
		  public function select_ins_company()
     {
       $branch_id= $_POST["branchno3"]; 
       $branch = $this->Bill_model->select_company_by_brnch($branch_id);    
       //var_dump( $branch);die();
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
		$count = $this->Job_model->count_filtered();
		$data = array();
		$no = $_POST['start'];
		 foreach($list as $row)  
           {  
                $sub_array = array();
				if($row->lc_type=="Paid Service"){
				$total=$row->lc_amount;	
				 }else
				 {
					  $total=$row->lc_rate;
				 }
	//$total=$row->lc_amount;	
 $sub_array[]='<input type="hidden" class="lc_code" value="'.$count.'"><input type="hidden" class="lc_amt" value="'.$total.'"><a style="font-size:11px;" href="'.base_url().'Admin/edit_jobcard/'.$row->inv_id.'">'.$row->inv_job_card_no.'</a>';				
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
				 }if($row->lc_type=="Paid Service"){
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
				$sub_array[] = ($row->lc_type== 'Paid Service')?	$row->inv_disc_total:'0'; 
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
		public function edit_customer($id){

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' && $_SESSION['role_des'] === 'employee') 
			{

            $res['c_list']=$this->Admin_model->edit_customer($id);
            $res['model']=$this->Admin_model->get_model_details();
            $data['title']='Edit Customer';
			$this->load->view('Staff/header',$data);
            $this->load->view('Staff/edit_customer',$res);
            $this->load->view('Staff/footer');
           
        } else {
            redirect('Staff/index', 'refresh');
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
                        redirect('Staff/list_customer');
          }
          else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger  text-center"> Some error occured... Try Later!!!...</div>');
                        redirect('Staff/list_customer');
                    }  


    }	
   
//---------------------------------------------------------------------------------------//

public function logout()
{
        $data = new stdClass();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect('Staff/index', 'refresh');
        } else {
            redirect('/');
        }
    }
}
?>