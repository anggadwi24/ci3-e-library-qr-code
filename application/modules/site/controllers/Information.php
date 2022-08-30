<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	
	}

	public function profil()
	{
		$this->template->load('template','profil');
	}

	public function contact()
	{
		$this->template->load('template','contact');
	}

	public function about()
	{
		$this->template->load('template','about');
	}
	
}
