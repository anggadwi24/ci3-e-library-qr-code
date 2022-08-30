<div class="col-md-12">
    <div class="row">
        
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-h-10">
                                <h5><?= $subtitle ?></h5>
                                <hr> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php 
                                            if(file_exists('upload/buku/'.$row['buku_cover'])){
                                                $cover = base_url('upload/buku/'.$row['buku_cover']);
                                            }else{
                                                $cover = base_url('upload/buku/404.jpg');
                                            }
                                        ?>
                                        <img src="<?= $cover ?>" alt="<?= $row['buku_slug'] ?>" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title"><?= $row['buku_judul'] ?></h5>
                                        <p><?= $row['buku_kode'] ?></p>
                                        <?= $row['buku_sinopsis'] ?>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Penerbit</label>
                                                    <h6><?= ucwords($row['buku_penerbit']) ?> - <?= $row['buku_tahun_terbit'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Penerbit</label>
                                                    <h6><?= ucwords($row['buku_penerbit']) ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah Tersedia</label>
                                                    <h6><?= $row['buku_qty'] ?> pcs</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Kode Rak</label>
                                                    <h6><?= $row['buku_rak'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Halaman</label>
                                                    <h6><?= $row['buku_halaman'] ?> halaman</h6>
                                                </div>
                                            </div>
                                          
                                        </div>
                                     
                                    </div>
                                   
                                </div>

                                    
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="p-h-10 ">
                                <h5>Denda</h5>
                                <hr> 
                                 
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Denda Buku Hilang</label>
                                        <h6><?= rp($row['buku_denda_hilang'])?></h6>
                                    </div>
                                    <div class="col-12">
                                        <label for="">Denda Buku Rusak</label>
                                        <h6><?= rp($row['buku_denda_rusak'])?></h6>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-h-10">
                                <h5>Peminjam</h5>
                                <hr>   
                                <div class="row" id="data"> 
                                
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>