
<?php 

if($row['transaksi_status'] == 'waiting'){
    $con = 'Belum dibayar';
}else if($row['transaksi_status'] == 'dibayar'){
    $con = 'Lunas';
}else if($row['transaksi_status'] == 'selesai'){
    $con = 'Selesai';
}else{
    $con = 'Expired';
}
?>
<div class="row">
    
    <div class="col-md-7">
        
        <div class="card mb-1">
            <div class="card-header">
                <h4>Detail Transaksi</h4>
            </div>
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row" width="40%">Nomor Transaksi</th>
                            <td><?= $row['transaksi_no'] ?></td>
                        </tr>
                         <tr>
                            <th scope="row" width="40%">Tanggal Pemesanan</th>
                            <td><?= tanggalwaktu($row['transaksi_created_on']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">Nama</th>
                            <td><?= $row['transaksi_member_nama'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">Email</th>
                            <td><?= $row['transaksi_member_email'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">No Telp</th>
                            <td><?= $row['transaksi_member_no_telp']?></td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">Alamat</th>
                            <td><?= $row['transaksi_member_alamat'] ?>, <?= $asal['kota_nama']?>, <?= $asal['provinsi_nama'] ?>, (<?= $row['transaksi_member_kode_pos'] ?>) </td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">Pengiriman</th>
                            <td><?= strtoupper($row['transaksi_ekspedisi']) ?> - <?= strtoupper($row['transaksi_service']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row" width="40%">Status Pembayaran</th>
                            <td><?= $con ?></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td><?= $row['transaksi_catatan']?></td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
        <?php 
            if($row['transaksi_status'] == 'dibayar'){
        ?>
        <div class="card mb-1">
            <div class="card-header">
                <h5>No. Resi</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('internal/transaksi/updateResi') ?>" method="POST">
                    <div class="row">
                        <div class="col-8 form-group">
                            <input type="hidden" name="id" id="id" value="<?= encode($row['transaksi_id']) ?>">
                            <input type="text" name="resi" required class="form-control" placeholder="No. Resi" value="<?= $row['transaksi_no_resi'] ?>">
                        </div>
                        <div class="col-4 form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <?php }?>

        <?php 
            if($row['transaksi_no_resi'] != NULL){
        ?>
         <div class="card">
            <div class="card-header">
                <h5>Tracking Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-12">
                        <div class="order-track"  id="data">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <div class="col-md-5">
        
        <div class="card mb-1">
            <div class="card-header">
                <h4>Detail Produk</h4>
            </div>
            <div class="card-body">
                
                <div class="card p-4">
                    <?php 
                        if($produk->num_rows() > 0){
                            foreach($produk->result_array() as $pro){
                                if(file_exists('upload/produk/'.$pro['produk_image'])){
                                    $image = base_url('upload/produk/'.$pro['produk_image']);
                                }else{
                                    $image = base_url('upload/produk/404.jpg');
                                }
                    ?>
                    <div class="row mb-2">
                        <div class="col-md-3 text-right">
                            <img class="img-fluid " src="<?= $image ?>" alt="">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body pt-0 pl-1">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        <div class="">
                                            <h4 class="card-title mb-0"><?= $pro['produk_nama']?> (<?= $pro['pb_batch'] ?>) x<?= $pro['td_qty'] ?> item</h4>
                                            <h5 class="card-title mb-1"><?= idr($pro['produk_harga_jual'])?></h5>
                                            <p><?= $pro['produk_mini_deskripsi'] ?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    }?>
                </div>


            </div>

        </div>
        <div class="card mb-1">
            <div class="card-header">
                <h4>Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Total</td>
                            <td class="text-right"><?= idr($row['transaksi_total']) ?></td>
                        </tr>
                        <tr>
                            <td>Ongkos Kirim</td>
                            <td class="text-right"><?= idr($row['transaksi_ongkir']) ?></td>
                        </tr>
                        <tr>
                            <th>Sub Total</th>
                            <td class="text-right"><b><?= idr($row['transaksi_subtotal']) ?></b></td>
                        </tr>
                        <?php 
                            $pembayaran = $this->model_app->view_where('payment',array('pay_transaksi_id'=>$row['transaksi_id']));
                            if($pembayaran->num_rows() > 0){
                                $pay = $pembayaran->row_array();
                                echo '<tr><td colspan="2"></td></tr>';
                                echo "<tr><td>Via</td><td class='text-right'>".str_replace('_',' ',strtoupper($pay['pay_channel']))."</td></tr>";
                                echo "<tr><td>Tgl Dibayar</td><td class='text-right'>".tanggalwaktu($pay['pay_date'])."</td></tr>";
                                echo "<tr><td>Jumlah Dibayar</td><td class='text-right'>".idr($pay['pay_amount'])."</td></tr>";

                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
