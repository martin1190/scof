<style>
	*{
		font-size: 10px;
	}
	.page-break {
    page-break-after: always;
	}
	#cbr{		
		color: #F42D2D;		
		font-size: 24px;
		padding-top: -55px;
		padding-bottom: -40px;
		font-family: "Courier New", Courier, monospace;
		font-style: oblique;
	}
	.cb{
		text-align: center;
	}
	#t1{
		padding-top: -22px;
		text-decoration: underline;
		font-size: 16px;
	}
	#t{
		padding-top: -30px;
	}

	.dvpac, .cuerpo{
		border-top: 1px solid #0B0B0B;
		border-left: 1px solid #0B0B0B;
		border-right: 1px solid #0B0B0B;
		border-bottom: 1px solid #0B0B0B;
	}
	.titulo{
		background-color: #140DAC;
		color: white;
		font-size: 12px;
	}
	.inptxt{
		height: 9px;
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;
		border-bottom: 1px solid black;		
		font-size: 12px;
	}
	#txtnombre{
		width: 394px;
	}
	#parentesco{
		text-align: center;
		width: 100px;
	}
	#hc{
		
		width: 79px;	
		text-align: center;
	}
	#tpa{
		text-align: center;
		width: 185px;
	}
	#sx{
		width: 105px;
		text-align: center;
	}
	#ed{
		text-align: center;
		width: 48px;
	}
	#tlf{
		text-align: center;
		width: 152px;
	}
	#dir{		
		width: 303px;
	}
	#cpm{
		width: 294px;
	}
	#eml{
		width: 678px;
	}
	.l1,.l2 {
		padding-top: -2.5px;
	}
	.l3{
		padding-top: -3.5px;
	}
	#ecl{
		text-decoration: underline;
		font-size: 17px;
	}
	#ncon{
		width: 40px;
		text-align: center;
	}	
	#feco{
		width: 70px;
		text-align: center;
	}
	#te{
		width: 690px;
	}
	#an1{
		width: 659.25px;
	}
	.txtf{
		width: 717px;		
	}
	#antc{
		width: 644.5px;
	}
	#antc1{
		width: 407.5px;
	}
	#pmc{
		text-align: center;
		width: 120px;
	}
	#ult{
		text-align: center;
		width: 50px;
	}
	.l8{
		left: 50px;
	}
	.inpex{
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		border-left: 1px solid black;
		border-right: 1px solid black;
		height: 10px;
		width: 80px;
		font-size: 12px;
	}
	.inpti{
		width: 150px;
		height: 12px;
		font-size: 12px;
	}

	.p1{
		padding-left: -10px;
	}
	.tblExa{
	  border: 1px solid #000;
	  border-collapse: collapse;	
	  padding-left: 50px;	
	}
	.tblExa th, .tblExa td{
	 border: 1px solid #000;
	 width: 50px;
	 text-align: center;
	}
	#ocu{
		border-top: 0px;
		border-right: 0px;
		border-left: 0px;
		border-bottom: 0px;
	}
	#orb{
		width: 618px;
	}	
	#apl{
		width: 622px;
	}
	#cje{
		width: 608px;
	}
	#crn{
		width: 674px;
	}
	#cmrt{
		width: 671px;
	}
	#irp{
		width: 650px;
	}
	#cri{
		width: 664px;
	}
	#vitr{
		width: 678px;
	}
	#tsch{
		width: 40px;
	}
	#but{
		width: 50px;
	}
	#cvts{
		width: 398px;
	}
	#oft{
		width: 638px;
	}
	#cv{
		width: 619px;
	}
	#mtoc{
		width: 626px;
	}
	#tnm{
		width: 80px;
	}
	#odt,#oit{
		width: 40px;
	}
	.dig{
		width: 550px;		
	}
	.ci{
		width: 50px;
	}
	.trm{
		width: 657px;
	}
	#ttre{
		width: 20px;
		height: 30PX;
	}
	.cbre{
		height: 10PX;
		width: 20px;
	}
	.tblRef{
	  border: 1px solid #000;
	  border-collapse: collapse;		  	
	}
	.tblRef th, .tblRef td{
	 border: 1px solid #000;
	 width: 100px;
	 text-align: center;
	}	
	.l18, .l19,{
		padding-left: 50px;
	}
	.brdd, .brdc{

	}
	.page-break>#idPaMed{		
		width: 200px;
		border: 1px solid #FFFFFF;
		padding-left: 110px;		
		color: #F31313;
		font-size: larger;

	}

	.tblRefH{
		border: 0px;
		padding-left: 120px;
	}

	.tblRefH th, .tblRefH td{		
		border: 0px;		
		font-size: 20px; 
		color: #FF0303;
		text-align: center;
	}
	.fH{
		border: 0px;
	}
	#diaC{
		width: 40px;
	}
	#anC{
		width: 45px;
		text-align: right;
	}
	#mesC{
		width: 120px;
		text-align: center;
	}
