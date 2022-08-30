
import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import errorRedirect from "../error-redirect.js";



import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";

data();
    function data(){
        $.ajax({
            type:'POST',
            url:baseUrl+'site/checkout/data',
            dataType:'json',
            beforeSend:function(){
                    waiting();
            },success:function(resp){
                // console.log(resp);
                if(resp.status == true){
                    $('#dataCheckout').html(resp.output);
                }else{
                    if(resp.redirect == null){
                        error('Peringatan',resp.msg);
                    }else{
                        errorRedirect('Peringatan',resp.msg,resp.redirect);
                    }
                    
                }
            },complete:function(){
                out();
            }

        })
    }
    $(document).on('change','#provinsi',function(){
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:baseUrl+'site/ajax/kabupaten',
            data:{id:id},
            dataType:'json',
            beforeSend:function(){
          
                $('#kabupaten').html($('<option>', {
                    
                    text: 'Loading...',
                }));
            },success:function(resp){
                   $('#kurir').val('');
                   $('#service').val('');
                   $('#ongkir').html('Pilih Ekspedisi');
                   $('#subtotal').html($('#total').html());
                    $('#kabupaten').html(resp);
                    // $('#kabupaten').removeClass('form-control');
                  
                    
               
                
            }
    
        })
    
    });
    $(document).on('change','#kabupaten',function(){
        $('#kurir').val('');
        $('#service').val('');
        $('#ongkir').html('Pilih Ekspedisi');
        $('#subtotal').html($('#total').html());
    })
    $(document).on('change','#service',function(){
        var ser = $('option:selected', this).attr('data-services');
        var est = $('option:selected', this).attr('data-estimate');
        
        $.ajax({
            type:'POST',
            url:baseUrl+'site/checkout/service',
            data:{ser:ser,est:est},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#ongkir').html(resp.arr.ongkir);
                    $('#subtotal').html(resp.arr.subtotal);
                    $('#buttonCheckout').attr('disabled',false);
                }else{
                    error('Peringatan',resp.msg);
                    $('#btnCheckout').attr('disabled',true);

                }
            }
            
        })
    });
    $(document).on('change','#kurir',function(){
        var id = $(this).val();
        var kabupaten = $('#kabupaten').val();
        $.ajax({
            type:'POST',
            url:baseUrl+'site/checkout/checkingEkspedisi',
            data:{ekspedisi:id,kabupaten:kabupaten},
            dataType:'json',
            beforeSend:function(){
                $('#ongkir').html('Pilih Ekspedisi');
                $('#subtotal').html($('#total').html());
                $('#buttonCheckout').attr('disabled',false);

                waiting();
                $('#service').html($('<option>', {
                    
                    text: 'Loading...',
                }));
            },success:function(resp){
                   if(resp.status == true){
                     $('#service').html(resp.output);
                   }else{
                          error('Peringatan',resp.msg);
                   }
                 
                    // $('#kabupaten').removeClass('form-control');
                  
                    
               
                
            },complete:function(){
                out();
            }
    
        })
    
    });

    $(document).on('submit','#formAct',function(e){
        e.preventDefault();
       
        var formData = new FormData(this);
        formData.append('ongkir',$('option:selected', '#service').attr('data-services'));
          
        
        
      
        $.ajax({
            type:'POST',
            url:baseUrl+'site/checkout/do',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType :'json',
            beforeSend:function(){
                waiting();
                $('input').attr('disabled',true);
                $('select').attr('disabled',true);
                $('button').attr('disabled',true);
                $('textarea').attr('disabled',true);
    
    
    
            },success:function(resp){
                
                if(resp.status == true){
                    // $('input').val('');
                    // $('select').val('');
                    // $('textarea').val('');
    
                    
                    window.location = resp.msg;
                }else{
                    error('Peringatan',resp.msg);
                }
            },complete:function(){
                out();
                $('input').attr('disabled',false);
                $('select').attr('disabled',false);
                $('button').attr('disabled',false);
                $('textarea').attr('disabled',false);
    
    
    
    
               
            }
        })
                
       
    })