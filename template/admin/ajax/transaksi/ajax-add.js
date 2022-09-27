import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";


$("#siswa").select2({
    placeholder: "Pilih siswa"
});



data();
function data(){
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/dataBuku',
        dataType:'json',
        beforeSend:function(){
            $('#dataBuku').html('<div class="loader-block"><div class="preloader6"><hr> </div></div>');
        },success:function(resp){
            $('#dataBuku').html(resp.output);
        },complete:function(){

        }
    })
}
$(document).on('click','.delete',function(){
    var id = $(this).attr('data-id');
        $.ajax({
            type:'POST',
            url:baseUrl+'transaksi/removeBook',
            data:{id:id},
            dataType:'json',
            beforeSend:function(){
                $('#dataBuku').html('<div class="loader-block"><div class="preloader6"><hr> </div></div>');
            },success:function(resp){
                if(resp.status == true){
                    data();
                    dataBuku();
                }else{
                    error('Peringatan',resp.msg);
                }
            },complete:function(){

            }
        })
})
$(document).on('change','.qty',function(){
    var id = $(this).attr('data-id');
    var qty = $(this).val();
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/updateBook',
        data:{id:id,qty:qty},
        dataType:'json',
        beforeSend:function(){
            $('#dataBuku').html('<div class="loader-block"><div class="preloader6"><hr> </div></div>');
        },success:function(resp){
            if(resp.status == true){
                data();
            }else{
                data();
                error('Peringatan',resp.msg);
            }
        },complete:function(){

        }
    })
})
dataBuku();
function dataBuku(){
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/buku',
        dataType:'json',
        success:function(resp){
            $('#buku').html(resp);
            $("#buku").select2({
                placeholder: "Pilih Buku"
            });
        }
    })
   
}
$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
   
      
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/store',
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

                
                successRedirect('Berhasil',resp.msg,resp.redirect);
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

const html5QrCode = new Html5Qrcode("reader");

const config = { fps: 10, qrbox: { width: 500, height: 500 } };

    html5QrCode.start({ facingMode: "environment" }, config, (text)=>{
        // console.log(text);
        var kode = text;
        $.ajax({
            url : baseUrl+'transaksi/searchBook',
            method : "POST",
            data : {kode: kode},
            dataType : 'json',
            success: function(resp){
                if(resp.status == true){
                    data();
                    dataBuku();
                }else{
                    error('Peringatan',resp.msg);
                }
                 
            }
        });
      
    });



$(document).on('click','#btnAdd',function(e){
    e.preventDefault();
    var buku = $('#buku').val();
    var qty = $('#qty').val();
    if(buku == null){
        error('Peringatan','Pilih buku terlebih dahulu');
    }else{
        $.ajax({
            type:'POST',
            url:baseUrl+'transaksi/addBook',
            data:{buku:buku,qty:qty},
            dataType:'json',
            beforeSend:function(){
                $('.theme-loader').css('display','');
                $('input').attr('disabled',true);
                $('select').attr('disabled',true);
                $('button').attr('disabled',true);
                $('textarea').attr('disabled',true);
    
            },success:function(resp){
                if(resp.status == true){
                    data();
                    dataBuku();
                }else{
                    error('Peringatan',resp.msg);
                }
            },
            complete:function(){
                $('.theme-loader').css('display','none');
                $('input').attr('disabled',false);
                $('select').attr('disabled',false);
                $('button').attr('disabled',false);
                $('textarea').attr('disabled',false);
            }
    
        })
    }
    
    
})