<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class email_model extends MY_Model{
	
	function __construct(){
		
	}

	public function log($receipients, $subject, $message){

		$emails = array(
			'el_id' 		   	=>   NULL,
			'el_subject'      	=>   $subject,
			'el_message'      	=>   $message,
			'el_recipients'   	=>   $receipients,
			'el_timestamp'   	=>   NULL
			);

		$insert = $this->db->insert('email_log', $emails);

	}
}