<?php
class estore extends CI_Controller {

    function __construct() {
        // Call the Controller constructor
        parent::__construct();
        $config['upload_path'] = './images/product/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->load->database();
    }

    function index() {
        $this->load->model('product_model');
        $products = $this->product_model->getAll();
        $data['products']=$products;
        
        $this->load->view('product/list.php',$data);
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
		 redirect("estore");
    }
    
    function remove($id)
    {
    	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
    	}
    		
    	$arr = array();
    		
    	if(isset($_SESSION['cart']))
    	{
    		$arr = $_SESSION['cart'];
    		if (isset($arr[$id])) {
    			$arr[$id] = $arr[$id] - 1;
    			if($arr[$id] <= 0) { 
                    unset($arr[$id]); 
    				unset($_SESSION['cart']);
    			}
    		}
    	}
    	if(isset($_SESSION['cart'])){ 
            $_SESSION['cart'] = $arr; 
        }
    	redirect("shoppingcart/Edit");
    }
    
}