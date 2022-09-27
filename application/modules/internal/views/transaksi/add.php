

<style>
   .ck-editor__editable {
    min-height: 200px;
}
</style>
    <div class="col-md-12">
        <form class="m-t-15" id="formAct" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
            
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <h5><?= $subtitle ?></h5>
                                        <hr>    
                                    
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Siswa</label>
                                                        <select name="siswa" id="siswa" class="form-control">
                                                            <option disabled selected>Pilih Siswa</option>
                                                            <?php 
                                                                if($kelas->num_rows() > 0){
                                                                    foreach($kelas->result_array() as $kel){
                                                                        echo "<optgroup label='".$kel['kelas_nama']."'>";
                                                                        $siswa = $this->model_app->view_where_ordering('siswa',array('siswa_kelas'=>$kel['kelas_id']),'siswa_nama_lengkap','ASC');
                                                                        if($siswa->num_rows() > 0){
                                                                            foreach($siswa->result_array() as $sis){
                                                                                echo "<option value='".$sis['siswa_id']."'>".$sis['siswa_nama_lengkap']."</option>";
                                                                            }   
                                                                        }
                                                                        echo "</optroup>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Tanggal Pinjam</label>
                                                    <input type="text" readonly class="form-control" value="<?= date('d/m/Y H:i') ?>">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Tanggal Kembali</label>
                                                    <input type="text" readonly class="form-control" value="<?= date('d/m/Y H:i',strtotime('+7 Day')) ?>">
                                                </div>
                                                
                                            </div>
                                            
                                        
                                        
                                           
                                           
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <h5>FORM BUKU</h5>
                                        <hr>    
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-qr-tab" data-toggle="tab" href="#nav-qr" role="tab" aria-controls="nav-qr" aria-selected="true">QR Code</a>
                                                    <a class="nav-item nav-link" id="nav-manual-tab" data-toggle="tab" href="#nav-manual" role="tab" aria-controls="nav-manual" aria-selected="false">Manual</a>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-qr" role="tabpanel" aria-labelledby="nav-qr-tab">
                                                            <div class="row">
                                                                <div class="col-12 form-group">
                                                                    <div id="reader" style="width:1000px"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-manual" role="tabpanel" aria-labelledby="nav-manual-tab">
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <label for="">Buku</label>
                                                                    <select  id="buku" class="form-control">
                                                                        <option disabled selected>Pilih buku</option>
                                                                    
                                                                    </select>
                                                                </div>
                                                            
                                                                <div class="col-md-12 form-group">
                                                                    <button class="btn btn-primary float-right" type="button" id="btnAdd"><i class="icofont icofont-plus"></i>Tambah</button>
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
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <h5>DATA BUKU</h5>
                                        <hr>    
                                        <div class="row justify-content-center" id="dataBuku">
                                            <div class="col-12"><h6><i>Belum ada buku yang dipilih</i></h6></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                       
                </div>


            </div>
        </form>
    </div>
    
