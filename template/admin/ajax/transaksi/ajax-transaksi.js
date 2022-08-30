import baseUrl from "../base.js";
import basePath from "../domain.js";

import success from "../success.js";
import successBack from "../success-back.js";
import successRedirect from "../success-redirect.js";

import error from "../error.js";

$(document).on('click','#refresh',function(){
    data();
})


$(document).on('submit','#formAct',function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
   
      
    
    
  
    $.ajax({
        type:'POST',
        url:baseUrl+'transaksi/data',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        dataType :'json',
        beforeSend:function(){
            $('#data').html('<div class="loader-block"><div class="preloader6"><hr> </div></div>');
            $('input').attr('disabled',true);
            $('select').attr('disabled',true);
            $('button').attr('disabled',true);
            $('textarea').attr('disabled',true);



        },success:function(resp){
            $('#data').html(resp);
            $('#simpletable').DataTable({
                "order": [],
            });
            
        },complete:function(){
     
            $('input').attr('disabled',false);
            $('select').attr('disabled',false);
            $('button').attr('disabled',false);
            $('textarea').attr('disabled',false);




           
        }
    })
            
   
})
data();
function data(){
    var start = $('#start').val();
    var end = $('#end').val();
    var siswa = $('#siswa').val();
    var buku = $('#buku').val();
    var status = $('#status').val();
    $.ajax({
        type :'POST',
        url : baseUrl+'transaksi/data',
        data : {start:start,end:end,siswa:siswa,buku:buku,status:status},
        dataType:'json',
        beforeSend:function(){
            $('#data').html('<div class="loader-block"><div class="preloader6"><hr> </div></div>');
        }
        ,success:function(resp){
            $('#data').html(resp);
            $('#simpletable').DataTable({
                "order": [],
            });
        }
        ,complete:function(){
          
        }
    })
}