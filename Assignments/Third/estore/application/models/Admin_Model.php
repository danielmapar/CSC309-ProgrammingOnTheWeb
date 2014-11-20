<?php
class admin_model extends CI_Model{

	function getOrders()
	{
		$query = $this->db->get('orders');
		return $query->result();
		
	}
	
	function get($id)
	{
		$query = $this->db->get_where('products',array('id' => $id));
	
		return $query->row(0,'product');
	}
	
	function getCustomers()
	{
		$query = $this->db->get('customers');
		return $query->result();
	}
	
	function  deleteCustomer($id)
	{
		 $this->db->delete("orders",array('customer_id' => $id ));
		 return $this->db->delete("customers",array('id' => $id ));
	}
	
	function delete($id) {
		return $this->db->delete("products",array('id' => $id ));
	}
	
	function insert($product) {
		return $this->db->insert("products", array('name' => $product->name,
				'description' => $product->description,
				'price' => $product->price,
				'photo_url' => $product->photo_url));
	}
	
	function update($product) {
		$this->db->where('id', $product->id);
		return $this->db->update("products", array('name' => $product->name,
				'description' => $product->description,
				'price' => $product->price,
				'photo_url' => $product->photo_url));
	}
}