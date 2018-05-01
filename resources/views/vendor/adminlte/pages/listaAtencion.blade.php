<style>
    table{
        background: #B7FDC9;
    }
</style>
<table class="table table-striped table-bordered table-hover" id="tblD">
    <thead>
        <tr>
            <th>N°</th>
            <th>N°H</th>
            <th>N°C</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>T. Servicio</th>
            <th>Fecha</th>
            <th>Plan Medico</th>
            <th>T.Atencion</th>            
            <th>Atender</th>
        </tr>                        
    </thead>
    <tbody>
        @php 
            $no=0;
        @endphp
        @foreach ($respuesta as $r)
            @php
                $no++;
            @endphp
            <input type="hidden" value="{{$r->nhistoria}}" id="idAte">
            <input type="hidden" value="{{$r->atencion}}" id="Atencio">
            <input type="hidden" value="{{$r->nconsulta}}" id="ncons">
            <input type="hidden" value="{{$r->fecha}}" id="fecCo">
            <input type="hidden" value="{{$r->id}}" id="ida">
            <input type="hidden" value="{{$r->planmed}}" id="pmed">
            <tr>
                <td>{{$no}}</td>
                <td>{{$r->nhistoria}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->nombre}}</td>
                <td>{{$r->edad}}</td>
                <td>{{$r->tipo}} </td>
                <td>{{$r->fecha}} </td>
                <td>{{$r->planmed}} </td>
                <td>{{$r->atencion}} </td>                
                <td align="center"><a class="btn btn-primary btn-sm" id="DatosPaciente" onclick="CargaPac({{$r->nhistoria}},{{$r->id}},'{{$r->planmed}}')"><i class="fa fa-user-md"></i></a></td>
            </tr>
        @endforeach

    </tbody>
</table> 