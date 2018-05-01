@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style>
  li{
    cursor: pointer;    
  }
  li:hover{
    
  }
</style>
@section('main-content')
  @if(Auth::user()->tipo_users_id==1 || Auth::user()->tipo_users_id==2)
    <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading">
            Reporte por diagnostico
          </div>
          <div class="panel-body">
            <form  id="frmDiario">
              <div class="form-group">
                <label class="col-sm-1">Desde:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control input-sm" id="fecIniD">
                </div>
                <label class="control-label col-sm-1">Hasta:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control input-sm" id="fecFinD">
                </div>
                <label class="control-label col-sm-1">Diagnostico:</label>
                <div class="col-sm-3"
                >
                  <select name="diagnostico" id="diagnostico" class="form-control input-sm select2">
                    <option value="Seleccionar">Seleccionar</option>           
                    <?php 
                      $cie=DB::table('cie')->where('cod_cat','like','%h%')->get();
                     ?>
                    @foreach ($cie as $t)
                      <option value="{{$t->desc_enf}}">{{$t->desc_enf}}</option>
                    @endforeach
                  </select>
                </div>
                <a class="btn btn-success btn-sm" id="btnBus">Generar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <a href="#" class="btn btn-info" id="printRD"><i class="fa fa-print">Imprimir</i></a>
      </div>
      <div id="reporteDiagnostico">
        
      </div>
  @else
  @include('adminlte::errors.503')
  @endif  
<!--Incio modal de lista de pacientes -->

<!--Fin Modal de atenciones al año -->
@endsection
            
 
<script src="{{ asset('js/funcionesReporte.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}"></script>  
<script>

</script>