import baseUrl from "../base.js";
import basePath from "../domain.js";


content();
function content(){
    var id = basePath('id');
    $.ajax({
        type:'POST',
        url:baseUrl+'administrasi/detailPelayanan',
        data:{id:id},
        dataType:'json',
        beforeSend:function(){
            loadContent('#content');

        },success:function(resp){
            if(resp.status == true){
                $('#content').html(resp.content);
            }else{
                error(resp.msg);
            }
        }
    })
}
detail();
$(document).on('click','#btnAppKaling',function(){
    var id = $(this).attr('data-id');
    swal({
        title: 'Apakah anda yakin',
        text: 'Anda akan menyetujui pelayanan ini sebagai kepala lingkungan?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: [ 'Batal','Yakin']
      }) .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url:baseUrl+'administrasi/approveKaling',
                data:{id:id},
                dataType:'json',
                beforeSend:function(){
                    loading();
                    $(this).attr('disabled',true);
                },success:function(resp){
                    if(resp.status == true){
                        success(resp.msg);
                        detail();
                    }else{
                        error(resp.msg);
                    }
                },complete:function(){
                    loadingOut();
                    $(this).attr('disabled',false);
                }
            });
        } else {
          swal.close();
        }
    });

})
$(document).on('click','#btnBatal',function(){
    $('#additional').html('');

    detail();
})
$(document).on('submit','#accPegawai',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append('id',basePath('id'))
    
       swal({
        title: 'Apakah anda yakin',
        text: 'Anda akan menyetujui pelayanan ini sebagai pegawai?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: [ 'Batal','Yakin']
      }) .then((willDelete) => {
        if (willDelete) {
  
                $.ajax({
                    type:'POST',
                    url:baseUrl+'administrasi/approvePegawai',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType :'json',
                    beforeSend:function(){
                        loading();
                        $('input').attr('disabled',true);
                        $('select').attr('disabled',true);
                        $('button').attr('disabled',true);
                        $('textarea').attr('disabled',true);



                    },success:function(resp){
                        
                        if(resp.status == true){
                         

                            
                            success(resp.msg);
                            detail();
                            $('#additional').html('');

                        }else{
                            error(resp.msg);
                        }
                    },complete:function(){
                       
                        $('input').attr('disabled',false);
                        $('select').attr('disabled',false);
                        $('button').attr('disabled',false);
                        $('textarea').attr('disabled',false);




                        loadingOut();
                    }
            })

        } else {
          swal.close();
        }
    });
            
   
})

