var token_csrf = $('input[name="csrf_token_tecsur"]').val();

function selectData(url, nameSelect){
	$.ajax({
		url : url,
		type : "POST",
		data: {csrf_token_tecsur: token_csrf},
		dataType : 'json',
		async: false,
		beforeSend: function() {
			$(`.${nameSelect}`).html('<option value="0">Cargando ...</option>');
		},
		success:function(response){
			if (response.verify == true) {
				$(`.${nameSelect}`).html('<option value="0">SELECCIONA</option>');
				for (var i = 0; i < response.contar; i++) {
					$(`.${nameSelect}`).append(`<option value="${response.id[i]}">${response.name[i]}</option>`);
				}
			} else {
				$(`.${nameSelect}`).html('<option value="0">Error al cargar</option>');
			}
		},
		error: function() {
			$(`.${nameSelect}`).html('<option value="0">Error al cargar datos</option>');
		},
	});
}

function selectDataAll(url, nameSelect){
	$.ajax({
		url : url,
		type : "POST",
		data: {csrf_token_tecsur: token_csrf},
		dataType : 'json',
		async: false,
		beforeSend: function() {
			$(`.${nameSelect}`).html('<option value="0">Cargando ...</option>');
		},
		success:function(response){
			if (response.verify == true) {
				$(`.${nameSelect}`).html('<option value="0">TODOS</option>');
				for (var i = 0; i < response.contar; i++) {
					$(`.${nameSelect}`).append(`<option value="${response.id[i]}">${response.name[i]}</option>`);
				}
			} else {
				$(`.${nameSelect}`).html('<option value="0">Error al cargar</option>');
			}
		},
		error: function() {
			$(`.${nameSelect}`).html('<option value="0">Error al cargar datos</option>');
		},
	});
}

$(document).ready(function() {
	$("#frmCambioPassword").unbind('submit').bind('submit', function(){
		let mipassword = $("#mipassword").val();
		if(mipassword == null || mipassword == '' || mipassword == undefined) {
			notifyMessage('exclamation-triangle', 'Ingresa la nueva contraseña.', 'warning');
		} else {
			$.ajax({
				url: 'main/mipassword',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					buttonLoad('btnFrmCambioPassword', 'Cambiando');
				},
				success: function(response){
					buttonNormal('btnFrmCambioPassword', 'Cambiar', 'edit');
					if (response.verify == true) {
						notifyMessage('check', response.msg, 'success');
						$("#modalCambioPassword").modal("hide");
					} else {
						notifyMessage('exclamation-triangle', response.msg, 'warning');
					}
				},
				error:function() {
					buttonNormal('btnFrmCambioPassword', 'Cambiar', 'edit');
					notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
				}
			});
		}
        return false;
	});
});

$("#menuCambioPassword").click(function() {
	$('#mipassword').val('');
	$('#modalCambioPassword').modal('show');
});

function buttonLoad(nameButton, text){
    $("body").css("cursor", "wait");
    $(`.${nameButton}`).html(`<i class="fas fa-spinner fa-spin"></i> ${ text } ...`);
	$(`.${nameButton}`).attr("disabled", true);
}

function buttonNormal(nameButton, text, iIcon){
    $("body").css("cursor", "default");
    $('.loader').addClass('none');
    $(`.${nameButton}`).html(`<i class="fas fa-${iIcon}"></i> ${text}`);
	$(`.${nameButton}`).attr("disabled", false);
}

function notifyMessage(iIcon, text, model){
    var notify = $.notify({ icon: 'fas fa-'+iIcon, title: ' ', message: "&nbsp;"+ text
    },{ element: 'body', type: model, allow_dismiss: false, placement: { from: "top", align: "right" }, delay: 2000});
}
