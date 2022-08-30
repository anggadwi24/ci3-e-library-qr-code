import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import successOK from "../successOK.js";


import error from "../error.js";

$(document).on('submit','#formCheck',function(e){
    e.preventDefault();
   
    data($('#notransaksi').val());
   
      
    
    
  
   
            
   
})
$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
   
    formData.append('no',$('#notransaksi').val());
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/return',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
            $('.theme-loader').css('display','');
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
                $('input').val('');
                $('select').val('');
                $('textarea').val('');

                
                successOK('Berhasil',resp.msg,resp.redirect);
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('.theme-loader').css('display','none');
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
            
   
})
function data(no){
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/detailPengembalian',
        data: {no_transaksi:no},
  
        dataType :'json',
        beforeSend:function(){
            $('.theme-loader').css('display','');
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
                $('#data').html(resp.output);
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('.theme-loader').css('display','none');
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
}
$(document).on('change','.condition',function(){
    var td = $(this).attr('data-td');
    var buku = $(this).attr('data-id');
    var qty = $(this).attr('data-qty');
    var con = $(this).val();
  
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/updateDetail',
        data:{td:td,buku:buku,qty:qty,con:con},
        dataType:'json',
        beforeSend:function(){
            $('.theme-loader').css('display','');
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);
        },success:function(resp){
            if(resp.status == true){
                data($('#notransaksi').val());
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
            $('.theme-loader').css('display','none');
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);
        }
    })

    
})