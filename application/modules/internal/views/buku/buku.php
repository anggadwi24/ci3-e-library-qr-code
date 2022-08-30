<div class="col-sm-12">

    <div class="card">
        <div class="card-header">
            <h5><?= $subtitle ?></h5>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
             
                <a href="<?= base_url('internal/buku/add') ?>"><i class="icofont icofont-plus" ></i></a>
            </div>
        </div>
        <div class="card-block">
             <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Penerbit </th>
                            <th>Pengarang</th>
                            <th>Jumlah Tersedia</th>
                            <th>Jumlah Dipinjam</th>
                          
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($record->num_rows() > 0){
                                $no = 1;
                            ?>
                            <?php foreach($record->result_array() as $row) {
                                $pinjam = $this->db->query("SELECT coalesce(sum(td_qty),0) as dipinjam FROM transaksi a JOIN transaksi_detail b ON a.transaksi_id = b.td_transaksi_id WHERE b.td_buku_id = '$row[buku_id]' AND a.transaksi_status = 'pinjam'")->row_array();
                               
                                ?>
                                <tr>
                                    <td><?= $no;?></td>
                                    <td><?= $row['buku_kode']?></td>
                                    <td><?= limitString($row['buku_judul'],50) ?> <small class="d-block"><?= $row['kategori_nama'] ?></small></td>
                                    <td><?= ucwords($row['buku_penerbit']).' - '.date('Y',strtotime($row['buku_tahun_terbit'])) ?></td>
                                    <td><?= ucwords($row['buku_pengarang'])?></td>
                                    <td><?= $row['buku_qty'] ?> pcs</td>
                                    <td><?= $pinjam['dipinjam'] ?> pcs</td>

                                  
                                  
                                    <td class="font-size-18">

                                        <a href="<?= base_url('internal/buku/detail?judul='.$row['buku_slug'])?>"  class="text-success m-r-15 " ><i class="ti-eye"></i></a>
                                        <a href="<?= base_url('internal/buku/edit?judul='.$row['buku_slug'])?>"  class="text-info m-r-15 " data-id="<?= encode($row['kategori_id'])?>"><i class="ti-pencil"></i></a>
                                        <a href="#" data-href="<?= base_url('internal/buku/delete?id=').encode($row['buku_id']) ?>" class="text-danger delete"><i class="ti-trash"></i></a>
                                        
                                        
                                    </td>
                                </tr>
                            <?php $no++; }?>
                        <?php }?>
                    </tbody>
                </table>
            </div> 
        </div>       
    </div>   
</div>
