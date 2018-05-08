<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class reporteController extends Controller
{
    public function diario(){
    	return view('vendor.adminlte.pages.reportes.partediario');
    }
    public function listaDia(){
    	$ff='';
    	$li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
            where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
            p.tipo_seguro_id=ts.id and dp.fechacon=curdate() order by c.id asc');
    	return view('vendor.adminlte.pages.reportes.listadia',compact('li','ff'));
    }
    public function diaGenPDF(){
    	$fc=Carbon::now()->toDateString();  	
    	$li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
            where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
            p.tipo_seguro_id=ts.id and dp.fechacon=:fc order by c.id asc',['fc'=>$fc]);
        $vista=view('vendor.adminlte.pages.reportes.pdfDiaGen', compact('li'));
        $pdf=\App::make('dompdf.wrapper');                
        $pdf->loadHTML($vista);        
        return $pdf->stream('Reporte General Dia'); 				    	
    }

    //Funcion para obtener los resultados de consulta por fechas y por tipo
    public function ReporteDF(Request $request){
    	if ($request->ajax()) {
    		$fi=$request->fi;
    		$ff=$request->ff;
    		$ti=$request->t;
    		if($ti==0){
		    	$li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
                where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
                p.tipo_seguro_id=ts.id and dp.fechacon between :fin and :ffin order by c.id asc',['fin'=>$fi,'ffin'=>$ff]);
		    	return view('vendor.adminlte.pages.reportes.listadia',compact('li'));
    		}else{
		    	$li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
                    where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
            p.tipo_seguro_id=ts.id and dp.fechacon between :fin and :ffin and ts.id=:tp order by c.id asc',['fin'=>$fi,'ffin'=>$ff,'tp'=>$ti]);
		    	return view('vendor.adminlte.pages.reportes.listadia',compact('li'));    			
    		}
    	}else{
    		return Response()->json(['mensaje'=>'No se recibieron Datos']);
    	}
    }
    //Generar el pdf del reporte por un rango de fechas
    public function ReporteDFF($fi, $ff,$ti){        
    	if($ti==0){
		    $li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
                where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
                    p.tipo_seguro_id=ts.id and dp.fechacon between :fin and :ffin order by c.id asc',['fin'=>$fi,'ffin'=>$ff]);		
            $vista=view('vendor.adminlte.pages.reportes.pdfDiaGen', compact('li','fi','ff','ti
                '));
            $pdf=\App::make('dompdf.wrapper');                
            $pdf->loadHTML($vista);        
            return $pdf->stream('Reporte por fechas');
    	}else{
		    $li=DB::select('select p.id as idp,c.nconsulta,p.nombre, p.edad, p.sexo,pm.planmedico,ts.nombre_aseguradora, dp.fechacon  from consulta c, paciente p, planmedico pm, datoprevio dp,tipo_seguro ts
                where p.id=c.paciente_id and c.id=pm.consulta_id and dp.consulta_id=c.id and 
                p.tipo_seguro_id=ts.id and dp.fechacon between :fin and :ffin and ts.id=:tp order by c.id asc',['fin'=>$fi,'ffin'=>$ff,'tp'=>$ti]);	
            $vista=view('vendor.adminlte.pages.reportes.pdfDiaGen', compact('li','fi','ff','ti'));
            $pdf=\App::make('dompdf.wrapper');                
            $pdf->loadHTML($vista);        
            return $pdf->stream('Reporte por fechas');
    	}
   	
    }
    //Reportes para generar los diagnosticos
    public function ReporteDiagnostico(){
        return view('vendor.adminlte.pages.reportes.diagnostico.generarreportediagnostico');
    }

    //para obtener los datos del reporte por diagnostico
    public function genRerporteDiagnostico(Request $request){
        if($request->ajax()){
            $ddg=DB::select('select p.id, c.nconsulta, p.nombre, pm.planmedico, dp.fechacon, d.diagnostico, d.cie from paciente p, consulta c, planmedico pm, datoprevio dp, diagnostico d
                where p.id=c.paciente_id and  c.id=pm.consulta_id and c.id=dp.consulta_id and c.id=d.consulta_id and
                dp.fechacon between :fi and :ff order by c.id asc ',['fi'=>$request->fi,'ff'=>$request->ff]);
            return view('vendor.adminlte.pages.reportes.diagnostico.listaresumendiagnostico',compact('ddg'));
        }else{
            return Response()->json(['mensaje'=>'No se recibieron datos']);
        }
    }
    //Generar el archivo PDF de la consulta generadad
    public function printReportediagnosticoR($feI,$feF){
        $ddg=DB::select('select p.id, c.nconsulta, p.nombre, pm.planmedico, dp.fechacon, d.diagnostico, d.cie from paciente p, consulta c, planmedico pm, datoprevio dp, diagnostico d
                where p.id=c.paciente_id and  c.id=pm.consulta_id and c.id=dp.consulta_id and c.id=d.consulta_id and
                dp.fechacon between :fi and :ff order by c.id asc ',['fi'=>$feI,'ff'=>$feF]);
        $vista=view('vendor.adminlte.pages.reportes.diagnostico.pdfReporteDiag', compact('ddg'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);        
        return $pdf->stream('Resumen de diagnosticos');
    }
    ///reporte para generar el resumen de diagnosticos
    public function ResumenDiag(Request $request){
        if($request->ajax()){
            $f=DB::select('select d.diagnostico, count(d.diagnostico) as cantidad from diagnostico d, datoprevio dp, consulta c
                where c.id=d.consulta_id and c.id=dp.consulta_id and dp.fechacon between :fi and :ff group by diagnostico',['fi'=>$request->fi,'ff'=>$request->ff]);
            return view('vendor.adminlte.pages.reportes.diagnostico.listaRdiagnostico',compact('f'));
        }else{
            return Response()->json(['mensaje'=>'No se recibieron datos']);
        }
    }
    //Reporte para genernar los diagnosticos mas frecuentes
    public function DiagFrecuente(Request $request){
        if($request->ajax()){
            $f=DB::select('select d.diagnostico, count(d.diagnostico) as cantidad from diagnostico d, datoprevio dp, consulta c
                where c.id=d.consulta_id and c.id=dp.consulta_id and dp.fechacon between :fi and :ff group by diagnostico order by cantidad desc limit 0,10',['fi'=>$request->fi,'ff'=>$request->ff]);
            return view('vendor.adminlte.pages.reportes.diagnostico.listaRdiagnostico',compact('f'));
        }else{
            return Response()->json(['mensaje'=>'No se recibieron datos']);
        }        
    }
    //Generar reporte pdf para el resumen de diagnosticos
    public function pdfresumend($fi,$ff){
        $f=DB::select('select d.diagnostico, count(d.diagnostico) as cantidad from diagnostico d, datoprevio dp, consulta c
            where c.id=d.consulta_id and c.id=dp.consulta_id and dp.fechacon between :fi and :ff group by diagnostico',['fi'=>$fi,'ff'=>$ff]);
        $vista=view('vendor.adminlte.pages.reportes.diagnostico.pdfRDiagnostico',compact('f'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);        
        return $pdf->stream('Resumen de diagnosticos');        
    }
    //Generar reporte pdf para los diagnosticos mas frecuentes
    public function pdfFrecuente($fi,$ff){
        $f=DB::select('select d.diagnostico, count(d.diagnostico) as cantidad from diagnostico d, datoprevio dp, consulta c
            where c.id=d.consulta_id and c.id=dp.consulta_id and dp.fechacon between :fi and :ff group by diagnostico order by cantidad desc limit 0,10',['fi'=>$fi,'ff'=>$ff]);
        $vista=view('vendor.adminlte.pages.reportes.diagnostico.pdfFrecuente',compact('f'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);        
        return $pdf->stream('Diagnosticos mas frecuentes');            
    }

    //Funciones para generar reportes de procedimientos
    public function procedimiento(){
        return view('vendor.adminlte.pages.reportes.procedimiento.procedimiento');
    }
    


    //Funciones para generar reportes por rango de edades
    public function reporteEdad(){
        return view('vendor.adminlte.pages.reportes.edad.reportedad');
    }
}
