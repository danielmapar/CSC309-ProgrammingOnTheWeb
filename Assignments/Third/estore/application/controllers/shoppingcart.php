<?php

class shoppingcart extends CI_Controller
{
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->load->library('form_validation');	
	}
	
	function index ()
	{
		$this->load->view('shoppingcart/cart.php');
	}
	
	function Edit(){
		$arr = array();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION['cart']))
		{
			$item = $_SESSION['cart'];
            while (list($key, $value) = each($item)) {
            	$this->load->model('product_model');
            	$prod = $this->product_model->get($key);
            	$prod->qtd = $value;
                array_push($arr, array($prod));
            }
				
		}
		
		$data['products']=$arr;
		$this->load->view('shoppingcart/cart.php',$data);
	}
	
	function add($id)
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
			
		$arr;
			
		if(isset($_SESSION['cart']))
		{
			$arr = $_SESSION['cart'];
			if (isset($arr[$id])) {
				$arr[$id] = $arr[$id] + 1;
			}else{
				$arr = $arr + array($id => 1);
			}
		}else
		{
			$arr = array($id => 1);
		}
			
		$_SESSION['cart'] = $arr;
		redirect("shoppingcart/Edit");
	}
	
	function Checkout()
	{
		$data['message'] = $this->session->flashdata('message');
		$arr = array();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION['cart']))
		{
			$item = $_SESSION['cart'];
			foreach ($item as $key => $value){
				$this->load->model('product_model');
				$prod = $this->product_model->get($key);
				$prod->qtd = $value;
				array_push($arr, array($prod));
			}
		
		}
		if(empty($arr)){
			redirect("estore");
		}
		$data['products']=$arr;
		$this->load->view('shoppingcart/checkout.php',$data);
		
	}
	
	function saveOrder()
	{
		$this->load->model('order_model');
		$checkout = new order();
		$this->form_validation->set_rules('mm','mm','required');
		$this->form_validation->set_rules('creditcard','creditcard','required');
		$this->form_validation->set_rules('yy','yy','required');
	
		if ($this->form_validation->run()){

			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['customer']) && isset($_SESSION['cart']))
			{
				date_default_timezone_set('UTC');
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$usr = $_SESSION['customer'];
				$item = $_SESSION['cart'];
				$total = 0 ;
				while (list($key, $value) = each($item)) {
					$this->load->model('product_model');
					$prod = $this->product_model->get($key);
					$total = $prod->price * $value;
				}
				$checkout->creditcard_month = $this->input->get_post('mm');
				$checkout->creditcard_number = $this->input->get_post('creditcard');
				$checkout->creditcard_year = $this->input->get_post('yy');
				
				$order_date = $checkout->creditcard_year . $checkout->creditcard_month;
    			$now   = new DateTime();
    			$now = $now->format('Ym');
				if((int)$order_date < (int)$now){
					$this->session->set_flashdata('message', 'Invalid creditcard date!');
					redirect("shoppingcart/Checkout", 'refresh');
				}

				$checkout->customer_id = $usr->id;
				$checkout->order_date = $date;
				$checkout->order_time = $time;
				$checkout->total = $total;
				$this->order_model->checkout($checkout);

				$order = $this->order_model->getLastOrder($usr->id, $date);

				foreach ($item as $key => $value) {
					$prod = $this->product_model->get($key);
					
					$item = new item();
					
					$item->product_id = $key;
					$item->quantity = $value;
	                $item->order_id = $order->id;
					$this->order_model->checkoutItem($item);
				}
				
			}
	
			$data['checkout']=$checkout;
			$this->load->view('product/print.php',$data);
		}
	}
}