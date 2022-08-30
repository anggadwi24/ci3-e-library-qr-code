import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";
data();
$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append('id',basePath('id'));
    $(document).ajaxStart(function() { Pace.restart(); });
      
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'produk/update',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
           
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
             

                
                successBack('Berhasil',resp.msg,resp.redirect);
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
            
   
})

$(document).on('submit','#formImage',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append('id',basePath('id'));
    $(document).ajaxStart(function() { Pace.restart(); });
      
   
  
    $.ajax({
        type:'POST',
        url:baseUrl+'produk/updateImage',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
           
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
                $('#image').attr('src',resp.image);

                $('#files').val('');
                
                successBack('Berhasil',resp.msg,resp.redirect);
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
            
   
})

$(document).on('submit','#formDetail',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append('id',basePath('id'));
    $(document).ajaxStart(function() { Pace.restart(); });
      
   
  
    $.ajax({
        type:'POST',
        url:baseUrl+'produk/storeDetail',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
           
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
               $('#modaltambahgambar').modal('hide');
                $('#detail').val('');
                data();
                successBack('Berhasil',resp.msg,resp.redirect);
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
            
   
})

function data(){
    $.ajax({
        type:'POST',
        url:baseUrl+'produk/dataGambar',
        data:{id:basePath('id')},
        dataType:'json',
        success:function(resp){
            if(resp.status == true){
                $('#data').html(resp.output);
            }else{
                error('Peringatan',resp.msg);
            }
        }  
    })
}
$(document).on('click','.delete',function(){
    var id = $(this).attr('data-id');
    $(document).ajaxStart(function() { Pace.restart(); });
      swal({
          title: 'Peringatan',
          text: 'apakah anda yakin menghapus gambar ini?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#334a65',
          confirmButtonText: 'Yakin',
          cancelButtonText: 'Tidak',
        },function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    type:'POST',
                    url:baseUrl+'produk/deleteGambar',
                    data:{id:id},
                    dataType:'json',
                    success:function(resp){
                        if(resp.status == true){
                            data();
                        }else{
                            error('Peringatan',resp.msg);
                        }
                    }  
                })
            } else {
                
            }
        });
  })
  