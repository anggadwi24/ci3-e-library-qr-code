


    <div class="col-md-4">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-h-10">
                            <h5>Foto Profil</h5>
                            <hr>    
                            <form class="m-t-15" action="<?= base_url('internal/profile/image') ?>" method="post" enctype="multipart/form-data">
                            <img class="img-fluid d-block text-center mx-auto" id="image" srcset="" src="<?= base_url('upload/user/').$row['users_foto']?>">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" accept="image/*" >
                                </div>
                                <div class="form-group">
                                    <div class="text-sm-right">
                                        <button class="btn btn-gradient-success" type="submit">Simpan</button>
                                    </div>
                                </div>     
                            </form>
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
                            <h5>Form Profil</h5>
                            <hr>    
                            <form class="m-t-15" action="<?= base_url('internal/profile/do') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">NIP</label>
                                            <input type="text" class="form-control" name="nip" value="<?= $row['users_nip']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $row['users_nama']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">No. Telp</label>
                                            <input type="text" class="form-control" name="no_telp" value="<?= $row['users_no_telp']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?= $row['users_email']?>">
                                        </div>
                                    </div>
                                </div>
                               <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= $row['users_username']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" name="password">
                                            <small>*Isi jika ingin mengganti password</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Alamat</label>
                                    <textarea name="address" class="form-control" cols="30" rows="10"><?= $row['users_alamat'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="text-sm-right">
                                        <button class="btn btn-gradient-success" type="submit">Simpan</button>
                                    </div>
                                </div>     
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


