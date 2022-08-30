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
