
<!-- Checkout start -->
<div class="contant">
    <div id="banner-part" class="banner inner-banner">
        <div class="container">
            <div class="bread-crumb-main">
                <h1 class="banner-title">Detail Checkout</h1>
                <div class="breadcrumb">
                    <ul class="inline">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                       
                        <li>Detail Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout-part ptb-100">
        <div class="container">
            <form class="main-form">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card p-4">
                            <div class="heading-part mb-30">
                            <h3>Detail Pemesan</h3>
                            </div>

                            <table class="table m-0">
                                <tbody>
                                <tr>
                                    <td><b>Nama Lengkap :</b></td>
                                    <td align="right"><?= $row['transaksi_member_nama'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>No Telp :</b></td>
                                    <td align="right"><?= $row['transaksi_member_no_telp'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>Email :</b></td>
                                    <td align="right"><?= $row['transaksi_member_email']?></td>
                                </tr>
                                <tr>
                                    <td><b>Alamat :</b></td>
                                    <td align="right"><?= $row['transaksi_member_alamat'] ?> , <?= $asal['kota_nama']?>, <?= $asal['provinsi_nama'] ?> , (<?= $row['transaksi_member_kode_pos'] ?>)</td>
                                </tr>
                                <tr>
                                    <td><b>Ekspedisi :</b></td>
                                    <td align="right"><?= strtoupper($row['transaksi_ekspedisi'])?> - <?= strtoupper($row['transaksi_service'])?></td>
                                </tr>
                                <tr>
                                    <td><b>Catatan :</b></td>
                                    <td align="right"><?= $row['transaksi_catatan']?></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="heading-part mb-30 mb-sm-20">
                            <h3>PESANAN</h3>
                        </div>
                        <div class="checkout-products sidebar-product mb-60">
                            <ul>
                                <?php 
                                      $pro = $this->db->query("SELECT * FROM transaksi_detail a JOIN produk b ON a.td_produk_id  = b.produk_id JOIN produk_batch c ON a.td_pb_id = c.pb_id WHERE a.td_transaksi_id = '$row[transaksi_id]'");
                                      if($pro->num_rows() > 0){
                                        foreach($pro->result_array() as $pr){
                                            if(file_exists('upload/produk/'.$pr['produk_image'])){
                                                $gambar = base_url().'upload/produk/'.$pr['produk_image'];
                                            }else{
                                                $gambar = base_url().'upload/produk/404.jpg';
                                            }
                                            echo '<li>
                                            <div class="pro-media"> <a href="'.base_url('product/'.$pr['produk_seo'].'/'.$pr['pb_batch']).'"><img alt="Xpoge" src="'.$gambar.'"></a> </div>
                                            <div class="pro-detail-info"> <a href="'.base_url('product/'.$pr['produk_seo'].'/'.$pr['pb_batch']).'" class="product-title">'.$pr['produk_nama'].' ('.$pr['pb_batch'].')</a>
                                                <div class="price-box"> 
                                                    <span class="price">'.idr($pr['produk_harga_jual']).'</span>
                                                    
                                                </div>
                                                <div class="checkout-qty">
                                                    <div>
                                                        <label>Qty: </label>
                                                        <span class="info-deta">'.$pr['td_qty'].'</span> 
                                                    </div>
                                                </div>
                                            </div>
                                        </li>';
                                        }
                                      }
                                ?>
                                
                            </ul>
                        </div>
                        <div class="complete-order-detail commun-table gray-bg mb-30">
                            <div class="table-responsive">
                                <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td><b>Tanggal Pemesanan :</b></td>
                                        <td><?= tanggalwaktu($row['transaksi_created_on']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ongkos Kirim :</b></td>
                                        <td><?= idr($row['transaksi_ongkir'])?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total :</b></td>
                                        <td><?= idr($row['transaksi_total']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Status :</b></td>
                                        <td>

                                        <?php 
                                        if($row['transaksi_status'] == 'waiting'){
                                            $status = 'Belum dibayar';
                                        }else if($row['transaksi_status'] == 'dibayar'){
                                            $status = 'Sudah dibayar';
                                        }else if($row['transaksi_status'] == 'selesai'){
                                            $status = 'Selesai';
                                        }else{
                                            $status = 'Expired';
                                        }
                                        
                                        echo $status;
                                         ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Sub Total :</b></td>
                                        <td><div class="price-box"> <span class="price"><?= idr($row['transaksi_subtotal']) ?></span> </div></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <?php 
                            $pembayaran = $this->model_app->view_where('payment',array('pay_transaksi_id'=>$row['transaksi_id']));
                            if($row['transaksi_status'] == 'dibayar' AND $pembayaran->num_rows() > 0 ){
                                $pay = $pembayaran->row_array();
                        ?>
                         <div class="complete-order-detail commun-table gray-bg mb-30">
                            <div class="table-responsive">
                                <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td><b>Tanggal Bayar :</b></td>
                                        <td><?= tanggalwaktu($pay['pay_date']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Via :</b></td>
                                        <td><?= str_replace('_',' ',strtoupper($pay['pay_channel']))?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total  Bayar :</b></td>
                                        <td><?= idr($pay['pay_amount']) ?></td>
                                    </tr>
                                  
                                  
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                        <?php 
                            if($row['transaksi_status'] == 'waiting'){
                                echo '  <a class="btn full btn-color" href="'.$row['transaksi_url_payment'].'">Pembayaran</a>';
                            }else if($row['transaksi_status'] == 'dibayar'){
                                echo '  <a class="btn full btn-color" href="'.base_url('tracking/'.$row['transaksi_no']).'">Lacak Pesanan</a>';
                                echo '  <button type="button" class="btn full btn-color  mt-2" id="btnDone" data-id="'.encode($row['transaksi_id']).'">Pesanan Selesai</a>';

                            }else if($row['transaksi_status'] == 'selesai'){
                            

                            }
                        ?>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Checkout end -->
