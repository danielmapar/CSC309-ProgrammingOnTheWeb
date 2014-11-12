<?php

class Customer_Model extends CI_Model{

    function login($login, $pass)
    {
        $query = null;
        if ($login == 'admin' && $pass == 'admin')
        {
        	$cust = new Customer();
        	$cust->id = 0;
        	$cust->first = 'Administrador';
        	$cust->last = ' ';
        	$cust->login = 'admin';
        	$cust->password = ' ';
            return $cust;

        } else{
            $query = $this->db->get_where('customer',array('login' => $login, 'password' => $pass));
        }
        return $query->row(0,'Customer');
    }
    
    function createAccount($customer){
    	return $this->db->insert("customer", array('id' => $customer->id,
    			'first' => $customer->first,
    			'last' => $customer->last,
    			'login' => $customer->login,
    	        'password' => $customer->password,
    	        'email' => $customer->email));
    	
    }
}