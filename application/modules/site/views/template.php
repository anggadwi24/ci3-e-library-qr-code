<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= $title ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="<?= base_url('template/public/')?>images/favicon.ico">
	<link rel="apple-touch-icon" href="<?= base_url('template/public/')?>images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?= base_url('template/public/')?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('template/public/')?>css/plugins.css">
	<link rel="stylesheet" href="<?= base_url('template/public/')?>style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/bower_components/') ?>/sweetalert/css/sweetalert.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="<?= base_url('template/public/')?>css/custom.css">

	<!-- Modernizer js -->
	<script src="<?= base_url('template/public/')?>js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
    <div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<div class="logo">
							<a href="index.html">
								<img src="<?= base_url('template/public/')?>images/logo/logo.png" alt="logo images">
							</a>
						</div>
					</div>
					<div class="col-lg-8 d-none d-lg-block">
						<nav class="mainmenu__nav">
							<ul class="meninmenu d-flex justify-content-start">
                                <li><a href="<?= base_url('') ?>">Beranda</a></li>
						
                                <li><a href="<?= base_url('buku') ?>">Buku</a></li>
								
								
								<li><a href="<?= base_url('kontak') ?>">Kontak</a></li>
							</ul>
						</nav>
					</div>
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<ul class="header__sidebar__right d-flex justify-content-end align-items-center">
							<li class="shop_search mr-5"><a class="search__active" href="#"></a></li>
						

							<li class="setting__bar__icon"><a class="setting__active" href="#"></a>
								<div class="searchbar__content setting__block">
									<div class="content-inner">
									
										<div class="switcher-currency">
											<strong class="label switcher-label">
												<span>Akun</span>
											</strong>
											<div class="switcher-options">
												<div class="switcher-currency-trigger">
													<div class="setting__menu">
														<?php if($this->session->userdata('isSiswa')){?>
														<span><a href="<?= base_url('profile') ?>">Profil</a></span>
														<span><a href="<?= base_url('history') ?>">History Peminjmaan</a></span>
														<span><a href="<?= base_url('logout') ?>">Logout</a></span>
														<?php }else{?>
														<span><a href="<?= base_url('auth') ?>">Login</a></span>
														<span><a href="<?= base_url('register') ?>">Daftar</a></span>


														<?php }?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- Start Mobile Menu -->
				<div class="row d-none">
					<div class="col-lg-12 d-none">
						<nav class="mobilemenu__nav">
							<ul class="meninmenu">
                                <li><a href="<?= base_url('') ?>">Beranda</a></li>
						
                                <li><a href="<?= base_url('buku') ?>">Buku</a></li>
                                
                                
                                <li><a href="<?= base_url('kontak') ?>">Kontak</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- End Mobile Menu -->
	            <div class="mobile-menu d-block d-lg-none">
	            </div>
	            <!-- Mobile Menu -->	
			</div>		
		</header>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<div class="brown--color box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="<?= base_url('buku') ?>" method="get">
				<div class="field__search">
					<input type="text" placeholder="Cari buku disini..." name="keyword">
					<?php 
						if($this->input->get('kategori')){
							$kat = $this->input->get('kategori');
						}else{
							$kat = 'all';
						}
						if($this->input->get('tersedia')){
							$sed = $this->input->get('tersedia');
						}else{
							$sed = 'all';
						}
					?>
					<input type="hidden" name="kategori" value="<?= $kat ?>">
									<input type="hidden" name="tersedia" value="<?= $sed ?>">
					<div class="action">
						<a href="#" type="button"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>
		<!-- End Search Popup -->
        <!-- Start Slider area -->
 
        <?=  $contents?>
        <footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
			<div class="footer-static-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer__widget footer__menu">
								<div class="ft__logo">
									<a href="<?= base_url('') ?>">
										<img src="<?= base_url('template/public/') ?>images/logo/logo.png" alt="logo">
									</a>
									<p>Mts Al-Ma’ruf merupakan sebuah sekolah dengan jenjang yang sama seperti sekolah SMP pada umunya, namun lebih bernuansa islami</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright__wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="copyright">
								<div class="copy__right__inner text-left">
									<p>Copyright <i class="fa fa-copyright"></i> <a href="#">Mts Al-ma`ruf.</a> All Rights Reserved</p>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</footer>
    </div>
<script src="<?= base_url('template/public/')?>js/vendor/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('template/public/')?>js/popper.min.js"></script>
<script src="<?= base_url('template/public/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('template/public/')?>js/plugins.js"></script>
<script src="<?= base_url('template/public/')?>js/active.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>sweetalert/js/sweetalert.min.js"></script>
    <?php if($this->session->flashdata('error')){
        echo "<script>
                swal({
                    title:'Warning!',
                    text:'".$this->session->flashdata('error')."',
                    customClass: 'swal-wide',
                    type:'error',
                });
            </script>";
    }?>
    <?php if($this->session->flashdata('success')){
        echo "<script>
                swal({
                    title:'Success!',
                    text:'".$this->session->flashdata('success')."',
                    customClass: 'swal-wide',
                    type:'success',
                });
            </script>";
    }?>
<?php if(isset($js)){
        echo "<script  type='module' src='".$js."'></script>";
    } ?>
	
</body>
</html>