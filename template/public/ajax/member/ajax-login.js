import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";
import waiting from "../loading.js";




$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);

      
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'site/auth/do',
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
                window.location = resp.redirect;
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

