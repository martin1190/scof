<style>

</style>
<table class="table table-striped table-bordered table-hover" id="tblAtenAnno">
    <thead>
        <tr>
            <th>N°Historia</th>
            <th>Nombre</th>
            <th>N°Consulta</th>            
            <th>Fecha</th>
            <th>Plan Medico</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($respuesta as $r)
            <tr>                
                <td>{{$r->id}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->fechacon}}</td>
                <td>{{$r->planmedico}} </td>          
            </tr>
        @endforeach
    </tbody>
</table> 