<?php

class ShoppingCart extends CI_Controller
{
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
	
	}
	
	function index ()
	{
		$this->load->view('ShoppingCart/Cart.php');
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
		$this->load->view('ShoppingCart/Cart.php',$data);
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
				$arr = array_merge($arr, array($id => 1));
			}
		}else
		{
			$arr = array($id => 1);
		}
			
		$_SESSION['cart'] = $arr;
		redirect("ShoppingCart/Edit");
	}
	
	function Checkout()
	{
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
		$this->load->view('ShoppingCart/Checkout.php',$data);
		
	}
	
	function saveOrder()
	{
		$this->load->model('Order_Model');
		$checkout = new Order();
		$this->form_validation->set_rules('mm','mm','required');
		$this->form_validation->set_rules('creditcard','creditcard','required');
		$this->form_validation->set_rules('yy','yy','required');
	
		if ($this->form_validation->run()){
			
			$date;
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['customer']) && isset($_SESSION['cart']))
			{
				$usr = $_SESSION['customer'];
				$item = $_SESSION['cart'];
				$total = 0 ;
				while (list($key, $value) = each($item)) {
					$this->load->model('product_model');
					$prod = $this->product_model->get($key);
					$total = $prod->price * $value;
				}
				$date = date("Y-m-d");
				$checkout->creditcard_month = $this->input->get_post('mm');
				$checkout->creditcard_number = $this->input->get_post('creditcard');
				$checkout->creditcard_year = $this->input->get_post('yy');
				$checkout->customer_id = $usr->id;
				$checkout->order_date = $date;
				$checkout->order_time = time();
				$checkout->total = $total;
				$this->Order_Model->checkout($checkout);
				
				$order = $this->Order_Model->getLastOrder($usr->id, $date );
				
				while (list($key, $value) = each($item)) {
					$prod = $this->product_model->get($key);
					$item = new Item();
					
					$item->product_id = $key;
					$item->quantity = $value;
	                $item->order_id = $order->order_id;
					$this->Order_Model->checkoutItem($item);
				}
				
			}
	
			$data['checkout']=$checkout;
			$this->load->view('product/print.php',$data);
		}
	}
}