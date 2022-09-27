<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MX_Controller 
{

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

		$data['page'] = 'Transaksi';
		$data['title'] = 'Transaksi - '.title();
		$data['subtitle'] = 'Transaksi';
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">Transaksi</span>';
		
		$data['js'] = base_url('template/admin/ajax/transaksi/ajax-transaksi.js');
		$data['siswa'] = $this->model_app->view_order('siswa','siswa_nama_lengkap','ASC');	
		$data['buku'] = $this->model_app->view_order('buku','buku_judul','ASC');

		$this->template->load('template','transaksi/transaksi',$data);

	}
	public function add(){
		$data['page'] = 'Add Transaksi';
		$data['title'] = 'Add Transaksi - '.title();
		// $this->cart->destroy();
		$data['subtitle'] = 'Form Transaksi';
		$data['breadcrumb'] = ' <a class="breadcrumb-item " href="'.base_url('internal/transaksi').'">Transaksi</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Peminjaman</span>';

		
		$data['js'] = base_url('template/admin/ajax/transaksi/ajax-add.js');
	
		
		// $data['buku'] = $this->model_app->view_where_ordering('buku',array('buku_qty >'=>0),'buku_judul','ASC');
		$data['kelas'] = $this->model_app->view_order('kelas','kelas_nama','ASC');


		$this->template->load('template','transaksi/add',$data);
	}
	public function pengembalian(){
		$data['page'] = 'Pengembalian Transaksi';
		$data['title'] = 'Pengembalian Transaksi - '.title();
		// $this->cart->destroy();
		$data['subtitle'] = 'Form Pengembalian';
		$data['breadcrumb'] = ' <a class="breadcrumb-item " href="'.base_url('internal/transaksi').'">Transaksi</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Pengembalian</span>';

		
		$data['js'] = base_url('template/admin/ajax/transaksi/ajax-pengembalian.js');
	
		




		$this->template->load('template','transaksi/pengembalian',$data);
	}
	public function perpanjang(){
		$data['page'] = 'Perpanjang Transaksi';
		$data['title'] = 'Perpanjang Transaksi - '.title();
		// $this->cart->destroy();
		$data['subtitle'] = 'Form Perpanjang';
		$data['breadcrumb'] = ' <a class="breadcrumb-item " href="'.base_url('internal/transaksi').'">Transaksi</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Perpanjang</span>';

		
		$data['js'] = base_url('template/admin/ajax/transaksi/ajax-perpanjang.js');
	
		




		$this->template->load('template','transaksi/perpanjang',$data);
	}
	public function detail(){
		$no = $this->input->get('no');
		$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['row'] = $row;
			$data['siswa'] = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']))->row_array();
			$data['record'] = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');

			$data['page'] = 'Detail Transaksi';
			$data['title'] = 'Detail Transaksi - '.title();
			// $this->cart->destroy();
			$data['js'] ='';
			$data['subtitle'] = $row['transaksi_no'];
			$data['breadcrumb'] = ' <a class="breadcrumb-item " href="'.base_url('internal/transaksi').'">Transaksi</a>';
			$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Detail</span>';
			$this->template->load('template','transaksi/detail',$data);
		}else{
			$this->session->set_flashdata('error','Transaksi tidak ditemukan');
			redirect('internal/transaksi');
		}
	}
	public function download(){
		$no = $this->input->get('no');
		$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['row'] = $row;
			$data['record'] = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
			$data['siswa'] = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']))->row_array();
			$title = $row['transaksi_no'];

			$html = $this->load->view('transaksi/pdf',$data,true);
			pdf_create($html, $title, 'A$', 'potraiet',TRUE);
		}else{
			$this->session->set_flashdata('error','Transaksi tidak ditemukan');
			redirect('internal/transaksi');
		}

	}
	function detailPerpanjang(){
		if($this->input->method() == 'post'){
			$output = null;
			$this->form_validation->set_rules('no_transaksi','Nomor Transaksi','required');
			if($this->form_validation->run() == FALSE){
				$status = false;
				$replace = array('<p>','</p>');
				$msg = replace($replace,validation_errors());
			}else{
				$no = $this->input->post('no_transaksi');
				$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
				if($cek->num_rows() > 0){
					$row = $cek->row_array();
					if($row['transaksi_status'] == 'pinjam'){
						$check = $this->model_app->view_where('transaksi_perpanjang',array('tp_transaksi_id'=>$row['transaksi_id']));
						if($check->num_rows() > 0){
							$status = false;
							$msg = 'Perpanjang hanya bisa 1x setiap transaksi';
						}else{
							$record =$this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
							if($record->num_rows() > 0){
								$siswa = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']));
								if($siswa->num_rows() > 0){
									$sis = $siswa->row_array();
									$status = true;
									$msg = null;
									$output = '<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<div class="p-h-10">
																<h5>DETAIL TRANSAKSI</h5>
																<hr>    
																	<form id="formAct">
																	<div class="form-row">
																		<div class="col-md-12">
																			<div class="form-group">
																				<label class="control-label">Siswa</label>
																				
																				<h6>'.$sis['siswa_nama_lengkap'].' <small>('.$sis['siswa_nisn'].')</small></h6>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<label class="control-label">Tanggal Transaksi</label>
																				<h6>'.tanggalwaktu($row['transaksi_tanggal']).'</h6>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<label class="control-label">Durasi Transaksi</label>
																				<h6>'.tanggalwaktu($row['transaksi_tanggal_pinjam']).' - '.tanggalwaktu($row['transaksi_tanggal_kembali']).'</h6>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<label class="control-label">Durasi Perpanjang</label>
																				<h6>'.tanggalwaktu($row['transaksi_tanggal_pinjam']).' - '.tanggalwaktu(date('Y-m-d H:i:s',strtotime('+7 Days',strtotime($row['transaksi_tanggal_kembali'])))).'</h6>
																			</div>
																		</div>
																		
																	
																		
																	</div>
																	<div class="form-row mt-2">
																		<div class="col-md-12 table-responsive">
																			<table class="table">
																				<thead>
																					<tr class="border-double">
																						<td>Buku</td>
																						<td>Qty</td>

																						
																					</tr>
																				</thead>
																				<tbody>
																	';
																	foreach($record->result_array() as $rows){
																		$output .= '<tr>
																						<td>'.$rows['buku_judul'].' <input type="hidden" name="td[]" value="'.$rows['td_id'].'"></td>
																						<td>'.$rows['td_qty'].'</td>
																																							
																					</tr>';
																	}
											$output .='							</tbody>
																			</table>
																		</div>
																	</div>
																	
																	<div class="form-row mt-2">
																		<div class="col-md-12 mt-3">
																			<button class="btn btn-primary float-right">Perpanjang</button>
																		</div>
																	</div>
																	</form>
																	
																
																
																	
																	
															
															</div>
														</div>
													</div>
												</div>
										
											</div>';
								}else{
									$status = false;
									$msg = 'Peminjam tidak ditemukan';
								}
								
							}else{
								$status = false;
								$msg = 'Transaksi tidak memiliki buku yang dipinjam';
							}
						}
					}else{	
						$status = false;
						$msg = 'Transaksi tidak dalam status peminjaman';
					}
				}else{	
					$status = false;
					$msg = 'Transaksi tidak ditemukan';
				}
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
		}
	}
	function detailPengembalian(){
		if($this->input->method() == 'post'){
			$output = null;
			$this->form_validation->set_rules('no_transaksi','Nomor Transaksi','required');
			if($this->form_validation->run() == FALSE){
				$status = false;
				$replace = array('<p>','</p>');
				$msg = replace($replace,validation_errors());
			}else{
				$no = $this->input->post('no_transaksi');
				$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
				if($cek->num_rows() > 0){
					$row = $cek->row_array();
					if($row['transaksi_status'] == 'pinjam'){
						$record =$this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
						if($record->num_rows() > 0){
							$siswa = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']));
							if($siswa->num_rows() > 0){
								$sis = $siswa->row_array();
								$status = true;
								$msg = null;
								$output = '<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="p-h-10">
															<h5>DETAIL TRANSAKSI</h5>
															<hr>    
																<form id="formAct">
																<div class="form-row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">Siswa</label>
																			<h6>'.$sis['siswa_nama_lengkap'].' <small>('.$sis['siswa_nisn'].')</small></h6>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">Tanggal Transaksi</label>
																			<h6>'.tanggalwaktu($row['transaksi_tanggal']).'</h6>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">Durasi Transaksi</label>
																			<h6>'.tanggalwaktu($row['transaksi_tanggal_pinjam']).' - '.tanggalwaktu($row['transaksi_tanggal_kembali']).'</h6>
																		</div>
																	</div>
																	
																
																	
																</div>
																<div class="form-row mt-2">
																	<div class="col-md-12 table-responsive">
																		<table class="table">
																			<thead>
																				<tr class="border-double">
																					<td>Buku</td>
																					<td>Qty</td>
																					<td>Kondisi</td>
																					
																				</tr>
																			</thead>
																			<tbody>
																';
																foreach($record->result_array() as $rows){
																	$output .= '<tr>
																					<td>'.$rows['buku_judul'].' <input type="hidden" name="td[]" value="'.$rows['td_id'].'"></td>
																					<td>'.$rows['td_qty'].'</td>
																					<td>
																	';
																	$output .= '<select class="form-control condition" data-td="'.$rows['td_id'].'" data-id="'.$rows['buku_id'].'" data-qty="'.$rows['td_qty'].'" name="kondisi[]" >';
																	if($rows['td_kondisi'] == 'normal'){
																		$output .= '<option value="normal" selected>Normal</option>';
																	}else{
																		$output .= '<option value="normal">Normal</option>';
																	}

																	if($rows['td_kondisi'] == 'hilang'){
																		$output .= '<option value="hilang" selected>Hilang</option>';
																	}else{
																		$output .= '<option value="hilang">Hilang</option>';
																	}

																	if($rows['td_kondisi'] == 'rusak'){
																		$output .= '<option value="rusak" selected>Rusak</option>';
																	}else{
																		$output .= '<option value="rusak">Rusak</option>';
																	}
																


																	
																	

																	$output .= ' </select>';
																	$output .='
																					</td>
																				
																				</tr>';
																}
										$output .='							</tbody>
																		</table>
																	</div>
																</div>
																<div class="form-row mt-2">
																	<div class="col-md-12 text-right">
																		<label>Total Denda Telat </label>
																		<h6 class="text-right"> '.rp($row['transaksi_denda_telat']).'</h6>
																	</div>
																	<div class="col-md-12 text-right">
																		<label>Total Denda Hilang/Rusak </label>
																		<h6 class="text-right" id="conditionTotal"> '.rp($row['transaksi_total_denda']).'</h6>
																	</div>

																	<div class="col-md-12 text-right mt-2">
																		<h6>Subtotal </h6>
																		<h4 class="text-right" id="subTotal"> '.rp($row['transaksi_denda_telat']+$row['transaksi_total_denda']).'</h4>
																	</div>
																	
																</div>
																<div class="form-row mt-2">
																	<div class="col-md-12 mt-3">
																		<button class="btn btn-primary float-right">Simpan</button>
																	</div>
																</div>
																</form>
																
															
															
																
																
														
														</div>
													</div>
												</div>
											</div>
									
										</div>';
							}else{
								$status = false;
								$msg = 'Peminjam tidak ditemukan';
							}
							
						}else{
							$status = false;
							$msg = 'Transaksi tidak memiliki buku yang dipinjam';
						}
					}else{	
						$status = false;
						$msg = 'Transaksi tidak dalam status peminjaman';
					}
				}else{	
					$status = false;
					$msg = 'Transaksi tidak ditemukan';
				}
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
		}
	}
	function extend(){
		if($this->input->method() == 'post'){
			$no = $this->input->post('no');
			$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				if($row['transaksi_status'] == 'pinjam'){
					$check = $this->model_app->view_where('transaksi_perpanjang',array('tp_transaksi_id'=>$row['transaksi_id']));
					if($check->num_rows() > 0){
						$status = false;
						$msg = 'Transaksi hanya bisa 1x perpanjang';
					}else{
						$after = date('Y-m-d H:i:s',strtotime('+7 Days',strtotime($row['transaksi_tanggal_kembali'])));
						$before = $row['transaksi_tanggal_kembali'];
						$this->model_app->update('transaksi',array('transaksi_tanggal_kembali'=>$after),array('transaksi_id'=>$row['transaksi_id']));
						$data['tp_transaksi_id'] = $row['transaksi_id'];
						$data['tp_tanggal_sebelum'] = $before;
						$data['tp_tanggal_sesudah'] = $after;
						$this->model_app->insert('transaksi_perpanjang',$data);
						$status = true;
						$msg = 'Transaksi berhasil diperpanjang';

					}
				}else{
					$status = false;
					$msg = 'Transaksi tidak dalam status pinjam';
				}
			}else{
				$status = false;
				$msg = 'Transaksi tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/transaksi')));
		}else{
			redirect('internal/transaksi/perpanjang');
		}
	}
	function return(){
		if($this->input->method() == 'post'){
			$no = $this->input->post('no');
			$td_id = $this->input->post('td');
			$kondisi = $this->input->post('kondisi');
			$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				if($row['transaksi_status'] == 'pinjam'){
					$record =$this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
					if($record->num_rows() > 0){
						for($a=0;$a<count($td_id);$a++){
							$con = $kondisi[$a];
							$get = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_id'=>$td_id[$a]),'td_id','ASC');
							if($get->num_rows() > 0){
								$get = $get->row_array();
								if($con == 'normal'){
									$jumlah = $get['buku_qty']+$get['td_qty'];
								}else if($con == 'rusak'){
									$jumlah = $get['buku_qty']+$get['td_qty'];
								}else{
									$jumlah = $get['buku_qty'];
								}
								$this->model_app->update('buku',array('buku_qty'=>$jumlah),array('buku_id'=>$get['buku_id']));
							}
							
						}
						$this->model_app->update('transaksi',array('transaksi_status'=>'selesai','transaksi_tanggal_selesai'=>date('Y-m-d H:i:s')),array('transaksi_id'=>$row['transaksi_id']));
						$status = true;
						$msg = 'Transaksi telah selesai';
					}else{
						$status = false;
						$msg = 'Transaksi tidak memiliki data pinjam buku';
					}
				}else{
					$status = false;
					$msg = 'Status transaksi tidak dalam dipinjam';
				}
			}else{
				$status = false;
				$msg = 'Transaksi tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/transaksi')));
		}else{
			redirect('internal/transaksi/pengembalian');
		}
	}
	function updateDetail(){
		if($this->input->method() == 'post'){
			$buku = $this->input->post('buku');
			$td = $this->input->post('td');
			$qty = $this->input->post('qty');
			$con = $this->input->post('con');
		
			$cek = $this->model_app->join_where('transaksi','transaksi_detail','transaksi_id','td_transaksi_id',array('td_id'=>$td));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$cekBook = $this->model_app->view_where('buku',array('buku_id'=>$buku));
				if($cekBook->num_rows() > 0){
					$book = $cekBook->row_array();
					 if($con == 'rusak'){
						$denda = $book['buku_denda_rusak'];
						

					}else if($con == 'hilang'){
						$denda = $book['buku_denda_hilang'];
					
					}else{
						$denda = 0;
						
					}
					
					$this->model_app->update('transaksi_detail',array('td_kondisi'=>$con,'td_denda'=>$denda),array('td_id'=>$td));
					$totalDenda = 0;
					$data = $this->model_app->view_where('transaksi_detail',array('td_transaksi_id'=>$row['transaksi_id']));
					if($data->num_rows() > 0){
						foreach($data->result_array() as $c ){
							$totalDenda += $c['td_denda'];
						}
					}
					$this->model_app->update('transaksi',array('transaksi_total_denda'=>$totalDenda),array('transaksi_id'=>$row['transaksi_id']));
					$status = true;
					$msg = null;
				}else{
					$status = false;
					$msg = 'Buku tidak ditemukan';
				}
			}else{
				$status = false;
				$msg = 'Transaksi tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg));
		}
	}
	function store(){
		if($this->input->method() == 'post'){
			$redirect=  base_url('internal/transaksi');
			if($this->cart->total_items() <= 0){
				$status = false;
				$msg = 'Tidak ada buku yang dipinjam';
			}else{
				$this->form_validation->set_rules('siswa','Siswa','required');
			




				if($this->form_validation->run() == FALSE){
					$status = false;
					$replace = array('<p>','</p>');
					$msg = replace($replace,validation_errors());
				}else{
					$siswa = $this->input->post('siswa');
					$cek = $this->model_app->view_where('siswa',array('siswa_id'=>$siswa));
					if($cek->num_rows() > 0){
						$sis = $cek->row_array();
						$words = getInitial($sis['siswa_nama_lengkap']);
						$no = $words.date('mdY');
						$checkno = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
						if($checkno->num_rows() > 0){
							$no = $words.date('mdY').shuffleChar(1);
						}
						$start = date('Y-m-d H:i:s');
						$end = date('Y-m-d H:i:s',strtotime('+7 Days'));
						$date =date('Y-m-d H:i:s');

						$cekTrans = $this->model_app->view_where('transaksi',array('transaksi_siswa_id'=>$siswa,'transaksi_status'=>'pinjam'));
						if($cekTrans->num_rows() > 0){
							$status = false;
							$msg = 'Siswa masih memiliki transaksi belum selesai';
						}else{
							$data = array('transaksi_no'=>$no,'transaksi_siswa_id'=>$siswa,'transaksi_tanggal_pinjam'=>$start,'transaksi_tanggal_kembali'=>$end,'transaksi_tanggal'=>$date,'transaksi_total_denda'=>0,'transaksi_denda_telat'=>0,'transaksi_status'=>'pinjam');
							$transaksi_id = $this->model_app->insert_id('transaksi',$data);

							$record = $this->cart->contents();
							foreach($record as $rec){
								$dataD['td_transaksi_id'] = $transaksi_id;
								$dataD['td_buku_id'] = $rec['id'];
								$dataD['td_qty'] = $rec['qty'];
								$dataD['td_kondisi'] = 'normal';
								$dataD['td_denda'] = 0;
								$this->model_app->insert('transaksi_detail',$dataD);
								$book = $this->model_app->view_where('buku',array('buku_id'=>$rec['id']))->row_array();
								$qty = $book['buku_qty']-$rec['qty'];
								$this->model_app->update('buku',array('buku_qty'=>$qty),array('buku_id'=>$rec['id']));
 							}
							$status = true;
							$msg = 'Peminjaman berhasil';
							$redirect = base_url('internal/transaksi/detail?no='.$no);
							$this->cart->destroy();
						}

					}else{
						$status = false;
						$msg = 'Siswa tidak ditemukan';
					}
				}
			
				
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));

		}else{
			redirect('internal/transaksi/add');
		}
	}
	function dataBuku(){
	
		if($this->input->method() == 'post'){
			$output = null;
			$count = $this->cart->total_items() ;
			$subtotal = 0;
		
				if($this->cart->total_items() <= 0){
					$output = '<div class="col-12"><span><i>Belum ada buku yang dipilih</i></span></div>';
				}else{
				
					$record = $this->cart->contents();
					$output = "<div class='col-12 table-responsive'>
								<table class='table table-xl'>
								<thead>
									<th>Cover</th>
									<th>Buku</th>
									<th>Qty</th>
									<th>#</th>
								</thead>
								<tbody>";
					foreach($record as $row ){
					
						$cek =  $this->model_app->view_where('buku',array('buku_id'=>$row['id']));
						if($cek->num_rows() > 0){
								$rows = $cek->row_array();
								if(file_exists('upload/buku/'.$row['image'])){
									$image = base_url('upload/buku/'.$row['image']);
								}else{
									$image = base_url('upload/buku/404.jpg');
								}
							
								$output .= '<tr><td>
												<img class="img-thumbnail" src="'.$image.'" style="max-width:300px;">
											</td>
											<td>'.$row['name'].' </td>
											<td>
										'.$row['qty'].'
								</td>
											<td>
												<a data-id="'.$row['rowid'].'" class="text-danger delete"><i class="ti-trash"></i></a>
											</td></tr>';
						}
					}
					$output .= "</tbody></table></div>";
					$output .= "<div class='col-12 mt-2'>
									<button class='btn btn-primary float-right'>PINJAM</button>
								</div>";
				
				}   
			
			echo json_encode(array('output'=>$output));
		}
		   
	}
	function buku(){
		if($this->input->method() == 'post'){
			$output = '<option disabled selected>Pilih buku</option>';
			
		
			
			$kategori = $this->model_app->view_order('kategori','kategori_nama','ASC');
			if($kategori->num_rows() > 0){
				foreach($kategori->result_array() as $cat){
					$output .=  "<optgroup label='".$cat['kategori_nama']."'>";
					$buku = $this->model_app->view_where_ordering('buku',array('buku_qty >'=>0,'buku_kategori_id'=>$cat['kategori_id']),'buku_judul','ASC');
					if($buku->num_rows() > 0){
						foreach($buku->result_array() as $book){
							
							
							if(checkCart($book['buku_id']) == true ){
								$output .= "<option value='".$book['buku_id']."'>".$book['buku_judul']."</option>";
							}else{
								$output .= "<option value='".$book['buku_id']."' disabled>".$book['buku_judul']."</option>";
							}
							
									
						}
					
					}

					$output .=  "</optgroup>";
					
				}
			}   
			echo json_encode($output);
		}
	}
	function removeBook(){
        if($this->input->method() == 'post'){
            $rowid = $this->input->post('id');
            if($rowid != '' AND $rowid != null){
                $remove = $this->cart->remove($rowid);
            
           
                $status = true;
            }else{
                $status = false;
            }
            echo json_encode(array('status'=>$status));
        }
     
        
    }
	function updateBook(){
		
		if($this->input->method() == 'post'){
			$rowid = $this->input->post('id');
			$qty = $this->input->post('qty');
			$item = 0;
			if(!empty($rowid)){
				$record = $this->cart->contents();
					foreach($record as $rw ){
						$item =  $rw['qty']+$item;

					}
					if($item > 1){
						$status = false;
						$msg = 'Buku yang dipinjam maksimal 2';
					}else{
						if($qty > 0){
							
								
								$data = array(
									'rowid' => $rowid,
									'qty'   => $qty
								);
								$this->cart->update($data);
							
								$status = true;
								$msg = null;
							
							
						}else{
							$status = false;
							$msg = 'Quantity tidak boleh 0';
						}
					}
			}else{
				$status = false;
				$msg = 'Buku tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg));
		}
		
	}
	function searchBook(){
		if($this->input->method() == 'post'){
			$buku = $this->input->post('kode');
			$qty = 1;
			$item = 0;
			$cek = $this->model_app->view_where('buku',array('buku_kode'=>$buku));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$record = $this->cart->contents();
				foreach($record as $rw ){
					$item =  $rw['qty']+$item;

				}
				if($item > 1){
					$status = false;
					$msg = 'Buku yang dipinjam maksimal 2';
				}else{
					if($qty > 2){
						$status = false;
						$msg = 'Jumlah buku yang dipinjam maksimal 2';
					}else{
						if($row['buku_qty'] >= $qty){
							$data = array(
								'id' => $row['buku_id'], 
							   
								'name' => $row['buku_judul'],
							
								'price' =>0, 
								'image'=>$row['buku_cover'],
								'qty' => $qty, 
							);
							$this->cart->insert($data);
							$status = true;
							$msg = null;
						}else{
							$status = false;
							$msg = 'Jumlah buku tidak cukup';
						}
						
					}
				}
			}else{
				$status = false;
				$msg = 'Buku tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg));
		}
	}
	function addBook(){
		if($this->input->method() == 'post'){
			$buku = $this->input->post('buku');
			$qty = 1;
			$item = 0;
			$cek = $this->model_app->view_where('buku',array('buku_id'=>$buku));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$record = $this->cart->contents();
				foreach($record as $rw ){
					$item =  $rw['qty']+$item;

				}
				if($item > 1){
					$status = false;
					$msg = 'Buku yang dipinjam maksimal 2';
				}else{
					if($qty > 2){
						$status = false;
						$msg = 'Jumlah buku yang dipinjam maksimal 2';
					}else{
						if($row['buku_qty'] >= $qty){
							$data = array(
								'id' => $row['buku_id'], 
							   
								'name' => $row['buku_judul'],
							
								'price' =>0, 
								'image'=>$row['buku_cover'],
								'qty' => $qty, 
							);
							$this->cart->insert($data);
							$status = true;
							$msg = null;
						}else{
							$status = false;
							$msg = 'Jumlah buku tidak cukup';
						}
						
					}
				}
			}else{
				$status = false;
				$msg = 'Buku tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg));
		}
	}
	
	function data(){
		if($this->input->method()  == 'post'){
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$siswa = $this->input->post('siswa');
			$buku = $this->input->post('buku');
			$status = $this->input->post('status');
			$output = '<table id="simpletable" class="table table-hover table-xl">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Nama Siswa</th>
								<th>Tanggal Transaksi</th>
								<th>Tanggal Peminjaman</th>
								<th>Status</th>
								<th>Denda</th>
								<th></th>
							</tr>
						</thead>
						<tbody>';
			$data = $this->model_app->view_booking($start,$end,$siswa,$buku,$status);
			if($data->num_rows() > 0){
				foreach($data->result_array() as $row){
					$pr = '';
					$produk = $this->db->query("SELECT *  FROM transaksi_detail a JOIN buku b ON a.td_buku_id = b.buku_id WHERE td_transaksi_id = '$row[transaksi_id]'");
					if($produk->num_rows() > 0){
						foreach($produk->result_array() as $pro){
							$pr .=$pro['buku_judul'].' x'.$pro['td_qty'].' item<br>';
						}
					}
					if($row['transaksi_status'] == 'pinjam'){
						$con = 'Belum selesai';
					}else if($row['transaksi_status'] == 'selesai'){
						$con = 'Selesai';
					}
					$output .= '<tr>
									<td>'.$row['transaksi_no'].'</td>
									<td>'.$row['siswa_nama_lengkap'].'</td>
									<td>'.tanggalwaktu($row['transaksi_created_on']).'</td>
									<td>'.tanggalwaktu($row['transaksi_tanggal_pinjam']).' - '.tanggalwaktu($row['transaksi_tanggal_kembali']).'</td>
									<td>'.$con.'</td>
									<td>'.idr($row['transaksi_total_denda']+$row['transaksi_denda_telat']).'</td>
									<td> <a class="text-gray m-r-15" href="'.base_url('internal/transaksi/detail?no='.$row['transaksi_no']).'" >
											<i class="mdi mdi-eye m-r-5"></i>
											<span>Detail</span>
										</a>
									</td>


								</tr>';
				}
			}
			$output .= '</tbody>
					</table>';
			echo json_encode($output);
		}else{
			redirect('internal/transaksi');
		}
	}
	
}
