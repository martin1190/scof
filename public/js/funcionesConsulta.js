   window.addEventListener('load', function(){


    //Funcion para cargar las histrias
    $('#hp').click(function(){
        idp=$('#nhis').val();
        token=$('#token').val();         
        if(idp==''){
            alertify.error('Seleccion primero un paciente')
        }else{
            $('#historiaPaciente').modal('show')
            $.ajax({

                url: 'listaHistoriaP',
                data: {idp:idp},
                type: 'post',
                headers: {'X-CSRF-TOKEN': token},
                success: function(dato){
                    $('#listaHistoria').empty().html(dato);                                    
                    tabla('tblhist')
                }, 
                error: function(){
                    alertify.error('Error cargando las historias')
                }       
            });
        }
    });
    //Fin de la funcion para cargar las historias
    //Funcion para el tab de la fila OD
    pasartab('odesfera','oiesferaC')
    pasartab('odcilindro','oicilindroC')
    pasartab('odeje','oiejeC')
    pasartab('odav','oiavC')
    pasartab('oddip','odesfera')
    //Funcion para el tab de la fila OI
    pasartab('oiesfera','odcilindro')
    pasartab('oicilindro','odeje')
    pasartab('oieje','odav')
    pasartab('oiav','oiesfera')
    //Funcion para el tab de a fila OD Cerca
    pasartab('odesferaC','oicilindro')
    pasartab('odcilindroC','oieje')
    pasartab('odejeC','oiav')
    pasartab('odavC','oidip')
    pasartab('oddipC','odesferaC')
    //Funcion para el tab de la fila OI Cerca
        
    pasartab('oiesferaC','odcilindroC')
    pasartab('oicilindroC','odejeC')
    pasartab('oiejeC','odavC')
    pasartab('oiavC','oddipC')
    pasartab('oidipC','btnGu')    
    //Pasar al cie
    pasartab('txtoi','txtoi')
 }, false);
   function pasartab(inI, inD){
        $('#'+inI).keydown(function (e){
            if(e.which==9){
                $('#'+inD).focus()                
            }
        });    
   }
   function tabla(tabla){//Proporciona estilos a las tablas
        $('#'+tabla).dataTable({
        "sPaginationType":"full_numbers",
        "bJqueryUI": true,        
        "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                    "zeroRecords": "No hay coincidencias",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No registros disponibles",
                    "infoFiltered": "(Filtrado del total de  _MAX_ registros)",
                    "sSearch": "Buscar:",               
                    "paginate":{
                    "sFirst": "Primero",
                    "sLast": "Ultimo",
                    "sNext": "Siguiente",                 
                    "sPrevious": "Anterior" 
                    }
                  }                         
        });
    }
    function cargarDia(){//Cagra la lista de pacientes del dia
        token=$('#token').val();    
        $.ajax({
            url: "listaDia",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#tblLista').empty().html(dato);
                tabla('tblD');
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });
    }
    function cargarAtencion(){//Cagra la lista de pacientes del dia
        token=$('#token').val();    
        $.ajax({
            url: "listaAtencion",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            success: function(dato){
                $('#tblListaA').empty().html(dato);
                    
            },
            error: function(){
                alertify.error('Sucedio un error')
            }
        });
    }    
    function CargaPac(id, ida, p){
        //id=$('#idAte').val()        
        token=$('#token').val()
        tAte=$('#Atencio').val()
        ncons=$('#ncons').val()
        fech=$('#fecCo').val()
        $('#planMe').val(p)
        if(p=='MEDIDA DE LA VISTA'){
            $('#anm1').val('DEFICIT VISUAL. ACUDE PARA MEDIRSE LA VISTA')
            $('#FonOjo').attr('disabled',true)
            $('#chkTono').attr('disabled',true)
            $('#chkECE').attr('disabled',true)
            $('#EEO').attr('disabled',true)
            $('#chkBlef').attr('disabled',true)
            $('#chkSchirmer').attr('disabled',true)
            $('#chkRefra').attr('checked',true)
        }else{
            $('#anm1').val('')
            $('#FonOjo').attr('disabled',false)
            $('#chkTono').attr('disabled',false)
            $('#chkECE').attr('disabled',false)
            $('#EEO').attr('disabled',false)
            $('#chkBlef').attr('disabled',false)
            $('#chkSchirmer').attr('disabled',false)
            $('#chkRefra').attr('checked',false)            
        }
        $('#Taten').val(""+tAte)
        $.ajax({
            url: "Atencion/"+id+"/edit",
            type: 'GET',
            headers:{'X-CSRF-TOKEN': token},
            success: function(data){
                $('#idan').val(ida)
                $('#nombrePaciente').val(data.nombre)
                $('#nhis').val(data.id)
                $('#parentescoP').val(data.parentesco)
                $('#edadP').val(data.edad)
                $('#Taten').val(tAte)
                $('#sexoP').val(data.sexo)
                $('#telefonoP').val(data.telefono)
                $('#direccionP').val(data.direccion)
                $('#emailP').val(data.email)                
                
                $('#listaA').modal('hide')   
                cantidadConsulta(data.id)
                if(data.tipo_seguro_id!=1){
                    verificarTipo(id)
                }
            },
            error: function(){
                alertify.error('Ocurrio un error')
            }
        });
    }
    function cantidadConsulta(id){
        $.ajax({
            url: 'cantidadC',
            type: 'get',
            data: {
                id:id
            }, 
            success: function(r){
                $('#hcP').val(r)
            },
            error: function(){
                alertify.error('Error al verificar las consultas')
            }
        });
    }
    //verifica si es particular o rimac
    function verificarTipo(id){
        $.ajax({
            url: "carcomp",
            type: 'get',
            data: {
                id: id                
            },
            success: function(datas){
                $('#companiaT').val(datas[0].nombre)
            }
        });
    }
    function cargarpdf(nc, idp){
        $.ajax({
            url: 'Consultapdf/'+nc+'/'+idp,
            type: 'get',
            success: function(){
                 
            }
        });
    }
    function registroConsulta(){        
        nc=$('#hcP').val()
        ta=$('#Atencio').val()
        idpac=$('#nhis').val()
        ida=$('#idan').val()
        //para la tabla datoprevio
        fechaC=$('#fechaC').val()
        te=$('#txtte').val()
        anm1=$('#anm1').val()
        anm2=$('#anm2').val()
        anm3=$('#anm3').val()
        anm4=$('#anm4').val()
        antece=$('#antecedente1').val()
        antece1=$('#antecedente2').val()  
        usLen=$('#usLen').val()    
        if(te.length==0){
            te=''
        }else{
            te=te
        }
        if(anm1.length==0){
            anm1=''
        }else{
            anm1=anm1
        }
        if(anm2.length==0){
            anm2=''
        }else{
            anm2=anm2
        }
        if(anm3.length==0){
            anm3=''
        }else{
            anm3=anm3
        }
        if(anm4.length==0){
            anm4=''
        }else{
            anm4=anm4
        }  
        if(antece.length==0){
            antece=''
        }else{
            antece=antece
        }   
        if(antece1.length==0){
            antece1=''
        }else{
            antece1=antece1
        }                                                
        //para la tabla examen1
        odsc=$('#odsc').val()
        oisc=$('#oisc').val()
        odcc=$('#odcc').val()
        oicc=$('#oicc').val()
        odca=$('#odca').val()
        oica=$('#oica').val()
        if(odsc.length==0){
            odsc=''
        }else{
            odsc=odsc
        }        
        if(oisc.length==0){
            oisc=''
        }else{
            oisc=oisc
        }        
        if(odcc.length==0){
            odcc=''
        }else{
            odcc=odcc
        }        
        if(oicc.length==0){
            oicc=''
        }else{
            oicc=oicc
        }        
        if(odca.length==0){
            odca=''
        }else{
            odca=odca
        }        
        if(oica.length==0){
            oica=''
        }else{
            oica=oica
        }                                                        
        //para la tabla examen2
        orbPar=$('#orbPar').val()
        orbPar1=$('#orbPar1').val()
        aparLagr=$('#aparLagr').val()
        conjEsc=$('#conjEsc').val()
        conjEsc1=$('#conjEsc1').val()
        cornea=$('#cornea').val()
        cornea1=$('#cornea1').val()
        camaraAnt=$('#camaraAnt').val()
        irPup=$('#irPup').val()
        campoVi=$('#campoVi').val()
        cristalino=$('#cristalino').val()
        cristalino1=$('#cristalino1').val()
        vitreo=$('#vitreo').val()
        tonometria=$('#tonometria').val()
        od=$('#txtod').val()
        oi=$('#txtoi').val()
        motOcu=$('#motOcu').val()
        motOcu1=$('#motOcu1').val()
        schirmer=$('#schirmer').val()
        but=$('#but').val()
        covertest=$('#covertest').val()
        oftal1=$('#oftal1').val()
        oftal2=$('#oftal2').val()
        oftal3=$('#oftal3').val()
        oftal4=$('#oftal4').val()
        if(orbPar.length==0){
            orbPar=''
        }else{
            orbPar=orbPar
        } 
        if(orbPar1.length==0){
            orbPar1=''
        }else{
            orbPar1=orbPar1
        } 
        if(aparLagr.length==0){
            aparLagr=''
        }else{
            aparLagr=aparLagr
        } 
        if(conjEsc.length==0){
            conjEsc=''
        }else{
            conjEsc=conjEsc
        } 
        if(conjEsc1.length==0){
            conjEsc1=''
        }else{
            conjEsc1=conjEsc1
        } 
        if(cornea.length==0){
            cornea=''
        }else{
            cornea=cornea
        } 
        if(cornea1.length==0){
            cornea1=''
        }else{
            cornea1=cornea1
        } 
        if(camaraAnt.length==0){
            camaraAnt=''
        }else{
            camaraAnt=camaraAnt
        } 
        if(irPup.length==0){
            irPup=''
        }else{
            irPup=irPup
        } 
        if(campoVi.length==0){
            campoVi=''
        }else{
            campoVi=campoVi
        } 
        if(cristalino.length==0){
            cristalino=''
        }else{
            cristalino=cristalino
        } 
        if(cristalino1.length==0){
            cristalino1=''
        }else{
            cristalino1=cristalino1
        } 
        if(vitreo.length==0){
            vitreo=''
        }else{
            vitreo=vitreo
        }        
        if(tonometria.length==0){
            tonometria=''
        }else{
            tonometria=tonometria
        }  
        if(od.length==0){
            od=''
        }else{
            od=od
        }  
        if(oi.length==0){
            oi=''
        }else{
            oi=oi
        }  
        if(motOcu.length==0){
            motOcu=''
        }else{
            motOcu=motOcu
        }  
        if(motOcu1.length==0){
            motOcu1=''
        }else{
            motOcu1=motOcu1
        }     
        if(schirmer.length==0){
            schirmer=''
        }else{
            schirmer=schirmer
        } 
        if(but.length==0){
            but=''
        }else{
            but=but
        } 
        if(covertest.length==0){
            covertest=''
        }else{
            covertest=covertest
        } 
        if(oftal1.length==0){
            oftal1=''
        }else{
            oftal1=oftal1
        } 
        if(oftal2.length==0){
            oftal2=''
        }else{
            oftal2=oftal2
        }  
        if(oftal3.length==0){
            oftal3=''
        }else{
            oftal3=oftal3
        }
        if(oftal4.length==0){
            oftal4=''
        }else{
            oftal4=oftal4
        }                                                                                                                                                                                     
        //para la tabla de diagnostico
        diag1=$('#diag1').val()
        diag2=$('#diag2').val()
        diag3=$('#diag3').val()
        diag4=$('#diag4').val()
        cie1=$('#cie1').val()
        cie2=$('#cie2').val()
        cie3=$('#cie3').val()
        cie4=$('#cie4').val()
        if(diag1=='Seleccionar'){
            diag1=''
        }else{
            diag1=diag1
        }        
        if(diag2=='Seleccionar'){
            diag2=''
        }else{
            diag2=diag2
        }   
        if(diag3=='Seleccionar'){
            diag3=''
        }else{
            diag3=diag3
        }   
        if(diag4=='Seleccionar'){
            diag4=''
        }else{
            diag4=diag4
        }     
        if(cie1=='Seleccionar'){
            cie1=''
        }else{
            cie1=cie1
        }  
        if(cie2=='Seleccionar'){
            cie2=''
        }else{
            cie2=cie2
        }  
        if(cie3=='Seleccionar'){
            cie3=''
        }else{
            cie3=cie3
        }  
        if(cie4=='Seleccionar'){
            cie4=''
        }else{
            cie4=cie4
        }                                                        
        //para la tabla de tratamiento
        tra1=$('#tra1').val()
        tra2=$('#tra2').val()
        tra3=$('#tra3').val()
        tra4=$('#tra4').val()
        if(tra1.length==0){
            tra1=''
        }else{
            tra1=tra1
        }     
        if(tra2.length==0){
            tra2=''
        }else{
            tra2=tra2
        }     
        if(tra3.length==0){
            tra3=''
        }else{
            tra3=tra3
        }     
        if(tra4.length==0){
            tra4=''
        }else{
            tra4=tra4
        }                                     
        //para la tabla plan medico
        planMe=$('#planMe').val()
        if(planMe.length==0){
            planMe=''
        }else{
            planMe=planMe
        }         
        //para la tabla de refraccion
        odesfera=$('#odesfera').val()
        oiesfera=$('#oiesfera').val()
        odesferaC=$('#odesferaC').val()
        oiesferaC=$('#oiesferaC').val()
        odcilindro=$('#odcilindro').val()
        oicilindro=$('#oicilindro').val()
        odcilindroC=$('#odcilindroC').val()        
        oicilindroC=$('#oicilindroC').val()  
        odeje=$('#odeje').val()
        oieje=$('#oieje').val()
        odejeC=$('#odejeC').val()
        oiejeC=$('#oiejeC').val()
        odav=$('#odav').val()
        oiav=$('#oiav').val()
        odavC=$('#odavC').val()
        oiavC=$('#oiavC').val()
        oddip=$('#oddip').val()
        oidip=$('#oidip').val()
        oddipC=$('#oddipC').val()
        oidipC=$('#oidipC').val()
        if(odesfera.length==0){
            odesfera=''
        }else{
            odesfera=odesfera
        }    
        if(oiesfera.length==0){
            oiesfera=''
        }else{
            oiesfera=oiesfera
        }    
        if(odesferaC.length==0){
            odesferaC=''
        }else{
            odesferaC=odesferaC
        }    
        if(oiesferaC.length==0){
            oiesferaC=''
        }else{
            oiesferaC=oiesferaC
        }          
        if(odcilindro.length==0){
            odcilindro=''
        }else{
            odcilindro=odcilindro
        }    
        if(oicilindro.length==0){
            oicilindro=''
        }else{
            oicilindro=oicilindro
        }    
        if(odcilindroC.length==0){
            odcilindroC=''
        }else{
            odcilindroC=odcilindroC
        }    
        if(oicilindroC.length==0){
            oicilindroC=''
        }else{
            oicilindroC=oicilindroC
        }          
        if(odeje.length==0){
            odeje=''
        }else{
            odeje=odeje
        }    
        if(oieje.length==0){
            oieje=''
        }else{
            oieje=oieje
        }    
        if(odejeC.length==0){
            odejeC=''
        }else{
            odejeC=odejeC
        }    
        if(oiejeC.length==0){
            oiejeC=''
        }else{
            oiejeC=oiejeC
        }        
        if(odav.length==0){
            odav=''
        }else{
            odav=odav
        }    
        if(oiav.length==0){
            oiav=''
        }else{
            oiav=oiav
        }    
        if(odavC.length==0){
            odavC=''
        }else{
            odavC=odavC
        }    
        if(oiavC.length==0){
            oiavC=''
        }else{
            oiavC=oiavC
        }          
        if(oddip.length==0){
            oddip=''
        }else{
            oddip=oddip
        }  
        if(oidip.length==0){
            oidip=''
        }else{
            oidip=oidip
        }  
        if(oddipC.length==0){
            oddipC=''
        }else{
            oddipC=oddipC
        }      
        if(oidipC.length==0){
            oidipC=''
        }else{
            oidipC=oidipC
        }                                                                                                                      
        //para la tabla de procedimientos
        if( $('#FonOjo').prop('checked')) {
            FonOjo=$('#FonOjo').val()    
        }else{
            FonOjo=''
        }
        if( $('#chkTono').prop('checked') ) {
            chkTono=$('#chkTono').val()   
        }else{
            chkTono=''
        }     
        if( $('#chkECE').prop('checked') ) {
            chkECE=$('#chkECE').val()   
        }else{
            chkECE=''
        }
        if( $('#EEO').prop('checked') ) {
            EEO=$('#EEO').val()
        }else{
            EEO=''
        }
        if( $('#chkBlef').prop('checked') ) {
            chkBlef=$('#chkBlef').val()
        }else{
            chkBlef=''
        }
        if( $('#chkRefra').prop('checked') ) {
            chkRefra=$('#chkRefra').val()   
        }else{
            chkRefra=''
        }
        if( $('#chkSchirmer').prop('checked') ) {
            chkSchirmer=$('#chkSchirmer').val()  
        }else{
            chkSchirmer=''
        }                                                   
        if(nc.length>0){
            $.ajax({
                url: 'RegistroConsulta',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                data:{
                    nc:nc,
                    ta:ta,
                    ida:ida,
                    idpac:idpac,
                    //para la tabla datoprevio
                    fechaC:fechaC,
                    te:te,
                    anm1:anm1,
                    anm2:anm2,
                    anm3:anm3,                    
                    anm4:anm4,
                    antece:antece,
                    antece1:antece1,
                    usLen:usLen,
                    //para la tabla examen1
                    odsc:odsc,
                    oisc:oisc,
                    odcc:odcc,
                    oicc:oicc,
                    odca:odca,
                    oica:oica,
                    //para la tabla examen2
                    orbPar:orbPar,
                    orbPar1:orbPar1,
                    aparLagr:aparLagr,
                    conjEsc:conjEsc,
                    conjEsc1:conjEsc1,
                    cornea:cornea,
                    cornea1:cornea1,
                    camaraAnt:camaraAnt,
                    irPup:irPup,
                    campoVi:campoVi,
                    cristalino:cristalino,
                    cristalino1:cristalino1,
                    vitreo:vitreo,
                    tonometria:tonometria,
                    od:od,
                    oi:oi,
                    motOcu:motOcu,
                    motOcu1:motOcu1,
                    schirmer:schirmer,
                    but:but,
                    covertest:covertest,
                    oftal1:oftal1,
                    oftal2:oftal2,
                    oftal3:oftal3,
                    oftal4:oftal4,
                    //para la tabla de diagnostico
                    diag1:diag1,
                    diag2:diag2,
                    diag3:diag3,
                    diag4:diag4,
                    cie1:cie1,
                    cie2:cie2,
                    cie3:cie3,
                    cie4:cie4,
                    //para la tabla de tratamiento
                    tra1:tra1,
                    tra2:tra2,
                    tra3:tra3,
                    tra4:tra4,
                    //para la tabla plan medico
                    planMe:planMe,
                    //para la tabla de refraccion
                    odesfera:odesfera,
                    oiesfera:oiesfera,
                    odesferaC:odesferaC,
                    oiesferaC:oiesferaC,
                    odcilindro:odcilindro,
                    oicilindro:oicilindro,
                    odcilindroC:odcilindroC,
                    oicilindroC:oicilindroC,
                    odeje:odeje,
                    oieje:oieje,
                    odejeC:odejeC,
                    oiejeC:oiejeC,
                    odav:odav,
                    oiav:oiav,
                    odavC:odavC,
                    oiavC:oiavC,
                    oddip:oddip,
                    oidip:oidip,
                    oddipC:oddipC,
                    oidipC:oidipC,
                    //para la tabla de procedimientos
                    FonOjo:FonOjo,
                    chkTono:chkTono,
                    chkECE:chkECE,
                    EEO:EEO,
                    chkBlef:chkBlef,
                    chkRefra:chkRefra,
                    chkSchirmer:chkSchirmer
                },                
                success: function(r){
                    if(r=='Consulta registrada'){
                        alertify.success('Consulta Registrada')
                        $('#frmDato')[0].reset()
                        $('#frmConsulta')[0].reset()                        
                        $('#cie1').val('Seleccionar').trigger('change.select2');
                        $('#diag1').val('Seleccionar').trigger('change.select2');
                        $('#cie2').val('Seleccionar').trigger('change.select2');
                        $('#diag2').val('Seleccionar').trigger('change.select2');                        
                        $('#cie3').val('Seleccionar').trigger('change.select2');
                        $('#diag3').val('Seleccionar').trigger('change.select2');                        
                        $('#cie4').val('Seleccionar').trigger('change.select2');
                        $('#diag4').val('Seleccionar').trigger('change.select2');                        
                        //Esta es una opcion
                        //window.open('historia/'+nc+'/'+idpac, "Historia Clinica" , "width=2480,height=3508,scrollbars=NO")                         
                        window.open('Consultapdf/'+nc+'/'+idpac, '_blank');
                        a=window.open('Receta/'+idpac+'/'+nc,'Receta de Paciente','location=no, directories=no,width=620,height=650,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
                        b=window.open('Refraccion/'+idpac+'/'+nc,'Refraccion del Paciente',' location=no, directories=no,width=595,height=420,left=240,scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');                                                                                            
                    }else{
                        alertify.error('Ocurrio un error en el registro')
                    }
                }, 
                error: function(){

                }
            });
        }else{
            alertify.error('No se puede registrar la consulta')            
        }
    }
//Realizar el llenado de acuerdo a la opcion
  function cambiocie(numc){    
    diag=$('#diag'+numc).val() 
    if(diag!='Seleccionar'){
        $.ajax({
          url: 'cambio',
          data:{
            diag: diag,        
          },
          type: 'GET',
          success: function(red){        
            c=$("#cie"+numc).val()
            if(c==red[0].cod_cie){            
            }else{
                $("#cie"+numc).val(red[0].cod_cie).change()
            }        
          }  
        });  
    }
  }
  function cambiodesc(numc){    
    diag=$('#cie'+numc).val()
    if(diag!='Seleccionar'){
        $.ajax({
          url: 'cambio1',
          data:{
            diag: diag,        
          },
          type: 'GET',
          success: function(red){
            
            d=$("#diag"+numc).val()
            if(d==red[0].desc_enf){            
            }else{
                $("#diag"+numc).val(red[0].desc_enf).change()                    
            }
          }
        }); 
    }       
  }
//Funcion que permite capturar la ultima palabra y colocarla en el siguinete input
  function pasarInput(cantidad,inicial, siguiente){
    vl=$('#'+inicial).val();
    c=vl.length
    if(c==cantidad){
        cadena=vl.split(" ")
        $('#'+siguiente).val(cadena.pop())
        $('#'+siguiente).focus()
        nuevo=cadena.join(' ')
        $('#'+inicial).val(nuevo)
    }
  }



