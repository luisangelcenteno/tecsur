var tblArea, numrowtable;

$(document).ready(function() {
	listaArea();

	$("#frmCambio").unbind('submit').bind('submit', function(){
		$.ajax({
			url: 'areas/cambio',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'json',
			beforeSend: function() {
				buttonLoad('btnFrmCambio', 'Cargando');
			},
			success:function(response) {
				botonEstado(x_valor);
				buttonNormal('btnFrmCambio', '', '');
				if (response.verify == true) {
					tblArea.ajax.reload(null, false);
					$("#modalCambio").modal("hide");
					notifyMessage('check', response.msg, 'success');
				} else {
					notifyMessage('times-circle', response.msg, 'danger');
				}
			},
			error:function() {
				botonEstado(x_valor);
				buttonNormal('btnFrmCambio', '', '');
				notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
			}
		});
		return false;
	});

	$("#frmRegistrar").unbind('submit').bind('submit', function(){
		let descripcion = $("#rdescripcion").val();
		if(descripcion == null || descripcion == '' || descripcion == undefined) {
			notifyMessage('exclamation-triangle', 'Ingresa la descripción.', 'warning');
		} else {
			$.ajax({
				url: 'areas/registrar',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					buttonLoad('btnFrmRegistrar', 'Creando');
				},
				success: function(response){
					buttonNormal('btnFrmRegistrar', 'Crear', 'save');
					if (response.verify == true) {
						notifyMessage('check', response.msg, 'success');
						tblArea.ajax.reload(null, false);
						$("#modalRegistrar").modal("hide");
					} else {
						notifyMessage('exclamation-triangle', response.msg, 'warning');
					}
				},
				error:function() {
					buttonNormal('btnFrmRegistrar', 'Crear', 'save');
					notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
				}
			});
		}
        return false;
	});

	$("#frmEditar").unbind('submit').bind('submit', function(){
		let descripcion = $("#edescripcion").val();
		if(descripcion == null || descripcion == '' || descripcion == undefined) {
			notifyMessage('exclamation-triangle', 'Ingresa la descripción.', 'warning');
		} else {
			$.ajax({
				url: 'areas/editar',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					buttonLoad('btnFrmEditar', 'Editando');
				},
				success: function(response){
					buttonNormal('btnFrmEditar', 'Editar', 'edit');
					if (response.verify == true) {
						notifyMessage('check', response.msg, 'success');
						tblArea.ajax.reload(null, false);
						$("#modalEditar").modal("hide");
					} else {
						notifyMessage('exclamation-triangle', response.msg, 'warning');
					}
				},
				error:function() {
					buttonNormal('btnFrmEditar', 'Editar', 'edit');
					notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
				}
			});
		}
        return false;
	});

});

$("#btnRegistrarArea").click(function() {
	$('#rdescripcion').val('');
	$('#modalRegistrar').modal('show');
});

$('#tblArea tbody').on('click', 'tr', function () {
	numrowtable = tblArea.row(this).index();
});

function listaArea(){
	tblArea = $("#tblArea").DataTable({
		"destroy": true,
		"dom": 'Bftip',
        "processing": true,
		"responsive": true,
		"lengthChange": false,
		"autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print"],
        "ajax": {
            "url": "areas/lista",
            "type": "POST",
            "data": {csrf_token_tecsur: token_csrf},
            "dataSrc": function (json){
                if (json.data[1] == false) {
                    notifyMessage('exclamation-triangle', json.data[0], 'warning');
                    json.data = false;
                }
                return json.data;
            }
        }
	});
}

function botonEstado(n_valor){
	switch (n_valor) {
		case '0':
			$('#titleCambio').html('<i class="fas fa-trash"></i> Eliminar área');
			$("#mensaje").text('¿Deseas eliminar el área?');
			$("#btnFrmCambio").html('<i class="fa fa-trash"></i> Eliminar').removeClass('btn-success').addClass('btn-danger');
			break;
		case '1':
			$('#titleCambio').html('<i class="fas fa-check"></i> Activar área');
			$("#mensaje").text('¿Deseas activar el área?');
			$("#btnFrmCambio").html('<i class="fa fa-check"></i> Activar').removeClass('btn-danger').addClass('btn-success');
			break;
	}
}

function cambio(c_area, n_valor) {
	setTimeout(() => {
		let x_area = tblArea.cell(numrowtable, 2).data();
		$('#modalCambio').modal('show');
		$('#x_area').text(x_area);
		$('#c_area').val(c_area);
		$('#n_valor').val(n_valor);
		x_valor = n_valor;
		botonEstado(n_valor);
	}, 500);
}

function editar(c_area){
	setTimeout(() => {
		let x_area = tblArea.cell(numrowtable, 2).data();
		$('#modalEditar').modal('show');
		$('#ec_area').val(c_area);
		$('#edescripcion').val(x_area);
	}, 500);
}
