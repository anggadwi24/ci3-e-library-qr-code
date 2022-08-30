<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MX_Controller 
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
		$this->output->set_header(500);
	}
   function countFine(){
        if($this->input->method() == 'post'){
            $record = $this->model_app->view_where('transaksi',array('transaksi_status'=>'pinjam'));
            $denda = $this->model_app->view('denda')->row_array();
            if($record->num_rows() > 0){
                foreach($record->result_array() as $row){
                    if($row['transaksi_tanggal_kembali'] < date('Y-m-d H:i:s')){
                        $days = daysDifference(date('Y-m-d H:i:s'),$row['transaksi_tanggal_kembali']);
                        // echo json_encode($days);
                        $count = $days/$denda['denda_hari'];
                        if($count == 0){
                            $count = 1;
                        }
                        $fine = $denda['denda']*$count;
                        // echo $count;
                        $this->model_app->update('transaksi',array('transaksi_denda_telat'=>$fine),array('transaksi_id'=>$row['transaksi_id']));
                    }
                }
            }
        }
   }
   
   function sendEmail(){
        if($this->input->method() == 'post'){
            $record = $this->model_app->view_where('transaksi',array('transaksi_status'=>'pinjam','transaksi_send_email'=>'n'));
            $denda = $this->model_app->view('denda')->row_array();
            if($record->num_rows() > 0){
                foreach($record->result_array() as $row){
                    $date = date('Y-m-d H:i:s',strtotime('-1 Days',strtotime($row['transaksi_tanggal_kembali'])));
                    if($date < date('Y-m-d H:i:s')){
                        $siswa = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']));
                        if($siswa->num_rows() > 0){
                            $this->model_app->update('transaksi',array('transaksi_send_email'=>'y'),array('transaksi_id'=>$row['transaksi_id']));
                            $sis =  $siswa->row_array();
                            $email = $sis['siswa_email'];
                            $subject = '[MTS AL-MA`RUF] PENGEMBALIAN BUKU';
                            $content = 'Assallamuallaikum adik '.$sis['siswa_nama_lengkap'].'.<br>
                                     Sebagai pengingat jangan lupa untuk mengembalikan buku dibawah ini <br>';
                            $data = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
                            if($data->num_rows() > 0){
                                $no = 1;
                                foreach($data->result_array() as $rows){
                                    $content .= $no.'. '.$rows['buku_judul'].'<br><br>';
                                    $no++;
                                }
                            }

                            $content .='dengan jadwal yang telah ditentukan pada saat transaksi peminjaman buku. yang jatuh tempo pada '.tanggalwaktu($row['transaksi_tanggal_kembali']).'. Terimakasih';
                            $status = pushEmail($email,$subject,$content);
                            echo json_encode($status);
                        }
                    }
                }
            }
        }
   }
    

}
