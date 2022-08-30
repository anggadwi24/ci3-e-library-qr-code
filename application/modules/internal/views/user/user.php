<div class="col-sm-12">

    <div class="card">
        <div class="card-header">
            <h5><?= $subtitle ?></h5>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
             
                <a href="<?= base_url('internal/user/add') ?>"><i class="icofont icofont-plus"></i></a>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                    
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($record->num_rows() > 0){ $no = 1;?>
                        <?php foreach($record->result_array() as $row){?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td>
                               
                                    <span class="title"><?= $row['users_nama']?></span>
                                    <span class="text-default d-block"><?= $row['users_username']?></span>
                                   
                                          
                                       
                            </td>
                            <td><?= $row['users_no_telp']?></td>
                        
                            <td>
                                <?php 
                                    if($row['users_active']=='y')
                                    {
                                        echo"Aktif";
                                    }else{
                                        echo"Tidak Aktif";
                                    }
                                ?>
                            </td>
                            <td class="font-size-18">
                               
                                <?php 
                                    if($row['users_id'] != decode($this->session->userdata['isLog']['users_id']))
                                    {
                                ?>
                                 <a href="<?= base_url('internal/user/status?id='.encode($row['users_id'])) ?>" class=" m-r-15 btn btn-warning">
                                            <span><?php if($row['users_active'] == 'y'){echo ' <i class="ti-close m-r-5"></i> Suspen';}else{echo '  <i class="ti-check m-r-5"></i> Aktif';}?></span>
                                </a>
                                <a href="<?= base_url('internal/user/edit?id='.$row['users_id']) ?>" class="text-info m-r-15"><i class="ti-pencil"></i></a>
                                <a data-href="<?= base_url('internal/user/delete?id=').encode($row['users_id']) ?>" class="text-danger delete"><i class="ti-trash"></i></a>
                                <?php }else{
                                    ?>
                                     <a href="<?= base_url('internal/profile')?>" class="text-info m-r-15"><i class="ti-pencil"></i></a>
                                <?php }?>
                              

                                

                            </td>
                        </tr>
                        <?php $no++;} } ?>
                    </tbody>
                </table>
            </div> 
        </div>       
    </div>   
</div>