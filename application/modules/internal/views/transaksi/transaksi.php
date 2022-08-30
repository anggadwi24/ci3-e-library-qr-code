
<div  class="col-sm-12">
    <div class="collapse" id="collapseExample">
   
        <div class="card card-body">

                <form id="formAct" >
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="start" id="start" class="form-control" value="<?= date('Y-m-01')  ?>">
                        </div>
                        <div class="col-6 form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="end" id="end" class="form-control" value="<?= date('Y-m-d',strtotime('last day of  this month'))?>">
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Siswa</label>
                            <select name="siswa" id="siswa" class="form-control">
                                <option value="all">Semua</option>
                                <?php 
                                    
                                    if($siswa->num_rows() > 0){
                                        foreach($siswa->result_array() as $sis){
                                            echo "<option value='".$sis['siswa_id']."'>".$sis['siswa_nama_lengkap']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Buku</label>
                            <select name="buku" id="buku" class="form-control">
                                <option value="all">Semua</option>
                                <?php 
                                    
                                    if($buku->num_rows() > 0){
                                        foreach($buku->result_array() as $buk){
                                            echo "<option value='".$buk['buku_id']."'>".$buk['buku_judul']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="all">Semua</option>
                                <option value="pinjam">Dipinjam</option>
                                <option value="selesai">Selesai</option>
                               



                            </select>
                        </div>
                        
                        <div class="col-12 form-group text-right">
                            <button class="btn btn-info kanan">CARI</button>
                        </div>
                    </div>
                </form>

        </div>
  </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex">
                <a href="<?= base_url('internal/transaksi/add') ?>" class="btn btn-primary mr-1"><i class="icofont icofont-plus" ></i> PEMINJAMAN</a>
                <a href="<?= base_url('internal/transaksi/perpanjang') ?>" class="btn btn-warning mr-1"><i class="icofont icofont-ui-calendar" ></i> PERPANJANG</a>
                <a href="<?= base_url('internal/transaksi/pengembalian') ?>" class="btn btn-danger"><i class="icofont icofont-refresh" ></i> PENGEMBALIAN</a>
       
            </div>
            
        </div>
        
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <h5><?= $subtitle ?></h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh" id="refresh"></i>
                        <i class="ti-filter" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-info kanan"> </i>
                      
                    </div>
                </div>
                <div class="card-block">    
                    <div class="dt-responsive table-responsive justify-content-center" id="data"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
   
     
</div>