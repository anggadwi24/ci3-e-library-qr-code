
<?php 
    $id = decode($this->session->userdata['isLog']['users_id']);
    $user = $this->model_app->view_where('users',array('users_id'=>$id))->row_array();
?>
 <?php 
    if(file_exists('upload/user/'.$user['users_foto'])){
        $user['users_foto'] = base_url('upload/user/').$user['users_foto'];
    }else{
        $user['users_foto'] = base_url('template/admin/assets/').'/images/user.png';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
      <meta name="description" content="Phoenixcoded">
      <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="Phoenixcoded">
      <!-- Favicon icon -->
      <link rel="icon" href="<?= base_url('template/admin/assets/') ?>/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/') ?>bower_components/bootstrap/css/bootstrap.min.css">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/icon/icofont/css/icofont.css">
      <!-- flag icon framework css -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/pages/flag-icon/flag-icon.min.css">
      <!-- Menu-Search css -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/pages/menu-search/css/component.css">
      <link rel="stylesheet" href="<?= base_url('template/admin/bower_components/') ?>select2/css/select2.min.css" />
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/bower_components/') ?>/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>pages/data-table/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/bower_components/') ?>/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/bower_components/') ?>/sweetalert/css/sweetalert.css">
      <!-- Horizontal-Timeline css -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/bower_components/') ?>datedropper/css/datedropper.min.css" />
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/pages/dashboard/horizontal-timeline/css/style.css">
      <!-- amchart css -->
      <link rel="stylesheet" href="<?= base_url('template/admin/bower_components/') ?>chartist/css/chartist.css" type="text/css" media="all">
      <!-- flag icon framework css -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/pages/flag-icon/flag-icon.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/css/style.css">
      <!--color css-->


      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/css/linearicons.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/css/simple-line-icons.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/css/ionicons.css">
      <link rel="stylesheet" type="text/css" href="<?= base_url('template/admin/assets/') ?>/css/jquery.mCustomScrollbar.css">

  </head>

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <!-- Menu header start -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header" header-theme="theme4">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="<?= base_url('internal/') ?>">
                            <img class="img-fluid" src="<?= base_url('upload/') ?>logo2.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                               
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                                
                            </ul>
                            <ul class="nav-right">
                              

                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="<?= $user['users_foto']?>" class="rounded-circle" alt="User-Profile-Image" style="height:30px;width:30px;">
                                        <span><?= singkatNama($user['users_nama'])?></span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                    
                                        <li>
                                            <a href="<?= base_url('internal/profile') ?>">
                                                <i class="ti-user"></i> Profil
                                            </a>
                                        </li>
                                   
                                        <li>
                                            <a href="<?= base_url('internal/logout') ?>">
                                                <i class="ti-layout-sidebar-left"></i> Keluar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- search -->
                           
                            <!-- search end -->
                        </div>
                    </div>
                </div>
            </nav>

          
           
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar" pcoded-header-position="relative">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                   
                                    <img class="img-40 rounded-circle" src="<?= $user['users_foto']?>" alt="User-Profile-Image" style="height:40px;">
                                    <div class="user-details">
                                        <span><?= singkatNama($user['users_nama'])?></span>
                                        <span id="more-details"><?= $user['users_username'] ?><i class="ti-angle-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="<?= base_url('internal/profile') ?>"><i class="ti-user"></i>Profil</a>
                                       
                                            <a href="<?=  base_url('internal/logout')?>"><i class="ti-layout-sidebar-left"></i>Keluar</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Menu</div>
                            <?php 
                                $activeDashboard = '';
                                $activeBuku = '';
                                $activeBukuM = '';
                                $activeKategori = '';
                                $activeDenda = '';
                                $activeTransaksiM = '';

                                $activeTransaksi = '';
                                $activeAnggota = '';
                                $activeLaporan = '';
                                $activeSiswa = '';
                                $activeKelas = '';
                                $activeAdmin ='';





                                $url = $this->uri->segment(2);

                                if($this->uri->segment(2) == '' OR $this->uri->segment(2) == 'main'){
                                    $activeDashboard = 'active';
                                }else if($this->uri->segment(2) == 'buku' OR $this->uri->segment(2) == 'denda' OR $this->uri->segment(2) == 'kategori'){
                                    $activeBukuM = 'active pcoded-trigger';
                                    if($this->uri->segment(2) == 'buku'){
                                        $activeBuku = 'active';
                                    }else if($url == 'denda'){
                                        $activeDenda = 'active';
                                    }else if($url == 'kategori'){
                                        $activeKategori =' active';
                                    }
                                }else if($url == 'transaksi' OR $url == 'laporan'){
                                    $activeTransaksiM = 'active pcoded-trigger';
                                    if($url == 'transaksi'){
                                        $activeTransaksi = 'active';
                                    }else{
                                        $activeLaporan = 'active';
                                    }
                                }else if($url == 'siswa' OR $url == 'kelas'){
                                    $activeAnggota = 'active pcoded-trigger';
                                    if($url == 'siswa'){
                                        $activeSiswa = 'active';
                                    }else{
                                        $activeKelas = 'active';
                                    }
                                }else if($url == 'user'){
                                    $activeAdmin = 'active';
                                }
                            ?>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="<?=  $activeDashboard?>">
                                    <a href="<?= base_url('internal/') ?>">
                                        <span class="pcoded-micon"><i class="ti-home"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu <?= $activeBukuM?>">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-book"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Buku</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="<?= $activeBuku?>">
                                            <a href="<?= base_url('internal/buku')?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Buku</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?= $activeKategori?>">
                                            <a href="<?= base_url('internal/kategori') ?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Kategori</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" <?= $activeDenda?>">
                                            <a href="<?= base_url('internal/denda') ?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Denda</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu <?= $activeTransaksiM ?>">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Transaksi</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="<?= $activeTransaksi?>">
                                            <a href="<?= base_url('internal/transaksi')?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Transaksi</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?= $activeLaporan?>">
                                            <a href="<?= base_url('internal/laporan') ?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Laporan</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                      
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu <?=$activeAnggota ?>">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Anggota</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="<?= $activeSiswa?>">
                                            <a href="<?= base_url('internal/siswa')?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Siswa</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="<?= $activeKelas ?>">
                                            <a href="<?= base_url('internal/kelas') ?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Kelas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                      
                                    </ul>
                                </li>
                               
                                <li class="<?=$activeAdmin ?> ">
                                    <a href="<?= base_url('internal/user') ?>">
                                        <span class="pcoded-micon"><i class="ti-user"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Admin</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               
                            </ul>
                           
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4><?= $page ?></h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="<?= base_url('internal')?>">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <?= $breadcrumb ?>
                                                <!-- <li class="breadcrumb-item"><a href="#!">Pages</a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                            <?= $contents ?>
                                        </div>
                                    </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/jquery/js/jquery.min.js"></script>
