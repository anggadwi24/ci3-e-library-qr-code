<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();

	
        if($this->session->userdata('isSiswa')){
			$this->load->model('model_app','',TRUE);
			$this->id = decode($this->session->userdata['isSiswa']['siswa_id']);
		}else{
			redirect('auth');
		}
    	
    
	}
	public function index()
	{
        $row = $this->model_app->view_where('siswa',array('siswa_id'=>$this->id))->row_array();
		$data['row'] = $row;
		$data['page'] = 'History';
        $data['record'] = $this->model_app->view_where_ordering('transaksi',array('transaksi_siswa_id'=>$this->id),'transaksi_id','DESC');
		$data['js'] = base_url('template/public/ajax/member/ajax-edit.js');
		$data['title'] = 'History - '.title();
		$this->template->load('template','history',$data);
		

	

	}
	function detail(){
		$no = $this->input->get('no');
		$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no,'transaksi_siswa_id'=>$this->id));
		if($cek->num_rows() >0){
			$row = $cek->row_array();
			$data['row'] = $row;
			$data['page'] = 'Detail';
			$data['record'] = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
			$data['js'] = base_url('template/public/ajax/member/ajax-edit.js');
			$data['title'] = $row['transaksi_no'].' - '.title();
			$this->template->load('template','history_detail',$data);
		}else{
			$this->session->set_flashdata('error','Transaksi tidak ditemukan');
			redirect('history');
		}
	}
   
}
?>