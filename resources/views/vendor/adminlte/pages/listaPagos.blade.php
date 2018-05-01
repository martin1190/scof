            <div class="pull-right">
              <?php 
              $fechaConsulta=Carbon\Carbon::now()->toDateString();
              $url="preLiquidacion/".$fechaConsulta;
               ?>
              <a href="<?php echo $url; ?>" class="btn btn-info">Generar Pre-Liquidacion</a>
            </div>
            <br>  
            <table class="table table-responsive  tpp" id="tblListaPago">
              <thead>
                <tr>
                  <th>N°H</th>
                  <th>Nombres</th>                     
                  <th>Compania</th>
                  <th>Plan </th>
                  <th class="oculto">F.</th>
                  <th>Ded. Fi</th>
                  <th>Costo</th>                  
                  <th>Procedimiento</th>
                  <th>Ded. Var</th>                  
                  <th>Costo</th>                  
                  <th>Guardar</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($a as $a)
                <tr>                  
                  <td>{{$a->id}} </td>
                  <td>{{$a->nombre}}</td>        
                  <td>{{$a->nombreco}}</td>
                  <td>{{$a->planmedico}}</td>
                  <td class="oculto">{{$a->fechacon}}</td>
                  <?php  
                    $cco=DB::select("select * from costo_compania where id_compania=(select id_compania from compania_paciente where id_paciente=:idp)",['idp'=>$a->id]);
                   ?>
                  <td>
                    @foreach ($cco as $c1)
                      {{$c1->copagoFijo}}
                    @endforeach
                  </td>                     
                  <td>
                    <?php 
                    $cc=DB::table('costobase')->where('procedimiento','=',$a->planmedico)->get();
                    $totalP=0;
                   ?> 
                   @foreach ($cc as $c2)
                    @foreach ($cco as $c1)
                      @php
                        $totalP=$c2->costo - $c1->copagoFijo;
                      @endphp
                      {{$c2->costo - $c1->copagoFijo}}
                    @endforeach
                   @endforeach                                   
                  </td>               
                  <?php 
                  $b=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();    
                   ?>
                  <td style="width: 200px;">
                    @foreach ($b as $b)
                                            
                      {{$b->procedimiento}} &nbsp; <a href="#" class="btn btn-sm pull-right" onclick="quitarProcedimiento({{$b->id}})"><i class="fa fa-minus-square" style="background-color: white; color: red;"></i></a> <br>
                    @endforeach
                    <a href="#" class="btn btn-sm center-block" style="color: green; background-color: white;" id="addPro" data-toggle="modal" data-target="#ModalProcedimiento"><i class="fa fa-plus-square" onclick="MostrarProcedimiento({{$a->idc}})"> </i></a>
                  </td>
                  <?php 
                  $b1=DB::table('procedimientos')->where('consulta_id','=',$a->idc)->get();
                   ?>                                    
                  <td>   
                    @foreach ($b1 as $b2)
                      <?php 
                      $cp=DB::table('costobase')->where('procedimiento','=',$b2->procedimiento)->get();                
                       ?>
                       @foreach($cp as $cp)
                        @foreach ($cco as $ccp)                        
                        {{$cp->costo * $ccp->copagoVariable/100}} <br>
                        @endforeach
                       @endforeach
                    @endforeach
                  </td>                  
                  <td>  
                     @foreach ($b1 as $b2)
                      <?php 
                      $cp=DB::table('costobase')->where('procedimiento','=',$b2->procedimiento)->get();                
                       ?>
                       @foreach($cp as $cp)
                        @foreach ($cco as $ccp)    
                        {{ $cp->costo - ($cp->costo * $ccp->copagoVariable/100)}} <br>      
                        @endforeach
                      @endforeach                      
                    @endforeach                  
                    
                  </td>                  
                  <td>
                    <a href="#" class="btn btn-success center-block ac" style="background-color: white; color: green; border: white;" onclick="RegistroPago('RIMAC','{{$a->nombreco}}','{{$a->planmedico}}','{{$totalP}}','{{$a->fechacon}}','{{$a->idc}}');" ><i class="fa fa-check-square"></i><input type="hidden" value="{{$a->idc}}" id="idcos"></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>