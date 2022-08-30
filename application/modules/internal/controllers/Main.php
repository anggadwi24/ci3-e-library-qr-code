<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->model('model_app','',TRUE);
    	if($this->session->userdata('isLog')){
			
		}else{
			redirect('internal/auth');
		}
	}

	public function index()
	{
		// $data['title'] = 'Dashboard - '.title();
		// $data['page'] = 'Dashboard';
		// $data['right'] ='';
		
		// $data['js'] = base_url('template/admin/ajax/user/ajax-dashboard.js');
		// $data['breadcrumb'] = '';
		// $data['member'] = $this->model_app->view('member')->num_rows();
		// $data['preorder'] = $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('pb_status'=>'open'))->num_rows();
		// $data['closeorder'] = $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('pb_status'=>'close'))->num_rows();
		// $data['trans'] = $this->db->query("SELECT * FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE (transaksi_status = 'dibayar' OR transaksi_status = 'selesai') GROUP BY td_transaksi_id ")->num_rows();
		// $data['newest'] = $this->model_app->view_ordering_limit('member','member_id','DESC',0,5);
		// $data['produk'] = $this->db->query("SELECT * FROM produk a JOIN produk_batch b ON a.produk_id = b.pb_produk_id GROUP BY b.pb_produk_id ORDER BY produk_id DESC LIMIT 0,5");
		// $data['revenue'] = $this->db->query("SELECT SUM(transaksi_subtotal) as subtotal, COUNT(transaksi_id) as pemesan FROM transaksi a  WHERE (a.transaksi_status = 'dibayar' OR a.transaksi_status = 'selesai' ) AND transaksi_created_on >= '".date('Y-m-d 00:00:00',strtotime('monday this week'))."' AND transaksi_created_on <= '".date('Y-m-d 23:59:59',strtotime('sunday this week'))."'  ")->row_array();
		// $hisz = $this->db->query("SELECT SUM(td_qty) as qty, COUNT(td_produk_id) as produk FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE (a.transaksi_status = 'dibayar' OR a.transaksi_status ='selesai')  AND transaksi_created_on >= '".date('Y-m-d 00:00:00',strtotime('monday this week'))."' AND transaksi_created_on <= '".date('Y-m-d 23:59:59',strtotime('sunday this week'))."' GROUP BY td_produk_id ");
		// if($hisz->num_rows() > 0){
		// 	$qty = 0;
		// 	$product = 0;
		// 	foreach($hisz->result_array() as $h){
		// 		$qty = $qty+ $h['qty'];
		// 		$product += $h['produk'];
		// 	}
		// 	$data['quantity'] = $qty;
		// 	$data['produkTot'] = $product;
		// }else{
		// 	$data['quantity'] = 0;
		// 	$data['produkTot'] = 0;
		// }
		$data['subtitle']='';
		$data['title'] = 'Dashboard - '.title();
		$data['page'] = 'Dashboard';
		$data['right'] ='';
		$data['breadcrumb'] = '';
		
		$data['js'] = base_url('template/admin/ajax/main/ajax-dashboard.js');
		$data['summary'] = $this->model_app->view_where('transaksi',array('transaksi_tanggal >='=>date('Y-m-d 00:00:00'),'transaksi_tanggal <='=>date('Y-m-d 23:59:59')));
		$data['buku'] = $this->model_app->view('buku');
		$data['siswa'] = $this->model_app->view('siswa');
		$data['admin'] = $this->model_app->view('users');
		$data['visitor'] = $this->model_app->join_order2('siswa_pengunjung','siswa','sp_siswa_id','siswa_id','sp_date','DESC');
		$data['tenggang'] = $this->model_app->join_where_order2('transaksi','siswa','transaksi_siswa_id','siswa_id',array('transaksi_tanggal_kembali <='=>date('Y-m-d H:i:s'),'transaksi_status'=>'pinjam'),'transaksi_id','DESC');
		$data['transaksi'] = $this->model_app->join_order2('transaksi','siswa','transaksi_siswa_id','siswa_id','transaksi_id','DESC');

		$this->template->load('template','dashboard/dashboard',$data);
		
	}
	
	function chart(){
		if($this->input->method() == 'post'){
			$dateStart = date('Y-m-d',strtotime('-6 Days'));
			$dateEnd = date('Y-m-d');
			$begin = new DateTime($dateStart);
			$end   = new DateTime($dateEnd);
			$hari = array();
			$transaksi = array();
			$arr = array();
			for($i = $begin; $i <= $end; $i->modify('+1 day')){
			
				$date = $i->format('Y-m-d');
				$transaksi[]= $this->db->query("SELECT * FROM  siswa_pengunjung a JOIN siswa b ON a.sp_siswa_id = b.siswa_id WHERE sp_date = '".$date."' GROUP BY sp_date ")->num_rows();
				$hari[] = hari(date('w',strtotime($date)));
				// $arr[] = array('day'=>$hari,'value'=>$transaksi);
			}
			$arr = array('period'=>$hari,'total'=>$transaksi);
			echo json_encode($arr);

		}
	}


	
}
