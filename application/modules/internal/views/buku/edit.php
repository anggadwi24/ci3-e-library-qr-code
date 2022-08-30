

<style>
   .ck-editor__editable {
    min-height: 200px;
}
</style>
    <div class="col-md-12">
        <form class="m-t-15" id="formAct" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
            
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <h5><?= $subtitle ?></h5>
                                        <hr>    
                                    
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class="control-label">Judul Buku</label>
                                                        <input type="text" class="form-control" name="judul" placeholder="Masukan Judul Buku" value="<?= $row['buku_judul'] ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Kode Buku</label>
                                                        <input type="text" class="form-control" name="kode"  placeholder="Masukan Kode Buku" value="<?= $row['buku_kode'] ?>">
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Sinopsis Buku</label>
                                                        <textarea id="editor1" name="sinopsis"><?= $row['buku_sinopsis'] ?></textarea>
                                                    </div>
                                                </div>
                                                
                                            
                                            </div>
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Kategori</label>
                                                        <select name="kategori" class="form-control">
                                                            <option disabled selected>Pilih Kategori</option>
                                                            <?php if($kategori->num_rows() > 0){ 
                                                                foreach($kategori->result_array() as $cat){
                                                                    if($cat['kategori_id'] == $row['kategori_id']){
                                                                        echo '<option value="'.$cat['kategori_id'].'" selected>'.$cat['kategori_nama'].'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$cat['kategori_id'].'">'.$cat['kategori_nama'].'</option>';
                                                                    }
                                                                    
                                                                }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Pengarang</label>
                                                        <input type="text" class="form-control" name="pengarang" placeholder="Masukan Pengarang" value="<?= $row['buku_pengarang'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Penerbit</label>
                                                        <input type="text" class="form-control" name="penerbit" placeholder="Masukan Penerbit" value="<?= $row['buku_penerbit'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tahun Terbit</label>
                                                        <input type="number" class="form-control" name="tahun_terbit" placeholder="Masukan Tahun Terbit" value="<?= $row['buku_tahun_terbit'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Jumlah Halaman</label>
                                                        <input type="number" class="form-control" name="halaman" placeholder="Masukan Jumlah Halaman" value="<?= $row['buku_halaman'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Rak</label>
                                                        <input type="text" class="form-control" name="rak" placeholder="Masukan Rak" value="<?= $row['buku_rak'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Cover Buku</label>
                                                        <input type="file" class="form-control" name="file" accept="image/*">
                                                        <small class="text-danger">* Isi jika ingin mengganti</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Jumlah Buku</label>
                                                        <input type="number" class="form-control" name="jumlah" min="1" value="1" placeholder="Masukan Jumlah Buku" value="<?= $row['buku_qty'] ?>">
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
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <h5>DENDA BUKU</h5>
                                        <hr>    
                                        <div class="form-group">
                                            <label class="control-label">Denda Buku Hilang</label>
                                            <input type="number" class="form-control" name="denda_hilang" placeholder="Masukan Denda Buku Hilang" value="<?= $row['buku_denda_hilang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Denda Buku Rusak</label>
                                            <input type="number" class="form-control" name="denda_rusak" placeholder="Masukan Denda Buku Rusak" value="<?= $row['buku_denda_rusak'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="text-sm-right">
                                                <button class="btn btn-default" type="reset">Reset</button>

                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
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
    