</style>
	<h1 id="cbr" class="cb">Dr. Bernardo Gamarra Benites</h1>
	<h5 class="cb" id="t">MEDICO - CIRUJANO OFTALMOLOGO</h5>
	<h5 class="cb" id="t1">Datos Personales del Paciente</h5>
	@foreach ($datos as $d)
	<div class="dvpac" id="dvp">
		<div class="l">
			<label class="titulo">Nombre:</label>
			<input type="text" value="{{$d->nombre}}" id="txtnombre" class="inptxt">
			<label class="titulo">Parentesco:</label>
			<input type="text" id="parentesco" value="{{$d->parentesco}} " class="inptxt"> 
			<label class="titulo">HC:</label>
			<input type="text" value="{{$d->id}}" id="hc" class="inptxt">		
		</div>

		<div class="l1">
			<label class="titulo">Tipo de Atencion:</label>
			<input type="text" class="inptxt" id="tpa" value="{{$d->tipo}} ">
			<label class="titulo">Sexo:</label>
			<input type="text" class="inptxt" id="sx" value="{{$d->sexo}} ">
			<label  class="titulo">Edad:</label>
			<input type="text" class="inptxt" id="ed" value="{{$d->edad}} ">
			<label class="titulo">Telefono:</label>
			<input type="text" class="inptxt" id="tlf" value="{{$d->telefono}} ">		
		</div>
		<div class="l2">
			<label class="titulo">Direccion:</label>
			<input type="text" class="inptxt" id="dir" value="{{$d->direccion}} ">
			<?php 
	$reco=DB::select('select c.*, cp.* from compania_paciente cp, compania c, paciente p
	where cp.id_paciente=p.id and cp.id_compania=c.id and cp.id_paciente= :id',['id'=>$d->id]);		
			 ?>		
			@foreach($reco as $rc)
			<label class="titulo">Compañia:</label>
			<input type="text" class="inptxt" id="cpm" value="{{$rc->nombre}}">	
			@endforeach	
		</div>
		<div class="l3">
			<label  class="titulo">E-mail</label>
			<input type="text" class="inptxt" id="eml" value="{{$d->email}} ">		
		</div>

	</div>
	<label id="ecl">Examen Clinico del Paciente</label>
	<div class="cuerpo">
		<div class="l4">
			<label class="titulo">N° Consulta:</label>
			<input type="text" class="inptxt" value="{{$d->nconsulta}}" id="ncon">
			<label  class="titulo">Fecha de Consulta:</label>
			<input type="text" class="inptxt" id="feco" value="{{$d->fechacon}} ">
		</div>
		<div class="l5">
			<label class="titulo">T.E:</label>
			<input type="text" class="inptxt" id="te" value="{{$d->te}} ">
		</div>
		<div class="l6">
			<label class="titulo">Anamnesis</label>
			<input type="text" class="inptxt" value="{{$d->anamnesis1}}" id="an1"><br>
			<input type="text" class="inptxt txtf" value="{{$d->anamnesis2}}" ><br>
			<input type="text" class="inptxt txtf" value="{{$d->anamnesis3}}" ><br>
			<input type="text" class="inptxt txtf" value="{{$d->anamnesis4}}" >						
		</div>
		<div class="l7">
			<label class="titulo">Antecedentes:</label>
			<input type="text" class="inptxt" id="antc" value="{{$d->antecedentes1}} "><br>
			<input type="text" class="inptxt" id="antc1" value="{{$d->antecedentes1}} ">
			<label class="titulo">Plan Medico:</label>
			<input type="text" class="inptxt" id="pmc" value="{{$d->atencion}} ">
			<label class="titulo">Usa Lente:</label>
			<input type="text" class="inptxt" id="ult" value="{{$d->usalentes}} ">
		</div>
		<div class="l8">
			<label class="titulo">Examen:</label><br>
			<table class="tblExa">
				<thead>
					<tr class="cbex">
						<th style="height: 10px; border-top: 0px; border-left: 0px"></th>
						<th style="height: 10px; font-size: 10px;" >SC</th>
						<th style="height: 10px; font-size: 10px;">CC</th>
						<th style="height: 10px; font-size: 10px;">CA</th>
					</tr>
				</thead>
				<tbody>
					<tr class="cntEx">
						<td style="text-align: right; height: 10px; font-size: 10px;">OJO DERECHO</td>
						<td style="height: 10px; font-size: 10px;">{{$d->odsc}} </td>
						<td style="height: 10px; font-size: 10px;">{{$d->odcc}} </td>
						<td style="height: 10px; font-size: 10px;">{{$d->odca}} </td>
					</tr>
					<tr>
						<td style="text-align: right; height: 10px; font-size: 10px;">OJO IZQUIERDO</td>
						<td style="height: 10px; font-size: 10px;">{{$d->oisc}} </td>
						<td style="height: 10px; font-size: 10px;">{{$d->oicc}} </td>
						<td style="height: 10px; font-size: 10px;">{{$d->oica}} </td>					
					</tr>
				</tbody>
			</table>						

		</div>
		<div class="l9">
			<label class="titulo">Orbitas y Parpados:</label>
			<input type="text" class="inptxt" id="orb" value="{{$d->orbitasparpados}} "><br>
			<input type="text" class="inptxt txtf" value="{{$d->orbitasparpados1}} ">
		</div>
		<div class="l10">
			<label class="titulo">Aparato Lagrimal:</label>
			<input type="text" class="inptxt" id="apl" value="{{$d->aparatolagrimal}} "><br>
			<label class="titulo">Conjuntiva y Esclera:</label>
			<input type="text" class="inptxt" value="{{$d->conjuntivaesclera}} " id="cje"><br>
			<input type="text" class="inptxt txtf" value="{{$d->conjuntivaesclera1}}">
		</div>
		<div class="l11">
			<label class="titulo">Cornea:</label>
			<input type="text" class="inptxt" id="crn" value="{{$d->cornea}} "><br>
			<input type="text" class="inptxt txtf" value="{{$d->cornea1}} ">
		</div>
		<div class="l12">
			<label class="titulo">Camara:</label>
			<input type="text" class="inptxt" value="{{$d->camaraanterior}} " id="cmrt"><br>
			<label class="titulo">Iris y Pupila:</label>
			<input type="text" class="inptxt" id="irp" value="{{$d->irispupila}} "><br>
			<label  class="titulo">Cristalino</label>
			<input type="text" class="inptxt" value="{{$d->cristalino}} " id="cri"><br>
			<input type="text" class="inptxt txtf" value="{{$d->cristalino1}}">
		</div>
		<div class="l13">
			<label class="titulo">Vitreo:</label>
			<input type="text" class="inptxt" id="vitr" value="{{$d->vitreo}} "><br>
			<label class="titulo">Motilidad Ocular:</label>
			<input type="text" class="inptxt" id="mtoc" value="{{$d->motilidadocular}} "><br>
			<input type="text" class="inptxt txtf" value="{{$d->motilidadocular1}} ">

		</div>
		<div class="l14">
			<label class="titulo">Test Schirmer: </label>
			<input type="text" class="inptxt" id="tsch" value="{{$d->testschirmer}} ">
			<label>mm</label>
			<label class="titulo">B.U.T:</label>
			<input type="text" class="inptxt" id="but" value="{{$d->but}} ">
			<label>seg.</label>
			<label class="titulo">Cover_Test:</label>
			<input type="text" class="inptxt" id="cvts" value="{{$d->covertest}} ">
			
		</div>
		<div class="l15">
			<label class="titulo">Oftalmoscopia:</label>
			<input type="text" class="inptxt" id="oft" value="{{$d->oftalmoscopia1}}"><br>
			<input type="text" class="inptxt txtf" value="{{$d->oftalmoscopia2}} "><br>
			<input type="text" class="inptxt txtf" value="{{$d->oftalmoscopia3}} "><br>
			<input type="text" class="inptxt txtf" value="{{$d->oftalmoscopia4}} "><br>		
		</div>
		<div class="l16">
			<label class="titulo">CAMPO VISUAL:</label>
			<input type="text" class="inptxt" id="cv" value="{{$d->campovisual}} ">
		</div>
		<div class="l17">
			<label class="titulo">TONOMETRIA:</label>
			<input type="text" class="inptxt" id="tnm" value="{{$d->tonometria}} ">
			<label class="titulo">OD:</label>
			<input type="text" class="inptxt" id="odt" value="{{$d->od}} ">
			<label for="">mmHg</label>
			<label  class="titulo">OI:</label>
			<input type="text" class="inptxt" id="oit" value="{{$d->oi}} ">	
			<label>mmHg</label>	
		</div>
		<label  class="titulo">DIAGNOSTICO</label><br>
		<div class="l18" id="diant">
				 
			@php ($v = $d->conid)				
			<?php 
			$cntd=DB::table('diagnostico')->where('consulta_id','=',$v)->count();
			$cn=DB::select('select @rownum:=@rownum+1 as numero,  diagnostico, cie FROM diagnostico d, (select @rownum:=0) r where consulta_id=:idc',['idc'=>$v ]);
			?>
	 		@if ($cntd == 1)
			 @foreach ($cn as $c)
			 	<label>{{$c->numero}}:</label>
			 	<input type="text" value="{{$c->diagnostico}} " class="dig inptxt">			 				
				<label class="titulo">CIE_D{{$c->numero}}:</label>
				<input type="text" value="{{$c->cie}} " class="inptxt ci"><br>								
		
			 @endforeach
				<label>2:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D2:</label>
				<input type="text"  class="ci inptxt"><br>		 
				<label>3:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D3:</label>
				<input type="text"  class="ci inptxt"><br>
				<label >4:</label>			
				<input type="text"  class="dig inptxt">
				<label class="titulo">CIE_D4:</label>
				<input type="text"  class="inptxt ci"><br>							
	 		@elseif ($cntd == 2)
	 		 @foreach ($cn as $c)
			 	<label>{{$c->numero}}:</label>
			 	<input type="text" value="{{$c->diagnostico}} " class="dig inptxt">			 				
				<label class="titulo">CIE_D{{$c->numero}}:</label>
				<input type="text" value="{{$c->cie}} " class="inptxt ci"><br>				
			 @endforeach			
				<label>3:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D3:</label>
				<input type="text"  class="ci inptxt"><br>
				<label >4:</label>			
				<input type="text"  class="dig inptxt">
				<label class="titulo">CIE_D4:</label>
				<input type="text"  class="inptxt ci"><br>			
	 		@elseif ($cntd == 3)
	 		 @foreach ($cn as $c)
			 	<label>{{$c->numero}}:</label>
			 	<input type="text" value="{{$c->diagnostico}} " class="dig inptxt">			 				
				<label class="titulo">CIE_D{{$c->numero}}:</label>
				<input type="text" value="{{$c->cie}} " class="inptxt ci"><br>			
			 @endforeach
				<label>4:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D4:</label>
				<input type="text"  class="ci inptxt"><br>
	 		@elseif ($cntd == 4)
	 		 @foreach ($cn as $c)
			 	<label>{{$c->numero}}:</label>
			 	<input type="text" value="{{$c->diagnostico}} " class="dig inptxt">			 				
				<label class="titulo">CIE_D{{$c->numero}}:</label>
				<input type="text" value="{{$c->cie}} " class="inptxt ci"><br>		
			 @endforeach
			@elseif ($cntd == 0)
				<label>1:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D1:</label>
				<input type="text"  class="ci inptxt"><br>
				<label>2:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_2:</label>
				<input type="text"  class="ci inptxt"><br>
				<label>3:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D3:</label>
				<input type="text"  class="ci inptxt"><br>
				<label>4:</label>
				<input type="text"  class="inptxt dig">				
				<label class="titulo">CIE_D4:</label>
				<input type="text"  class="ci inptxt"><br>													
	 		@endif
		
		</div>
		<label class="titulo">TRATAMIENTO:</label><br>
		<div class="l19">
			
			<?php 
			$cntr=DB::table('tratamiento')->where('consulta_id','=',$v)->count();
			$trm=DB::select('select @rownum:=@rownum+1 as numero,  tratamiento FROM tratamiento t, (select @rownum:=0) r where consulta_id=:id',['id'=>$v]);
			 ?>
			 @if($cntr == 0)					
					<label >1:</label><input type="text" class="inptxt trm"><br>		
					<label >2:</label><input type="text" class="inptxt trm"><br>	
					<label >3:</label><input type="text" class="inptxt trm"><br>
					<label >4:</label><input type="text" class="inptxt trm"><br>
			 @elseif ($cntr ==1)
				@foreach($trm as $t)

					<label >{{$t->numero}}:</label><input type="text" class="inptxt trm" value="{{$t->tratamiento}} "> 
				@endforeach
					<label >2:</label><input type="text" class="inptxt trm">	
					<label >3:</label><input type="text" class="inptxt trm">	
					<label >4:</label><input type="text" class="inptxt trm">				
			 @elseif ($cntr ==2)
				@foreach($trm as $t)

					<label >{{$t->numero}}:</label><input type="text" class="inptxt trm" value="{{$t->tratamiento}} ">
				@endforeach
					<label >3:</label><input type="text" class="inptxt trm">
					<label >4:</label><input type="text" class="inptxt trm">					
			 @elseif ($cntr ==3)
				@foreach($trm as $t)

					<label >{{$t->numero}}:</label><input type="text" class="inptxt trm" value="{{$t->tratamiento}} "><br> 
				@endforeach
					<label >4:</label><input type="text" class="inptxt trm">
			 @elseif ($cntr ==4)
				@foreach($trm as $t)

					<label >{{$t->numero}}:</label>
					<input type="text" class="inptxt trm" value="{{$t->tratamiento}} ">
				@endforeach
			 @endif
		</div>
		<div class="l20">
			<table border="2px" class="tblRef">
				<thead>
					<tr class="cbReff">
						<th rowspan="4" style="font-size: 16px; font-weight: bold;">Refraccion</th>
						<th></th>
						<th>ESFERA</th>
						<th>CILINDRO</th>
						<th>EJE</th>
						<th>AV</th>
						<th>DIP</th>
					</tr>				
				</thead>
				<tbody>
					<tr class="conRefr">

						<td>OD</td>
						<td>{{$d->odesfera}} </td>
						<td>{{$d->odcilindro}} </td>
						<td>{{$d->odeje}} </td>
						<td>{{$d->odav}} </td>
						<td>{{$d->oddip}} </td>
					</tr>
					<tr class="conRefr">	
								
						<td>OI</td>
						<td>{{$d->oiesfera}} </td>
						<td>{{$d->oicilindro}} </td>
						<td>{{$d->oieje}} </td>
						<td>{{$d->oiav}} </td>
						<td>{{$d->oidip}} </td>					
					</tr>
					<tr class="conRefr">	
								
						<td>OD Cerca</td>
						<td>{{$d->odesferaC}} </td>
						<td>{{$d->odcilindroC}} </td>
						<td>{{$d->odejeC}} </td>
						<td>{{$d->odavC}} </td>
						<td>{{$d->oddipC}} </td>						
					</tr>			
				</tbody>

			</table>
		</div>
	</div>
@endforeach


