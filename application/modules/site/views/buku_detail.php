<?php 
     if(file_exists('upload/buku/'.$row['buku_cover'])){
        $img = base_url('upload/buku/').$row['buku_cover'];
    }else{
        $img = base_url('upload/buku/404.jpg');
    }   
?>

<div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title"><?=$page  ?></h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="<?= base_url()?>">Home</a>
                              <span class="brd-separetor">/</span>
                              <a class="breadcrumb_item" href="<?= base_url('buku')?>">Buku</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active"><?= $page ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-9 col-12">
        				<div class="wn__single__product">
        					<div class="row">
        						<div class="col-lg-6 col-12">
        							<div class="wn__fotorama__wrapper">
	        							<div class="fotorama wn__fotorama__action" data-nav="thumbs">
		        							  <a href="<?= $img ?>"><img src="images/product/1.jpg" alt=""></a>
		        							  
	        							</div>
        							</div>
        						</div>
        						<div class="col-lg-6 col-12">
        							<div class="product__info__main">
        								<h1><?= $row['buku_judul'] ?></h1>
        								<div class="product-info-stock-sku d-flex">
        									<p>Ketersediaan:<span> <?php if($row['buku_qty'] > 0){echo "Tersedia";}else{echo "Tidak Tersedia";} ?></span></p>
                                            <p>Kategori: <span><?= $cat['kategori_nama'] ?></span></p>
        									
        								</div>
        								<div class="product-reviews-summary d-flex">
        									
        									<div class="reviews-actions d-flex">
        										<a >Penerbit : <?= $row['buku_penerbit'] ?></a>
        										<a >Pengarang : <?= $row['buku_pengarang']?></a>
        									</div>
        								</div>
                                        <div class="product-reviews-summary d-flex">
        									
        									<div class="reviews-actions d-flex">
        										<a >Halaman : <?= $row['buku_halaman'] ?> Halaman</a>
        										<a >Kode Rak : <?= $row['buku_rak']?></a>
        									</div>
        								</div>
        								<div class="price-box">
        									<span><?= $row['buku_tahun_terbit'] ?></span>
        								</div>
        								
        							</div>
        						</div>
        					</div>
        				</div>
        				<div class="product__info__detailed">
							<div class="pro_details_nav nav justify-content-start" role="tablist">
	                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Sinopsis</a>
	                          
	                        </div>
	                        <div class="tab__container">
	                        	<!-- Start Single Tab Content -->
	                        	<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
									<div class="description__attribute">
                                        <?= $row['buku_sinopsis']?>
									</div>
	                        	</div>
	                        	<!-- End Single Tab Content -->
	                        	<!-- Start Single Tab Content -->
	                        	
	                        	<!-- End Single Tab Content -->
	                        </div>
        				</div>
						<div class="wn__related__product pt--80 pb--50">
							<div class="section__title text-center">
								<h2 class="title__be--2">Buku Lainnya</h2>
							</div>
							<div class="row mt--60">
								<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
									<!-- Start Single Product -->
                                    <?php
                                        if($related->num_rows() > 0){
                                            foreach($related->result_array() as $rel){
                                                if(file_exists('upload/buku/'.$rel['buku_cover'])){
                                                    $image = base_url('upload/buku/').$rel['buku_cover'];
                                                }else{
                                                    $image = base_url('upload/buku/404.jpg');
                                                }   
                                            ?>
                                            	<div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="product">
                                                        <div class="product__thumb">
                                                            <a class="first__img" href="<?= base_url('buku/'.$rel['buku_slug']) ?>"><img src="<?= $image ?>" alt="<?= $rel['buku_judul'] ?>"></a>
                                                            <a class="second__img animation1" href="<?= base_url('buku/'.$rel['buku_slug']) ?>"><img  src="<?= $image ?>" alt="<?= $rel['buku_judul'] ?>"></a>
                                                          
                                                            <ul class="prize position__right__bottom d-flex">
                                                                <li> <?php if($rel['buku_qty'] > 0){echo "Tersedia";}else{echo "Tidak Tersedia";} ?></li>
                                                             
                                                            </ul>
                                                           
                                                        </div>
                                                        <div class="product__content">
                                                            <h4><a href="<?= base_url('buku/'.$rel['buku_slug']) ?>"><?= $rel['buku_judul']?></a></h4>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
								
								
								</div>
							</div>
						</div>
						
						
        			</div>
        			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        				<div class="shop__sidebar">
        					<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">Kategori</h3>
        						<ul>
        						<?php 
										if($kategori->num_rows() > 0){
											foreach($kategori->result_array() as $kat){
												$book =  $this->model_app->view_where_ordering('buku',array('buku_kategori_id'=>$kat['kategori_id']),'buku_judul','ASC')->num_rows();
												
													echo '<li><a href="'.base_url('buku?kategori=').$kat['kategori_slug'].'&tersedia=all">'.ucfirst($kat['kategori_nama']).' <span>('.$book.')</span></a></li>';
												
											}
										}
									?>
        						</ul>
        					</aside>
        				
        					
        				</div>
        			</div>
        		</div>
        	</div>
        </div>