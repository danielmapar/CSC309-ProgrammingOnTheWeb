<?php
class user extends CI_Controller {
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
	    $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');	
	}
	
	function index() {
		$data['message'] = $this->session->flashdata('message');
		$this->load->view('login/login.php', $data);
	}
	
	function createAccount(){
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('login','login','required');
		$this->form_validation->set_rules('first','first','required');
		$this->form_validation->set_rules('last','last','required');
		$this->form_validation->set_rules('password','password','required');
		
		$this->load->model('customer_model');
		$user_exist = $this->customer_model->getClientByEmail($this->input->get_post('email'));
		
		$message = " ";
		if(!$user_exist){
			$user_exist = $this->customer_model->getClientByLogin($this->input->get_post('login'));
			$message = 'Login already in use!';
		}else{
			$message = 'Email already in use!';
		}

		if ($this->form_validation->run() && !$user_exist){

			$customer = new customer();
				
			$customer->email = $this->input->get_post('email');
			$customer->login = $this->input->get_post('login');
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
			$customer->password = $this->input->get_post('password');
			
			$this->customer_model->createAccount($customer);
			
			if (session_status() == PHP_SESSION_NONE) {
	   			 session_start();
			}
			$_SESSION['customer'] = $this->customer_model->login($customer->login,$customer->password);


			redirect('estore', 'refresh');
		}
		$this->session->set_flashdata('message', $message);
		redirect('user', 'refresh');
		
	}
	
   function login(){
		$this->load->model('customer_model');
		$usr = $this->customer_model->login($this->input->get_post('login'),$this->input->get_post('password'));
		if ( $usr != NULL)
		{
			if (session_status() == PHP_SESSION_NONE) {
	   			 session_start();
			}
			
			$_SESSION['customer'] = $usr;
			
			if($usr->login == 'admin')
			{
				redirect('admin/index');
				return;
			}

            redirect('estore', 'refresh');
		}
		$this->session->set_flashdata('message', 'Login failed!');
		redirect('user', 'refresh');
   }

   function logout()
   {
   		if (session_status() == PHP_SESSION_NONE) {
	   			 session_start();
		}
   		if(isset($_SESSION['customer']))
   			unset($_SESSION['customer']);
   		session_destroy();
   		
        redirect('estore', 'refresh');
   		
   }
   
}