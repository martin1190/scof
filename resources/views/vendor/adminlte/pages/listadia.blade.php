<style>
    
</style>
<table style="margin: 0 auto;" border="1" id="tblD">
    <thead style="background-color: #2F65ED; color: #FFFFFF;">
        <tr>
            <th>N°</th>
            <th>N°H</th>
            <th>N°C</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>T. Servicio</th>
            <th>Fecha</th>
            <th>Plan Medico</th>            
            <th>Estado</th>
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
            <tr style="height: 20px;">
                <td>{{$no}}</td>
                <td>{{$r->nhistoria}}</td>
                <td>{{$r->nconsulta}}</td>
                <td>{{$r->nombre}}</td>
                <td style="text-align: center;">{{$r->edad}}</td>
                <td>{{$r->tipo}} </td>
                <td>{{$r->fecha}} </td>
                <td style="text-align: center;">{{$r->planmed}} </td>            
                <td>{{$r->estado}} </td>
            </tr>
        @endforeach

    </tbody>
</table> 
