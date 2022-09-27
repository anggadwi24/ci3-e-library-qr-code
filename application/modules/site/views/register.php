<div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Daftar</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="<?= base_url('') ?>">Beranda</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Daftar</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- Start My Account Area -->
		<section class="my_account_area pt--80 pb--55 bg--white">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Daftar</h3>
							<form id="formAct">
								<div class="account__form">
									<div class="row">
										<div class="input__box col-12 form-group">
											<label>NISN <span>*</span></label>
											<input type="number" placeholder="Masukan NISN" name="nisn">
										</div>
										<div class="input__box col-12 form-group">
											<label>Nama Lengkap <span>*</span></label>
											<input type="text" placeholder="Masukan Nama Lengkap" name="nama">
										</div>
										<div class="input__box col-12 form-group">
											<label>Kelas <span>*</span></label>
											<select name="kelas" class="form-control" >
												<option selected disabled>Pilih Kelas</option>
												<?php 
													if($kelas->num_rows() > 0){
														foreach($kelas->result_array() as $kel)
														{
															echo "<option value='".$kel['kelas_id']."'>".$kel['kelas_nama']."</option>";
														}
													}
												?>
											</select>
										</div>
										<div class="inbux__box col-12 form-group">
											<label for="">Jenis Kelamin</label>
											<select name="jk" class="form-control">
												<option selected disabled>Plih jenis kelamin</option>
												<option value="male">Laki-laki</option>
												<option value="female">Perempuan</option>

												
											</select>
										</div>
										<div class="input__box col-6 form-group">
											<label>Tempat Lahir <span>*</span></label>
											<input type="text" placeholder="Masukan tempat lahir" name="pob">
										</div>
										<div class="input__box col-6 form-group">
											<label>Tanggal Lahir<span>*</span></label>
											<input type="date" name="dob" placeholder="Masukan tanggal lahir">
										</div>
										<div class="input__box col-12 form-group">
											<label>No. Hp <span>*</span></label>
											<input type="number" placeholder="Masukan No.HP" name="phone">
										</div>
										<div class="input__box col-12 form-group">
											<label for="">Alamat</label>
											<textarea name="alamat" id="" cols="30" rows="3" class="form-control" placeholder="Masukan alamat"></textarea>
										</div>
										<div class="input__box col-12 form-group">
											<label>Email <span>*</span></label>
											<input type="email" placeholder="Masukan email" name="email">
										</div>
										<div class="input__box col-12 form-group">
											<label>Password<span>*</span></label>
											<input type="password" name="password" placeholder="Masukan Password">
										</div>
										<div class="form__btn col-12 form-group text-right">
											<button>Daftar</button>
											
										</div>
									</div>
									
									
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</section>