import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";
data();
function data(){
    $.ajax({
        type:'post',
        url:baseUrl+'transaksi/dataTracking',
        data:{id:$('#id').val()},
        dataType:'json',
        beforeSend:function(){
            $(document).ajaxStart(function() { Pace.restart(); });

           $('#data').html('<div class="spinner-border" id="spinner" role="status"><span class="sr-only">Loading...</span></div>');
        },success:function(resp){
            $('#data').html(resp);
        },complete:function(){
        
        }

    })
}