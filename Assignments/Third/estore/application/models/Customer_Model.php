<?php

class customer_model extends CI_Model{

    function login($login, $pass)
    {
        $query = null;
        if ($login == 'admin' && $pass == 'adminadmin')
        {
        	$cust = new customer();
        	$cust->id = 0;
        	$cust->first = 'Administrator';
            $cust->email = 'adm@adm.com';
        	$cust->last = ' ';
        	$cust->login = 'admin';
        	$cust->password = ' ';
            return $cust;

        } else{
            $query = $this->db->get_where('customers',array('login' => $login, 'password' => $pass));
        }
        return $query->row(0,'customer');
    }
    
    function createAccount($customer){
    	return $this->db->insert("customers", array('id' => $customer->id,
    			'first' => $customer->first,
    			'last' => $customer->last,
    			'login' => $customer->login,
    	        'password' => $customer->password,
    	        'email' => $customer->email));
    	
    }
    function getClientByEmail($email){
        $query = $this->db->get_where("customers",array('email' => $email));
        if($query->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }

    function getClientByLogin($login){
        $query = $this->db->get_where("customers",array('login' => $login));
        if($query->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}