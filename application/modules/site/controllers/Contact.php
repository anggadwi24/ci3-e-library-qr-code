<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	
	}

	

	public function index()
	{
		$data['title'] = 'Kontak - '.title();
		$data['page'] = 'Kontak';
		$this->template->load('template','contact',$data);
	
	}
	
}
