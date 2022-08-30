<div class="ht__bradcaump__area bg-image--6">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title"><?= $page ?></h2>
					<nav class="bradcaump-content">
						<a class="breadcrumb_item" href="<?=  base_url('')?>">Beranda</a>
						<span class="brd-separetor">/</span>
						<span class="breadcrumb_item active"><?= $page ?></span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->uri->segment('2')?>
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
        				<div class="shop__sidebar">
							<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">Cari</h3>
								<form action="<?= base_url('buku') ?>" method= "get">
									<input type="text" class="form-control" name="keyword" placeholder="Masukan kata kunci" value="<?= $keyword ?>">
									<input type="hidden" name="kategori" value="<?= $cat ?>">
									<input type="hidden" name="tersedia" value="<?= $sedia ?>">
									<button class="btn float-right mt-2">Cari</button>

								</form>
        					</aside>
        					<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">Kategori</h3>
        						<ul>
        							<li><a href="<?= base_url('buku?kategori=all&tersedia='.$sedia) ?>" ><?php if($cat == 'all'){echo "<b>Semua</b>";}else{echo "Semua";}?> <span>(<?= $buku->num_rows()	 ?>)</span></a></li>
									<?php 
										
									?>
									<?php 
										if($kategori->num_rows() > 0){
											foreach($kategori->result_array() as $kat){
												$book =  $this->model_app->view_where_ordering('buku',array('buku_kategori_id'=>$kat['kategori_id']),'buku_judul','ASC')->num_rows();
												if($cat==$kat['kategori_slug']){
													echo '<li><a href="'.base_url('buku?kategori=').$kat['kategori_slug'].'&tersedia='.$sedia.'"><b>'.ucfirst($kat['kategori_nama']).'</b> <span>('.$book.')</span></a></li>';

												}else{

													echo '<li><a href="'.base_url('buku?kategori=').$kat['kategori_slug'].'&tersedia='.$sedia.'">'.ucfirst($kat['kategori_nama']).' <span>('.$book.')</span></a></li>';
												}
											}
										}
									?>
        							
        						
        						</ul>
        					</aside>
        					<aside class="wedget__categories poroduct--tag">
        						<h3 class="wedget__title">Ketersediaan</h3>
        						<ul>	
        							<li><a href="<?=base_url('buku?kategori='.$cat.'&tersedia=all') ?>"><?php if($sedia == 'all'){echo "<b>Semua</b>";}else{echo "Semua";}?></a></li>
        							<li><a href="<?=base_url('buku?kategori='.$cat.'&tersedia=y') ?>"><?php if($sedia == 'y'){echo "<b>Tersedia</b>";}else{echo "Tersedia";}?></a></li>
        							<li><a href="<?=base_url('buku?kategori='.$cat.'&tersedia=n') ?>"><?php if($sedia == 'n'){echo "<b>Tidak Tersedia</b>";}else{echo "Tidak Tersedia";}?></a></li>
        				
        							
        						</ul>
        					</aside>
        					
        					
        				</div>
        			</div>
        			<div class="col-lg-9 col-12 order-1 order-lg-2">
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									<div class="shop__list nav justify-content-center" role="tablist">
			                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
			                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
			                        </div>
			                        <p>Showing <?=$first+1 ?> - <?= $per_page ?> of <?= $total ?> results</p>
			                        
		                        </div>
        					</div>
        				</div>
        				<div class="tab__container">
	        				<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
	        					<div class="row">
	        						<!-- Start Single Product -->
									<?php if($record->num_rows() > 0){?>
										<?php foreach($record->result_array() as $row){
												 if(file_exists('upload/buku/'.$row['buku_cover'])){
													$img = base_url('upload/buku/').$row['buku_cover'];
												}else{
													$img = base_url('upload/buku/404.jpg');
												}   
											?>
											<div class="col-lg-4 col-md-4 col-sm-6 col-12">
												<div class="product">
													<div class="product__thumb">
														<a class="first__img" href="<?= base_url('buku/'.$row['buku_slug']) ?>"><img src="<?= $img ?>" alt="<?= $row['buku_judul'] ?>" style="widht:450px;height:200px;"></a>
														<a class="second__img animation1" href="<?= base_url('buku/'.$row['buku_slug']) ?>"><img src="<?= $img ?>" alt="<?= $row['buku_judul'] ?>" ></a>
														
														<ul class="prize position__right__bottom d-flex">
															<?php if($row['buku_qty'] > 0){ ?>
															<li>Tersedia</li>
															<?php }else{?>
																<li>Tidak Tersedia</li>
															<?php }?>
														</ul>
													
													</div>
													<div class="product__content">
														<h4><a href="<?= base_url('buku/'.$row['buku_slug']) ?>"><?= $row['buku_judul'] ?></a></h4>
														
													</div>
												</div>
											</div>
										<?php }?>
									<?php }?>
		        					
		        				
		        					<!-- End Single Product -->
	        					</div>
								<!-- pagi -->
								<?php echo $links; ?>
	        				</div>
	        				<div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
	        					<div class="list__view__wrapper">
	        						<!-- Start Single Product -->
									<?php if($record->num_rows() > 0){?>
										<?php foreach($record->result_array() as $row){
												 if(file_exists('upload/buku/'.$row['buku_cover'])){
													$img = base_url('upload/buku/').$row['buku_cover'];
												}else{
													$img = base_url('upload/buku/404.jpg');
												}   
											?>
										<div class="list__view mb--40">
											<div class="thumb">
												<a class="first__img" href="<?= base_url('buku/'.$row['buku_slug']) ?>"><img src="<?= $img ?>" alt="<?= $row['buku_judul'] ?>"></a>
												<a class="second__img animation1" href="<?= base_url('buku/'.$row['buku_slug']) ?>"><img src="<?=  $img ?>" alt="<?= $row['buku_judul'] ?>"></a>
											</div>
											<div class="content">
												<h2><a href="<?= base_url('buku/'.$row['buku_slug']) ?>"><?= $row['buku_judul'] ?></a></h2>
												
												<ul class="prize__box">
													<?php if($row['buku_qty'] > 0){ ?>
													<li>Tersedia</li>
													<?php }else{?>
														<li>Tidak Tersedia</li>
													<?php }?>
												
												</ul>
												<p><?= substr($row['buku_sinopsis'],0,50) ?></p>
												<ul class="cart__action d-flex">
													<li class="cart"><a href="<?= base_url('buku/'.$row['buku_slug']) ?>">Detail</a></li>
													
												</ul>

											</div>
										</div>
										<?php }?>
									<?php }?>
	        						<!-- End Single Product -->
	        						<!-- Start Single Product -->
									<?php echo $links; ?>
	        						<!-- End Single Product -->
	        					</div>
	        				</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>