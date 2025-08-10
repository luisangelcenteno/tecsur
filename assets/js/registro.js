var tblRac;

selectData('registros/area', 'narea');

$("#btnBuscar").click(function() {
	listrac();
});

$("#btnRegistrar").click(function() {
	$('#nfecha').val('');
	$('#nsst').val('');
	$('#ndescripcion').val('');
	$('#nelemento').val('');
	$('#nareas').val(0);
	$('#nadjuntar').val('');
	document.querySelectorAll('[name=ntipo]').forEach((x) => x.checked = false);
	document.querySelectorAll('[name=ncategoria]').forEach((x) => x.checked = false);
	$("#frmRegistrar")[0].reset();
	$('#modalRegistrar').modal('show');
});

function msg(msg) {
	notifyMessage('exclamation-triangle', msg, 'warning');
	return false;
}

function listrac() {
	let tipo = $('#tipo').val();
	let estado = $('#estado').val();

	if(tipo == null || tipo == '' || tipo == undefined) { msg('Selecciona una solicitud'); }
	if(estado == null || estado == '' || estado == undefined) { msg('Selecciona un estado'); }

	tblRac = $("#tblRac").DataTable({
		"destroy": true,
		"processing": true,
		"ajax": {
			"url": "registros/racs",
			"type": "POST",
			"async": "false",
			"data": {csrf_token_tecsur: token_csrf, tipo: tipo, estado: estado},
			"dataSrc": function (json){
				if (json.data[1] == false) {
					msg(json.data[0]);
					json.data = false;
				}
				return json.data;
			}
		}
	});
}

$(document).ready(function() {

	bsCustomFileInput.init();
	listrac();

	$("#frmRegistrar").unbind('submit').bind('submit', function(){
		let nfecha = $("#nfecha").val();
		let nubicacion = $("#nubicacion").val();
		let ntipo = $('input[name=ntipo]:checked').val();
		let ncategoria = $('input[name=ncategoria]:checked').val();
		let ndescripcion = $("#ndescripcion").val();
		let nareas = $("#nareas").val();
		let nadjuntar = $("#nadjuntar").val();

		if(nfecha == null || nfecha == '' || nfecha == undefined) { msg('Ingresa una fecha'); }
		if(nubicacion == null || nubicacion == '' || nubicacion == undefined) { msg('Ingresa una ubicación'); }
		if(ntipo == null || ntipo == '' || ntipo == undefined || ntipo == 0) { msg('Selecciona un tipo de estandar'); }
		if(ncategoria == null || ncategoria == '' || ncategoria == undefined || ncategoria == 0) { msg('Selecciona una categoría'); }
		if(ndescripcion == null || ndescripcion == '' || ndescripcion == undefined) { msg('Ingresa una descripción'); }
		if(nareas == null || nareas == '' || nareas == undefined || nareas == 0) { msg('Selecciona el área'); }
		if(nadjuntar == null || nadjuntar == '' || nadjuntar == undefined) { msg('Selecciona un archivo'); }
		
		var form = $(this);
		$.ajax({
			url: 'registros/rac',
			type: 'POST',
			data : new FormData(form[0]),
            cache: false,
            contentType: false,
            processData: false,
			dataType: 'json',
			beforeSend: function() {
				buttonLoad('btnFrmRegistrar', 'Grabando');
			},
			success: function(response){
				buttonNormal('btnFrmRegistrar', 'Grabar', 'save');
				if (response.verify == true) {
					notifyMessage('check', response.msg, 'success');
					tblRac.ajax.reload(null, false);
					$("#modalRegistrar").modal("hide");
				} else {
					notifyMessage('exclamation-triangle', response.msg, 'warning');
				}
			},
			error:function() {
				buttonNormal('btnFrmRegistrar', 'Grabar', 'save');
				notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
			}
		});
        return false;
	});

	$("#frmAtender").unbind('submit').bind('submit', function(){
		let arecomendacion = $("#arecomendacion").val();
		if(arecomendacion == null || arecomendacion == '' || arecomendacion == undefined) {
			notifyMessage('exclamation-triangle', 'Ingresa una recomendación.', 'warning');
		} else {
			$.ajax({
				url: 'registros/atender',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					buttonLoad('btnFrmAtender', 'Atendiendo');
				},
				success: function(response){
					buttonNormal('btnFrmAtender', 'Atender', 'save');
					if (response.verify == true) {
						notifyMessage('check', response.msg, 'success');
						tblRac.ajax.reload(null, false);
						$("#modalAtender").modal("hide");
					} else {
						notifyMessage('exclamation-triangle', response.msg, 'warning');
					}
				},
				error:function() {
					buttonNormal('btnFrmAtender', 'Atender', 'save');
					notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
				}
			});
		}
        return false;
	});

});

function reporte(c_rac) {
	let url = '/tecsur/registros/reporte/'+c_rac;
	$('#modalReporte').modal('show');
	$('.iframeReporte').attr('src', url);
}

function atender(c_rac){
	$('#arecomendacion').val('');
	$('#c_rac').val(c_rac);
	$('#modalAtender').modal('show');
}
