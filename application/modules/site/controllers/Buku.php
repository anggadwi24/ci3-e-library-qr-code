<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);

    	
	}
	public function index()
	{
        $cat = $this->input->get('kategori');
        $sedia = $this->input->get('tersedia');
        if($cat == null OR $sedia == null){
            redirect('buku?kategori=all&tersedia=all');
        }else{
            $keyword = $this->input->get('keyword');
            $data['keyword'] = $keyword;
            $count = $this->model_app->dataBuku($cat,$sedia,$keyword)->num_rows();
            $data['total'] = $count;
            $config['base_url'] = site_url('buku?kategori='.$cat.'&tersedia='.$sedia); //site url
            $config['total_rows'] = $count;
            $config['per_page'] = 9;  //show record per halaman
            $config['page_query_string'] = TRUE;
            $config["uri_segment"] = 2;  // uri parameter
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
     
            // Membuat Style pagination untuk BootStrap v4
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '	<ul class="wn__pagination">';
            $config['full_tag_close']   = '</ul>';
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="active">';
            $config['cur_tag_close']    = '</li>';
            $config['next_tag_open']    = '<li>';
            $config['next_tagl_close']  = '</li>';
            $config['prev_tag_open']    = '<li>';
            $config['prev_tagl_close']  = '<i class="zmdi zmdi-chevron-right"></i></li>';
            $config['first_tag_open']   = '<li>';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li >';
            $config['last_tagl_close']  = '</li>';
          
     
            $this->pagination->initialize($config);
            // $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
     
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
          
     
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data["links"] = $this->pagination->create_links();
            $data['first'] = $page;
            $record =  $this->model_app->dataBukuLimit($cat,$sedia,$keyword,$config["per_page"], $page);   
            $data['record'] =$record;
            $data['per_page'] = $record->num_rows();

            $data['cat'] = $cat;
            $data['sedia'] = $sedia;
            $data['title'] = title();
            $data['page'] = 'Buku';
        
            $data['buku']  = $this->model_app->view_order('buku','buku_judul','ASC');
            $data['kategori'] = $this->model_app->view_order('kategori','kategori_nama','ASC');
            $data['semua'] = $this->model_app->view_order('buku','buku_judul','ASC');
            $this->template->load('template','buku',$data);
        }
		
	}
    function detail($slug){
        $cek = $this->model_app->view_where('buku',array('buku_slug'=>$slug));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['title'] = title();
            $data['page'] = 'Detail';
        
            $data['row']  = $row;
            $data['related'] = $this->model_app->view_where_ordering_limit('buku',array('buku_id !='=>$row['buku_id']),'buku_judul','ASC',0,10);
            $data['cat'] = $this->model_app->view_where('kategori',array('kategori_id'=>$row['buku_kategori_id']))->row_array();
            $data['kategori'] = $this->model_app->view_order('kategori','kategori_nama','ASC');
            $data['semua'] = $this->model_app->view_order('buku','buku_judul','ASC');
            $this->template->load('template','buku_detail',$data);
        }else{
            $this->session->set_flashdata('error','Buku tidak ditemukan');
            redirect('buku');
        }
    }
	
}
