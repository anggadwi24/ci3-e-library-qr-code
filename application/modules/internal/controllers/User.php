<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller 
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
        $row = $this->model_app->view_order('users','users_id','DESC');
        $data['record'] = $row;
        $data['page'] = 'Admin';
		$data['subtitle'] = 'Admin';
		$data['title'] = 'Admin - '.title();
		$data['js'] = base_url('template/admin/ajax/basic.js');
		$data['right'] =' <a href="'.base_url('internal/user/add') .'" class="btn btn-info kanan"><i class="ti-plus"> </i> Tambah User</a>';
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">User</span>';
		$this->template->load('template','user/user',$data);
	}
	function status(){
		$id = decode($this->input->get('id'));
		$cek = $this->model_app->view_where('users',array('users_id'=>$id));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			if($row['users_active']=='y'){
				$status = 'n';
				$this->session->set_flashdata('success','User berhasil di nonaktifkan');

			}else{
				$status = 'y';
				$this->session->set_flashdata('success','User berhasil di aktifkan');
			}
			$this->model_app->update('users',array('users_active'=>$status),array('users_id'=>$id));
			redirect('internal/user');
		}else{
			$this->session->set_flashdata('error','User tidak ditemukan');
			redirect('internal/user');
		}
	}
	function delete(){
		$id = decode($this->input->get('id'));
		$cek = $this->model_app->view_where('users',array('users_id'=>$id));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();	
			
			$this->model_app->delete('users',array('users_id'=>$id));
			$this->session->set_flashdata('success','User berhasil dihapus');
			redirect('internal/user');
		}else{
			$this->session->set_flashdata('error','MemUserber tidak ditemukan');
			redirect('internal/user');
		}
	}
	function store(){
		if($this->input->method() == 'post'){
			$this->form_validation->set_rules('name','Nama User','min_length[3]|max_length[255]|required');
			$this->form_validation->set_rules('no_telp','No telepon','min_length[5]|max_length[20]|required');
			$this->form_validation->set_rules('nip','Nip','min_length[5]|max_length[25]|is_unique[users.users_nip]|required');

			$this->form_validation->set_rules('username','Username','min_length[5]|max_length[100]|is_unique[users.users_username]|required');
			$this->form_validation->set_rules('email','email','min_length[5]|max_length[100]|is_unique[users.users_email]|required');
			$this->form_validation->set_rules('address','Alamat','required');

			$this->form_validation->set_rules('password','Password','min_length[5]|required');
			if($this->form_validation->run() == FALSE){
				$status = false;
				$replace = array('<p>','</p>');
				$msg = replace($replace,validation_errors());
			}else{
				$config['upload_path']          = './upload/user/';
				$config['encrypt_name'] = TRUE;
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
					
						
				$this->load->library('upload', $config);
		
				
							

				if ($this->upload->do_upload('gambar')){
					$upload_data = $this->upload->data();
					$foto = $upload_data['file_name'];
					$data = array(
						'users_nama' => $this->input->post('name'),
						'users_nip' => $this->input->post('nip'),
						'users_email'=> $this->input->post('email'),
					
						'users_no_telp' => $this->input->post('no_telp'),
						'users_username' => $this->input->post('username'),
						'users_password' => sha1($this->input->post('password')),
						'users_alamat'=>$this->input->post('address'),
						'users_foto'=>$foto,
						
					);
					$this->model_app->insert('users',$data);
					$status = true;
					$msg = 'User berhasil disimpan';
				}else{
					$status = false;
					$msg = 'Foto harus diisi';
				}
				
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/user')));
		}else{
			redirect('internal/user/add');
		}
	}
	function updateImage(){
		if($this->input->method() == 'post'){
			$id = $this->input->post('id');
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
					$status = true;
					$msg = 'Foto berhasil diubah';
				}else{
					$status = false;
					$msg ='Foto tidak boleh kosong';
				}
			}else{
				$status = false;
				$msg ='User tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'image'=>$image,'redirect'=>base_url('internal/produk')));
		}else{
			redirect('internal/produk');
		}
	}
	function update(){
		if($this->input->method() == 'post'){
			$id = $this->input->post('id');
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
					}else if($checking1->num_rows() > 0){
						$status = false;
						$msg = 'NIP sudah digunakan';

					}else if($checking2->num_rows() > 0){
						$status = false;
						$msg = 'Email sudah digunakan';
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
							$msg = 'User berhasil disimpan';
					}
					
					
					
				}
			}else{
				$status = false;
				$msg = 'User tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>base_url('internal/user')));
		}else{
			redirect('internal/user/add');
		}
	}

    public function add()
	{
        $data['page'] = 'User';
		$data['title'] = 'User - '.title();
		$data['right'] =' ';
		$data['breadcrumb'] = ' <a href="'.base_url('internal/user').'" class="breadcrumb-item">User</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Tambah</span>';
		$data['js'] = base_url('template/admin/ajax/user/ajax-add.js');
		$this->template->load('template','user/user_add',$data);
	}

    public function edit()
	{
		$id = $this->input->get('id');
		$cek = $this->model_app->view_where('users',array('users_id'=>$id));
		if($cek->num_rows() > 0){
			$data['row'] = $cek->row_array();
			$data['page'] = 'User';
			$data['title'] = 'User - '.title();
			$data['right'] =' ';
			$data['js'] = base_url('template/admin/ajax/user/ajax-edit.js');

			$data['breadcrumb'] = ' <a href="'.base_url('internal/user').'" class="breadcrumb-item">User</a>';
			$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Edit</span>';
			$this->template->load('template','user/user_edit',$data);
		}else{
			$this->session->set_flashdata('message','User tidak ditemukan');
			redirect('internal/user');
		}
       
	}


}
