<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);
	}

	public function index()
	{
        if($this->session->userdata('isMember')){
			redirect('');
		}else{
            $data['provinsi'] = $this->model_app->view_order('provinsi','provinsi_nama','ASC');
            $data['js'] = base_url('template/public/ajax/member/ajax-add.js');
            $data['title'] = 'Register - '.title();
		    $this->template->load('template','register',$data);
        }
	}
	function store(){
       
            if($this->input->method() == 'post'){
                $redirect = null;
                $this->form_validation->set_rules('nama','Nama Member','min_length[3]|max_length[255]|required');
                $this->form_validation->set_rules('no_telp','Nomor Telepon','min_length[10]|max_length[20]|required');
                $this->form_validation->set_rules('alamat','Alamat','required');
                // $this->form_validation->set_rules('file','File','required');
                $this->form_validation->set_rules('provinsi','Provinsi','required');
                $this->form_validation->set_rules('kabupaten','Kabupaten','required');
                $this->form_validation->set_rules('kode_pos','Kode Pos','required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[member.member_email]');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[password]');
                
    
                
    
                if($this->form_validation->run() == FALSE){
                    $status = false;
                    $replace = array('<p>','</p>');
                    $msg = replace($replace,validation_errors());
                }else{
                    $nama = $this->input->post('nama');
                    $no_telp = $this->input->post('no_telp');
                    $alamat = $this->input->post('alamat');
                    $provinsi = $this->input->post('provinsi');
                    $kabupaten = $this->input->post('kabupaten');
                    $kode_pos = $this->input->post('kode_pos');
                    $email = $this->input->post('email');
                    $pass = $this->input->post('password');
                    $password = sha1($pass);
                    $gambar = $_FILES['file'];

                    if ($gambar="") {}
                    else 
                    {
                        $config ['upload_path'] 	= './upload/member';
                        $config ['allowed_types']   = 'gif|jpg|png|jpeg';
				        $config['encrypt_name'] = TRUE;


                        $this->load->library('upload',$config);
                        if(!$this->upload->do_upload('file'))
                        {
                            echo "Gambar Gagal di Upload";
                        }
                        else
                        {
                            $gambar = $this->upload->data('file_name');
                        }
                    }
                    $data = array('member_nama'=>$nama,'member_no_telp'=>$no_telp,'member_alamat'=>$alamat,'member_provinsi'=>$provinsi,'member_kabupaten'=>$kabupaten,'member_kode_pos'=>$kode_pos,'member_email'=>$email,'member_password'=>$password,'member_foto'=>$gambar,'member_status'=>'y');
                    $this->model_app->insert('member',$data);
                    $status = true;
                    $msg = 'Register berhasil';
                    $redirect = base_url('auth');
                }
                echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
            }else{
                redirect('register');
            }
        
    }

}
