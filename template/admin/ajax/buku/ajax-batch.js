import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";

$('.dateTime').bootstrapMaterialDatePicker({ 
    format : 'YYYY-MM-DD HH:mm' 

});  

$(document).on('click','.edit',function(){
    var id = $(this).attr('data-id');
    $.ajax({
        type :'POST',
        url : baseUrl+'produk/dataBatch',
        data : {id:id},
        dataType:'json',
        beforeSend:function(){
            $(document).ajaxStart(function() { Pace.restart(); });
        },success:function(resp){
            if(resp.status == true){
                
                $('#idb').val(resp.arr.id);
                $('#batch').val(resp.arr.batch);
                $('#start').val(resp.arr.mulai);
                $('#end').val(resp.arr.selesai);
              
                $('#modalEdit').modal('show');
            }else{
                error('Peringatan',resp.msg);
            }
        },complete:function(){
        }
    })
})