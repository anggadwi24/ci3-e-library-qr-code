<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);
    	// if($this->session->userdata('isMember')){
			
		// }else{
		// 	redirect('auth');
		// }
	}

	public function index()
	{
		$this->output->set_header(500);
	}
    function kabupaten(){
        if($this->input->method() == 'post'){
            $prov = $this->input->post('id');
            $output = '<option disabled selected></option>';
            $data = $this->model_app->view_where_ordering('kota',array('kota_provinsi_id'=>$prov),'kota_nama','ASC');
            if($data->num_rows() > 0){
                foreach($data->result_array() as $row){
                    $output .= "<option value='".$row['kota_id']."'>".$row['kota_nama']."</option>";
                }
            }
            echo json_encode($output);
        }
    }
    function addCart(){
        if($this->input->method() == 'post'){
            $produk = decode($this->input->post('produk'));
            $batch = decode($this->input->post('batch'));
            $redirect =null;
            if($this->session->userdata('isMember')){
                $cekProduk = $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('produk_id'=>$produk,'pb_id'=>$batch));
                if($cekProduk->num_rows() > 0){
                    $row = $cekProduk->row_array();
                    if($row['pb_status'] == 'open'){
                        if($row['pb_tanggal_mulai'] <= date('Y-m-d H:i:s') AND $row['pb_tanggal_selesai'] >= date('Y-m-d H:i:s')){
                            $data = array(
                                'id' => $produk.'-'.$batch, 
                               
                                'name' => $row['produk_nama'],
                                'batch' =>$row['pb_batch'],
                                'price' => $row['produk_harga_jual'], 
                                'image'=>$row['produk_image'],
                                'qty' => 1, 
                            );
                            $this->cart->insert($data);
                            $status = true;
                            $msg = null;
                        }else{
                            $status = false;
                            $msg = 'Tanggal Pre Order sudah selesai';
                        }
                    }else{
                        $status = false;
                        $msg = 'Status produk close order';
                    }
                }else{
                    $status = false;
                    $msg = 'Produk tidak ditemukan';
                }
            }else{
                $status = false;
				$msg = 'Login terlebih dahulu untuk melakukan order';
				$redirect = base_url('auth');
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
            
        }
    }
    function dataCart(){
        if($this->input->method() == 'post'){
            $output = null;
            $count = $this->cart->total_items() ;
            $subtotal = 0;
            if($this->session->userdata('isMember')){
                if($this->cart->total_items() <= 0){
                    $output = '  <li><span>Keranjang masih kosong</span></li>';
                }else{
                
                    $record = $this->cart->contents();
                    foreach($record as $row ){
                        $ex = explode('-',$row['id']);
                        $id = $ex[0];
                        $batch = $ex[1];
                        $subtotal = $subtotal + $row['subtotal'];
                        $cek =  $this->model_app->join_where('produk','produk_batch','produk_id','pb_produk_id',array('produk_id'=>$id,'pb_id'=>$batch));
                        if($cek->num_rows() > 0){
                                $rows = $cek->row_array();
                                if(file_exists('upload/produk/'.$row['image'])){
                                    $image = base_url('upload/produk/'.$row['image']);
                                }else{
                                    $image = base_url('upload/produk/404.jpg');
                                }
                            
                                $output .= ' <li> 
                                <a class="close-cart deleteCart" data-id="'.$row['rowid'].'"><i class="fa fa-times-circle"></i></a>
                                <figure> 
                                    <a href="'.base_url('product/'.$rows['produk_seo'].'/'.$rows['pb_batch']).'" class="pull-left"> <img alt="Xpoge" src="'.$image.'" class="img-fluid"></a>
                                    <figcaption > 
                                        <p class="cart-price" style="font-size:11px; line-height:0px;">Batch '.$row['batch'].'</p>
                                        <span><a href="'.base_url('product/'.$rows['produk_seo'].'/'.$rows['pb_batch']).'">'.$row['name'].'</a></span> 
                                        <p class="cart-price">'.idr($row['price']).'</p>
                                        <div class="product-qty">
                                        <label>Qty:</label>
                                        <div class="custom-qty">
                                            <input type="number" name="qty" maxlength="0" value="'.$row['qty'].'" title="Qty" class="input-text qty quantity" data-id = "'.$row['rowid'].'">
                                        </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>';
                        }
                    }
                
                }   
            }else{
                $count = 0;
                $output = null;
                
            }
          echo json_encode(array('output'=>$output,'subtotal'=>idr($subtotal),'count'=>$count));
        }
       
    }
    function removeItem(){
        if($this->input->method() == 'post'){
            $rowid = $this->input->post('rowid');
            if($rowid != '' AND $rowid != null){
                $remove = $this->cart->remove($rowid);
            
           
                $status = true;
            }else{
                $status = false;
            }
            echo json_encode(array('status'=>$status));
        }
     
        
    }
    function updateCart(){
        if($this->input->method() == 'post'){
            $rowid = $this->input->post('rowid');
            $qty = $this->input->post('qty');
            if(!empty($rowid)){
                if($qty > 0){
                    $data = array(
                        'rowid' => $rowid,
                        'qty'   => $qty
                    );
                    $this->cart->update($data);
               
                    $status = true;
                    $msg = null;
                }else{
                    $status = false;
                    $msg = 'Quantity tidak boleh 0';
                }
            }else{
                $status = false;
                $msg = 'Cart tidak ditemukan';
            }
           echo json_encode(array('status'=>$status,'msg'=>$msg));
        }
    }
   

}
