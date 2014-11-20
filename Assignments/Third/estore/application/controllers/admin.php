<?php
class admin extends CI_Controller {
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->load->library('form_validation');	
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (!(isset($_SESSION['customer']) && $_SESSION['customer']->login == 'admin')){
			redirect('estore', 'refresh');
		}
		
	}
	
	function index() {
		$this->load->model('admin_model');
		$orders = $this->admin_model->getOrders();
		$data['orders'] = $orders;
		$this->load->view('admin/showorders.php', $data);
	}
	
	function ShowOrders()
	{
		$this->load->model('admin_model');
		$orders = $this->admin_model->getOrders();
		$data['orders'] = $orders;
		$this->load->view('admin/showorders.php', $data);
	}
	
	function Edit()
	{
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products']=$products;
		
		$this->load->view('admin/edit.php',$data);
	}
	
	function DeleteItem($id)
	{
		$this->load->model('admin_model');
		$this->admin_model->delete($id);
		redirect('admin/Edit');
	}
	
	function newProd()
	{
		$this->load->view('admin/newproduct.php');
	}
	
	function update($id)
	{	
		$this->load->model('admin_model');

		$products = $this->admin_model->get($id);
		$data['products']=$products;
			
		$this->load->view('admin/updateprod.php',$data);
	}
	
	function updateProd($id)
	{
		$this->load->model('admin_model');
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('price','price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();

		if ($this->form_validation->run()){
			$product = new product();

			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');

			if($fileUploadSuccess){
		    	$data = $this->upload->data();
		    	$product->photo_url = $data['file_name'];
	    	}else{
	    		$product->photo_url = "";
	    	}

			$this->admin_model->update($product);
			redirect('admin/Edit');
		}
		else
		{
			print_r($this->upload->display_errors());
		}
	}
	
	function insertProd()
	{
		$this->load->model('admin_model');
		$this->form_validation->set_rules('name','name','required|is_unique[products.name]');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('price','price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
	    if ($this->form_validation->run() == $fileUploadSuccess){
	    	$product = new product();
	    	
	    	$product->name = $this->input->get_post('name');
	    	$product->description = $this->input->get_post('description');
	    	$product->price = $this->input->get_post('price');
	    		
	    	$data = $this->upload->data();
	    	$product->photo_url = $data['file_name'];

	    	$this->admin_model->insert($product);
	    	
	    	redirect('admin/Edit');
	    	
		}
		else
		{
			print_r($this->upload->display_errors());
		}
	}
	
	function DeleteCustomer($id)
	{
		$this->load->model('admin_model');
		$order = $this->admin_model->deleteCustomer($id);
		
		redirect("admin/DeleteCustomerShow");
	}
	
	function DeleteCustomerShow()
	{
		$this->load->model('admin_model');
		$customer = $this->admin_model->getCustomers();
		$data['customer'] = $customer;
		$this->load->view('admin/deletecustomer.php',$data);
	}
}