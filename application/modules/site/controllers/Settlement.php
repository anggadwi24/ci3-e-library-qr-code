<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settlement extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
		if($this->session->userdata('isMember')){
			$this->load->model('model_app','',TRUE);
			$this->id = decode($this->session->userdata['isMember']['member_id']);
		}else{
			// redirect('auth');
            $this->load->model('model_app','',TRUE);
		}
    
	}
    function index(){
      
        
        $invoice = $this->input->get('order_id');
        $cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$invoice));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['title'] = '#'.$invoice;
            $data['row'] = $row;
            $data['status'] = $this->input->get('status_code');
            $this->template->load('template','finish',$data);
        }else{
             echo "<script>window.close();</script>";
        }

            // $this->template->load('template','finish');

    }

    function unfinish(){
      
        $invoice = $this->input->get('order_id');
        $cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$invoice));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['title'] = '#'.$invoice;
            $data['row'] = $row;
            $this->template->load('template','unfinish',$data);
        }else{
             echo "<script>window.close();</script>";
        }

        // $this->template->load('template','unfinish');


    }
    function error(){
        $data['title'] = 'Error - '.title();
        $this->template->load('template','error',$data);
    }

   
}
?>