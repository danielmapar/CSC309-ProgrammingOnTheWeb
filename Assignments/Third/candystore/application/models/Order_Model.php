<?php

class Order_Model extends CI_Model{
	
	function checkout($order)
	{
		return $this->db->insert("order", array('id' => $order->id,
				'customer_id' => $order->customer_id,
				'order_date' => $order->order_date,
				'order_time' => $order->order_time,
				'total' => $order->total,
				'creditcard_number' => $order->creditcard_number,
				'creditcard_month' => $order->creditcard_month,
				'creditcard_year' => $order->creditcard_year
		));
	}

	function checkoutItem($item)
	{
		$this->db->insert("order_item", array('id' => $item->id,
				'order_id' => $item->oder_id,
				'product_id' => $item->product_id,
				'quantity' => $item->quantity
		));
	}
	
	function getLastOrder($user, $date)
	{
  		$query = $this->db->get_where('order',array('customer_id' => $user, 'order_date' => $date));

        return $query->row(0,'order');
	}
}