<script src="<?= base_url('template/admin/') ?>bower_components/jquery-ui/js/jquery-ui.min.js"></script>
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
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<?php if($js){
        echo "<script  type='module' src='".$js."'></script>";
    } ?>

<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/classie/js/classie.js"></script>
<!-- Rickshow Chart js -->
<script src="<?= base_url('template/admin/') ?>bower_components/d3/js/d3.js"></script>
<script src="<?= base_url('template/admin/') ?>bower_components/rickshaw/js/rickshaw.js"></script>
<!-- Morris Chart js -->
<script type="text/javascript" src="<?= base_url('template/admin/bower_components/') ?>chart.js/js/Chart.js"></script>

<!-- Horizontal-Timeline js -->
<script type="text/javascript" src="<?= base_url('template/admin/assets/') ?>/pages/dashboard/horizontal-timeline/js/main.js"></script>
<!-- amchart js -->
<script src="<?= base_url('template/admin/assets/') ?>pages/ckeditor/ckeditor.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>raphael/js/raphael.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>morris.js/js/morris.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>pages/data-table/js/jszip.min.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>pages/data-table/js/pdfmake.min.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>pages/data-table/js/vfs_fonts.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('template/admin/bower_components/') ?>/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/bower_components/') ?>datedropper/js/datedropper.min.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url('template/admin/') ?>bower_components/select2/js/select2.full.min.js"></script>
<!-- <script type="text/javascript" src="<?= base_url('template/admin/assets/') ?>/pages/dashboard/custom-dashboard.js"></script> -->
<script src="<?= base_url('template/admin/assets/') ?>pages/data-table/js/data-table-custom.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/assets/') ?>pages/ckeditor/ckeditor-custom.js"></script>
<script type="text/javascript" src="<?= base_url('template/admin/assets/') ?>/js/script.js"></script>

<!-- pcmenu js -->
<script src="<?= base_url('template/admin/assets/') ?>/js/pcoded.min.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>/js/demo-12.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= base_url('template/admin/assets/') ?>/js/jquery.mousewheel.min.js"></script>
</body>

</html>
