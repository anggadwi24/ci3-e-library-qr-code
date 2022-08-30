import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";

$(document).on('click','.edit',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        type:'POST',
        url:baseUrl+'kategori/edit',
        data:{id:id},
        dataType :'json',
        beforeSend:function(){
            $('.theme-loader').css('display','');
        },success:function(resp){
            if(resp.status == true){
                $('#modalEdit').modal('show');
                $('#kategori').val(resp.arr.kategori);
                $('#id').val(resp.arr.id);
             
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('.theme-loader').css('display','none');

        }
    
    })

})
$(document).on('click','.delete',function(){
    var href = $(this).attr('data-href');
      swal({
          title: 'Peringatan',
          text: 'apakah anda yakin menghapus kategori ini?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#334a65',
          confirmButtonText: 'Yakin',
          cancelButtonText: 'Tidak',
        },function(isConfirm){
                  if (isConfirm) {
                      window.location = href;
                  } else {
                      
                  }
              });
  })
  
  
    
      