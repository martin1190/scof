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
}
