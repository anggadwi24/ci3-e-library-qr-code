
import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import errorRedirect from "../error-redirect.js";



import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";


$(document).ready( function () {
    //If your <ul> has the id "glasscase"
    $('#glasscase').glassCase({ 
        'thumbsPosition': 'bottom', 
        'widthDisplayPerc' : 100,
        isDownloadEnabled: false,
    });
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
$(document).on('click','#addToCart',function(){
    var id = $(this).attr('data-id');
    var qty = $('#qty1').val();
    var batch = $('#select-by-size').val();
    var url = baseUrl+'site/product/addToCart';
    $.ajax({
        type:'post',
        url:url,
        data:{id:id,qty:qty,batch:batch},
        dataType:'json',
        beforeSend:function(){
            waiting();
        },success:function(resp){
            if(resp.status == true){
                success('Berhasil',resp.msg);
                dataCart1();
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
})
$(document).on('click','#checkout',function(){
    var id = $(this).attr('data-id');
    var batch = $('#select-by-size').val();
    var qty = $('#qty1').val();
    $.ajax({
        type:'post',
        url: baseUrl+'site/product/doCheckout',
        data:{id:id,qty:qty,batch:batch},
        dataType:'json',
        beforeSend:function(){
            waiting();
        },success:function(resp){
            if(resp.status == true){
                window.location = resp.redirect;
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
})