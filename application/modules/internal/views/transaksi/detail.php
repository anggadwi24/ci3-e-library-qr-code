<?php 
    $kelas = $this->model_app->view_where('kelas',array('kelas_id'=>$siswa['siswa_kelas']))->row_array();
?>
<div class="col-md-12"> 
    <div class="card">
        <div class="row invoice-contact">
          
            <div class="col-md-2 offset-md-10">
                <div class="row text-center">
                    <div class="col-sm-12 invoice-btn-group">
                        <a href="<?= base_url('internal/transaksi/download?no='.$row['transaksi_no']) ?>" class="btn btn-primary btn-print-invoice waves-effect waves-light m-r-20 m-b-10">Print Transaksi</a>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>SISWA :</h6>
                    <h6 class="m-0"><?= $siswa['siswa_nama_lengkap'] ?></h6>
                    <p class="m-0 m-t-10"><?= $siswa['siswa_nisn'] ?> - <?= $kelas['kelas_nama']?></p>
                    <p class="m-0"><?= $siswa['siswa_no_telp'] ?></p>
                    <p><?= $siswa['siswa_email'] ?></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>DETAIl TRANSAKSI :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Tanggal :</th>
                                <td><?= fullDate($row['transaksi_tanggal']) ?></td>
                            </tr>
                            <tr>
                                <th>Tgl Pinjam : </th>
                                <td>&nbsp;<?= tanggalwaktu($row['transaksi_tanggal_pinjam']) ?> </td>
                            </tr>
                            <tr>
                                <th>Batas Pinjam : </th>
                                <td>&nbsp;<?= tanggalwaktu($row['transaksi_tanggal_kembali']) ?> </td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td>
                                    <?php if($row['transaksi_status'] == 'pinjam'){?>
                                        <span class="label label-warning">Belum Selesai</span>
                                    <?php }else{?>
                                        <span class="label label-success">Selesai</span>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php if($row['transaksi_status'] == 'selesai'){?>
                                <th>Tanggal Kembali : </th>
                                <td>&nbsp;<?= tanggalwaktu($row['transaksi_tanggal_selesai']) ?></td>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">No. Transaksi   <span> #<?= $row['transaksi_no']?></span></h6>
                    <h6 class="text-uppercase text-primary">Total Denda :
                <span><?= rp($row['transaksi_total_denda']+$row['transaksi_denda_telat'])?></span>
            </h6>
                </div>
            </div>
            <?php 
                $perpanjang = $this->model_app->view_where('transaksi_perpanjang',array('tp_transaksi_id'=>$row['transaksi_id']));
                if($perpanjang->num_rows() > 0){
            ?>
             <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Tanggal Kembali Sebelum Perpanjang</th>
                                    <th>Tanggal Kembali Sesudah Perpanjang</th>
                                  
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($perpanjang->num_rows() > 0){
                                    foreach($perpanjang->result_array() as $per){
                                        echo "<tr>
                                                <td>".tanggalwaktu($per['tp_tanggal_sebelum'])."</td>
                                                <td>".tanggalwaktu($per['tp_tanggal_sesudah'])."</td>
                                             
                                           




                                              </tr>";
                                    }
                                }?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Judul Buku</th>
                                    <th>Qty</th>
                                    <th>Kondisi</th>
                                    <th>Denda</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($record->num_rows() > 0){
                                    foreach($record->result_array() as $rows){
                                        echo "<tr>
                                                <td>".$rows['buku_judul']."</td>
                                                <td>".$rows['td_qty']."</td>
                                                <td>".ucfirst($rows['td_kondisi'])."</td>
                                                <td>".rp($rows['td_denda'])."</td>
                                           




                                              </tr>";
                                    }
                                }?>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Total Denda :</th>
                                <td><?= rp($row['transaksi_total_denda']) ?></td>
                            </tr>
                            <tr>
                                <th>Total Denda Telat :</th>
                                <td><?=  rp($row['transaksi_denda_telat'])?></td>
                            </tr>
                           
                            <tr class="text-info">
                                <td>
                                    <hr/>
                                    <h5 class="text-primary">Total  :</h5>
                                </td>
                                <td>
                                    <hr/>
                                    <h5 class="text-primary"><?= rp($row['transaksi_total_denda'] + $row['transaksi_denda_telat'])?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                </div>
            </div>
        </div>
    </div>
</div>

