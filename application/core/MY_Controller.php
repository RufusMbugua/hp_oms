<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */
class MY_Controller extends MX_Controller{

	function __construct() {
        parent::__construct();
         $this->em = $this->doctrine->em;
    }
}