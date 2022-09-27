<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);

    	
	}

	public function index()
	{
		if($this->session->userdata('isSiswa')){
			redirect('');
		}else{
			$data['title'] = 'Login - ' .title();
			$data['js'] = base_url('template/public/ajax/member/ajax-login.js');
	
			$this->template->load('template','login',$data);
		}
		
	}
	public function register()
	{
		if($this->session->userdata('isSiswa')){
			redirect('');
		}else{
			$data['kelas'] = $this->model_app->view_order('kelas','kelas_nama','ASC');
			$data['title'] = 'Register - ' .title();
			$data['js'] = base_url('template/public/ajax/member/ajax-register.js');
	
			$this->template->load('template','register',$data);
		}
		
	}
	public function regist(){
		if($this->input->method() == 'post'){
			$redirect = null;
			$this->form_validation->set_rules('nisn','NISN','min_length[3]|max_length[20]|required|is_unique[siswa.siswa_nisn]');

			$this->form_validation->set_rules('nama','Nama Lengkap','min_length[3]|max_length[255]|required');
			$this->form_validation->set_rules('phone','Nomor Hp.','min_length[10]|max_length[20]|required');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('kelas','Kelas','required');
			$this->form_validation->set_rules('jk','Jenis Kelamin','required');
			$this->form_validation->set_rules('dob','Tanggal Lahir','required');
			$this->form_validation->set_rules('pob','Tempat Lahir','required');




			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[siswa.siswa_email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');



			// $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run() == FALSE){
				$status = false;
				$replace = array('<p>','</p>');
				$msg = replace($replace,validation_errors());
				
				
			}else{
				$nisn = $this->input->post('nisn');
				$nama = $this->input->post('nama');
				$no_telp = $this->input->post('phone');
				$alamat = $this->input->post('alamat');
				$kelas = $this->input->post('kelas');
				$jk = $this->input->post('jk');
				$dob = $this->input->post('dob');
				$pob = $this->input->post('pob');
				$email = $this->input->post('email');
				$pass = $this->input->post('password');
				$password = sha1($pass);
				$data = array('siswa_nisn'=>$nisn,'siswa_nama_lengkap'=>$nama,'siswa_no_telp'=>$no_telp,'siswa_alamat'=>$alamat,'siswa_kelas'=>$kelas,'siswa_jenis_kelamin'=>$jk,'siswa_dob'=>$dob,'siswa_pob'=>$pob,'siswa_email'=>$email,'siswa_password'=>$password);
				$id = $this->model_app->insert_id('siswa',$data);
				$redirect = base_url();
				$cekk = $this->model_app->view_where('siswa_pengunjung',array('sp_siswa_id'=>$id,'sp_date'=>date('Y-m-d')));
				if($cekk->num_rows() > 0){
					
				}else{
					$dataR['sp_siswa_id'] = $id;
					$dataR['sp_date'] = date('Y-m-d');
					$this->model_app->insert('siswa_pengunjung',$dataR);
				}
				$data = array('siswa_id'=>encode($id));
				$this->session->set_userdata('isSiswa',$data);
				$status = true;
				$msg = null;
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
		}else{
			redirect('register');
			
		}
	}
	public function do()
	{
		if($this->input->method() == 'post'){
			$redirect = null;
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			if(!trim($email) AND !trim($pass)){
				
				$status = false;
				$msg = 'Email dan password wajib diisi';
			}else if(!trim($email) ){
				$status = false;
				$msg = 'Email wajib diisi';
			}else if(!trim($pass)){
				$status = false;
				$msg = 'Passowrd wajib diisi';
			}else{
				$cek = $this->model_app->view_where('siswa',array('siswa_email'=>$email));
				if($cek->num_rows() > 0){
					$row = $cek->row_array();
					$cekPass = $this->model_app->view_where('siswa',array('siswa_email'=>$email,'siswa_password'=>sha1($pass)));
					if($cekPass->num_rows() > 0){
						$data = array('siswa_id'=>encode($row['siswa_id']));
						$this->session->set_userdata('isSiswa',$data);
						$status = true;
						$msg = null;
						$redirect = base_url();
						$cekk = $this->model_app->view_where('siswa_pengunjung',array('sp_siswa_id'=>$row['siswa_id'],'sp_date'=>date('Y-m-d')));
						if($cekk->num_rows() > 0){

						}else{
							$dataR['sp_siswa_id'] = $row['siswa_id'];
							$dataR['sp_date'] = date('Y-m-d');
							$this->model_app->insert('siswa_pengunjung',$dataR);
						}

					}else{
						$msg = 'Password salah';
						$status = false;
					}

				}else{
					$msg = 'Email tidak ditemukan';
					$status = false;
				}
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
		}else{
			redirect('auth');
		}
	}
}
