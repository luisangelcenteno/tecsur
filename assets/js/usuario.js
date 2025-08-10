var tblUsuario, numrowtable;

selectData('usuarios/perfil', 'nperfil');
selectData('usuarios/cargo', 'ncargo');
selectData('usuarios/area', 'narea');
selectData('usuarios/tdocumento', 'ntdocumento');

function msg(msg) {
	notifyMessage('exclamation-triangle', msg, 'warning');
	return false;
}

$(document).ready(function() {
	listaUsuario();

	$("#frmCambio").unbind('submit').bind('submit', function(){
		$.ajax({
			url: 'usuarios/cambio',
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
					tblUsuario.ajax.reload(null, false);
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

	$("#frmPassword").unbind('submit').bind('submit', function(){
		let ppassword = $("#ppassword").val();
		if(ppassword == null || ppassword == '' || ppassword == undefined) {
			notifyMessage('exclamation-triangle', 'Ingresa la nueva contraseña.', 'warning');
		} else {
			$.ajax({
				url: 'usuarios/password',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					buttonLoad('btnFrmPassword', 'Cambiando');
				},
				success: function(response){
					buttonNormal('btnFrmPassword', 'Cambiar', 'edit');
					if (response.verify == true) {
						notifyMessage('check', response.msg, 'success');
						tblUsuario.ajax.reload(null, false);
						$("#modalPassword").modal("hide");
					} else {
						notifyMessage('exclamation-triangle', response.msg, 'warning');
					}
				},
				error:function() {
					buttonNormal('btnFrmPassword', 'Cambiar', 'edit');
					notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
				}
			});
		}
        return false;
	});

	$("#frmRegistrar").unbind('submit').bind('submit', function(){
		let nperfil = $("#nperfil").val();
		let ncargo = $("#ncargo").val();
		let narea = $("#narea").val();
		let ntdocumento = $("#ntdocumento").val();
		let nndocumento = $("#nndocumento").val();
		let nnombre = $("#nnombre").val();
		let nappaterno = $("#nappaterno").val();
		let napmaterno = $("#napmaterno").val();
		let ncorreo = $("#ncorreo").val();

		if(nperfil == null || nperfil == '' || nperfil == undefined || nperfil == 0) { msg('Selecciona un perfil'); }
		if(ncargo == null || ncargo == '' || ncargo == undefined || ncargo == 0) { msg('Selecciona un cargo'); }
		if(narea == null || narea == '' || narea == undefined || narea == 0) { msg('Selecciona un área'); }
		if(ntdocumento == null || ntdocumento == '' || ntdocumento == undefined || ntdocumento == 0) { msg('Selecciona un tipo de documento'); }
		if(nndocumento == null || nndocumento == '' || nndocumento == undefined) { msg('Ingresa un número de documento'); }
		if(nnombre == null || nnombre == '' || nnombre == undefined) { msg('Ingresa el nombre'); }
		if(nappaterno == null || nappaterno == '' || nappaterno == undefined) { msg('Ingresa el apellido paterno'); }
		if(napmaterno == null || napmaterno == '' || napmaterno == undefined) { msg('Ingresa el apellido materno'); }
		if(ncorreo == null || ncorreo == '' || ncorreo == undefined) { msg('Ingresa el correo electrónico'); }
		
		$.ajax({
			url: 'usuarios/registrar',
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
					tblUsuario.ajax.reload(null, false);
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
        return false;
	});

	$("#frmEditar").unbind('submit').bind('submit', function(){
		let nperfil = $("#eperfil").val();
		let ncargo = $("#ecargo").val();
		let narea = $("#earea").val();
		let ntdocumento = $("#etdocumento").val();
		let nndocumento = $("#endocumento").val();
		let nnombre = $("#enombre").val();
		let nappaterno = $("#eappaterno").val();
		let napmaterno = $("#eapmaterno").val();
		let ncorreo = $("#ecorreo").val();
		let cusuario = $("#ec_usuario").val();

		if(nperfil == null || nperfil == '' || nperfil == undefined || nperfil == 0) { msg('Selecciona un perfil'); }
		if(ncargo == null || ncargo == '' || ncargo == undefined || ncargo == 0) { msg('Selecciona un cargo'); }
		if(narea == null || narea == '' || narea == undefined || narea == 0) { msg('Selecciona un área'); }
		if(ntdocumento == null || ntdocumento == '' || ntdocumento == undefined || ntdocumento == 0) { msg('Selecciona un tipo de documento'); }
		if(nndocumento == null || nndocumento == '' || nndocumento == undefined) { msg('Ingresa un número de documento'); }
		if(nnombre == null || nnombre == '' || nnombre == undefined) { msg('Ingresa el nombre'); }
		if(nappaterno == null || nappaterno == '' || nappaterno == undefined) { msg('Ingresa el apellido paterno'); }
		if(napmaterno == null || napmaterno == '' || napmaterno == undefined) { msg('Ingresa el apellido materno'); }
		if(ncorreo == null || ncorreo == '' || ncorreo == undefined) { msg('Ingresa el correo electrónico'); }
		if(cusuario == null || cusuario == '' || cusuario == undefined) { msg('Selecciona a un usuario'); }

		$.ajax({
			url: 'usuarios/editar',
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
					tblUsuario.ajax.reload(null, false);
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
        return false;
	});

});

$("#btnRegistrarUsuario").click(function() {
	$('#nperfil').val(0);
	$('#ncargo').val(0);
	$('#narea').val(0);
	$('#ntdocumento').val(0);
	$('#nndocumento').val('');
	$('#nnombre').val('');
	$('#nappaterno').val('');
	$('#napmaterno').val('');
	$('#ncorreo').val('');
	$('#modalRegistrar').modal('show');
});

$('#tblUsuario tbody').on('click', 'tr', function () {
	numrowtable = tblUsuario.row(this).index();
});

function listaUsuario(){
	tblUsuario = $("#tblUsuario").DataTable({
		"destroy": true,
		"dom": 'Bftip',
        "processing": true,
		"responsive": true,
		"lengthChange": false,
		"autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print"],
        "ajax": {
            "url": "usuarios/lista",
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
			$('#titleCambio').html('<i class="fas fa-trash"></i> Eliminar usuario');
			$("#mensaje").text('¿Deseas eliminar al usuario?');
			$("#btnFrmCambio").html('<i class="fa fa-trash"></i> Eliminar').removeClass('btn-success').addClass('btn-danger');
			break;
		case '1':
			$('#titleCambio').html('<i class="fas fa-check"></i> Activar usuario');
			$("#mensaje").text('¿Deseas activar al usuario?');
			$("#btnFrmCambio").html('<i class="fa fa-check"></i> Activar').removeClass('btn-danger').addClass('btn-success');
			break;
	}
}

function cambio(c_usuario, n_valor) {
	setTimeout(() => {
		let x_nombre = tblUsuario.cell(numrowtable, 2).data();
		let x_appaterno = tblUsuario.cell(numrowtable, 3).data();
		let x_apmaterno = tblUsuario.cell(numrowtable, 4).data();
		let x_usuario = x_nombre+' '+x_appaterno+' '+x_apmaterno;
		$('#modalCambio').modal('show');
		$('#x_usuario').text(x_usuario);
		$('#c_usuario').val(c_usuario);
		$('#n_valor').val(n_valor);
		x_valor = n_valor;
		botonEstado(n_valor);
	}, 500);
}

function password(c_usuario){
	setTimeout(() => {
		$('#ppassword').val('');
		let x_nombre = tblUsuario.cell(numrowtable, 2).data();
		let x_appaterno = tblUsuario.cell(numrowtable, 3).data();
		let x_apmaterno = tblUsuario.cell(numrowtable, 4).data();
		let x_usuario = x_nombre+' '+x_appaterno+' '+x_apmaterno;
		$('#modalPassword').modal('show');
		$('#pc_usuario').val(c_usuario);
		$('#pusuario').val(x_usuario);
	}, 500);
}

function editar(c_usuario){
	setTimeout(() => {
		let x_ndocumento = tblUsuario.cell(numrowtable, 1).data();
		let x_nombre = tblUsuario.cell(numrowtable, 2).data();
		let x_appaterno = tblUsuario.cell(numrowtable, 3).data();
		let x_apmaterno = tblUsuario.cell(numrowtable, 4).data();
		$('#modalEditar').modal('show');
		$('#ec_usuario').val(c_usuario);
		$('#endocumento').val(x_ndocumento);
		$('#enombre').val(x_nombre);
		$('#eappaterno').val(x_appaterno);
		$('#eapmaterno').val(x_apmaterno);
	}, 500);
	seleccionar(c_usuario);
}

function seleccionar(c_usuario){
	$.ajax({
		url: 'usuarios/user',
		type: 'POST',
		data: {csrf_token_tecsur: token_csrf, cusuario: c_usuario},
		dataType: 'json',
		success: function(response){
			$('#eperfil').val(response.perfil);
			$('#ecargo').val(response.cargo);
			$('#earea').val(response.area);
			$('#etdocumento').val(response.documento);
			$('#ecorreo').val(response.usuario);
		},
		error:function() {
			notifyMessage('exclamation-triangle', 'Error en el proceso.', 'warning');
		}
	});
}
