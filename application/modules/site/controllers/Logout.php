<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MX_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_app');
            $this->load->helper('base_helper');
           

        }
        
    
        public function index()
        {
            if(!isset($_SESSION)) {	session_start(); } 
            $this->session->unset_userdata('isSiswa');
            session_destroy();
            redirect('auth', 'refresh');
        }
    
}
?>