<?php
class Admin extends CI_Controller {
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
	}
	
	function index() {
		$this->load->model('admin_model');
		$orders = $this->admin_model->getOrders();
		$data['orders'] = $orders;
		$this->load->view('Admin/ShowOrders.php', $data);
	}
	
	function ShowOrders()
	{
		$this->load->model('admin_model');
		$orders = $this->admin_model->getOrders();
		$data['orders'] = $orders;
		$this->load->view('Admin/ShowOrders.php', $data);
	}
	
	function Edit()
	{
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products']=$products;
		
		$this->load->view('Admin/Edit.php',$data);
	}
	
	function DeleteItem($id)
	{
		$this->load->model('admin_model');
		$this->admin_model->delete($id);
		redirect('admin/Edit');
	}
	
	function newProd()
	{
		$this->load->view('Admin/NewProduct.php');
	}
	
	function update($id)
	{	
		$this->load->model('admin_model');

		$products = $this->admin_model->get($id);
		$data['products']=$products;
			
		$this->load->view('Admin/updateProd.php',$data);
	}
	
	function updateProd($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('price','price','required');
		if ($this->form_validation->run()){
			$this->load->model('admin_model');
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			$this->admin_model->update($product);
		}
		redirect('admin/Edit');
	}
	
	function insertProd()
	{
		$this->load->model('admin_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('price','price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
	    if ($this->form_validation->run() == $fileUploadSuccess){
	    	$product = new Product();
	    	
	    	$product->name = $this->input->get_post('name');
	    	$product->description = $this->input->get_post('description');
	    	$product->price = $this->input->get_post('price');
	    		
	    	$data = $this->upload->data();
	    	$product->photo_url = $data['file_name'];
	    		
	    	$this->admin_model->insert($product);
	    	
	    	redirect('admin/edit');
	    	
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
		
		redirect("Admin/DeleteCustomerShow");
	}
	
	function DeleteCustomerShow()
	{
		$this->load->model('admin_model');
		$customer = $this->admin_model->getCustomers();
		$data['customer'] = $customer;
		$this->load->view('Admin/DeleteCustomer.php',$data);
	}
}