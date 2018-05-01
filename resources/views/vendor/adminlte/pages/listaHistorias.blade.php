<style>
    table{
        
    }
</style>
<h3>Lista de Consulta por Paciente</h3>
<table class="table table-striped table-bordered " id="tblD">
    <thead>
        <tr>
            <th>N° H</th>
            <th>Nombre Paciente</th>
            <th>DNI</th>
            <th>N° Consulta</th>
            <th>Fecha</th>            
            <th>Acciones</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($datosH as $h)
            <tr>                
                <td align="center">{{$h->idp}}</td>
                <td>{{$h->nombre}}</td>
                <td>{{$h->dni}}</td>
                <td>{{$h->nconsulta}}</td>
                <td>{{$h->fechacon}} </td>
                <td align="center"><a class="btn btn-warning btn-sm dbt" onclick="editH({{$h->idc}})" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-info btn-sm dbt" id="btnCarA" onclick="pdfh({{$h->nconsulta}},{{$h->idp}})" data-toggle="tooltip" data-placement="top" title="Imprimir Historia"><i class="fa fa-print"></i></a> &nbsp;<a class="btn bg-olive btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Receta" onclick="receta({{$h->idp}},{{$h->nconsulta}})"><i class="fa fa-file-o"></i></a>&nbsp;<a class="btn bg-navy btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir Refraccion" onclick="refraccion({{$h->idp}},{{$h->nconsulta}})"><i class="fa fa-file-text"></i></a></td>                
            </tr>
        @endforeach

    </tbody>
</table> 
<script>
    function pdfh(nc, idpac){
        window.open('Consultapdf/'+nc+'/'+idpac, '_blank')
    }
    function editH(idc){
        window.open('editHistoria/'+idc,'_blank')        
    }
    function receta(idpac, nc){
        window.open('Receta/'+idpac+'/'+nc,'ventana','width=620,height=650,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO')        
    }

    function refraccion(idpac, nc){
        window.open('Refraccion/'+idpac+'/'+nc,'ventana','width=595,height=420,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO')
    }
</script>