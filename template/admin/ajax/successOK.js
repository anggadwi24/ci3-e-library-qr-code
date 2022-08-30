export default function successOK(title,msg,redirect){
    swal({
        title:title,
        text: msg,
        type: 'success',
      
        confirmButtonColor: '#334a65',
        confirmButtonText: 'OK',
     
      },function(isConfirm){
				if (isConfirm) {
					window.location = redirect;
				} else {
					
				}
			});
    }