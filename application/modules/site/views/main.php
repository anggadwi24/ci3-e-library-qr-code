<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <h2>PERPUSTAKAAN </h2>
                            <h2><span>MTS AL-MA`RUF </span></h2>
                        
                            <a class="shopbtn" href="<?= base_url('buku') ?>">lihat buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <h2>PERPUSTAKAAN </h2>
                            <h2><span>MTS AL-MA`RUF </span></h2>
                        
                            <a class="shopbtn" href="<?= base_url('buku') ?>">lihat buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
</div>
<?php if($newest->num_rows() > 0){?>
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">Buku <span class="color--theme">TERBARU</span></h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
            <!-- Start Single Product -->
           
                <?php foreach($newest->result_array() as $new){
                    if(file_exists('upload/buku/'.$new['buku_cover'])){
                        $img = base_url('upload/buku/').$new['buku_cover'];
                    }else{
                        $img = base_url('upload/buku/404.jpg');
                    }   
                ?>
                 <div class="product product__style--3">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="product__thumb">
                        <a class="first__img" href="<?= base_url('buku/'.$new['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $new['buku_judul'] ?>"></a>
                        <a class="second__img animation1" href="<?= base_url('buku/'.$new['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $new['buku_judul'] ?>"></a>
                      
                    </div>
                    <div class="product__content content--center">
                        <h4><a href="<?= base_url('buku/'.$new['buku_slug'])?>"><?= $new['buku_judul'] ?></a></h4>
                       
                        <div class="action">
                            <div class="actions_inner">
                                <ul class="add_to_links">
                         
                                    <li><a class="compare" href="<?= base_url('buku/'.$new['buku_slug'])?>"><i class="bi bi-search"></i></a></li>
                              
                                </ul>
                            </div>
                        </div>
                       
                    </div>
                </div>
                </div>
            <?php }?>
            
            <!-- Start Single Product -->
            
         
           
            </div>
        </div>
        <!-- End Single Tab Content -->
    </div>
</section>
<?php }?>

<section class="wn__newsletter__area bg-image--2">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
                <div class="section__title text-center">
                    <h2>MTS AL-MA`RUF</h2>
                </div>
                <div class="newsletter__block text-center">
                    <p style="font-weight:bold">Mts Al-Ma’ruf adalah madrasah tsanawiyah yang berlembaga Pendidikan islam yang didirikan pada tanggal 5 juni 1979. Mts Al-Ma’ruf merupakan sebuah sekolah dengan jenjang yang sama seperti sekolah SMP pada umunya, namun lebih bernuansa islami. </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wn__bestseller__area bg--white pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">SEMUA <span class="color--theme">BUKU</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<div class="row mt--50">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="product__nav nav justify-content-center" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">SEMUA</a>
                            <?php
                                if($kategori->num_rows() > 0){
                                    foreach($kategori->result_array() as $cat){
                                        echo ' <a class="nav-item nav-link" data-toggle="tab" href="#nav-'.$cat['kategori_slug'].'" role="tab">'.strtoupper($cat['kategori_nama']).'</a>';
                                    }
                                }
                            ?>
                           
                           
                        </div>
					</div>
				</div>
				<div class="tab__container mt--60">
					<!-- Start Single Tab Content -->
                    
					<div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
						<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
							
								<!-- Start Single Product -->
                                <?php 
                                    if($semua->num_rows() > 0){
                                        foreach($semua->result_array() as $all){
                                            if(file_exists('upload/buku/'.$all['buku_cover'])){
                                                $img = base_url('upload/buku/').$all['buku_cover'];
                                            }else{
                                                $img = base_url('upload/buku/404.jpg');
                                            }   
                                            ?><div class="single__product">
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                <div class="product product__style--3">
                                                    <div class="product__thumb">
                                                        <a class="first__img" href="<?= base_url('buku/'.$all['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $all['buku_judul'] ?>" style="height: 340px;"></a>
                                                        <a class="second__img animation1" href="<?= base_url('buku/'.$all['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $all['buku_judul'] ?>" style="height: 340px;"></a>
                                                        
                                                    </div>
                                                    <div class="product__content content--center content--center">
                                                        <h4><a href="<?= base_url('buku/'.$all['buku_slug'])?>"><?= $all['buku_judul'] ?></a></h4>
                                                      
                                                        <div class="action">
                                                            <div class="actions_inner">
                                                                <ul class="add_to_links">
                                                               
                                                                    <li><a class="compare" href="<?= base_url('buku/'.$all['buku_slug'])?>"><i class="bi bi-search"></i></a></li>
                                                               
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
									<!-- Start Single Product -->
							
						</div>
					</div>
					<!-- End Single Tab Content -->
					<!-- Start Single Tab Content -->
                    <?php 
                        if($kategori->num_rows() > 0){
                            foreach($kategori->result_array() as $kat){
                                $buku = $this->model_app->view_where_ordering('buku',array('buku_kategori_id'=>$kat['kategori_id']),'buku_judul','ASC');
                                ?>
                                <div class="row single__tab tab-pane fade" id="nav-<?=$kat['kategori_slug']?>" role="tabpanel">
                                    <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                                      
                                            <?php 
                                                if($buku->num_rows() > 0){
                                                    foreach($buku->result_array() as $bu){
                                                        if(file_exists('upload/buku/'.$bu['buku_cover'])){
                                                            $img = base_url('upload/buku/').$bu['buku_cover'];
                                                        }else{
                                                            $img = base_url('upload/buku/404.jpg');
                                                        }   
                                                        $url = base_url('buku/'.$bu['buku_slug']);
                                                        ?>
                                                          <div class="single__product">
                                                         <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                            <div class="product product__style--3">
                                                                <div class="product__thumb">
                                                                    <a class="first__img" href="<?= base_url('buku/'.$bu['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $bu['buku_judul'] ?>" style="height: 340px;"></a>
                                                                    <a class="second__img animation1" href="<?= base_url('buku/'.$bu['buku_slug'])?>"><img src="<?= $img ?>" alt="<?= $bu['buku_judul'] ?>" style="height: 340px;"></a>
                                                                    
                                                                </div>
                                                                <div class="product__content content--center content--center">
                                                                    <h4><a href="<?= base_url('buku/'.$bu['buku_slug'])?>"><?= $bu['buku_judul'] ?></a></h4>
                                                                
                                                                    <div class="action">
                                                                        <div class="actions_inner">
                                                                            <ul class="add_to_links">
                                                                        
                                                                                <li><a class="compare" href="<?= $url ?>"><i class="bi bi-search"></i></a></li>
                                                                        
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                         </div>
                                                        <?php
                                                    }
                                                }

                                            ?>
                                       
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
					
					<!-- End Single Tab Content -->
				</div>
			</div>
		</section>
		<!-- Start BEst Seller Area -->
		<!-- Start Recent Post Area -->
		
		