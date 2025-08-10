var tblRac;

selectDataAll('seguimientos/area', 'narea');

$("#btnBuscar").click(function() {
	listrac();
});

function msg(msg) {
	notifyMessage('exclamation-triangle', msg, 'warning');
	return false;
}

function listrac() {
	let area = $('#area').val();
	let estado = $('#estado').val();
	if(area == null || area == '' || area == undefined) { msg('Selecciona un área'); }
	if(estado == null || estado == '' || estado == undefined) { msg('Selecciona un estado'); }

	tblRac = $("#tblRac").DataTable({
		"destroy": true,
		"processing": true,
		"ajax": {
			"url": "seguimientos/racs",
			"type": "POST",
			"async": "false",
			"data": {csrf_token_tecsur: token_csrf, area: area, estado: estado},
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
});

function reporte(c_rac) {
	let url = '/tecsur/seguimientos/reporte/'+c_rac;
	$('#modalReporte').modal('show');
	$('.iframeReporte').attr('src', url);
}
