<div class="ht__bradcaump__area bg-image--6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?= $page ?></h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="<?= base_url('') ?>">Beranda</a>
                        <span class="brd-separetor">/</span>
                        <a class="breadcrumb_item" href="<?= base_url('history') ?>">History</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?= $page ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>No. Transaksi</li>
                                    <li>Tanggal Pinjam</li>
                                    <li>Tanggal Kembali</li>
                                    <li>Status</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li><?= $row['transaksi_no'] ?></li>
                                    <li><?= tanggalwaktu($row['transaksi_tanggal_pinjam'])?></li>
                                    <li><?= tanggalwaktu($row['transaksi_tanggal_kembali'])?></li>
                                    <li><?php if($row['transaksi_status'] == 'selesai'){ echo "Selesai";}else{echo "Belum Selesai";}?></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                    
                            <div class="table-content wnro__table table-responsive">
                                <table style="width:100% !important;border:10px solid #e1e1e1 !important" >
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Cover</th>
                                            <th class="product-name">Judul</th>
                                          
                                     
                                            <th class="product-price">Denda</th>
                                            <th class="product-subtotal">Kondisi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($record->num_rows() > 0){
                                                foreach($record->result_array() as $rows){
                                                    if(file_exists('upload/buku/'.$rows['buku_cover'])){
                                                        $img = base_url('upload/buku/').$rows['buku_cover'];
                                                    }else{
                                                        $img = base_url('upload/buku/404.jpg');
                                                    }
                                        ?>
                                         <tr>
                                            <td class="product-thumbnail" style="width:20%"><a href="#"><img src="<?= $img ?>" alt="<?= $rows['buku_judul'] ?>"></a></td>
                                            <td class="product-name" style="width:50%"><a href="<?= base_url('buku/'.$rows['buku_slug']) ?>"><?= $rows['buku_judul']?></a></td>
                                            <td class="product-subtotal" style="width:15%"><?= idr($rows['td_denda']) ?></td>

                                           
                                            <td class="product-subtotal"  style="width:20%"><?= ucfirst($rows['td_kondisi']) ?><td>
                                         
                                        </tr>
                                        <?php
                                                }
                                            }
                                            
                                        ?>
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                       
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>Denda Terlamat</li>
                                    <li>Denda Buku</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li><?= rp($row['transaksi_denda_telat']) ?></li>
                                    <li><?= rp($row['transaksi_total_denda'])?></li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Total Denda</span>
                                <span><?= rp($row['transaksi_denda_telat']+$row['transaksi_total_denda']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>