<div class="col-sm-12">
    <form class="m-t-15" id="formAct" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $subtitle ?></h5>
                        
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                          
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-h-10">
                                  
                                
                                
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">NISN</label>
                                                    <input type="text" class="form-control" name="nisn" placeholder="Masukan NISN">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Lengkap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Kelas</label>
                                                    <select name="kelas" class="form-control" >
                                                        <option disabled selected>Pilih kelas</option>
                                                        <?php 
                                                            if($kelas->num_rows() > 0){
                                                                foreach($kelas->result_array() as $kel){
                                                                    echo '<option value="'.$kel['kelas_id'].'">'.$kel['kelas_nama'].'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Kelamin</label>
                                                    <select name="gender" id="" class="form-control">
                                                        <option disabled selected>Pilih jenis kelamin</option>
                                                        <option value="male">Laki-laki</option>
                                                        <option value="female">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" name="pob" placeholder="Masukan Tempat Lahir">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control date" name="dob" placeholder="Masukan Tanggal Lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">No. Telp</label>
                                            <input type="text" class="form-control" name="telp" placeholder="Masukan No. Telp">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" placeholder="Masukan Alamat"></textarea>
                                        </div>
                                    
                                        
                                       
                                          
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>FORM LOGIN SISWA</h5>
                        
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                          
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>                                       
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-h-10">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukan Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukan Password">
                                    </div>
                                    <div class="form-group">
                                            <div class="text-sm-right">
                                                <button class="btn btn-default" type="reset">Reset</button>
                                                <button class="btn btn-success" type="submit">Simpan</button>
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
