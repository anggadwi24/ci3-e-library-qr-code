<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);

    	
	}
	public function index()
	{
		$data['title'] = title();
		$senin = date('Y-m-d 00:00:00',strtotime('monday this week'));
		$minggu = date('Y-m-d 23:59:59',strtotime('sunday this week'));
		$data['newest']  = $this->model_app->view_where_ordering('buku',array('buku_created_on >='=>$senin,'buku_created_on <='=>$minggu),'buku_created_on','DESC');
		$data['kategori'] = $this->model_app->view_order('kategori','kategori_nama','ASC');
		$data['semua'] = $this->model_app->view_order('buku','buku_judul','ASC');
		$this->template->load('template','main',$data);
	}
	
}
