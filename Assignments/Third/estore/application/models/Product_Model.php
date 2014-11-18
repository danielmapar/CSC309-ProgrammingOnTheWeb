<?php
class Product_Model extends CI_Model{

    function getAll()
    {
        $query = $this->db->get('products'); 
        return $query->result();
    }

    function get($id)
    {
        $query = $this->db->get_where('products',array('id' => $id));

        return $query->row(0,'product');
    }

    function delete($id) {
        return $this->db->delete("products",array('id' => $id ));
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