<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class email extends MY_Controller {
	

	//Mail server credentials	
	public $imap_server;
	public $imap_user;
	public $imap_pass;
	public $smtp_config;


	public function __construct(){

		$this->load->config("email");

		$this->imap_server 		=		$this->config->item("imap_server");
		$this->imap_user 		=		$this->config->item("imap_user");
		$this->imap_pass 		=		$this->config->item("imap_pass");
		$this->smtp_config 		=		$this->config->item("smtp_config");

		$this->load->model('email_model');
		$this->load->library('Imap');
	}


	/*
	|
	|--------------------------------------------------------------------------
	|Send email
	|--------------------------------------------------------------------------
		|
		|	@var receipients
		|
		|		$receipients is a string of email addresses separated by comma
		|		@example
		|
		|			"mwangikevinn@gmail.com,rufusmbugua@gmail.com"
		|
		|
		|	@var attachments
		|
		|		$attachments is an array bearing paths to files that are to be attached	|	
		|		@example
		|
		|			array(
		|					"../file1.jpg",
		|					"../file2.jpg"
		|				)
	|	
	*/
	public function send($receipients,$subject=Null,$message=Null,$attachments=array(),$sender_description="HP OMS",$mailtype="html"){

		$time	=	date('Y-m-d');
		
		$this->load->library('email', $this->smtp_config);

		$this->email->set_newline("\r\n");
		$this->email->from($this->imap_user, $sender_description);
		$this->email->to($receipients);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype($mailtype);

		if(sizeof($attachments)>0){
			foreach ($attachments as $key => $file) {
				$this->email->attach($file);
			}
		}
		
		if($this->email->send()){
			$this->email_model->log($receipients, $subject, $message);
		}else{
			show_error($this->email->print_debugger());
		}
		

	}
}