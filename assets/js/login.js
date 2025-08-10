$(document).ready(function() {
	
	document.getElementById("x_usuario").focus();

	$("#frmIngresar").unbind('submit').bind('submit', function(){
		$.ajax({
			url: '/tecsur/auth/validate',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'json',
			beforeSend: function() {
				buttonLoad('btnIngresar', 'Cargando');
			},
			success: function(xhr){
				buttonNormal('btnIngresar', 'Ingresar', '');
				if (xhr.verify) {
					window.location.replace(xhr.url);
				} else {
					$('.x_input').val('');
					notifyMessage('exclamation-circle', xhr.msg, 'info');
				}
			},
			error: function(error) {
				buttonNormal('btnIngresar', 'Ingresar', '');
				notifyMessage('exclamation-circle', error, 'danger');
			}
		});
		return false;
	});
	
});
