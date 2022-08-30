
<hr>

<div class="contant">
<div id="banner-part" class="banner inner-banner">
		<div class="container">
			<div class="bread-crumb-main">
				<h1 class="banner-title">Detail Produk</h1>
				<div class="breadcrumb">
                    <ul class="inline">
                        <li><a href="<?= base_url('')?>">Home</a></li>
                        <li><a href="<?= base_url('product')?>">Produk</a></li>
                        <li>Detail Produk</li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
	<div class="ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12">
						<div class="align-center mb-md-30">
							<ul id="glasscase" class="gc-start">
								<?php 
									if(file_exists('upload/produk/'.$row['produk_image'])){
										$image = base_url().'upload/produk/'.$row['produk_image'];
									}else{
										$image = base_url().'upload/produk/404.jpg';
									}
								?>
								<li><img src="<?= $image ?>" alt="'.$row['produk_nama'].'"/></li>
								<?php 
									$detail = $this->model_app->view_where('produk_gambar',array('pg_produk_id'=>$row['produk_id']));
									if($detail->num_rows() > 0){
										foreach($detail->result_array() as $img){
											if(file_exists('upload/produk/'.$img['pg_gambar'])){
												$images = base_url().'upload/produk/'.$img['pg_gambar'];
											}else{
												$images = base_url().'upload/produk/404.jpg';
											}
											echo '<li><img src="'.$images.'" alt="'.$row['produk_nama'].'" /></li>';	
										}
									}
								?>
								
								
								
							</ul>
						</div>
				</div>
				<div class="col-lg-7 col-md-6 col-12">
					<div class="product-detail-main">
						<div class="product-item-details">
							<h1 class="product-item-name"><?= $row['produk_nama']?></h1>
							<div class="price-box"> <span class="price"><?= idr($row['produk_harga_jual'])?></span> 
							
							</div>
							
							<div class="product-des">
								<p><?= $row['produk_mini_deskripsi']?></p>
							</div>
							
							<hr class="mb-20">
							<div class="row">
								<div class="col-12">
									<div class="table-listing qty mb-20">
										<div class="row">
											<div class="col-xl-2 col-md-3 col-sm-12">
												<span>Qty:</span>
											</div>
											<div class="col-xl-10 col-md-9 col-sm-12">
												<div class="custom-qty">
												<button onclick="var result = document.getElementById('qty1'); var qty1 = result.value; if( !isNaN( qty1 ) && qty1 > 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
												<input type="text" class="input-text qty" title="Qty" value="1" maxlength="8" id="qty1" name="qty">
												<button onclick="var result = document.getElementById('qty1'); var qty1 = result.value; if( !isNaN( qty1 )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="table-listing product-size select-arrow mb-20">
										<div class="row">
											<div class="col-xl-2 col-md-3 col-sm-12">
												<span>Batch :</span>
											</div>
											<div class="col-xl-10 col-md-9 col-sm-12">
												<select class="selectpicker full" id="select-by-size">
													<?php 
														if($batch->num_rows() > 0){
															foreach($batch->result_array() as $bth){
																if($bth['pb_status'] == 'open'){
																	if($bth['pb_tanggal_mulai'] <= date('Y-m-d H:i:s') AND $bth['pb_tanggal_selesai'] >= date('Y-m-d H:i:s')){
																		$disabled = '';
																		if($selected != null){
																			if($selected['pb_id'] == $bth['pb_id']){
																				$selected = 'selected';
																			}else{
																				$selected = '';
																			}
																		}else{
																			$selected = '';
																		}
																	}else{
																		$disabled = 'disabled';
																		$selected = '';
																	}
																}else{
																	$disabled = 'disabled';
																	$selected = '';
																}
																
																
																
																echo '<option value="'.encode($bth['pb_id']).'" '.$selected.' '.$disabled.'>'.$bth['pb_batch'].'</option>';
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<hr class="mb-20">
							<div class="product-details-btn"><!-- detail-page-btn  -->
							<?php 
								$cekB = $this->model_app->view_where('produk_batch',array('pb_produk_id'=>$row['produk_id'],'pb_status'=>'open'));
								if($cekB->num_rows() > 0){

								
							?>
								<ul>
									<li>
										<button href="cart.html" class="btn btn-color" id="addToCart" data-id="<?= encode($row['produk_id']) ?>" ><span  class="icon cart-icon"></span>Tambah Ke Keranjang</button>
									</li>
									<li class="icon wishlist-icon">
										<button class="btn btn-color" id="checkout" data-id="<?= encode($row['produk_id']) ?>">Checkout</button>
									</li>
									
								</ul>
								<?php }else{
									}?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="product-tab-part position-r pb-100">
	<div class="container">
		<div class="product-tab-inner">
			<div class="row">
				<div class="col-12">
						<div id="tabs">
						<ul class="nav nav-tabs">
							<li><a class="tab-Description selected" title="Description">Deskripsi</a></li>
						
						</ul>
					</div>
					<div id="items">
						<div class="tab_content">
							<ul>
								<li>
									<div class="items-Description selected">
									<?= $row['produk_deskripsi']?>
									</div>
								</li>
								
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

