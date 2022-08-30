<div class="ht__bradcaump__area bg-image--6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?= $page ?></h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="<?= base_url('') ?>">Beranda</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?= $page ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wishlist-area section-padding--lg bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table wnro__table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                      
                                        <th class="product-name"><span class="nobr">No. Transaksi</span></th>
                                        <th class="product-price"><span class="nobr"> Tanggal Pinjam </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Tanggal Kembali </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Status </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Total Denda </span></th>

                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($record->num_rows() > 0){
                                        foreach($record->result_array() as $rows){ ?>
                                    <tr>
                                        
                                        <td class="product-name"><a href="<?= base_url('history/detail?no='.$rows['transaksi_no'])?>"><?= $rows['transaksi_no'] ?></a></td>
                                        <td class="product-price"><?= tanggalwaktu($rows['transaksi_tanggal_pinjam']) ?></td>
                                        <td class="product-price"><?= tanggalwaktu($rows['transaksi_tanggal_kembali']) ?></td>

                                        <td class="product-stock-status">
                                            <?php if($rows['transaksi_status'] == 'selesai'){?>
                                            <span class="wishlist-in-stock">Selesai</span>
                                            <?php }else{?>
                                                <span class="wishlist-out-stock">Belum Selesai</span>
                                            <?php }?>
                                        </td>
                                        <td class="product-price"><span class="amount"><?= rp($rows['transaksi_total_denda']+$rows['transaksi_denda_telat']) ?></span></td>
                                
                                    </tr>
                                  <?php }}?>
                                </tbody>
                            </table>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>