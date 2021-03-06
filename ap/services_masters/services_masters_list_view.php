<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">SERVICIOS</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Grúa</th>
					<th>Nombres y apellidos operador</th>
					<th>Número de servicio</th>
					<th>Inicio del servicio</th>
					<th>Fin del servicio</th>
					<th>Estatus cliente</th>
					<th>Estatus grúa</th>
					<th>Motivo</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Grúa</th>
					<th>Nombres y apellidos operador</th>
					<th>Número de servicio</th>
					<th>Inicio del servicio</th>
					<th>Fin del servicio</th>
					<th>Estatus cliente</th>
					<th>Estatus grúa</th>
					<th>Motivo</th>
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	
</div>

	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/ap/services_masters/index.php?action=services_masters_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
		"order": [[ 3, "desc" ]],
        "columns": [
            { "data": "idGrua" },
			{ "data": "NombresApellidos" },
			{ "data": "IdSolicitud" },
            { "data": "TimeInicio" },
            { "data": "TimeFin" },
            { "data": "EstatusCliente" },
            { "data": "EstatusGrua" },
            { "data": "Motivo" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 8] }
       ]				
    });
} );

</script>
