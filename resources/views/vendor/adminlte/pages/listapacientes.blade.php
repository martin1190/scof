<style>
	table{
		background-color: #85F3D5;
	}
	#msj{
	color: #FB2323;
	text-align: center;
	}
</style>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>N°</th>
			<th>Nombre</th>
			<th>DNI</th>
			<th>Sexo</th>
			<th>Edad</th>
			<th>Telefono</th>			
			<th>Parentesco</th>
			<th>Tipo</th>
			<th>Accioness</th>
		</tr>
	</thead>
	<tbody>
		@foreach($respuesta as $da) 			
			<tr class="danger">
				<td>{{$da->id}} </td>
				<td>{{$da->nombre}} </td>
				<td>{{$da->dni}} </td>
				<td>{{$da->sexo}} </td>
				<td>{{$da->edad}} </td>
				<td>{{$da->telefono}} </td>				
				<td>{{$da->parentesco}} </td>
				<td>{{$da->tipo_seguro->nombre_aseguradora}} </td>
				<td>
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#complemento" onclick="AgregarId({{$da->id}})"><i class="glyphicon glyphicon-hand-up" ></i></a>
                    <a href="#" class="btn btn-primary btn-sm" onclick="consultasAnno({{$da->id}})"><i class="glyphicon glyphicon-list-alt"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="cargarDatosPaciente({{$da->id}})"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
			</tr>
		@endforeach
	</tbody>
</table>
