<div class="col-md-6 col-xl-3">
    <div class="card social-widget-card">
        <div class="card-block-big bg-success">
            <h3><?= $summary->num_rows() ?></h3>
            <span class="m-t-10">Transaksi Hari Ini</span>
            <i class="ti-receipt"></i>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-3">
    <div class="card social-widget-card">
        <div class="card-block-big bg-twitter">
            <h3><?= $siswa->num_rows() ?></h3>
            <span class="m-t-10">Siswa</span>
            <i class="ti-id-badge"></i>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-3">
    <div class="card social-widget-card">
        <div class="card-block-big bg-linkein">
            <h3><?= $buku->num_rows()?></h3>
            <span class="m-t-10">Buku</span>
            <i class="ti-book"></i>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-3">
    <div class="card social-widget-card">
        <div class="card-block-big bg-google-plus">
            <h3><?= $admin->num_rows()?></h3>
            <span class="m-t-10">Admin</span>
            <i class="ti-user"></i>
        </div>
    </div>
</div>
<div class="col-xl-7 col-md-12 ">
    <div class="card">
        <div class="card-header">
            <h5>Pengunjung Perminggu</h5>
          
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
                <i class="icofont icofont-refresh"></i>
                <i class="icofont icofont-close-circled"></i>
            </div>
        </div>
        <div class="card-block">
             <canvas id="barChart" class="chart" style="height: 170px;"></canvas>
        </div>
    </div>
</div>
<div class="col-xl-5 col-md-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="card table-1-card">
                <div class="card-header">
                    <h5>Data Pengunjung</h5>
                
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                     
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>Nama </th>
                                    <th>Tanggal</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                               <?php  if($visitor->num_rows() > 0){
                                    foreach($visitor->result_array() as $vit){
                                        echo "<tr>
                                                <td>".$vit['siswa_nama_lengkap']."</td>
                                                <td>".fullDate($vit['sp_date'])."</td>
                                            </tr>";
                                    }
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($tenggang->num_rows() > 0){ ?>
<div class="col-xl-4 col-md-12">

    <div class="row">
        <?php
            foreach($tenggang->result_array() as $te){
                echo ' <div class="col-lg-12">
                <div class="card card-border-primary">
                    <div class="card-header">
                        <h5>'.$te['siswa_nama_lengkap'].' </h5>
                        <span class="label label-danger f-right">Belum Selesai</span> 
                      
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-8">
                                <ul class="list list-unstyled">
                                    <li>No. #: &nbsp;'.$te['transaksi_no'].'</li>
                                    <li>Batas Pengembalian: <span class="text-semibold">'.tanggalwaktu($te['transaksi_tanggal_kembali']).'</span></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list list-unstyled text-right">
                                    <li>Denda</li>
                                    <li><span class="text-semibold">'.idr($te['transaksi_denda_telat']).'</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                     
                        <div class="task-board m-0">
                            <a href="'.base_url('internal/transaksi/detail?no='.$te['transaksi_no']).'" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                          
                        </div>
                        <!-- end of pull-right class -->
                    </div>
                    <!-- end of card-footer -->
                </div>
            </div>';
            }
        ?>
       
    </div>
</div>
<?php } ?>
<?php if($tenggang->num_rows() > 0){ 
    echo "<div class='col-xl-8 col-md-12'>";
}else{
    echo "<div class='col-12'></div>";
}?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card table-1-card">
                <div class="card-header">
                    <h5>Transaksi Terbaru</h5>
                
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                      
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                               <?php  if($transaksi->num_rows() > 0){
                                    foreach($transaksi->result_array() as $rows){
                                        if($rows['transaksi_status'] == 'pinjam'){
                                            $status = 'Belum Selesai';
                                        }else{
                                            $status = 'Selesai';
                                        }
                                        echo "<tr>
                                                <td><a href='".base_url('internal/transaksi/detail?no='.$rows['transaksi_no'])."'>".$rows['transaksi_no']."</a></td>
                                                <td>".$rows['siswa_nama_lengkap']."</td>
                                                <td>".fullDate($rows['transaksi_tanggal'])."</td>
                                                <td>".$status."</td>
                                                <td>".rp($rows['transaksi_total_denda']+$rows['transaksi_denda_telat'])."</td>
                                            </tr>";
                                    }
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
