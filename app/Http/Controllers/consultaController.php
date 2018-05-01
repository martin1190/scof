<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\paciente;
use App\Modelos\consulta;
use App\Modelos\datoprevio;
use App\Modelos\diagnostico;
use App\Modelos\planmedico;
use App\Modelos\procedimientos;
use App\Modelos\refraccion;
use App\Modelos\tratamiento;
use App\Modelos\atencion;
use App\Modelos\examen1;
use App\Modelos\examen2;
use DB;

class consultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.pages.consulta');
    }
    public function historia($nc,$idp){
        $datos=DB::select('select c.id as conid,p.nombre, p.parentesco, p.id, ta.tipo, p.sexo, p.edad, p.telefono, p.direccion, p.email, c.nconsulta, dp.fechacon, dp.te, dp.anamnesis1, dp.anamnesis2,
dp.anamnesis3, dp.anamnesis4, dp.antecedentes1, dp.antecedentes2, dp.atencion, dp.usalentes, e1.odca, e1.odcc, e1.odsc, e1.oica, e1.oicc, e1.oisc, e2.orbitasparpados, e2.orbitasparpados1, e2.aparatolagrimal, e2.conjuntivaesclera, e2.conjuntivaesclera1, e2.cornea, e2.cornea1, e2.camaraanterior, e2.irispupila,
e2.cristalino, e2.cristalino1, e2.vitreo, e2.motilidadocular, e2.motilidadocular1, e2.testschirmer, e2.but, e2.covertest, e2.oftalmoscopia1, e2.oftalmoscopia2, e2.oftalmoscopia3, e2.oftalmoscopia4, e2.campovisual,e2.tonometria, e2.od, e2.oi, re.odesfera, re.oiesfera, re.lecturaesfera, re.odcilindro, re.oicilindro, re.lecturacilindro, re.odeje, re.oieje, re.lecturaeje, re.odav, re.oiav, re.lecturaav, re.oddip, re.oidip, re.lecturadip
from paciente p, consulta c, tipo_seguro ts, tipo_atencion ta, datoprevio dp, examen1 e1, examen2 e2, planmedico pm, refraccion re where p.id=c.paciente_id and ts.id=p.tipo_seguro_id and c.tipo_atencion_id=ta.id and dp.consulta_id=c.id and e1.consulta_id=c.id and e2.consulta_id=c.id
and pm.consulta_id=c.id and re.consulta_id=c.id and c.nconsulta=:nc and p.id=:idp',['nc'=>$nc, 'idp'=>$idp]);

        return view('vendor.adminlte.pages.pdfconsulta', compact('datos'));
    }
    public function pdfConsulta($nc, $idp){
        $datos=DB::select('select c.id as conid,p.nombre, p.parentesco, p.id, ta.tipo, p.sexo, p.edad, p.telefono, p.direccion, p.email, c.nconsulta, dp.fechacon, dp.te, dp.anamnesis1, dp.anamnesis2,
dp.anamnesis3, dp.anamnesis4, dp.antecedentes1, dp.antecedentes2, dp.atencion, dp.usalentes, e1.odca, e1.odcc, e1.odsc, e1.oica, e1.oicc, e1.oisc, e2.orbitasparpados, e2.orbitasparpados1, e2.aparatolagrimal, e2.conjuntivaesclera, e2.conjuntivaesclera1, e2.cornea, e2.cornea1, e2.camaraanterior, e2.irispupila,
e2.cristalino, e2.cristalino1, e2.vitreo, e2.motilidadocular, e2.motilidadocular1, e2.testschirmer, e2.but, e2.covertest, e2.oftalmoscopia1, e2.oftalmoscopia2, e2.oftalmoscopia3, e2.oftalmoscopia4, e2.campovisual,e2.tonometria, e2.od, e2.oi, re.odesfera, re.oiesfera, re.odcilindro, re.oicilindro, re.odeje, re.oieje, re.odav, re.oiav,re.oddip, re.oidip, re.odesferaC, re.odcilindroC, re.odejeC, re.odavC, re.oddipC, re.oiesferaC, re.oicilindroC, re.oiejeC, re.oiavC, re.oidipC
from paciente p, consulta c, tipo_seguro ts, tipo_atencion ta, datoprevio dp, examen1 e1, examen2 e2, planmedico pm, refraccion re where p.id=c.paciente_id and ts.id=p.tipo_seguro_id and c.tipo_atencion_id=ta.id and dp.consulta_id=c.id and e1.consulta_id=c.id and e2.consulta_id=c.id
and pm.consulta_id=c.id and re.consulta_id=c.id and c.nconsulta=:nc and p.id=:idp',['nc'=>$nc, 'idp'=>$idp]);
        $vista=view('vendor.adminlte.pages.pdfconsulta', compact('datos'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->stream('consulta');
    }
    public function pdfRefraccion($idp, $ncon){
        $datos=DB::select('select * from paciente p, consulta c, refraccion r, datoprevio d where p.id=c.paciente_id and c.id=r.consulta_id and c.id=d.consulta_id and p.id=:idp and c.nconsulta=:ncon',['idp'=>$idp,'ncon'=>$ncon]);
        $vista=view('vendor.adminlte.pages.pdfrefraccion', compact('datos'));
        $pdf=\App::make('dompdf.wrapper');

        $pdf->loadHTML($vista);
        return $pdf->stream('Medida de la vista');        
    }
    public function popRefraccion($idp, $ncon){
        $datos=DB::select('select * from paciente p, consulta c, refraccion r, datoprevio d where p.id=c.paciente_id and c.id=r.consulta_id and c.id=d.consulta_id and p.id=:idp and c.nconsulta=:ncon',['idp'=>$idp,'ncon'=>$ncon]);
         return view('vendor.adminlte.pages.poprefraccion', compact('datos'));    
    }    
    public function recetapdf($idp, $ncon){
        $con=DB::select('select p.nombre, p.tipo_seguro_id, c.id as idcon, d.fechacon from paciente p,consulta c, datoprevio d where p.id=c.paciente_id and c.id=d.consulta_id and c.nconsulta=:ncon and c.paciente_id=:id',['ncon'=>$ncon,'id'=>$idp]);
        $vista=view('vendor.adminlte.pages.pdfreceta', compact('con'));
        $pdf=\App::make('dompdf.wrapper');                
        $pdf->loadHTML($vista);
        $pdf->setOptions(['defaultPaperSize' => 'a5']);
        return $pdf->stream('Receta');        
    }
    public function recetapop($idp, $ncon){
    $con=DB::select('select p.nombre, p.tipo_seguro_id, c.id as idcon, d.fechacon from paciente p,consulta c, datoprevio d where p.id=c.paciente_id and c.id=d.consulta_id and c.nconsulta=:ncon and c.paciente_id=:id',['ncon'=>$ncon,'id'=>$idp]);
         return view('vendor.adminlte.pages.popreceta', compact('con'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function registroCon(Request $request){
        if($request->ajax()){
            $paciente= new paciente;
            $consulta= new consulta;
            $datop= new datoprevio;
            $diag= new diagnostico;
            $diag1= new diagnostico;
            $diag2= new diagnostico;
            $diag3= new diagnostico;
            $pm= new planmedico;
            $proce= new procedimientos;
            $proce1= new procedimientos;
            $proce2= new procedimientos;
            $proce3= new procedimientos;
            $proce4= new procedimientos;
            $proce5= new procedimientos;
            $proce6= new procedimientos;            
            $refra= new refraccion;
            $tra= new tratamiento;
            $tra1= new tratamiento;
            $tra2= new tratamiento;
            $tra3= new tratamiento;
            $at=new atencion;
            $e1=new examen1;
            $e2=new examen2;
            //Registro de consulta   
            $consulta->nconsulta=$request->nc;
            $consulta->estadoPago="Pendiente";
            $tiA=$request->ta;
            switch ($tiA) {
                case 'AMBULATORIO':
                    $idta="1";
                    break;
                case 'EMERGENCIA':
                    $idta="2";
                    break;
                case 'PREVENTIVA':
                    $idta="3";
                    break;
                case 'DOMICILIARIA':
                    $idta="4";
                    break;                                   
                default:
                    # code...
                    break;
            }
            $idAtenc=$request->ida;
            $consulta->tipo_atencion_id=$idta;
            $consulta->paciente_id=$request->idpac;
            $regCon=$consulta->save();
            $ate=$at::FindOrFail($idAtenc);
            $ate->estado="Atendido";
            $ate->save();
            $idconsulta=consulta::max('id');
            //Registro en la tabla datoprevio
            $datop->fechacon=$request->fechaC;
            $datop->te=$request->te;
            $datop->anamnesis1=$request->anm1;
            $datop->anamnesis2=$request->anm2;
            $datop->anamnesis3=$request->anm3;
            $datop->anamnesis4=$request->anm4;
            $datop->antecedentes1=$request->antece;
            $datop->antecedentes2=$request->antece1;
            $datop->usalentes=$request->usLen;
            $datop->atencion=$tiA;
            $datop->consulta_id=$idconsulta;
            $regDatoP=$datop->save();
            //Registro en la tabla examen1
            $e1->odsc=$request->odsc;
            $e1->oisc=$request->oisc;
            $e1->odcc=$request->odcc;
            $e1->oicc=$request->oicc;
            $e1->odca=$request->odca;
            $e1->oica=$request->oica;
            $e1->consulta_id=$idconsulta;
            $regex1=$e1->save();
            //Registro en la tabla examen2
            $e2->orbitasparpados=$request->orbPar;
            $e2->orbitasparpados1=$request->orbPar1;
            $e2->aparatolagrimal=$request->aparLagr;
            $e2->conjuntivaesclera=$request->conjEsc;
            $e2->conjuntivaesclera1=$request->conjEsc1;
            $e2->cornea=$request->cornea;
            $e2->cornea1=$request->cornea1;
            $e2->camaraanterior=$request->camaraAnt;
            $e2->irispupila=$request->irPup;
            $e2->campovisual=$request->campoVi;
            $e2->cristalino=$request->cristalino;
            $e2->cristalino1=$request->cristalino1;
            $e2->vitreo=$request->vitreo;
            $e2->tonometria=$request->tonometria;
            $e2->od=$request->od;
            $e2->oi=$request->oi;
            $e2->motilidadocular=$request->motOcu;
            $e2->motilidadocular1=$request->motOcu1;
            $e2->testschirmer=$request->schirmer;
            $e2->but=$request->but;
            $e2->covertest=$request->covertest;
            $e2->oftalmoscopia1=$request->oftal1;
            $e2->oftalmoscopia2=$request->oftal2;
            $e2->oftalmoscopia3=$request->oftal3;
            $e2->oftalmoscopia4=$request->oftal4;
            $e2->consulta_id=$idconsulta;
            $regex2=$e2->save();
            //Registros para la tabla diagnostico
            $d1=strlen($request->diag1);
            $d2=strlen($request->diag2);
            $d3=strlen($request->diag3);
            $d4=strlen($request->diag4);
            if ($d1>0) {
                $diag->diagnostico=$request->diag1;
                $diag->cie=$request->cie1;
                $diag->consulta_id=$idconsulta;
                $reDig=$diag->save();
            }
            if ($d2>0) {
                $diag1->diagnostico=$request->diag2;
                $diag1->cie=$request->cie2;
                $diag1->consulta_id=$idconsulta;
                $re1Dig=$diag1->save();
            }
            if ($d3>0) {
                $diag2->diagnostico=$request->diag3;
                $diag2->cie=$request->cie3;
                $diag2->consulta_id=$idconsulta;
                $re2Dig=$diag2->save();
            }
            if ($d4>0) {
                $diag3->diagnostico=$request->diag4;
                $diag3->cie=$request->cie4;
                $diag3->consulta_id=$idconsulta;
                $reDig=$diag3->save();
            }    
            //Para registrar el tratamiento
            $t1=strlen($request->tra1);
            $t2=strlen($request->tra2);
            $t3=strlen($request->tra3);
            $t4=strlen($request->tra4);
            if ($t1>0) {
                $tra->tratamiento=$request->tra1;                
                $tra->consulta_id=$idconsulta;
                $reTr=$tra->save();
            }       
            if ($t2>0) {
                $tra1->tratamiento=$request->tra2;                
                $tra1->consulta_id=$idconsulta;
                $reTr=$tra1->save();
            }       
            if ($t3>0) {
                $tra2->tratamiento=$request->tra3;                
                $tra2->consulta_id=$idconsulta;
                $reTr=$tra2->save();
            }       
            if ($t4>0) {
                $tra3->tratamiento=$request->tra4;                
                $tra3->consulta_id=$idconsulta;
                $reTr=$tra3->save();
            }                                                       
            //para registrar el plan medico
            $pm->planmedico=$request->planMe;
            $pm->consulta_id=$idconsulta;
            $regpm=$pm->save();
            //Para registrar la refraccion
            $refra->odesfera=$request->odesfera;
            $refra->odcilindro=$request->odcilindro;
            $refra->odeje=$request->odeje;
            $refra->odav=$request->odav;
            $refra->oddip=$request->oddip;
            $refra->oiesfera=$request->oiesfera;
            $refra->oicilindro=$request->oicilindro;
            $refra->oieje=$request->oieje;
            $refra->oiav=$request->oiav;
            $refra->oidip=$request->oidip;
            $refra->odesferaC=$request->odesferaC;
            $refra->odcilindroC=$request->odcilindroC;
            $refra->odejeC=$request->odejeC;
            $refra->odavC=$request->odavC;
            $refra->oddipC=$request->oddipC;
            $refra->oiesferaC=$request->oiesferaC;
            $refra->oicilindroC=$request->oicilindroC;
            $refra->oiejeC=$request->oiejeC;
            $refra->oiavC=$request->oiavC;
            $refra->oidipC=$request->oidipC;            
            $refra->consulta_id=$idconsulta;
            $regRefr=$refra->save();
            //Pare registrar en la tabla procedimientos
            $pr1=strlen($request->FonOjo);
            $pr2=strlen($request->chkTono);
            $pr3=strlen($request->chkECE);
            $pr4=strlen($request->EEO);
            $pr5=strlen($request->chkBlef);
            $pr6=strlen($request->chkRefra);
            $pr7=strlen($request->chkSchirmer);
            if($pr1>0){
                $proce->procedimiento=$request->FonOjo;
                $proce->consulta_id=$idconsulta;
                $regPro1=$proce->save();
            }
            if($pr2>0){
                $proce1->procedimiento=$request->chkTono;
                $proce1->consulta_id=$idconsulta;
                $regPro2=$proce1->save();
            }
            if($pr3>0){
                $proce2->procedimiento=$request->chkECE;
                $proce2->consulta_id=$idconsulta;
                $regPro3=$proce2->save();
            }
            if($pr4>0){
                $proce3->procedimiento=$request->EEO;
                $proce3->consulta_id=$idconsulta;
                $regPro4=$proce3->save();
            }                                    
            if($pr5>0){
                $proce4->procedimiento=$request->chkBlef;
                $proce4->consulta_id=$idconsulta;
                $regPro5=$proce4->save();
            }
            if($pr6>0){
                $proce5->procedimiento=$request->chkRefra;
                $proce5->consulta_id=$idconsulta;
                $regPro6=$proce5->save();
            }
            if($pr7>0){
                $proce6->procedimiento=$request->chkSchirmer;
                $proce6->consulta_id=$idconsulta;
                $regPro7=$proce6->save();
            }                                    
            echo "Consulta registrada";
            
            

        }else{
            echo "No se recibieron datos";
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoDiag(){
        $di=DB::table('cie')->get();
        return response()->json($di);
    }
    public function cargarCie(Request $request){
        $enf=$request->enf;

        $ccie=DB::table('cie')->where('desc_enf','=',$enf)->get();
        return response()->json($ccie);
    }
    public function cargarEnf($co){
        $en=DB::select('select * from cie where cod_cie =:co',['co'=>$co]);
        return response()->json($en);
    }   
    public function cambiocie_diag(Request $request){
        $diag=$request->diag;
        $ci=DB::table('cie')->where('desc_enf','=',$diag)->get();
        return response()->json($ci);
    }
    public function cambio_desc(Request $request){
        $diag=$request->diag;
        $ci=DB::table('cie')->where('cod_cie','=',$diag)->get();
        return response()->json($ci);
    }    
    public function store(Request $request)
    {
        //
    }
    public function cargarCompania(Request $request){
        $idp=$request->id;
        $reco=DB::select('select c.*, cp.* from compania_paciente cp, compania c, paciente p
where cp.id_paciente=p.id and cp.id_compania=c.id and cp.id_paciente= :id',['id'=>$idp]);
        return response()->json($reco);
    }

    public function cantidadC(Request $request){
        $cn=consulta::where('paciente_id','=',$request->id)->count();
        $cnn=$cn+1;

        return response()->json($cnn);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
