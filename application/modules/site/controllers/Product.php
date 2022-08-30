<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);
    	
	}

	public function index()
	{
		$data['title'] = 'Produk - '.title();
		$data['js'] = base_url('template/public/ajax/produk/ajax-produk.js');
		$this->template->load('template','product',$data);
	}
	function addToCart(){
        if($this->input->method() == 'post'){
            $produk = decode($this->input->post('id'));
            $batch = decode($this->input->post('batch'));
			$qty = $this->input->post('qty');
            $redirect =null;
			if($this->session->userdata('isMember')){
				$cekProduk = $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('produk_id'=>$produk,'pb_id'=>$batch));
				if($cekProduk->num_rows() > 0){
					$row = $cekProduk->row_array();
					if($row['pb_status'] == 'open'){
						if($row['pb_tanggal_mulai'] <= date('Y-m-d H:i:s') AND $row['pb_tanggal_selesai'] >= date('Y-m-d H:i:s')){
							$data = array(
								'id' => $produk.'-'.$batch, 
								
								'name' => $row['produk_nama'],
								'batch' =>$row['pb_batch'],
								'price' => $row['produk_harga_jual'], 
								'image'=>$row['produk_image'],
								'qty' => $qty, 
							);
							$this->cart->insert($data);
							$status = true;
							$msg = 'Berhasil tambah ke keranjang';
						}else{
							$status = false;
							$msg = 'Tanggal Pre Order sudah selesai';
						}
					}else{
						$status = false;
						$msg = 'Status produk close order';
					}
				}else{
					$status = false;
					$msg = 'Produk tidak ditemukan';
				}
			}else{
				$status = false;
				$msg = 'Login terlebih dahulu untuk melakukan order';
				$redirect = base_url('auth');
			}
          
        
            echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
            
        }
    }
	function doCheckout(){
        if($this->input->method() == 'post'){
            $produk = decode($this->input->post('id'));
            $batch = decode($this->input->post('batch'));
			$qty = $this->input->post('qty');
            $redirect =null;
			if($this->session->userdata('isMember')){
				$cekProduk = $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('produk_id'=>$produk,'pb_id'=>$batch));
				if($cekProduk->num_rows() > 0){
					$row = $cekProduk->row_array();
					if($row['pb_status'] == 'open'){
						if($row['pb_tanggal_mulai'] <= date('Y-m-d H:i:s') AND $row['pb_tanggal_selesai'] >= date('Y-m-d H:i:s')){
							$data = array(
								'id' => $produk.'-'.$batch, 
								
								'name' => $row['produk_nama'],
								'batch' =>$row['pb_batch'],
								'price' => $row['produk_harga_jual'], 
								'image'=>$row['produk_image'],
								'qty' => $qty, 
							);
							$this->cart->insert($data);
							$status = true;
							$msg = null;
							$redirect = base_url('cart');
						}else{
							$status = false;
							$msg = 'Tanggal Pre Order sudah selesai';
						}
					}else{
						$status = false;
						$msg = 'Status produk close order';
					}
				}else{
					$status = false;
					$msg = 'Produk tidak ditemukan';
				}
			}else{
				$status = false;
				$msg = 'Login terlebih dahulu untuk melakukan order';
				$redirect = base_url('auth');
			}
          
        
            echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
            
        }
    }
	public function detail()
	{
		$produk = $this->uri->segment('2');
		$batch = $this->uri->segment('3');
		$cek = $this->model_app->view_where('produk',array('produk_seo'=>$produk));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$batchh = $this->model_app->view_where_ordering('produk_batch',array('pb_produk_id'=>$row['produk_id']),'pb_id','ASC');
			if($batchh->num_rows() > 0){
				
				$data['row'] = $row;
				$data['title'] = $row['produk_nama'].' - '.title();
				$data['produk'] = $row;
				$data['js'] = base_url('template/public/ajax/produk/ajax-detail.js');
				if($batch == ''){
					$data['selected'] = null;
				}else{
					$data['selected'] = $this->model_app->view_where_ordering('produk_batch',array('pb_produk_id'=>$row['produk_id'],'pb_id'=>$batch),'pb_id','DESC')->row_array();

				}
				$data['batch'] = $batchh;
				$this->template->load('template','product_detail',$data);
			}else{
				$this->session->set_flashdata('error','Produk tidak memiliki batch');
				redirect('product');
			}
			

			
		}else{
			$this->session->set_flashdata('error','Produk tidak ditemukan');
			redirect('product');

		}
		
	}
	function data(){
		if($this->input->method() == 'post'){
			$output = null;
			$status = $this->input->post('status');
			if($status == 'close'){
				$data = $this->db->query("SELECT *,COUNT(pb_id) as batch FROM produk a JOIN produk_batch b ON a.produk_id = b.pb_produk_id WHERE pb_status = 'close' GROUP BY pb_produk_id ORDER BY pb_created_on DESC  ");
			}else {
				$data =  $this->db->query("SELECT *,COUNT(pb_id) as batch FROM produk a JOIN produk_batch b ON a.produk_id = b.pb_produk_id WHERE pb_status = 'open' AND pb_tanggal_mulai <= '".date('Y-m-d H:i:s')."' AND pb_tanggal_selesai >= '".date('Y-m-d H:i:s')."' GROUP BY pb_produk_id ORDER BY pb_created_on DESC  ");
			}
			if($data->num_rows() > 0){
				foreach($data->result_array() as $row) {
					$btch = $this->model_app->view_where("produk_batch",array('pb_produk_id'=>$row['produk_id']));
					if(file_exists('upload/produk/'.$row['produk_image'])){
						$gambar = base_url().'upload/produk/'.$row['produk_image'];
					}else{
						$gambar = base_url().'upload/produk/404.jpg';
					}
					if($row['pb_status'] == 'close'){
						$button = '<ul>
									<li class="icon cart-icon">
										<p><b>Close Order</b></p>
									</li>
								</ul>';
					}else{
						$button = ' <ul>
						<li class="icon cart-icon">
							<a class="addToCart" data-produk="'.encode($row['produk_id']).'" data-batch="'.encode($row['pb_id']).'">
								<span></span>
							</a>
						</li>
					</ul>';
					}
					if(countTime($row['pb_created_on']) < 7){
						$new = ' <div class="new-label"><span>New</span></div>';
					}else{
						$new = '';
					}
					if($btch->num_rows() > 1){
						$judul = $row['produk_nama'].' ('.$row['pb_batch'].')';
					}else{
						$judul = $row['produk_nama'];
					}
					$output .=  ' <div class="col-lg-3 col-md-4 col-6">
						<div class="product-item">
							<div class="product-image">
							'.$new.'
								<a href="'.base_url('product/'.$row['produk_seo'].'/'.$row['pb_batch'].'').'">
									<img src="'.$gambar.'" alt="Xpoge">
								</a>
							</div>
							<div class="product-details-outer">
								<div class="product-details">
									<div class="product-title">
										<a href="'.base_url('product/'.$row['produk_seo'].'/'.$row['pb_batch'].'').'">'.$judul.'</a>
									</div>
									<div class="price-box">
										<span class="price">'.idr($row['produk_harga_jual']).'</span>
									
									</div>
								</div>
								<div class="product-details-btn">
									'.$button.'
								</div>
							</div>
						</div>
					</div>';
				}
			}
			echo json_encode($output);
		}
	}
}
