<?php
class Admin_Model extends CI_Model{

	function getOrders()
	{
		$query = $this->db->get('order');
		return $query->result('order');
		
	}
	
	function get($id)
	{
		$query = $this->db->get_where('product',array('id' => $id));
	
		return $query->row(0,'Product');
	}
	
	function getCustomers()
	{
		$query = $this->db->get('customer');
		return $query->result('customer');
	}
	
	function  deleteCustomer($id)
	{
		 $this->db->delete("order",array('customer_id' => $id ));
		 return $this->db->delete("customer",array('id' => $id ));
	}
	
	function delete($id) {
		return $this->db->delete("product",array('id' => $id ));
	}
	
	function insert($product) {
		return $this->db->insert("product", array('name' => $product->name,
				'description' => $product->description,
				'price' => $product->price,
				'photo_url' => $product->photo_url));
	}
	
	function update($product) {
		$this->db->where('id', $product->id);
		return $this->db->update("product", array('name' => $product->name,
				'description' => $product->description,
				'price' => $product->price));
	}
}