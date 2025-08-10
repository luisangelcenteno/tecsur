var tblCategoria;

$(document).ready(function() {
	listaCategoria();
});

function listaCategoria(){
	tblCategoria = $("#tblCategoria").DataTable({
		"destroy": true,
		"dom": 'Bftip',
        "processing": true,
		"responsive": true,
		"lengthChange": false,
		"autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print"],
        "ajax": {
            "url": "categorias/lista",
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
	}).buttons().container().appendTo('#tblCategoria_wrapper .col-md-5:eq(0)');
}
