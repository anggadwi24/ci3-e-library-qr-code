<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MX_Controller 
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
		$data['page'] = 'Kategori';
		$data['title'] = 'Kategori - '.title();
		$data['subtitle'] = 'Kategori';
        $data['breadcrumb'] = ' <span class="breadcrumb-item ">Buku</span>';
		$data['breadcrumb'] .= ' <span class="breadcrumb-item active">Kategori</span>';
		$data['record'] = $this->model_app->view_order('kategori','kategori_id','DESC');
		$data['js'] = base_url('template/admin/ajax/buku/ajax-cat.js');

		$this->template->load('template','buku/kategori',$data);
	
	}
    public function edit(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $cek = $this->model_app->view_where('kategori',array('kategori_id'=>$id));
            $arr = null;
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $status = true;
                $msg = null;
                $arr['kategori'] = $row['kategori_nama'];
            
                $arr['id'] = encode($row['kategori_id']);
            }else{
                $status = false;
                $msg = 'Kategori tidak ditemukan';
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
            $kategori = $this->input->post('kategori');
          
            $cek = $this->model_app->view_where('kategori',array('kategori_id'=>$id));
            if($cek->num_rows() > 0){
                $this->form_validation->set_rules('kategori','Kategori','required');
           
                if($this->form_validation->run() == FALSE){
                    $status = false;
                    $replace = array('<p>','</p>');
                    $msg = replace($replace,validation_errors());
                    $this->session->set_flashdata('error',$msg);
                    redirect('internal/kategori');
                }else{
                 
                    $data = array(
                        'kategori_nama' => $kategori,
                        'kategori_slug' => $this->model_app->seo_kategori_update(seo($kategori),$id),
                    );
                    $this->model_app->update('kategori',$data,array('kategori_id'=>$id));
                    $this->session->set_flashdata('success','Kategori berhasil diubah');
                    redirect('internal/kategori');
                }
            }else{
                $this->session->set_flashdata('error','kategori tidak ditemukan');
                redirect('internal/kategori');
            }
           
            

        }else{
            redirect('internal/denda');
        }
    }
    public function delete(){
        if($this->input->method() == 'get'){
            $id = decode($this->input->get('id'));
            $cek = $this->model_app->view_where('kategori',array('kategori_id'=>$id));
            if($cek->num_rows() > 0){
                $this->model_app->delete('kategori',array('kategori_id'=>$id));
                $this->session->set_flashdata('success','Kategori berhasil dihapus');
                redirect('internal/kategori');
            }else{
                $this->session->set_flashdata('error','Kategori tidak ditemukan');
                redirect('internal/kategori');
            }
         
        }else{
            redirect('internal/kelas');
        }
    }
    public function store(){
        if($this->input->method() == 'post'){
            $this->form_validation->set_rules('kategori','Kategori','required|is_unique[kategori.kategori_nama]');
          
        




            if($this->form_validation->run() == FALSE){
                $status = false;
                $replace = array('<p>','</p>');
                $msg = replace($replace,validation_errors());
                $this->session->set_flashdata('error',json_encode($msg));
                redirect('internal/kategori');
            }else{
                $kategori=  $this->input->post('kategori');
                $slug = $this->model_app->seo_kategori(seo($kategori));;
                $data = array(
                    'kategori_nama' => $kategori,
                    'kategori_slug' => $slug
                );
                $this->model_app->insert('kategori',$data);
                $this->session->set_flashdata('success','Kategori berhasil ditambahkan');
                redirect('internal/kategori');
            }

        }else{
            redirect('internal/kelas');
        }
    }
}