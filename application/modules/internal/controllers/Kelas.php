<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MX_Controller 
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
		$data['page'] = 'Kelas';
		$data['title'] = 'Kelas - '.title();
		$data['subtitle'] = 'Kelas';
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">Kelas</span>';
		$data['record'] = $this->model_app->view_order('kelas','kelas_nama','DESC');
		$data['js'] = base_url('template/admin/ajax/member/ajax-kelas.js');

		$this->template->load('template','kelas/kelas',$data);
	
	}
    public function edit(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $cek = $this->model_app->view_where('kelas',array('kelas_id'=>$id));
            $arr = null;
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $status = true;
                $msg = null;
                $arr['kelas'] = $row['kelas_nama'];
                $arr['ruangan'] = $row['kelas_ruangan'];
                $arr['id'] = encode($row['kelas_id']);
            }else{
                $status = false;
                $msg = 'Kelas tidak ditemukan';
            }
            $data = array(
                'status' => $status,
                'msg' => $msg,
                'arr' => $arr
            );
            echo json_encode($data);
        }else{
            redirect('internal/kelas');
        }
    }
    public function update(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $kelas = $this->input->post('kelas');
            $ruangan = $this->input->post('ruangan');
            $cek = $this->model_app->view_where('kelas',array('kelas_id'=>$id));
            if($cek->num_rows() > 0){
                $this->form_validation->set_rules('kelas','Kelas','required');
                $this->form_validation->set_rules('ruangan', 'Ruangan', 'required');
                if($this->form_validation->run() == FALSE){
                    $status = false;
                    $replace = array('<p>','</p>');
                    $msg = replace($replace,validation_errors());
                    $this->session->set_flashdata('error',$msg);
                    redirect('internal/kelas');
                }else{
                    $kelas=  $this->input->post('kelas');
                    $ruangan = $this->input->post('ruangan');
                    $data = array(
                        'kelas_nama' => $kelas,
                        'kelas_ruangan' => $ruangan
                    );
                    $this->model_app->update('kelas',$data,array('kelas_id'=>$id));
                    $this->session->set_flashdata('success','Kelas berhasil diubah');
                    redirect('internal/kelas');
                }
            }else{
                $this->session->set_flashdata('error','Kelas tidak ditemukan');
                redirect('internal/kelas');
            }
           
            

        }else{
            redirect('internal/kelas');
        }
    }
    public function delete(){
        if($this->input->method() == 'get'){
            $id = decode($this->input->get('id'));
            $cek = $this->model_app->view_where('kelas',array('kelas_id'=>$id));
            if($cek->num_rows() > 0){
                $this->model_app->delete('kelas',array('kelas_id'=>$id));
                $this->session->set_flashdata('success','Kelas berhasil dihapus');
                redirect('internal/kelas');
            }else{
                $this->session->set_flashdata('error','Kelas tidak ditemukan');
                redirect('internal/kelas');
            }
         
        }else{
            redirect('internal/kelas');
        }
    }
    public function store(){
        if($this->input->method() == 'post'){
            $this->form_validation->set_rules('kelas','Kelas','required|is_unique[kelas.kelas_nama]');
            $this->form_validation->set_rules('ruangan', 'Ruangan', 'required');
        




            if($this->form_validation->run() == FALSE){
                $status = false;
                $replace = array('<p>','</p>');
                $msg = replace($replace,validation_errors());
                $this->session->set_flashdata('error',$msg);
                redirect('internal/kelas');
            }else{
                $kelas=  $this->input->post('kelas');
                $ruangan = $this->input->post('ruangan');
                $data = array(
                    'kelas_nama' => $kelas,
                    'kelas_ruangan' => $ruangan
                );
                $this->model_app->insert('kelas',$data);
                $this->session->set_flashdata('success','Kelas berhasil ditambahkan');
                redirect('internal/kelas');
            }

        }else{
            redirect('internal/kelas');
        }
    }
}