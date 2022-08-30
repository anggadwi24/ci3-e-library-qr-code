import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";



$("#dob").dateDropper( {
    dropWidth: 200,
    format: "Y-m-d",
    defaultDate: $('#dob').val(),
    dropPrimaryColor: "#1abc9c", 
    dropBorder: "1px solid #1abc9c"
});

$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
  
    
    formData.append('id',basePath('id'));
  
    $.ajax({
        type:'POST',
        url:baseUrl+'siswa/update',
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
               

                
                successBack('Berhasil',resp.msg,resp.redirect);
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
$(document).on('submit','#formLogin',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
  
    
    formData.append('id',basePath('id'));
  
    $.ajax({
        type:'POST',
        url:baseUrl+'siswa/updateLogin',
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
               

                
                successBack('Berhasil',resp.msg,resp.redirect);
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

