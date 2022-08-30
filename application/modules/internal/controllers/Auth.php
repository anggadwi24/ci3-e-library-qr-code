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
		if($this->session->userdata('isLog')){
			redirect('internal/main');
		}else{
			$data['title'] = 'Login - '.title();
			$this->load->view('login',$data);
		}
		
	}
	function do(){
		if($this->input->method() == 'post'){
			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			
			if(!trim($username) AND !trim($pass)){
				$this->session->set_flashdata('error','Email/Username dan password wajib diisi');
				redirect('internal/auth');
			}else if(!trim($username) ){
				$this->session->set_flashdata('error','Email/Username  wajib diisi');
				redirect('internal/auth');
			}else if(!trim($pass)){
				$this->session->set_flashdata('error','Password wajib diisi');
				redirect('internal/auth');
			}else{
				$cek = $this->model_app->dataUsers($username);
				if($cek->num_rows() > 0){
					$row = $cek->row_array();
					$cekPass = $this->model_app->view_where('users',array('users_id'=>$row['users_id'],'users_password'=>sha1($pass)));
					if($cekPass->num_rows() > 0){
						$data = array('users_id'=>encode($row['users_id']));
						$this->session->set_userdata('isLog',$data);
						redirect('internal/main');
					}else{
						$this->session->set_flashdata('error','Password salah');
						redirect('internal/auth');
					}

				}else{
					$this->session->set_flashdata('error','Email/Username tidak ditemukan');
					redirect('internal/auth');
				}
			}
		}else{
			redirect('internal/auth');
		}
	}

	
}
