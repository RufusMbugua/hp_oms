<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Action_Center extends MY_Controller
{

    function __construct() {
        parent::__construct();
        
    }

    public function index() {
        $data['contentView'] = "action_center/index";
        $data['title'] = "Dashboard";
        $this->template($data);
    }

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

   
}
