<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('model_app','',TRUE);
    	if($this->session->userdata('isLog')){
			
		}else{
			redirect('internal/auth');
		}
	}
    function image(){
		if($this->input->method() == 'post'){
			$id = decode($this->session->userdata['isLog']['users_id']);
			$cek = $this->model_app->view_where('users',array('users_id'=>$id));
			$image = null;
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$config['upload_path']          = './upload/user/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
					
						
				$this->load->library('upload', $config);
		
				
							

				if ($this->upload->do_upload('file')){
					$upload_data = $this->upload->data();
					$foto = $upload_data['file_name'];
					$path = './upload/user/'.$row['users_foto'] ;
           
          
                    unlink($path);
					$image = base_url('upload/user/').$foto;
					$this->model_app->update('users',array('users_foto'=>$foto),array('users_id'=>$id));
                    $this->session->set_flashdata('success','Foto berhasil diubah');
					redirect('internal/profile');
				}else{
                    $this->session->set_flashdata('error','Foto gagal diubah');
					redirect('internal/profile');
				}
			}else{
                $this->session->set_flashdata('error','Sesi telah berakhir');
                redirect('internal/logout');
			}
		
		}else{
			redirect('internal/profile');
		}
	}
	public function index()
	{
        $id = decode($this->session->userdata['isLog']['users_id']);
        $row = $this->model_app->view_where('users',array('users_id'=>$id))->row_array();
        $data['page'] = 'Profil';
		$data['title'] = 'Profil - '.title();
		$data['right'] =' ';
		$data['js'] = '';
		$data['row'] = $row;
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">Profil</span>';

        $this->template->load('template','profile',$data);
	
	}
    function do(){
        $id = decode($this->session->userdata['isLog']['users_id']);
        $cek = $this->model_app->view_where('users',array('users_id'=>$id));
        if($cek->num_rows() > 0){
            
			$row = $cek->row_array();
			$this->form_validation->set_rules('nama','Nama ','min_length[3]|max_length[255]|required');
			$this->form_validation->set_rules('no_telp','No telepon','min_length[5]|max_length[20]|required');
			$this->form_validation->set_rules('username','Username','min_length[5]|max_length[100]|required');
			$this->form_validation->set_rules('address','Alamat','required');
			$this->form_validation->set_rules('nip','NIP ','required');
			$this->form_validation->set_rules('email','Email','required');
			
			if($this->form_validation->run() == FALSE){
				$status = false;
				$replace = array('<p>','</p>');
				$msg = replace($replace,validation_errors());
			}else{
				
				$username = $this->input->post('username');
				$nip = $this->input->post('nip');
				$email = $this->input->post('email');
				$alamat= $this->input->post('address');

				$password = $this->input->post('password');
				$checking = $this->db->query("SELECT * FROM users WHERE users_username = '$username' AND users_id != '$id'");
				$checking1 = $this->db->query("SELECT * FROM users WHERE users_nip = '$nip' AND users_id != '$id'");
				$checking2 = $this->db->query("SELECT * FROM users WHERE users_email = '$email' AND users_id != '$id'");
				if($checking->num_rows() > 0){
					$status = false;
					$msg = 'Username sudah digunakan';
					$this->session->set_flashdata('error',$msg);
					redirect('internal/profile');
				}else if($checking1->num_rows() > 0){
					$status = false;
					$msg = 'NIP sudah digunakan';
					$this->session->set_flashdata('error',$msg);
					redirect('internal/profile');
				}else if($checking2->num_rows() > 0){
					$status = false;
					$msg = 'Email sudah digunakan';
					$this->session->set_flashdata('error',$msg);
					redirect('internal/profile');
				}else{
					if($password != ''){
						$data = array(
							'users_nama' => $this->input->post('nama'),
							'users_no_telp' => $this->input->post('no_telp'),
							'users_username' => $username,
							'users_password' => sha1($password),
							'users_nip' => $nip,
							'users_email' => $email,
							'users_alamat' => $alamat,
						
							
						);
					}else{
						$data = array(
							'users_nama' => $this->input->post('nama'),
							'users_no_telp' => $this->input->post('no_telp'),
							'users_username' => $username,
							'users_nip' => $nip,
							'users_email' => $email,
							'users_alamat' => $alamat,
						
						
							
						);
					}
						$this->model_app->update('users',$data,array('users_id'=>$id));
						$status = true;
						$this->session->set_flashdata('success','Profil berhasil diperbarui');
						redirect('internal/profile');
				}
			}
          
        }else{
            $this->session->set_flashdata('error','Sesi telah berakhir');
            redirect('internal/logout');
        }
       
    }


	
}
