<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends MX_Controller 
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
		$data['page'] = 'Buku';
		$data['title'] = 'Buku - '.title();
		$data['subtitle'] = 'Buku';
		$data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';

		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Buku</span>';
		
		$data['js'] = base_url('template/admin/ajax/basic.js');
		$data['record'] = $this->model_app->join_order2('buku','kategori','buku_kategori_id','kategori_id','buku_id','DESC');	
		$this->template->load('template','buku/buku',$data);


	}
	function generateQR($kode){
		$this->load->library('ciqrcode');
	   
		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = './upload/qr/'; //string, the default is application/cache/
		$config['errorlog']     = './upload/qr/'; //string, the default is application/logs/
		$config['imagedir']     = './upload/qr/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
 
		$image_name=$kode.'.png'; //buat name dari qr code sesuai dengan nim
 
		$params['data'] = $kode; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
		return $image_name;
	}
	public function add()
	{
		$data['page'] = 'Buku';
		$data['title'] = 'Tambah Buku - '.title();
		$data['subtitle'] = 'Tambah Buku';
		$data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';

		$data['breadcrumb'] .= ' <a  href= "'.base_url('internal/buku').'" class="breadcrumb-item ">Buku</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Add</span>';

		
		$data['js'] = base_url('template/admin/ajax/buku/ajax-add.js');
		$data['kategori'] = $this->model_app->view_order('kategori','kategori_id','DESC');	
		$this->template->load('template','buku/add',$data);
	}

	public function delete()
	{
		$id = decode($this->input->get('id'));
		$cek = $this->model_app->view_where('buku',array('buku_id'=>$id));
		if($cek->num_rows() > 0){
			$cekk =  $this->db->query("SELECT * FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE b.td_buku_id = '$id' AND a.transaksi_status = 'pinjam'");
			if($cekk->num_rows() > 0){
				$this->session->set_flashdata('error','Buku tidak bisa dihapus karena sedang dipinjam');
				redirect('internal/buku');
			}else{
				$this->model_app->delete('buku',array('buku_id'=>$id));
			
				$this->session->set_flashdata('success','Buku berhasil dihapus');
				redirect('internal/buku');
			}	
			
		}else{
			$this->session->set_flashdata("error","Buku tidak ditemukan");
			redirect('internal/buku');
		}
		
	}
	public function edit()
	{
		$judul = $this->input->get('judul');
		$cek = $this->model_app->view_where('buku',array('buku_slug'=>$judul));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['page'] = 'Buku';
			$data['row'] =  $this->model_app->join_where('buku','kategori','buku_kategori_id','kategori_id',array('buku_id'=>$row['buku_id']))->row_array();
			$data['title'] = 'Edit Buku - '.title();
			$data['subtitle'] = 'Edit Buku';
			$data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';
			$data['js'] = base_url('template/admin/ajax/buku/ajax-edit.js');
			$data['breadcrumb'] .= ' <a  href= "'.base_url('internal/buku').'" class="breadcrumb-item ">Buku</a>';
			$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Detail</span>';
			$data['kategori'] = $this->model_app->view_order('kategori','kategori_id','DESC');	
			$this->template->load('template','buku/edit',$data);
		}else{
			$this->session->set_flashdata("error","Buku tidak ditemukan");
			redirect('internal/buku');
		}
		
	}
	public function detail()
	{
		$judul = $this->input->get('judul');
		$cek = $this->model_app->view_where('buku',array('buku_slug'=>$judul));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['page'] = 'Buku';
			$data['row'] =  $this->model_app->join_where('buku','kategori','buku_kategori_id','kategori_id',array('buku_id'=>$row['buku_id']))->row_array();
			$data['title'] = 'Detail Buku - '.title();
			$data['subtitle'] = 'Detail Buku';
			$data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';
			$data['js'] ='';
			$data['breadcrumb'] .= ' <a  href= "'.base_url('internal/buku').'" class="breadcrumb-item ">Buku</a>';
			$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Detail</span>';
			
			$this->template->load('template','buku/detail',$data);
		}else{
			$this->session->set_flashdata("error","Buku tidak ditemukan");
			redirect('internal/buku');
		}
		
	}
	


	public function update()
	{
		if($this->input->method() == 'post'){
			$slug = $this->input->post('slug');
			$cek = $this->model_app->view_where('buku',array('buku_slug'=>$slug));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$this->form_validation->set_rules('judul','Judul Buku','min_length[3]|max_length[255]|required');
				$this->form_validation->set_rules('kode','Kode Buku','required');
				$this->form_validation->set_rules('sinopsis','Sinopsis Buku','required');
				$this->form_validation->set_rules('kategori','Kategori Buku','required');
				$this->form_validation->set_rules('pengarang','Pengarang Buku','required');
				$this->form_validation->set_rules('penerbit','Penerbit Buku','required');
				$this->form_validation->set_rules('penerbit','Penerbit Buku','required');
				$this->form_validation->set_rules('tahun_terbit','Tahun Terbit Buku','required');
				$this->form_validation->set_rules('halaman','Halaman Buku','required');
				$this->form_validation->set_rules('rak','Rak Buku','required');
				$this->form_validation->set_rules('jumlah','Jumlah Buku','required');
				$this->form_validation->set_rules('denda_hilang','Denda Buku Hilang','required');
				$this->form_validation->set_rules('denda_rusak','Denda Buku Rusak','required');



			
				if($this->form_validation->run() == FALSE){
					$status = false;
					$replace = array('<p>','</p>');
					$msg = replace($replace,validation_errors());
				}else{
						$config['upload_path']          = './upload/buku/';
						$config['encrypt_name'] = TRUE;
						$config['allowed_types']        = 'gif|jpg|png|jpeg';
						$config['max_size']             = 5000;
							
								
						$this->load->library('upload', $config,'thumbnail');
				
						$this->thumbnail->initialize($config);
									

					if ($this->thumbnail->do_upload('file')){
						
							
						$upload_data = $this->thumbnail->data();
						$cover = $upload_data['file_name'];
							
						
					
						
							
						
					}else{
						$cover = $row['buku_cover'];
					}
						
						
						$judul = $this->input->post('judul');
						$kode = $this->input->post('kode');
						$sinopsis = $this->input->post('sinopsis');
						$kategori = $this->input->post('kategori');
						$pengarang = $this->input->post('pengarang');
						$penerbit = $this->input->post('penerbit');
						$tahun_terbit = $this->input->post('tahun_terbit');
						$halaman = $this->input->post('halaman');
						$rak = $this->input->post('rak');
						$jumlah = $this->input->post('jumlah');
						$denda_hilang = $this->input->post('denda_hilang');
						$denda_rusak = $this->input->post('denda_rusak');
						$slug = $this->model_app->seo_buku_update(seo($judul),$row['buku_id']);
						if($row['buku_qr_code'] != NULL OR $row['buku_qr_code'] != ''){
							unlink('/upload/qr'.$row['buku_qr_code']);
						}
						$data = array(
							'buku_judul'=>$judul,
							'buku_kode'=>$kode,
							'buku_sinopsis'=>$sinopsis,
							'buku_kategori_id'=>$kategori,
							'buku_pengarang'=>$pengarang,
							'buku_penerbit'=>$penerbit,
							'buku_tahun_terbit'=>$tahun_terbit,
							'buku_halaman'=>$halaman,
							'buku_rak'=>$rak,
							'buku_qty'=>$jumlah,
							'buku_denda_hilang'=>$denda_hilang,
							'buku_denda_rusak'=>$denda_rusak,
							'buku_cover'=>$cover,
							'buku_slug'=>$slug,
							'buku_qr_code'=>$this->generateQR($kode),
							
							);
						$this->model_app->update('buku',$data,array('buku_id'=>$row['buku_id']));
						$status = true;
						$msg = 'Buku berhasil diubah';
					
					
				}
			
			}else{
				$status = false;
				$msg = 'Buku tidak ditemukan';
			}
		}else{
			redirect('internal/buku');
		}
		echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/buku')));
		
	}
	function updateImage(){
		if($this->input->method() == 'post'){
			$id = $this->input->post('id');
			$cek = $this->model_app->view_where('produk',array('produk_id'=>$id));
			$image = null;
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$config['upload_path']          = './upload/produk/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
					
						
				$this->load->library('upload', $config);
		
				
							

				if ($this->upload->do_upload('file')){
					$upload_data = $this->upload->data();
					$foto = $upload_data['file_name'];
					$path = './upload/produk/'.$row['produk_image'] ;
           
          
                    unlink($path);
					$image = base_url('upload/produk/').$foto;
					$this->model_app->update('produk',array('produk_image'=>$foto),array('produk_id'=>$id));
					$status = true;
					$msg = 'Foto berhasil diubah';
				}else{
					$status = false;
					$msg ='Gambar tidak boleh kosong';
				}
			}else{
				$status = false;
				$msg ='Produk tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'image'=>$image,'redirect'=>base_url('internal/produk')));
		}else{
			redirect('internal/produk');
		}
	}

	function store(){
		if($this->input->method() == 'post'){
			$this->form_validation->set_rules('judul','Judul Buku','min_length[3]|max_length[255]|required');
			$this->form_validation->set_rules('kode','Kode Buku','required|is_unique[buku.buku_kode]');
			$this->form_validation->set_rules('sinopsis','Sinopsis Buku','required');
			$this->form_validation->set_rules('kategori','Kategori Buku','required');
			$this->form_validation->set_rules('pengarang','Pengarang Buku','required');
			$this->form_validation->set_rules('penerbit','Penerbit Buku','required');
			$this->form_validation->set_rules('penerbit','Penerbit Buku','required');
			$this->form_validation->set_rules('tahun_terbit','Tahun Terbit Buku','required');
			$this->form_validation->set_rules('halaman','Halaman Buku','required');
			$this->form_validation->set_rules('rak','Rak Buku','required');
			$this->form_validation->set_rules('jumlah','Jumlah Buku','required');
			$this->form_validation->set_rules('denda_hilang','Denda Buku Hilang','required');
			$this->form_validation->set_rules('denda_rusak','Denda Buku Rusak','required');



		
			if($this->form_validation->run() == FALSE){
                $status = false;
                $replace = array('<p>','</p>');
                $msg = replace($replace,validation_errors());
			}else{
					$config['upload_path']          = './upload/buku/';
					$config['encrypt_name'] = TRUE;
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 5000;
						
							
					$this->load->library('upload', $config,'thumbnail');
			
					$this->thumbnail->initialize($config);
								

				if ($this->thumbnail->do_upload('file')){
					$upload_data = $this->thumbnail->data();
					$cover = $upload_data['file_name'];
					
					$judul = $this->input->post('judul');
					$kode = $this->input->post('kode');
					$sinopsis = $this->input->post('sinopsis');
					$kategori = $this->input->post('kategori');
					$pengarang = $this->input->post('pengarang');
					$penerbit = $this->input->post('penerbit');
					$tahun_terbit = $this->input->post('tahun_terbit');
					$halaman = $this->input->post('halaman');
					$rak = $this->input->post('rak');
					$jumlah = $this->input->post('jumlah');
					$denda_hilang = $this->input->post('denda_hilang');
					$denda_rusak = $this->input->post('denda_rusak');
					$slug = $this->model_app->seo_buku(seo($judul));
					$data = array(
						'buku_judul'=>$judul,
						'buku_kode'=>$kode,
						'buku_sinopsis'=>$sinopsis,
						'buku_kategori_id'=>$kategori,
						'buku_pengarang'=>$pengarang,
						'buku_penerbit'=>$penerbit,
						'buku_tahun_terbit'=>$tahun_terbit,
						'buku_halaman'=>$halaman,
						'buku_rak'=>$rak,
						'buku_qty'=>$jumlah,
						'buku_denda_hilang'=>$denda_hilang,
						'buku_denda_rusak'=>$denda_rusak,
						'buku_cover'=>$cover,
						'buku_slug'=>$slug,
						'buku_qr_code'=>$this->generateQR($kode),
						
						);
					$this->model_app->insert('buku',$data);
					$status = true;
					$msg = 'Buku berhasil ditambahkan';
						
						
						
					
				
					
						
					
				}else{
					$status = false;
					$msg = 'Masukan cover buku';
				}
				
				
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/buku')));
		}else{
			redirect('internal/produk/add');
		}
	}
	
	
}
