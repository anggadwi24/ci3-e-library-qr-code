export default function successRedirect(title,msg,redirect){
    swal({
        title:title,
        text: msg,
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#334a65',
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Tetap disini',
      },function(isConfirm){
				if (isConfirm) {
					window.location = redirect;
				} else {
				
				}
			});
    }