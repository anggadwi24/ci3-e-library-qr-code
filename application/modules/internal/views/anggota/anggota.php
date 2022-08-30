<div class="col-sm-12">

    <div class="card">
        <div class="card-header">
            <h5><?= $subtitle ?></h5>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
              
                <a href="<?= base_url('internal/siswa/add') ?>"><i class="icofont icofont-plus"></i></a>
            </div>
        </div>
        <div class="card-block">
             <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>No Telp</th>
                         
                          
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($record->num_rows() > 0){
                                $no = 1;
                            ?>
                            <?php foreach($record->result_array() as $row) {
                               
                                ?>
                                <tr>
                                    <td><?= $no;?></td>
                                    <td><?= $row['siswa_nisn']?></td>
                                    <td>
                                        <span class="title"><?= $row['siswa_nama_lengkap']?></span>
                                        <span class="text-default d-block"><?= $row['siswa_email']?></span>
                                    
                                    </td>
                                    <td><?= $row['kelas_nama'] ?></td>
                                    <td><?= $row['siswa_no_telp']?></td>
                                  
                                  
                                    <td class="font-size-18">

                                       
                                        <a href="<?= base_url('internal/siswa/edit?id='.$row['siswa_id']) ?>" class="text-info m-r-15"><i class="ti-pencil"></i></a>
                                        <a href="<?= base_url('internal/siswa/delete?id=').encode($row['siswa_id']) ?>" class="text-danger"><i class="ti-trash"></i></a>
                                        
                                        
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