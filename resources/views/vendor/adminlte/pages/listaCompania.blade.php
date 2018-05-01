<style>
    table{
        background: #B7FDC9;
    }
</style>
<table class="table table-striped table-bordered table-hover" id="tblD">
    <thead>
        <tr align="center">
            <th >N°</th>
            <th >Nombre</th>
            <th >RUC</th>
            <th >Aseguradora</th>
            <th >Acciones</th>
        </tr>                        
    </thead>
    <tbody>
        @foreach ($lista as $r)
            <tr>
                <td></td>
                <td>{{$r->nombre}}</td>
                <td align="center">{{$r->ruc}}</td>
                <?php 
                $ase=DB::table('tipo_seguro')->where('id','=',$r->tipo_seguro_id)->get();
                 ?>
                 @foreach ($ase as $a)
                    <td>{{$a->nombre_aseguradora}}</td>
                 @endforeach                
                <td align="center"><a class="btn btn-danger btn-sm tblc" onclick="eliminarCompania('{{$r->id}}','{{$r->nombre}}')"><i class="fa fa-trash"></i></a>&nbsp <a class="btn btn-info btn-sm tblc" onclick="CargarCompanias('{{$r->id}}')"><i class="fa fa-edit"></i></a></td>
            </tr>
        @endforeach

    </tbody>
</table> 