$(document).on('click','#btnAppPegawai',function(){
    // var id = $(this).attr('data-id');
    // swal({
    //     title: 'Apakah anda yakin',
    //     text: 'Anda akan menyetujui pelayanan ini sebagai pegawai?',
    //     icon: 'warning',
    //     buttons: true,
    //     dangerMode: true,
    //     buttons: [ 'Batal','Yakin']
    //   }) .then((willDelete) => {
    //     if (willDelete) {
        $('#approve').html('');
            var html = "<form id='accPegawai'><div class='row mt-4'><div class='col-8 form-group'><input class='form-control' name='no_surat' required placeholder='Masukan No. surat' ></div><div class='col-4 form-group'><button class='btn btn-danger float-right ' type='button' id='btnBatal'>Batal</button><button class='btn btn-primary float-right '>Setujui</button></div></div></form>";
            $('#additional').html(html);
            // $.ajax({
            //     type:'POST',
            //     url:baseUrl+'administrasi/approvePegawai',
            //     data:{id:id},
            //     dataType:'json',
            //     beforeSend:function(){
            //         loading();
            //         $(this).attr('disabled',true);
            //     },success:function(resp){
            //         if(resp.status == true){
            //             success(resp.msg);
            //             detail();
            //         }else{
            //             error(resp.msg);
            //         }
            //     },complete:function(){
            //         loadingOut();
            //         $(this).attr('disabled',false);
            //     }
            // });
    //     } else {
    //       swal.close();
    //     }
    // });

})
$(document).on('click','#btnDisPegawai',function(){
    var id = $(this).attr('data-id');
    swal({
        title: 'Apakah anda yakin',
        text: 'Anda akan menolak pelayanan ini sebagai pegawai?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: [ 'Batal','Yakin']
      }) .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url:baseUrl+'administrasi/disapprovePegawai',
                data:{id:id},
                dataType:'json',
                beforeSend:function(){
                    loading();
                    $(this).attr('disabled',true);
                },success:function(resp){
                    if(resp.status == true){
                        success(resp.msg);
                        detail();
                    }else{
                        error(resp.msg);
                    }
                },complete:function(){
                    loadingOut();
                    $(this).attr('disabled',false);
                }
            });
        } else {
          swal.close();
        }
    });

})
$(document).on('change','input[name=tanda_tangan]',function(){
    var id = $(this).val();
    var name= $(this).attr('data-file');
    $('#sign').val(id);
    $('#fileNameSign').html(name);
    $('#modalSign').modal('hide');
  

})
$(document).on('submit','#uploadSign',function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url:baseUrl+'administrasi/uploadSign',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
            loading();
            $('#modalSign').modal('hide');
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
             

                
               dataSign();
            }else{
                error(resp.msg);
            }
        },complete:function(){
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




            loadingOut();
        }
    })
})
function dataSign(){
    var id = basePath('id');
    $.ajax({
        type:'POST',
        url:baseUrl+'administrasi/checkingSign',
        data:{id:id},
        dataType:'json',
        beforeSend:function(){
            loading();
        },success:function(resp){
            if(resp.status == true){
                $('#modal').html(resp.output);
                $('#modalSign').modal('show');
            }else{
                error(resp.msg);
            }
        },complete:function(){
            loadingOut();
        }
    })
}
$(document).on('click','#btnSelSign',function(){
   dataSign();
})
$(document).on('click','#btnAppLurah',function(){
    var html = '<form id="appLurah"><input type="hidden" name="sign" id="sign"><div class="row mt-4"><div class="col-8"><button class="btn btn-icon btn-outline-primary" type="button" id="btnSelSign"><i class="fas fa-image"></i></button><span id="fileNameSign">Pilih tanda tangan</span></div><div class="col-4"><button class="btn btn-danger float-right " type="button" id="btnBatal">Batal</button><button class="btn btn-primary float-right">Setujui</button></div></div></form>';
    $('#additional').html(html);
    $('#approve').html('');
    // var id = $(this).attr('data-id');
    // $.ajax({
    //     type:'POST',
    //     url:baseUrl+'administrasi/checkingSign',
    //     data:{id:id},
    //     dataType:'json',
    //     beforeSend:function(){
    //         loadingContent('#approve');
    //         loadButton('#btnAppLurah');
    //         loadButton('#btnDisLurah');
    //     },success:function(resp){
    //         if(resp.status == true){
    //             $('#additional').html(resp.output);
    //         }else{
    //             error(resp.msg);
    //         }
    //     },complete:function(){
    //         $('#approve').html('');
    //     }
    // })

    // swal({
    //     title: 'Apakah anda yakin',
    //     text: 'Anda akan menyetujui pelayanan ini sebagai lurah?',
    //     icon: 'warning',
    //     buttons: true,
    //     dangerMode: true,
    //     buttons: [ 'Batal','Yakin']
    //   }) .then((willDelete) => {
    //     if (willDelete) {
    //         $.ajax({
    //             type:'POST',
    //             url:baseUrl+'administrasi/approveLurah',
    //             data:{id:id},
    //             dataType:'json',
    //             beforeSend:function(){
    //                 loading();
    //                 $(this).attr('disabled',true);
    //             },success:function(resp){
    //                 if(resp.status == true){
    //                     success(resp.msg);
    //                     detail();
    //                 }else{
    //                     error(resp.msg);
    //                 }
    //             },complete:function(){
    //                 loadingOut();
    //                 $(this).attr('disabled',false);
    //             }
    //         });
    //     } else {
    //       swal.close();
    //     }
    // });

})
$(document).on('submit','#appLurah',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append('id',basePath('id'))
    if($('#sign').val() == ''){
        dataSign();
    }else{
        swal({
            title: 'Apakah anda yakin',
            text: 'Anda akan menyetujui pelayanan ini sebagai lurah?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: [ 'Batal','Yakin']
          }) .then((willDelete) => {
            if (willDelete) {
      
                    $.ajax({
                        type:'POST',
                        url:baseUrl+'administrasi/approveLurah',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData:false,
                        dataType :'json',
                        beforeSend:function(){
                            loading();
                            $('input').attr('disabled',true);
                            $('select').attr('disabled',true);
                            $('button').attr('disabled',true);
                            $('textarea').attr('disabled',true);
    
    
    
                        },success:function(resp){
                            
                            if(resp.status == true){
                             
    
                                
                                success(resp.msg);
                                detail();
                                $('#additional').html('');
                            }else{
                                error(resp.msg);
                                detail();
                                $('#additional').html('');


                            }
                        },complete:function(){
                            $('input').attr('disabled',false);
                            $('select').attr('disabled',false);
                            $('button').attr('disabled',false);
                            $('textarea').attr('disabled',false);
    
    
    
    
                            loadingOut();
                        }
                })
    
            } else {
              swal.close();
            }
        });
    }
      
            
   
})
$(document).on('click','#btnDisLurah',function(){
    var id = $(this).attr('data-id');
    swal({
        title: 'Apakah anda yakin',
        text: 'Anda akan menolak pelayanan ini sebagai lurah?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: [ 'Batal','Yakin']
      }) .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url:baseUrl+'administrasi/disapproveLurah',
                data:{id:id},
                dataType:'json',
                beforeSend:function(){
                    loading();
                    $(this).attr('disabled',true);
                },success:function(resp){
                    if(resp.status == true){
                        success(resp.msg);
                        detail();
                    }else{
                        error(resp.msg);
                    }
                },complete:function(){
                    loadingOut();
                    $(this).attr('disabled',false);
                }
            });
        } else {
          swal.close();
        }
    });

})
$(document).on('click','#btnDisKaling',function(){
    var id = $(this).attr('data-id');
    swal({
        title: 'Apakah anda yakin',
        text: 'Anda akan menolak pelayanan ini sebagai kepala lingkungan?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: [ 'Batal','Yakin']
      }) .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url:baseUrl+'administrasi/disapproveKaling',
                data:{id:id},
                dataType:'json',
                beforeSend:function(){
                    loading();
                    $(this).attr('disabled',true);
                },success:function(resp){
                    if(resp.status == true){
                        success(resp.msg);
                        detail();
                    }else{
                        error(resp.msg);
                    }
                },complete:function(){
                    loadingOut();
                    $(this).attr('disabled',false);
                }
            });
        } else {
          swal.close();
        }
    });

})
function detail(){
    var id = basePath('id');
    $.ajax({
        type:'POST',
        url:baseUrl+'administrasi/dataDetail',
        data:{id:id},
        dataType:'json',
        beforeSend:function(){
            loadButton('#approve');

        },success:function(resp){
            if(resp.status == true){
                $('#approve').html(resp.content);
            }else{
                error(resp.msg);
            }
        }
    })
}
function error(msg){

    swal({
        title: 'Ooopss!',
       
        text:msg,
        
          
        customClass: 'swal-wide',
         icon:'error',
        
        })

}
$(document).on('click','.img',function(){
    var src = $(this).attr('data-src');
    var img = document.createElement("img");
    img.src = src;
    img.className ='img-fluid';
 
    swal({
    content: img,
    });
})

function loadContent(elem){
    var html ='<div class="col-12 d-flex justify-content-center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div></div>';    
    $(elem).html(html);
}
function loadButton(elem){
    var html ='<div class="col-12 mt-3 "><button class="btn btn-primary" type="button" disabled=""><span class="spinner-border spinner-border-sm" role="status"></span>   <span class="sr-only">Loading...</span></button></div>';    
    $(elem).html(html);
}
function loading(){
    $('.loading').css('display','');

}
function loadingOut(){
    setTimeout(function() {
        $('.loading').fadeOut('slow', function() {
            $(this).css('display','none');
        });
    },400);

}
function success(msg){
swal({
    title: 'Successfully!',
   
    text:msg,
    
      
    customClass: 'swal-wide',
    icon:'success',
    
    })  
}
function success_redirect(msg,redirect){

    swal({
        title: 'Successfully',
        text: msg,
        icon: 'success',
        
        
        
      }) .then((willDelete) => {
        if (willDelete) {
            window.location = redirect;
        } 
    });
}