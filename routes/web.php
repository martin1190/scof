<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    route::post('/DatosPaciente/{datos}','pacienteController@Datos');
    route::resource('Paciente','pacienteController');
    route::post('listaDia','pacienteController@listaDia');
    route::post('AddConsultaDia','pacienteController@AddConsultaDia');
    route::resource('Consulta','consultaController');
    route::post('listaAtencion','pacienteController@listaAtencion');
    route::resource('Atencion','atencionController');
    route::get('listaCom','atencionController@listaCom');
    Route::POST('RegistroConsulta','consultaController@registroCon');
    route::get('Consultapdf/{nc}/{idp} ','consultaController@pdfConsulta');
    route::get('historia/{nc}/{idp}','consultaController@historia');
    route::get('cie','consultaController@autoDiag');
    route::post('Accie','consultaController@cargarCie');
    route::get('Aenf/{$co}','consultaController@cargarEnf');
    route::get('cambio','consultaController@cambiocie_diag');  
    route::get('cambio1','consultaController@cambio_desc'); 
    route::get('carcomp','consultaController@cargarCompania');
    route::get('cantidadC','consultaController@cantidadC');
    route::resource('compania','companiaController');
    route::post('listaAseguradora','companiaController@listaAseguradora');
    route::get('Aseguradora','companiaController@VAseguradora');
    route::post('RAseguradora','companiaController@RegistroAseguradora');
    route::post('CargarAs','companiaController@cargarAseguradoras');
    route::post('ModAseg','companiaController@modificarAseguradora');
    route::post('EliAse','companiaController@EliminarAseguradora');
    route::get('listaCompania','companiaController@cargarCompania');
    route::get('obComp','pacienteController@ObtenerCompania');
    route::get('ConAn/{idP}','pacienteController@consultaAnno');  
    route::get('Costos','companiaController@MostrarCosto');
    route::post('ACostos/{id}/{cos}','companiaController@actualizarCostos');
    route::get('Historia','historiaController@Principal');
    route::get('HistoriaD','historiaController@BuscarDni');
    route::get('HistoriaN','historiaController@BuscarNombre');    
    route::get('editHistoria/{idc}','historiaController@CargarHistoria');
    route::get('cargaDatosHCD/{idc}','historiaController@cargarHCD');
    route::post('editHistoria','historiaController@EditarHistoria');
    route::get('Refraccionpdf/{idp}/{ncon}','consultaController@pdfRefraccion');
    route::get('Refraccion/{idp}/{ncon}','consultaController@popRefraccion');
    route::get('Recetapdf/{idp}/{ncon}','consultaController@recetapdf');
    route::get('Receta/{idp}/{ncon}','consultaController@recetapop');    
    route::post('ActualizarD    iagnostico','historiaController@ActualizarDiagnostico');
    route::post('AgregarDiagnostico','historiaController@AgregarDiagnostico');
    route::post('eliminarDiagnostico','historiaController@eliminarDiagnostico');
    route::post('ActualizarTratamiento','historiaController@actualizarTratamiento');
    route::post('ActualizarTratamiento','historiaController@actualizarTratamiento');
    route::post('EliminarTratamiento','historiaController@eliminarTratamiento');
    route::post('AgregarTratamiento','historiaController@agregarTratamiento');
    route::resource('Pagos','pagosController');
    route::get('MostrarProcedimiento/{idc}','pagosController@mostrarProcedimiento');
    route::delete('quitarProce/{idp}','pagosController@quitarProcedimiento');
    route::post('AgregarProcedimiento','pagosController@agregarProcedimiento');
    route::get('listaPago','pagosController@listaPagos');
    route::get('pagoProcedimiento','pagosController@RegistroPagos');
    route::get('preLiquidacion/{fecha}','pagosController@preliquidacion');
    route::get('cargaCompania', 'companiaController@cargarCompania1');
    route::post('listaHistoriaP','historiaController@hisPac');
    route::resource('Usuario','usuarioController');
    route::get('ListaU','usuarioController@ListaU');
    route::get('Lista','usuarioController@UsuariosLista');
    route::post('MPassword','usuarioController@updateContra');
    route::get('ParteDiario','reporteController@diario');
    route::get('ReporteDia','reporteController@listaDia');
    route::get('ReporteDiaPDF','reporteController@diaGenPDF');
    route::get('ReporteDiaFecha','reporteController@ReporteDF');
    route::get('ReporteDiaFechaG/{fechaI}/{fechaF}/{tipo}','reporteController@ReporteDFF');
    route::get('ReporteDiagnostico','reporteController@ReporteDiagnostico');
});
