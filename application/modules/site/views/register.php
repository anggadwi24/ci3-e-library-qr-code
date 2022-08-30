<!-- Register contant start -->
<div class="contant">
	<div id="banner-part" class="banner inner-banner">
		<div class="container">
			<div class="bread-crumb-main">
				<h1 class="banner-title">Daftar Akun</h1>
				<div class="breadcrumb">
                    <ul class="inline">
                        <li><a href="index.html">Home</a></li>
                        <li>Daftar Akun</li>
                    </ul>
                </div>
			</div>
		</div>
	</div>
	<div class="ptb-100">
		<div class="container">
			<div class="row justify-content-center">
	            <div class="col-12 ">
	              <form class="main-form full" id="formAct">
	                <div class="row">
	                  <div class="col-12 mb-20">
	                    <div class="heading-part align-center">
	                      <h2 class="heading">Daftar Akun</h2>
	                    </div>
	                  </div>
	                  <div class="col-12">
	                  	<div class="form-row">
		                    <div class="form-group col-md-6">
		                      <label for="f-name">Nama Lengkap</label>
		                      <input type="text" id="f-name" required="" name="nama">
		                    </div>
		                    <div class="form-group col-md-6">
		                      <label for="f-name">No telp</label>
		                      <input type="text" id="f-name" required="" name="no_telp">
		                    </div>
	                    </div>
	                  </div>
	                  <div class="col-12">
	                    <div class="form-group">
	                      <label for="l-name">Alamat</label>
	                      <textarea name="alamat"></textarea>
	                    </div>
	                  </div>
	                  <div class="col-md-4 col-12">
							<div class="form-group">
								<label for="zip">Provinsi</label>
	                        	<select name="provinsi" id="provinsi">
									<option selected disabled></option>
	                        		<?php
										if($provinsi->num_rows() > 0){
											foreach($provinsi->result_array() as $prv){
												echo "<option value='".$prv['provinsi_id']."'>".$prv['provinsi_nama']."</option>";
											}
										}
									?>
	                        	</select>
	                        </div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="city">Kabupaten</label>
	                        	<select id="kabupaten" name="kabupaten">
	                        		<option disabled selected></option>
	                        	</select>
	                        </div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="city">Kode Pos</label>
			                        <input type="text" name="kode_pos">

	                        </div>
						</div>
					  <div class="col-12">
	                    <div class="form-group">
	                      <label for="l-name">Foto Profil</label>
	                      <input type="file" id="l-name" required="" name="file">
	                    </div>
	                  </div>
	                  <div class="col-12">
	                    <div class="form-group">
	                      <label for="l-name">Email</label>
	                      <input type="text" id="l-name" required="" name="email">
	                    </div>
	                  </div>
	                  <div class="col-12">
	                  	<div class="form-row">
		                    <div class="form-group col-md-6">
		                      <label for="f-name">Password</label>
		                      <input type="password" id="f-name" required="" name="password">
		                    </div>
		                    <div class="form-group col-md-6">
		                      <label for="f-name">Re-Password</label>
		                      <input type="password" id="f-name" required="" name="repass">
		                    </div>
	                    </div>
	                  </div>
	                 
	                  <div class="col-12">
	                  	<div class="mb-30 dit w-100">
		                    <button name="submit" type="submit" class="btn-color right-side">Daftar</button>
	                    </div>
	                  </div>
	                  <div class="col-12">
	                  	<hr>
	                    <div class="new-account align-center mt-20"> <span>Sudah memiliki akun</span> 
	                    	<a class="link" title="Login Here" href="<?= base_url('auth') ?>">Login disini</a> </div>
	                  </div>
	                </div>
	              </form>
	            </div>
	        </div>
		</div>
	</div>
</div>
<!-- Register contant end -->