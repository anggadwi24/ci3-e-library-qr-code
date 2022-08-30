<div class="col-sm-12">
   
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
                        <form class="m-t-15" id="formAct" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">NISN</label>
                                                        <input type="text" class="form-control" name="nisn" placeholder="Masukan NISN" value="<?= $row['siswa_nisn'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Lengkap" value="<?= $row['siswa_nama_lengkap'] ?>">
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
                                                                        if($row['siswa_kelas'] == $kel['kelas_id']){
                                                                            echo '<option value="'.$kel['kelas_id'].'" selected>'.$kel['kelas_nama'].'</option>';

                                                                        }else{
                                                                            echo '<option value="'.$kel['kelas_id'].'">'.$kel['kelas_nama'].'</option>';

                                                                        }
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
                                                            <option disabled >Pilih jenis kelamin</option>
                                                            <option value="male" <?php if($row['siswa_jenis_kelamin'] == 'male'){ echo "selected";}?>>Laki-laki</option>
                                                            <option value="female" <?php if($row['siswa_jenis_kelamin'] == 'female'){ echo "selected";}?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="pob" placeholder="Masukan Tempat Lahir" value="<?= $row['siswa_pob'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tanggal Lahir</label>
                                                        <input type="text" class="form-control " name="dob" id="dob" placeholder="Masukan Tanggal Lahir" value="<?= $row['siswa_dob']?>" data-default="<?= $row['siswa_dob']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">No. Telp</label>
                                                <input type="text" class="form-control" name="telp" placeholder="Masukan No. Telp" value="<?= $row['siswa_no_telp'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Alamat</label>
                                                <textarea class="form-control" name="alamat" placeholder="Masukan Alamat"><?= $row['siswa_alamat'] ?></textarea>
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
                        </form>
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
                        <form id="formLogin">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-h-10">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="<?=  $row['siswa_email']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Masukan Password">
                                            <small>* Isi jika ingin mengganti</small>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
</div>
