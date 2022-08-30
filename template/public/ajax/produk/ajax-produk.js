import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";


data('open');
$(document).on('change','#status',function(){
    data($(this).val());
});
function data(status){
    if(status == 'close' || status == 'open'){
        $.ajax({
            type:'post',
            url:baseUrl+'site/product/data',
            data:{status:status},
            dataType:'json',
            beforeSend:function(){
                waiting();
            },success:function(resp){
                $('#data').html(resp);
            },complete:function(){
                out();
            }

        })
    }else{
        error('Peringatan','Status yang dipilih salah');
    }
}
