$(document).on('click','.delete',function(){
  var href = $(this).attr('data-href');
    swal({
        title: 'Peringatan',
        text: 'apakah anda yakin menghapus data ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#334a65',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Tidak',
      },function(isConfirm){
				if (isConfirm) {
					window.location = href;
				} else {
					
				}
			});
})


  
    