import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";

$('.dateTime').bootstrapMaterialDatePicker({ 
    format : 'YYYY-MM-DD HH:mm' 

});  
$(document).on('change','#status',function(){
    var status = $(this).val();
    if(status == 'preorder'){
        $('.formBatch').css('display','');
    }else{
        $('.formBatch').css('display','none');
    }
})
$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    $(document).ajaxStart(function() { Pace.restart(); });
      
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'produk/store',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
           
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            
            if(resp.status == true){
                $('input').val('');
                $('select').val('');
                $('textarea').val('');

                
                successBack('Berhasil',resp.msg,resp.redirect);
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

$(document).on('change keyup','#count',function(){
    var total = $(this).val();
    var html = $('.formBatch').html();
    var count = $('.formBatch').length;
    if(total > 0){
        if(total > count){
            for(var i = count; i < total; i++){
                var newHtml = '<div class="col-12 my-1 formBatch child">'+html+'</div>';
                $('#place').append(newHtml);
                $('.dateTime').bootstrapMaterialDatePicker({ 
                    format : 'YYYY-MM-DD HH:mm' 
                
                });  
            }
        }else{
            var sel = count-total;
            for(var i = 0; i < sel; i++){
                $('.formBatch').last().remove();
            }
        }
    }else{
        error('Peringatan','Jumlah batch tidak boleh kosong');
    }
    


});
$(document).on('click','button[type="reset"]',function(){
    $('.child').remove();
})
