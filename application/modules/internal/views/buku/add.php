

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
                                                        <input type="text" class="form-control" name="judul" placeholder="Masukan Judul Buku" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Kode Buku</label>
                                                        <input type="text" class="form-control" name="kode"  placeholder="Masukan Kode Buku">
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Sinopsis Buku</label>
                                                        <textarea id="editor1" name="sinopsis"></textarea>
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
                                                                    ?>
                                                                    <option value="<?= $cat['kategori_id']?>"><?= $cat['kategori_nama']?></option>
                                                                    <?php
                                                                }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Pengarang</label>
                                                        <input type="text" class="form-control" name="pengarang" placeholder="Masukan Pengarang">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Penerbit</label>
                                                        <input type="text" class="form-control" name="penerbit" placeholder="Masukan Penerbit">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tahun Terbit</label>
                                                        <input type="number" class="form-control" name="tahun_terbit" placeholder="Masukan Tahun Terbit">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Jumlah Halaman</label>
                                                        <input type="number" class="form-control" name="halaman" placeholder="Masukan Jumlah Halaman">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Rak</label>
                                                        <input type="text" class="form-control" name="rak" placeholder="Masukan Rak">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Cover Buku</label>
                                                        <input type="file" class="form-control" name="file" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Jumlah Buku</label>
                                                        <input type="number" class="form-control" name="jumlah" min="1" value="1" placeholder="Masukan Jumlah Buku">
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
                                            <input type="number" class="form-control" name="denda_hilang" placeholder="Masukan Denda Buku Hilang">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Denda Buku Rusak</label>
                                            <input type="number" class="form-control" name="denda_rusak" placeholder="Masukan Denda Buku Rusak">
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
    
