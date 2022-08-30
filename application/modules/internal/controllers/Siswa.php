<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends MX_Controller 
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
		$data['page'] = 'Siswa';
		$data['title'] = 'Siswa - '.title();
		$data['subtitle'] = 'Siswa';
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">Siswa</span>';
		$data['record'] = $this->model_app->join_order2('siswa','kelas','siswa_kelas','kelas_id','siswa_id','DESC');
		$data['js'] = base_url('template/admin/ajax/basic.js');

		$this->template->load('template','anggota/anggota',$data);
		// $this->template->load('template_admin','admin/anggota');
	}

	public function add()
	{
		$data['page'] = 'Siswa';
		$data['title'] = 'Siswa - '.title();
		$data['right'] =' ';
		$data['subtitle'] = 'Form Siswa';
		$data['kelas'] = $this->model_app->view_order('kelas','kelas_nama','ASC');
		$data['breadcrumb'] = ' <a href="'.base_url('internal/siswa').'" class="breadcrumb-item">Siswa</a>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Tambah</span>';
		
		$data['js'] = base_url('template/admin/ajax/member/ajax-add.js');
		$this->template->load('template','anggota/anggota_add',$data);
		// $this->template->load('template_admin','admin/anggota');
	}
	
	public function edit()
	{
		$id = $this->input->get('id');
		$cek = $this->model_app->view_where('siswa',array('siswa_id'=>$id));
		if($cek->num_rows() > 0){
			$data['title'] = 'Anggota - '.title();
			$data['row'] = $cek->row_array();
			$data['page'] = 'Member';
			$data['title'] = 'Member - '.title();
			$data['subtitle'] = 'Form Siswa';
			$data['breadcrumb'] = ' <a href="'.base_url('internal/siswa').'" class="breadcrumb-item">Siswa</a>';
			$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Edit</span>';
			$data['kelas'] = $this->model_app->view_order('kelas','kelas_nama','ASC');
			$data['js'] = base_url('template/admin/ajax/member/ajax-edit.js');

			$this->template->load('template','anggota/anggota_edit',$data);
		}else{
			$this->session->set_flashdata('error','Member tidak ditemukan');
			redirect('internal/member');
		}
	}
	public function update()
	{
		if($this->input->method() == 'post'){
			$id = $this->input->post('id');
			$redirect = base_url('internal/siswa');
			$cek = $this->model_app->view_where('siswa',array('siswa_id'=>$id));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$this->form_validation->set_rules('nisn','NISN','min_length[3]|max_length[20]|required');

				$this->form_validation->set_rules('nama','Nama Lengkap','min_length[3]|max_length[255]|required');
				$this->form_validation->set_rules('telp','Nomor Telepon','min_length[10]|max_length[20]|required');
				$this->form_validation->set_rules('alamat','Alamat','required');
				$this->form_validation->set_rules('kelas','Kelas','required');
				$this->form_validation->set_rules('gender','Jenis Kelamin','required');
				$this->form_validation->set_rules('dob','Tanggal Lahir','required');
				$this->form_validation->set_rules('pob','Tempat Lahir','required');
			




				if($this->form_validation->run() == FALSE){
					$status = false;
					$replace = array('<p>','</p>');
					$msg = replace($replace,validation_errors());
				}else{
					$nisn = $this->input->post('nisn');
					$nama = $this->input->post('nama');
					$no_telp = $this->input->post('telp');
					$alamat = $this->input->post('alamat');
					$kelas = $this->input->post('kelas');
					$jk = $this->input->post('gender');
					$dob = $this->input->post('dob');
					$pob = $this->input->post('pob');

					if($nisn != $row['siswa_nisn']){
						$checking = $this->db->query("SELECT * FROM siswa WHERE siswa_nisn = '$nisn' AND member_id != '".$row['siswa_id']."' " );
						if($checking->num_rows() > 0){
							$status = false;
							$msg = 'NISN sudah digunakan';
						}else{
							$data = array('siswa_nisn'=>$nisn,'siswa_nama_lengkap'=>$nama,'siswa_no_telp'=>$no_telp,'siswa_alamat'=>$alamat,'siswa_kelas'=>$kelas,'siswa_jenis_kelamin'=>$jk,'siswa_dob'=>$dob,'siswa_pob'=>$pob);
							$this->model_app->update('siswa',$data,array('siswa_id'=>$id));
							$status = true;
							$msg = 'Siswa berhasil diubah';
						}
					}else{
						$data = array('siswa_nisn'=>$nisn,'siswa_nama_lengkap'=>$nama,'siswa_no_telp'=>$no_telp,'siswa_alamat'=>$alamat,'siswa_kelas'=>$kelas,'siswa_jenis_kelamin'=>$jk,'siswa_dob'=>$dob,'siswa_pob'=>$pob);
						$this->model_app->update('siswa',$data,array('siswa_id'=>$id));
						$status = true;
						$msg = 'Siswa berhasil diubah';
					}
				}
			}else{
				$status = false;
				$msg = 'Siswa tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
		}else{
			redirect('internal/siswa');
		}
		
	}
	public function updateLogin()
	{
		if($this->input->method() == 'post'){
			$id = $this->input->post('id');
			$redirect = base_url('internal/siswa');
			$cek = $this->model_app->view_where('siswa',array('siswa_id'=>$id));
			if($cek->num_rows() > 0){
				$row = $cek->row_array();
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				
			




				if($this->form_validation->run() == FALSE){
					$status = false;
					$replace = array('<p>','</p>');
					$msg = replace($replace,validation_errors());
				}else{
					$email = $this->input->post('email');
					$pass = $this->input->post('password');
					$password = sha1($pass);

					if($email != $row['siswa_email']){
						$checking = $this->db->query("SELECT * FROM siswa WHERE siswa_email = '$email' AND member_id != '".$row['siswa_id']."' " );
						if($checking->num_rows() > 0){
							$status = false;
							$msg = 'Email sudah digunakan';
						}else{
							if(trim($pass) != ''){
								$data = array('siswa_email'=>$email,'siswa_password'=>$password);
							}else{
								$data = array('siswa_email'=>$email);
							}
							$this->model_app->update('siswa',$data,array('siswa_id'=>$id));
							$status = true;
							$msg = 'Login siswa berhasil diubah';
							
						}
					
					}else{
						if(trim($pass) != ''){
							$data = array('siswa_email'=>$email,'siswa_password'=>$password);
						}else{
							$data = array('siswa_email'=>$email);
						}
						$this->model_app->update('siswa',$data,array('siswa_id'=>$id));
						$status = true;
						$msg = 'Login siswa berhasil diubah';
					}
				}
			}else{
				$status = false;
				$msg = 'Siswa tidak ditemukan';
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
		}else{
			redirect('internal/siswa');
		}
		
	}
	function status(){
		$id = decode($this->input->get('id'));
		$cek = $this->model_app->view_where('member',array('member_id'=>$id));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			if($row['member_status']=='y'){
				$status = 'n';
				$this->session->set_flashdata('success','Member berhasil di nonaktifkan');

			}else{
				$status = 'y';
				$this->session->set_flashdata('success','Member berhasil di aktifkan');
			}
			$this->model_app->update('member',array('member_status'=>$status),array('member_id'=>$id));
			redirect('internal/member');
		}else{
			$this->session->set_flashdata('error','Member tidak ditemukan');
			redirect('internal/member');
		}
	}
	function delete(){
		$id = decode($this->input->get('id'));
		$cek = $this->model_app->view_where('siswa',array('siswa_id'=>$id));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();	
			
			$this->model_app->delete('siswa',array('siswa_id'=>$id));
			$this->session->set_flashdata('success','Siswa berhasil dihapus');
			redirect('internal/siswa');
		}else{
			$this->session->set_flashdata('error','Siswa tidak ditemukan');
			redirect('internal/siswa');
		}
	}
	function store(){
		if($this->input->method() == 'post'){
			$redirect = null;
			$this->form_validation->set_rules('nisn','NISN','min_length[3]|max_length[20]|required|is_unique[siswa.siswa_nisn]');

			$this->form_validation->set_rules('nama','Nama Lengkap','min_length[3]|max_length[255]|required');
			$this->form_validation->set_rules('telp','Nomor Telepon','min_length[10]|max_length[20]|required');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('kelas','Kelas','required');
			$this->form_validation->set_rules('gender','Jenis Kelamin','required');
			$this->form_validation->set_rules('dob','Tanggal Lahir','required');
			$this->form_validation->set_rules('pob','Tempat Lahir','required');




			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[siswa.siswa_email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		




            if($this->form_validation->run() == FALSE){
                $status = false;
                $replace = array('<p>','</p>');
                $msg = replace($replace,validation_errors());
			}else{
				$nisn = $this->input->post('nisn');
				$nama = $this->input->post('nama');
				$no_telp = $this->input->post('telp');
				$alamat = $this->input->post('alamat');
				$kelas = $this->input->post('kelas');
				$jk = $this->input->post('gender');
				$dob = $this->input->post('dob');
				$pob = $this->input->post('pob');
				$email = $this->input->post('email');
				$pass = $this->input->post('password');
				$password = sha1($pass);
				$data = array('siswa_nisn'=>$nisn,'siswa_nama_lengkap'=>$nama,'siswa_no_telp'=>$no_telp,'siswa_alamat'=>$alamat,'siswa_kelas'=>$kelas,'siswa_jenis_kelamin'=>$jk,'siswa_dob'=>$dob,'siswa_pob'=>$pob,'siswa_email'=>$email,'siswa_password'=>$password);
				$this->model_app->insert('siswa',$data);
				$status = true;
				$msg = 'Siswa berhasil ditambah';
				$redirect = base_url('internal/siswa');
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
		}else{
			redirect('internal/member');
		}
	}
	
}
