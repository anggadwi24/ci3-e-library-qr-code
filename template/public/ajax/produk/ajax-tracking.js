import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";
data();
function data(){
    $.ajax({
        type:'post',
        url:baseUrl+'site/checkout/dataTracking',
        data:{id:$('#id').val()},
        dataType:'json',
        beforeSend:function(){
        

           $('#data').prepend('<div class="spinner-border" id="spinner" role="status"><span class="sr-only">Loading...</span></div>');
        },success:function(resp){
            $('#data').prepend(resp);
        },complete:function(){
           $('#spinner').remove();
        }

    })
}