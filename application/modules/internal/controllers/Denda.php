<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda extends MX_Controller 
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
		$data['page'] = 'Denda';
		$data['title'] = 'Denda - '.title();
		$data['subtitle'] = 'Denda';
		$data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';

		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Denda</span>';
		$data['record'] = $this->model_app->view_order('denda','denda_id','DESC');
		$data['js'] = base_url('template/admin/ajax/buku/ajax-denda.js');

		$this->template->load('template','buku/denda',$data);
	
	}
    public function edit(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $cek = $this->model_app->view_where('denda',array('denda_id'=>$id));
            $arr = null;
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $status = true;
                $msg = null;
                $arr['hari'] = $row['denda_hari'];
                $arr['denda'] = $row['denda'];

            
                $arr['id'] = encode($row['denda_id']);
            }else{
                $status = false;
                $msg = 'Denda tidak ditemukan';
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
            $hari = $this->input->post('hari');
            $denda = $this->input->post('denda');

          
            $cek = $this->model_app->view_where('denda',array('denda_id'=>$id));
            if($cek->num_rows() > 0){
                $this->form_validation->set_rules('denda','Denda','required');
                $this->form_validation->set_rules('hari','Hari','required');

           
                if($this->form_validation->run() == FALSE){
                    $status = false;
                    $replace = array('<p>','</p>');
                    $msg = replace($replace,validation_errors());
                    $this->session->set_flashdata('error',$msg);
                    redirect('internal/denda');
                }else{
                 
                    $data = array(
                        'denda_hari' => $hari,
                        'denda' => $denda,
                    );
                    $this->model_app->update('denda',$data,array('denda_id'=>$id));
                    $this->session->set_flashdata('success','Denda berhasil diubah');
                    redirect('internal/denda');
                }
            }else{
                $this->session->set_flashdata('error','Denda tidak ditemukan');
                redirect('internal/denda');
            }
           
            

        }else{
            redirect('internal/denda');
        }
    }
    
}