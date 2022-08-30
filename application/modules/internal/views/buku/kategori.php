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
                            <th>Kategori</th>
                         
                          
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
                                    <td><?= $row['kategori_nama']?></td>
                                   
                             
                                  
                                  
                                    <td class="font-size-18">

                                       
                                        <a href="#"  class="text-info m-r-15 edit" data-id="<?= encode($row['kategori_id'])?>"><i class="ti-pencil"></i></a>
                                        <a href="#" data-href="<?= base_url('internal/kategori/delete?id=').encode($row['kategori_id']) ?>" class="text-danger delete"><i class="ti-trash"></i></a>
                                        
                                        
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('internal/kategori/store') ?>" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Kategori</label>
                        <input type="text" name="kategori" class="form-control">
                    </div>
                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                <button  class="btn btn-primary waves-effect waves-light ">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('internal/kategori/update') ?>" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control">
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