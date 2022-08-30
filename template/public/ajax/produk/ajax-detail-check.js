
import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";
import errorRedirect from "../error-redirect.js";



import error from "../error.js";
import waiting from "../loading.js";
import out from "../loadingOut.js";


$(document).on('click','#btnDone',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        type:'POST',
        url:baseUrl+'site/checkout/setDone',
        data:{id:id},
        dataType:'json',
        beforeSend:function(){
            waiting();      
        },
        success:function(resp){
            if(resp.status == true){
               
                successBack('Berhasil',resp.msg,resp.redirect);
            }else{
                error('Peringatan',resp.msg);
            }
        },
        complete:function(){
            out();   
        }

    })
})