@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style>
  li:hover{
    background-color: #105FE1;
    color: #ECECEC;
  }
</style>
@section('main-content')

	@if (Auth::user())
    <div class="container-fluid spark-screen">
            <div class="row">
                <div class="col-md-12">
                     <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#registro"><i class="fa fa-plus">Nuevo Paciente</i></a>
                     <a class="btn btn-success btn-sm"><i class="fa fa-search">Antiguo Paciente</i></a>
                     <a class="btn btn-warning btn-sm"><i class="fa fa-list" data-toggle="modal" data-target="#lista" onclick="cargarDia()">Lista de pacientes</i></a>
                </div>
            </div>
        <div class="row">
          <div class="col-md-12">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Consulta de Pacientes</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <form action="" class="form-horizontal">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                  <label class="col-sm-1 control-label">DNI</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control input-sm" id="dniPaciente" onchange="desNom()" minlength="8" maxlength="10">

                  </div>
                  <label class="col-sm-1 control-label">Nombre</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control input-sm" id="nombrePaciente" onchange="desDNI()">
                  </div>
                  <a class="btn btn-info btn-sm" onclick="BuscarPaciente()">Buscar</a>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          <div id="upload-img" style="display: none;"></div>
          </div>
        </div>
        <div class="row">
          <div id="historia">
            
          </div>
        </div>
      </div>

        <!-- Modal de registro-->
    <div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Registro de Pacientes</div>
                <div class="panel panel-body">
                  <form class="form-horizontal" id="frmPaciente">
                      <div class="form-group">
                          <label class="col-sm-1 control-label">Nombres:</label>
                          <div class="col-sm-7">
                              <input type="text" class="form-control input-sm " id="nombre" name="nombre">
                              <span class="help-block" style="display: none"></span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-1 control-label">DNI:</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control input-sm" id="nuevodni" name="dni" maxlength="8">
                              <span class="help-block"></span>
                          </div>
                          <label class="col-sm-1 control-label">Nacimiento:</label>
                          <div class="col-sm-3">
                              <input type="date" class="form-control input-sm" id="fecnac" name="fecnac">
                          </div>
                          <label class="col-sm-1 control-label">Sexo:</label>
                          <div class="col-sm-3">
                              <select name="sexo" id="sexo" class="form-control input-sm">
                                  <option value="">Seleccionar</option>
                                  <option value="Masculino">Masculino</option>
                                  <option value="Femenino">Femenino</option>
                              </select>
                          </div>                                            
                      </div>
                      <div class="form-group">
                          <label  class="control-label col-sm-1">Direccion</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control input-sm" name="direccion" id="direccion">
                          </div>
                          <label class="control-label col-sm-1">E-mail</label>
                          <div class="col-sm-3">
                              <input type="email" class="form-control input-sm" name="email" id="email">
                          </div>
                          <label class="control-label col-sm-1">Telefono</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control input-sm" name="telefono" id="telefono">
                          </div>                      
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-1">Tipo de Servicio</label>
                          <div class="col-sm-3" id="Rta">
                              <select name="tipo_servicio_id" id="tipoServicio" class="form-control input-sm">
                                  <option value="">Seleccionar</option>                              
                                  <?php 
                                    $as=DB::table('tipo_seguro')->get();
                                   ?>
                                   @foreach($as as $as)
                                    <option value="{{$as->id}}">{{$as->nombre_aseguradora}}</option>
                                   @endforeach
                              </select>
                          </div>
                          <label class="control-label col-sm-1">Compañia</label>
                          <div class="col-sm-3">
                           <select name="compania" id="compania" class="form-control select2" style="width: 100%;" disabled>
                            <option value="Seleccionar">Seleccionar</option>

                          </select>
                          </div>
                          <div id="abtn">
                            <a href="#" id="btnmac" data-toggle="modal" data-target="#modalCompa" class="btn btn-sm bg-navy"><i class="fa fa-plus"></i></a>                        
                          </div>
                          <label class="control-label col-sm-1">Parentesco</label>
                          <div class="col-sm-3" id="Rcol">
                              <select name="parentesco" id="parentesco" class="form-control input-sm">
                                  <option value="">Seleccionar</option>
                                  <option value="Titular">Titular</option>
                                  <option value="Conyuge">Conyuge</option>
                                  <option value="Hijo(a)">Hijo(a)</option>
                                  <option value="Madre">Madre</option>
                                  <option value="Padre">Padre</option>
                              </select>
                          </div>                                            
                      </div>
                      <div class="form-group">
                          <label class="col-sm-1 control-label">Plan Medico</label>
                          <div class="col-sm-3">
                              <select name="planmedico" id="planmedico" class="form-control input-sm">
                                  <option value="">Seleccionar</option>
                                  <option value="CONSULTA" selected="">Consulta</option>
                                  <option value="MEDIDA DE LA VISTA">Medida de la Vista</option>
                                  <option value="SCTR">SCTR</option>
                                  <option value="EVALUACION PREVENTIVA">Evaluacion Preventiva</option>
                              </select>
                          </div>
                          <label class="col-sm-1 control-label">Tipo de Atencion</label>
                          <div class="col-sm-3">
                              <select name="idtipo_plan" id="idtipo_plan" class="form-control input-sm">
                                  <option value="">Seleccionar</option>
                                  <?php 
                                  $tipoA=DB::table('tipo_atencion')->get();
                                   ?>
                                   @foreach ($tipoA as $a)
                                  <option value="{{$a->id}}">{{$a->tipo}}</option>
                                  @endforeach
                              </select>
                          </div>     
                      </div>
                      <div class="row">
                          <a  class="btn btn-success btn-sm" onclick="registroPaciente()" id="btnRegPac">Guardar</a>
                          <a  class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</a>
                      </div>
                  </form>                
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Fin modal de registro -->    
    <!--Incio modal de lista de pacientes -->
    <div class="modal fade" id="lista" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Lista de pacientes del dia</div>
                <div class="panel panel-body" id="tblLista">
                 
                </div>
            </div>
        </div>
      </div>
    </div>
    <!--Fin de modal de lista de pacientes -->
    <!--Incio modal de Complemento -->
    <div class="modal fade" id="complemento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Datos complementarios</div>
                <div class="panel panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Plan Medico</label>
                            <div class="col-sm-7">
                                <select name="planMedi" id="planMedi" class="form-control input-sm">
                                    <option value="">Seleccionar</option>
                                    <option value="CONSULTA" selected>Consulta</option>
                                    <option value="MEDIDA DE LA VISTA">Medida de la Vista</option>
                                    <option value="SCTR">SCTR</option>
                                    <option value="EVALUACION PREVENTIVA">Evaluacion Preventiva</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="idPer" id="idPer">
                            <label class="col-sm-5 control-label">Tipo Atencion</label>
                            <div class="col-sm-7">
                                <select name="tAtencion" id="tAtencion" class="form-control input-sm">
                                    <option value="">Seleccionar</option>
                                    <option value="AMBULATORIO" selected>Ambulatorio</option>
                                    <option value="EMERGENCIA">Emergencia</option>
                                    <option value="PREVENTIVA">Preventiva</option>
                                    <option value="DOMICILIARIA">Domiciliaria</option>
                                </select>                            
                            </div>                                           
                        </div>
                        <div class="form-group center-block">
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <a class="btn btn-info" onclick="AgregarParaConsulta()">Agregar</a>                        
                          </div>
                          <div class="col-md-4"></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!--Fin de modal de complemento-->
    <!--Inicio Modal de atenciones al año -->
    <div class="modal fade" id="AtenAnno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel panel-heading">Lista de consulta al año del Paciente</div>
                <div class="panel panel-body" id="tblListaAn">
                 
                </div>
            </div>
        </div>
      </div>
    </div>
    <!--Fin Modal de atenciones al año -->

    <!--Modal para agregar una compania -->
    <div class="modal fade" id="modalCompa" tabindex="-1" role="dialog" aria-labellebdy="gridSystemModalLabel">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="panel panel-danger">
            <div class="panel panel-heading">Agregar Companias</div>
            <div class="panel panel-body">
              <div class="container">
                <form id="frmcomp">
                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-1 control-label" for="nombreCompa">Nombre</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="nombreC" name="nombreC">
                      </div>                  
                    </div>
            
                  </div><br>
                  <div class="row">
                    <div class="form-group">
                      <label for="rucCom" class="col-sm-1 control-label"> RUC      
                      </label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" name="rucCo" id="rucCo">
                      </div>                  
                    </div>

                  </div><br>
                  <div class="row">
                    <div class="form-group">
                      <label for="aseguradora" class="col-sm-1 control-label">Aseguradora</label>
                        <div class="col-sm-3">
                          <select name="Aseguradora" id="Aseguradora" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php 
                              $as=DB::table('tipo_seguro')->get();
                             ?>
                             @foreach($as as $as)
                              <option value="{{$as->id}}">{{$as->nombre_aseguradora}}</option>
                             @endforeach
                          </select>                     
                        </div>                  
                    </div>               
                  </div><br>
                  <div class="row">
                    <div class="form-group">
                      <label for="copF" class="col-sm-1 control-label">Copago Fijo</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" id="coFi" name="coFi">
                      </div>
                      <label for="copV" class="col-sm-1 control-label">Copago Variable</label>
                      <div class="col-sm-2">
                        <input type="text" name="coVa" id="coVa" class="form-control input-sm">
                      </div>                
                    </div>
                  </div><br>
                  <div class="row center-block">
                    <a href="#" class="btn bg-olive btn-sm" id="btnAgregarC">Agregar</a> &nbsp; <a href="#" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    @include('adminlte::errors.503')

  @endif
  

@endsection
            
 
<script src="{{ asset('js/funcionesPaciente.js') }}"></script>     
<script src="{{ asset('js/validar.js') }}">


</script>  
<script>

window.addEventListener('load', function(){  

 
 }, false);  

</script>