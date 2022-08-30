
    <div class="card">
        <div class="card-header">
            <h4>Detail Produk</h4>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-h-10">
                        <div class="row">
                            <div class="col-md-12">
                                <img class="img-fluid d-block mx-auto" id="image" src="<?=  base_url('upload/produk/').$row['produk_image']?>" width="50%">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="p-h-10">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title"><?= $row['produk_nama']?></h5>
                                <p><?= $row['produk_mini_deskripsi']?></p>
                                <p><?= $row['produk_deskripsi'] ?></p>
                            </div>
                            <div class="col-md-12">
                                <h5 class="card-title mb-0">Batch : <?= $row['pb_batch']?></h5>
                                <span ><?= tanggal($row['pb_tanggal_mulai'])?> - <?= tanggal($row['pb_tanggal_selesai']) ?></span>
                                
                            </div>
                            <div class="col-md-2 mt-2">
                            <?php 
                                    if($row['pb_status'] == 'open'){
                                        echo '<span class="badge badge-success d-block">Open Order</span>';
                                    }else{
                                        echo '<span class="badge badge-danger d-block">Close Order</span>';
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="card">
    <div class="card-header">
        <h4>Data Pemesan</h4>
    </div>
    <hr>
    <div class="card-body">
        <div class="table-overflow">
            <table id="dt-opt" class="table table-hover table-xl">
                <thead>
                    <tr>
                        <th>No. Transaksi</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Jumlah Pesan</th>
                        <th>Status</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $transaksi = $this->db->query("SELECT * FROM transaksi_detail a JOIN transaksi b  ON a.td_transaksi_id = b.transaksi_id WHERE td_produk_id = '".$row['produk_id']."' AND td_pb_id = '".$row['pb_id']."' AND (transaksi_status != 'expired' OR transaksi_status = 'cancel') ");
                        if($transaksi->num_rows() > 0){
                            foreach($transaksi->result_array() as $rows){
                                if($rows['transaksi_status'] == 'waiting'){
                                    $status = '<span class="badge badge-warning">Belum Bayar</span>';
                                }else if($rows['transaksi_status'] == 'dibayar'){
                                    $status = '<span class="badge badge-info">Lunas</span>';

                                }else if($rows['transaksi_status'] == 'selesai'){
                                    $status = '<span class="badge badge-success">Selesai</span>';
                                }
                                echo '<tr>
                                <td><a href="'.base_url('internal/transaksi/detail?no='.$rows['transaksi_no']).'">'.$rows['transaksi_no'].'</a></td>
                                <td>
                                    <span class="title">'.$rows['transaksi_member_nama'].'</span><br>
                                  
                                </td>
                                <td>'.$rows['transaksi_member_no_telp'].'</td>
                                <td>'.$rows['td_qty'].'</td>
                                <td>'.$status.'</td>
                               
                              
                            </tr>';
                            }
                        }
                    ?>
                  
                    
                </tbody>
            </table>
        </div> 
    </div>       
</div>   