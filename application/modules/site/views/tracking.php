
<div class="contant">
    <div id="banner-part" class="banner inner-banner">
        <div class="container">
            <div class="bread-crumb-main">
                <h1 class="banner-title">Pelacakan Pesanan</h1>
                <div class="breadcrumb">
                    <ul class="inline">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                       
                        <li><a href="<?= base_url('order/'.$row['transaksi_no']) ?>">Detail</a></li>
                        <li>Tracking</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout-part ptb-100">
        <div class="container">
          
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card p-4">
                        <div class="heading-part mb-30">
                            <h3>Lacak</h3>
                        </div>
                        <div class="row" >
                            <div class="col-12">
                                <div class="order-track"  id="data">
                                 
                                    <?= $payment ?>
                                    <div class="order-track-step">
                                        <div class="order-track-status">
                                            <span class="order-track-status-dot"></span>
                                            <span class="order-track-status-line"></span>
                                        </div>
                                        <div class="order-track-text">
                                            <p class="order-track-text-stat"> Pesanan diterima</p>
                                            <span class="order-track-text-sub"><?= tanggalwaktu($row['transaksi_created_on'])?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                           
                            <!-- <div class="col-12" id="data"></div>
                            <?= $payment ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"><?= tanggalwaktu($row['transaksi_created_on'])?></div>
                                    <div class="col-8">Pesanan diterima</div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
<input type="hidden" id="id" value="<?= encode($row['transaksi_id'])?>">