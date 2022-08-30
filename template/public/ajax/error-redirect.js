export default function errorRedirect(title,msg,redirect){
    swal({
        title:title,
        text: msg,
        type: 'warning',
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