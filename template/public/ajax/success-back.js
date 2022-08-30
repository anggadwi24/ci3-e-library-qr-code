export default function successBack(title,msg,redirect){
    swal({
        title:title,
        text: msg,
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#334a65',
        confirmButtonText: 'OK',
      
      },function(isConfirm){
				if (isConfirm) {
					window.location = redirect;
				} else {
					
				}
			});
    }