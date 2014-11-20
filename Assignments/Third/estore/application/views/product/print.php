<?php
	echo '<div id="printable">';
	echo '<p><b> Receipt </b><p>'; 
	echo '<p> Customer ID = ' . $checkout->customer_id . '</p>';
	echo '<p> Order Date = ' . $checkout->order_date . '<p>';
	echo '<p> Order Time = ' . $checkout->order_time . '<p>';
	echo '<p> Total = ' . $checkout->total . '<p>';
	echo '<hr />';
	echo '<p> Thanks for shopping wiht us</p>';
	echo '</div>';
	echo '<script> window.print(); </script>';
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION['customer']))
	{
		$usr = $_SESSION['customer'];
		
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'estoresmtp@gmail.com',
				'smtp_pass' => 'estore123',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'crlf' => "\r\n",
				'newline' => "\r\n"
		);
		$this->load->library('email');
		
		$this->email->initialize($config);
		
		$this->email->from(' ',' ');
		$this->email->to($usr->email);
		$this->email->subject('Receipt');
		
		$message ='<div id="printable">';
	    $message .='<p><b> Receipt </b><p>'; 
	    $message .='<p> Customer ID = ' . $checkout->customer_id . '</p>';
	    $message .='<p> Order Date = ' . $checkout->order_date . '<p>';
	    $message .='<p> Order Time = ' . $checkout->order_time . '<p>';
	    $message .='<p> Total = ' . $checkout->total . '<p>';
	    $message .= '<hr />';
	    $message .='<p> Thanks for shopping with us</p>';
   	    $message .='</div>';
		
		$this->email->message($message);
		if($this->email->send()){
		echo "The receipt was sent to your email address.";
	}else{
		echo "Could not send the email.";
	}
		
	}

	
	?>
