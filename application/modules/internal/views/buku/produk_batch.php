

<div class="card">
    <div class="card-body">
        <div class="table-overflow">
            <table id="dt-opt" class="table table-hover table-xl">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Batch</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Pembeli</th>
                        <th>Status</th>
                     
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($record->num_rows() > 0){
                           
                            foreach($record->result_array() as $rows){
                                if($rows['pb_status'] == 'open'){
                                    $status = 'Open Order';
                                }else{
                                    $status = 'Close Order';
                                }
                                $buyer = $this->db->query("SELECT coalesce(COUNT(td_qty),0) as total FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE td_produk_id = ".$row['produk_id']."  AND td_pb_id = ".$rows['pb_id']." AND (transaksi_status = 'dibayar' OR transaksi_status ='selesai' )")->row_array();
                                echo '<tr>
                                <td>
                                    <div class="list-media">
                                        <div class="list-item">
                                            <div class="media-img">
                                                <img class="rounded" src="'.base_url('upload/produk/'.$row['produk_image']) .'" alt="">
                                            </div>
                                            <div class="info">
                                            <span class="title">'.$row['produk_nama'] .'</span>
                                            <span class="sub-title">'. $row['produk_mini_deskripsi'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>'.$rows['pb_batch'].'</td>
                                <td>'.tanggalwaktu($rows['pb_tanggal_mulai']).'</td>
                                <td>'.tanggalwaktu($rows['pb_tanggal_selesai']).'</td>
                                <td>'.$buyer['total'].'</td>
                                <td>'.$status.'</td>
                           
                                <td class="font-size-18 text-center">
                                    
                                    <a href="'.base_url('internal/produk/detailBatch?id='.$rows['pb_id']).'" class="text-primary m-r-15"><i class="ti-eye"></i></a>
                                    <a href="#"  class="text-info m-r-15 edit" data-id="'.encode($rows['pb_id']).'"><i class="ti-pencil"></i></a>
                                    '; 
                                    $belanja = $this->db->query("SELECT coalesce(SUM(td_qty),0) as total FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE td_produk_id = ".$row['produk_id']."  AND td_pb_id = ".$rows['pb_id']." ")->row_array();
                                    if($belanja['total'] == 0){
                                        echo '   <a href="'.base_url('internal/produk/deleteBatch?id='.encode($rows['pb_id'])).'" class="text-danger m-r-15"><i class="ti-trash"></i></a>';
                                    }
                                    echo'
                                    

                                </td>
                            </tr>';
                              
                            }

                        }
                    ?>
                            
                </tbody>
            </table>
        </div> 
    </div>       
</div>   

<div class="modal fade" id="modaltambahbatch">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Tambah Batch Produk</h4>
                </div>
                <div class="modal-body">
                <form class="m-t-15" action="<?= base_url('internal/produk/storeBatch') ?>" method="post" enctype="multipart/form-data">
                    
                <div class="row" id="place">
                    <div class="col-12 my-1 formBatch parent" >
                        <div class="form-row  mt-3">
                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Batch</label>
                                    <input type="text" class="form-control" name="batch" placeholder="Masukan Batch" required>
                                </div>
                            </div>
                            
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Target Mulai</label>
                                    <input type="text"   class="form-control dateTime" name="start" autocomplete="off" placeholder="Masukan Tanggal Mulai Batch" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Target Mulai</label>
                                    <input type="text "  class="form-control dateTime" name="end" autocomplete="off" placeholder="Masukan Tanggal Selesai Batch" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= encode($row['produk_id'])?>" >
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Ubah Batch Produk</h4>
                </div>
                <div class="modal-body">
                <form class="m-t-15" action="<?= base_url('internal/produk/updateBatch') ?>" method="post" enctype="multipart/form-data">
                    
                <div class="row" id="place">
                    <div class="col-12 my-1 formBatch parent" >
                        <div class="form-row  mt-3">
                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Batch</label>
                                    <input type="text" class="form-control" name="batch" id="batch" placeholder="Masukan Batch" required>
                                </div>
                            </div>
                          
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Target Mulai</label>
                                    <input type="text"   class="form-control dateTime" name="start" id="start" autocomplete="off" placeholder="Masukan Tanggal Mulai Batch" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Target Mulai</label>
                                    <input type="text "  class="form-control dateTime" name="end" id="end" autocomplete="off" placeholder="Masukan Tanggal Selesai Batch" required>
                                </div>
                            </div>
                            <input type="hidden" id="idb" name="id" value="<?= encode($row['produk_id'])?>" >
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

