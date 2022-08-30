<div class="col-sm-12">

    <div class="card">
        <div class="card-header">
            <h5><?= $subtitle ?></h5>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
             
                <i class="icofont icofont-plus"  data-toggle="modal" data-target="#addModal"></i>
            </div>
        </div>
        <div class="card-block">
             <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Denda</th>
                         
                          
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
                                    <td><?= $row['denda_hari']?> Hari /<?= rp($row['denda'])?></td>
                                   
                             
                                  
                                  
                                    <td class="font-size-18">

                                       
                                        <a href="#"  class="text-info m-r-15 edit" data-id="<?= encode($row['denda_id'])?>"><i class="ti-pencil"></i></a>
                                       
                                        
                                        
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Denda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('internal/denda/update') ?>" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="">Hari</label>
                        <input type="number" name="hari" id="hari" class="form-control">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Denda</label>
                        <input type="number" name="denda" id="denda" class="form-control">
                    </div>
                    
            </div>
            <input type="hidden" id="id" name="id">
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                <button  class="btn btn-primary waves-effect waves-light ">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>