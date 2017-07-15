<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct(){
	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin/admin_model');
                $this->load->library('session');
	}

	public function index()
	{	
		$this->load->view('admin/login');
	}
	

	public function admin_login()
	{
		$this->form_validation->set_rules('username', ' username', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'required');
		 	 
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/login');
		}else{
			$name = strip_tags($this->input->post('username'));
			$password = $this->input->post('password');
			$md5_password = md5($password);
			
			$data = array(
			'username'=>$name,
			'password'=>$md5_password
			);
			$userinfo = $this->admin_model->chkLogin($data);
			if($userinfo !== FALSE){ //echo 123;exit;
				$session = array(
						'userid' => $userinfo->id,
						'username' => $userinfo->username,
						'usertype' => $userinfo->type
						);
					
				$this->session->set_userdata($session);
				//redirect('admin/members');
                                redirect('admin/dashboard');
			}
			$this->session->set_flashdata('loginerr', ' Wrong Email and Password . Try Again');
			redirect('admin');
 	  }
	  
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}

		
	public function register()
	{
		$this->form_validation->set_rules('username', ' username', 'required|trim|is_unique[users.username]');	
		$this->form_validation->set_rules('firstname', 'firstname', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
		$this->form_validation->set_rules('lastname', 'lastname', 'required|trim');
		$this->form_validation->set_rules('user_type', 'user type', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|matches[re_pass]|trim');
		$this->form_validation->set_rules('re_pass', 'Retype password', 'required|trim');
		 	 
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/register');
		}else{
			$password = $this->input->post('password');
			$md5_password = md5($password);
			$data['username'] = strip_tags($this->input->post('username'));
			$data['firstname'] =strip_tags($this->input->post('firstname'));
			$data['lastname'] = strip_tags($this->input->post('lastname'));
			$data['type'] = strip_tags($this->input->post('user_type'));
			$data['email'] = strip_tags($this->input->post('email'));
			$data['password'] = $md5_password;
			$data['date_added'] = date('Y-m-d',time());
			$this->admin_model->insert($data);
			redirect('login/index');
	 
	  }
	  
	}

	public function errors(){
		$data['breadcumbs'][]='<a href="'.base_url('admin/index/').'">Home</a>';
		$data['breadcumbs'][]='<a href="'.base_url('admin/errors/').'">Errors </a>';
		$data['title'] = "Errors";
		$this->load->view('admin/common/header',$data);
		$this->load->view('admin/common/left_sidebar');
		$this->load->view('admin/common/errors',$data);
		$this->load->view('admin/common/footer');
	}

	

	
	
	
	
}