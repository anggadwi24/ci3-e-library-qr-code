<div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title"><?= $page ?></h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="<?= base_url('') ?>">Beranda</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active"><?= $page ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="wn_contact_area bg--white pt--80 mb--40">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-8 col-12">
        				<div class="contact-form-wrap">
        					<h2 class="contact__title">Profil</h2>
        				
                            <form  action="<?= base_url('site/profile/update') ?>" method="post">
                                <div class="single-contact-form space-between">
                                    <input type="text" name="nama" placeholder="Nama Lengkap*" value="<?= $row['siswa_nama_lengkap'] ?>">
                                  
                                </div>
                                <div class="single-contact-form space-between">
                                    <input type="text" name="no_telp" placeholder="Nomor Telepon*" value="<?= $row['siswa_no_telp'] ?>">
                                  
                                </div>
                                <div class="single-contact-form space-between">
                                    <input type="text" name="pob" placeholder="Tempat Lahir*" value="<?= $row['siswa_pob'] ?>">
                                    <input type="date" name="dob" placeholder="Tanggal Lahir*" value="<?= $row['siswa_dob'] ?>">
                                </div>
                                <div class="single-contact-form message">
                                    <textarea name="alamat" placeholder="Alamat"><?= $row['siswa_alamat']?></textarea>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit">Simpan</button>
                                </div>
                            </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege">
                        </div>
        			</div>
        			<div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
        				<div class="contact-form-wrap">
        					<h2 class="contact__title">Login</h2>
        				
                            <form  action="<?= base_url('site/profile/change') ?>" method="post">
                              
                                <div class="single-contact-form space-between">
                                    <input type="email" name="email" placeholder="Email*" value="<?= $row['siswa_email'] ?>">
                                
                                </div>
                              
                                <div class="single-contact-form message">
                                  <input type="password" name="password" placeholder="Password ">
                                  <small>Isi jika ingin mengganti</small>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit">Simpan</button>
                                </div>
                            </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege">
                        </div>
        			</div>
        			</div>
        		</div>
        	</div>
        
        </section>