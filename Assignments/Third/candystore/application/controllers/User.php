<?php
class User extends CI_Controller {
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
	
	}
	
	function index() {
		$this->load->view('login/login.php');
	}
	
	function createAccount(){
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('login','login','required');
		$this->form_validation->set_rules('first','first','required');
		$this->form_validation->set_rules('last','last','required');
		$this->form_validation->set_rules('password','password','required');
		
		if ($this->form_validation->run()){
			$this->load->model('Customer_Model');
			$customer = new Customer();
				
			$customer->email = $this->input->get_post('email');
			$customer->login = $this->input->get_post('login');
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
			$customer->password = $this->input->get_post('password');
			
			$this->Customer_Model->createAccount($customer);
			redirect('index.php/index', 'refresh');
		}

		
	}
	
   function login(){
		$this->load->model('Customer_Model');
		$usr = $this->Customer_Model->login($this->input->get_post('login'),$this->input->get_post('password'));
		if ( $usr != NULL)
		{
			if (session_status() == PHP_SESSION_NONE) {
	   			 session_start();
			}
			
			$_SESSION['customer'] = $usr;
			
			if($usr->login == 'admin')
			{
				redirect('Admin/index');
				return;
			}

            redirect('CandyStore', 'refresh');
		}
   }

   function logout()
   {
   		if (session_status() == PHP_SESSION_NONE) {
	   			 session_start();
		}
   		if(isset($_SESSION['customer']))
   			unset($_SESSION['customer']);
   		session_destroy();
   		
        redirect('CandyStore', 'refresh');
   		
   }
   
}