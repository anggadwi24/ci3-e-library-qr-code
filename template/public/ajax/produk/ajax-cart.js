
import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import errorRedirect from "../error-redirect.js";



import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";


    $(document).on('click','.removeCart1',function(){
        var rowid = $(this).attr('data-id');
        $.ajax({
            type:'POST',
            url:baseUrl+'site/ajax/removeItem',
            data:{rowid:rowid},
            dataType:'json',
            beforeSend:function(){
                    waiting();
            },success:function(resp){
                if(resp.status == true){
                    dataCart();
                    dataCart1();
                }else{
                    error('Peringatan','Item tidak ditemukan');
                }
            },complete:function(){
                out();
            }
        })
    })
    $(document).on('click','#buttonCheckout',function(){
        window.location = baseUrl+'checkout';
    });
    function dataCart1(){
        $.ajax({
            type:'POST',
            url:baseUrl+'site/ajax/dataCart',
            dataType:'json',
            beforeSend:function(){
                
            },success:function(resp){
                $('#dataCart').html(resp.output);
                $('#totalCart').html(resp.subtotal);
                $('#countCart').html(resp.count);
            },complete:function(){
            
            }

        })
    }
dataCart();
    function dataCart(){
        $.ajax({
            type:'POST',
            url:baseUrl+'site/profile/dataCart',
            dataType:'json',
            beforeSend:function(){
                
            },success:function(resp){
                $('#cartData').html(resp.output);
                $('#subtotal').html(resp.subtotal);
                $('#total').html(resp.count);
                $('#buttonCheckout').html(resp.button)
            },complete:function(){
               
            }

        })
    }
    $(document).on('change','.quantity1',function(){
        var rowid = $(this).attr('data-id');
        var qty = $(this).val();
        if(qty <= 0){
            error('Peringatan','Jumlah tidak boleh kurang dari 1');
        }else{
            $.ajax({
                type:'POST',
                url:baseUrl+'site/profile/updateCart',
                data:{rowid:rowid,qty:qty},
                dataType:'json',
                beforeSend:function(){
                    waiting();
                },success:function(resp){
                    if(resp.status == true){
                        dataCart();
                        dataCart1();
                    }else{
                        error('Peringatan',resp.message);
                    }
                },complete:function(){
                    out();
                }
    
            })
        }
        
    })