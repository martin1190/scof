   window.addEventListener('DOMContentLoaded', function(){    
    $('#btnAgregarC').click(function(){
    nombreC=$('#nombreC').val()
    rucCo=$('#rucCo').val()
    Aseguradora=$('#Aseguradora').val()
    coFi=$('#coFi').val()
    coVa=$('#coVa').val()    
    if(nombreC.length>1){        
            if(Aseguradora!=0){
                if(coFi.length>=0){
                    if(coFi>=0){
                        if(coVa.length>=0){
                            if(coVa>=0){
                                AgregarCompania();                                
                            }else{
                                alertify.error('Ingrese solo valores positivos')
                            }
                        }else{
                            alertify.error('Ingrese el monto de copago variable')
                        }
                    }else{
                        alertify.error('Ingrese solo valores positivos ')
                    }
                }else{
                    alertify.error('Ingrese el monto de copago FIjo')
                }
            }else{
                alertify.error('Selecciona una Aseguradora')
            }
    }else{
        alertify.error('Ingrese el nombre de la compania')
    }
        
    });
    $('#tipoServicio').change(function (){
        t=$('#tipoServicio').val()
        $('#compania').find('option').remove();            
        $('#compania').append('<option value="">Seleccionar</option>');                    
        cargarCompanias(t);
    });
document.getElementById("btnmac").style.display="none";
$('#tipoServicio').change(function(){  
  ts=$("#tipoServicio option:selected").index()
  if(ts!=1){
    document.getElementById("btnmac").style.display="block";    
    $('#abtn').attr('class','col-sm-1')
    $('#Rta').attr('class','col-sm-2')
    $('#btnmac').attr('class','btn bg-navy btn-sm')
    $('#compania').attr('disabled',false)
  }else{
    document.getElementById("btnmac").style.display="none";    
    $('#abtn').removeAttr('class','col-sm-1')
    $('#Rta').attr('class','col-sm-3')    
    $('#compania').attr('disabled',true)
  }
});
$('#abtn').click(function (){
  ida=$('#tipoServicio').val()
$('#Aseguradora > option[value='+ida+']').attr('selected', 'selected');            
});
  $('#idtipo_plan > option[value="1"]').attr('selected', 'selected');    
 }, false)
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

    function desNom(){  //Desahabilita el campo de nombre cuando esta en el campo DNI
        dni=$('#dniPaciente').val()
        if(dni.length>1){
            $('#nombrePaciente').prop('disabled', true)
        }else{
            $('#nombrePaciente').prop('disabled', false)
        }
    }
    function desDNI(){//Deshabilita el campo DNI cuanto esta en el campo nombre
        dni=$('#nombrePaciente').val()
        if(dni.length>1){
            $('#dniPaciente').prop('disabled', true)
        }else{
            $('#dniPaciente').prop('disabled', false)
        }
    }    
    function BuscarPaciente(){//Devuelde la lista de pacientes que conincide con los parametros indicados
        dni= $('#dniPaciente').val();
        nombre=$('#nombrePaciente').val();
        token=$('#token').val();        
        valor="";
        if(dni.length==8){
            valor=dni;
        }else if(nombre.length>2){
            valor=nombre;
        }else if(dni.length==0 && nombre.length==0){
            alertify.error('Ingrese un parametro de busqueda')
        }
    $.ajax({
        url: "DatosPaciente/"+valor,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',        
        beforeSend: function(){
	      	document.getElementById("upload-img").style.display="block";
	      	document.getElementById("upload-img").innerHTML="<img src='img/espere.gif' />";         
        }, 
        success: function(resp){
            document.getElementById("upload-img").style.display="none";
            if(resp=='No hay datos'){                
                alertify.error('No hay paciente con esos parametros')
                $('#registro').modal('show')
                $('#nuevodni').val(dni);
            }else{                 
                $('#historia').empty().html(resp);
                tabla('dataTables-example');
            }
        },
        error: function(){
            document.getElementById("upload-img").style.display="none";
            alertify.error('Ocurrio un error')
        }
    });        
    }	
    function registroPaciente(){//realiza el registro de nuevos pacientes
        formData = new FormData($("#frmPaciente")[0]);
        token=$('#token').val();    
        if(validarCamposRegistro()){
            $.ajax({
                url: "Paciente",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': token},
                data: formData,          
                contentType: false,
                processData: false,            
                beforeSend: function(){
                document.getElementById("upload-img").style.display="block";
                document.getElementById("upload-img").innerHTML="<img src='img/espere.gif' />";         
                },
                success: function(re){                
                    if(re=='ocurrio un error'){                    
                        alertify.error("Ocurrio un error al registrar el paciente");
                        document.getElementById("upload-img").style.display="none";
                        $('#registro').modal('hide')  
                    }else if(re=='No se recibieron Datos'){
                        alertify.error("Ocurrio un errro a enviar los datos");   
                        document.getElementById("upload-img").style.display="none"; 
                        $('#registro').modal('hide')                  
                    }else if(re=='El paciente ya esta registrado'){                    
                        document.getElementById("upload-img").style.display="none";
                        $('#registro').modal('hide')  
                        alertify.alert('Paciente ya se encuentra registrado')
                    }else if(re!='registrado'){
                        document.getElementById("upload-img").style.display="none";
                        $('#registro').modal('hide')                    
                        alertify.success("Paciente Regitrado")
                        $('#historia').empty().html(re)
                        tabla()                            
                        $('#frmPaciente')[0].reset()      
                        $('#compania').val('Seleccionar').trigger('change.select2');
                    }
                },
                error: function(){
                    document.getElementById("upload-img").style.display="none";
                }
            });            
        }else{
            console.log('no se verifo')
        }
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
    function comboTipo(){//deshabilta el campo compania si no es del tipo rimac
        ts=$('#tipoServicio').val();
        if(ts=='1'){
            $('#compania').attr('disabled',true);
        }else if(ts=='2'){
            $('#compania').attr('disabled',false);
        }
    }
function validarCamposRegistro(){
        nombre = $('#nombre').val()
        dni = $('#nuevodni').val()
        fecnac = $('#fecnac').val()
        sexo = $('#sexo').val()    
        tipos = $('#tipoServicio').val()
        compania = $('#compania').val()
        parentesco = $('#parentesco').val()
        planmed = $('#planmedico').val()
        tipoPlan =$('#idtipo_plan').val()
        if(nombre.length>0){
            if(dni.length>0 && dni.length==8){
                if(fecnac.length>0 && fecnac.length==10){
                    if(sexo.length>0){
                        if(tipos.length>0){
                            if(tipos==1){
                                if(planmed.length>0){
                                    if(tipoPlan.length>0){
                                        return true
                                    }else{
                                        alertify.alert('Seleccione el tipo de atencion')
                                        $('#idtipo_plan').focus()
                                        return false                                         
                                    }
                                }else{
                                    alertify.alert('Seleccione un plan medico')
                                    $('#planmedico').focus()
                                    return false                                     
                                }
                            }else{
                                if(compania!='Seleccionar'){
                                    if(parentesco.length>0){
                                        if(planmed.length>0){
                                            if(tipoPlan.length>0){
                                                return true
                                            }else{
                                                alertify.alert('Seleccione el tipo de atencion')
                                                $('#idtipo_plan').focus()
                                                return false                                                    
                                            }
                                        }else{
                                            alertify.alert('Seleccione un plan medico')
                                            $('#planmedico').focus()
                                            return false                                              
                                        }
                                    }else{
                                        alertify.alert('Seleccione el grado de parentesco')
                                        $('#parentesco').focus()
                                        return false                                          
                                    }
                                }else{
                                    alertify.alert('Seleccione la compañia a la que pertence')
                                    $('#compania').focus()
                                    return false                                      
                                }
                            }
                        }else{
                            alertify.alert('Seleccione un Servicio')
                            $('#tipoServicio').focus()
                            return false                              
                        }
                    }else{
                        alertify.alert('Seleccione un Genero')
                        $('#sexo').focus()
                        return false  
                    }
                }else{
                    alertify.alert('Verifique la Fecha de Nacimiento')
                    $('#fecnac').focus()
                    return false                    
                }
            }else{
                alertify.alert('Verifique el campo DNI')
                $('#nuevodni').focus()
                return false
            }
        }else{
            alertify.alert('El Nombre es un campo obligatorio')
            $('#nombre').focus()
            return false
        }
}
function AgregarId(id){
    $('#idPer').val(""+id)
}
function AgregarParaConsulta(){
    token=token=$('#token').val()
    id=$('#idPer').val()
    tAtencion=$('#tAtencion').val()
    planMedi=$('#planMedi').val()
    $.ajax({
        url: "AddConsultaDia",
        type: 'POST',
        data: {
            id: id,
            tAtencion: tAtencion,
            planMedi: planMedi
        },
        headers:{'X-CSRF-TOKEN': token},
        success: function (res){    
            if(res=="Paciente Agregado Correctamente"){
                alertify.alert("Agregado Correctamente")
                $('#complemento').modal('hide') 
            }else{                
                alertify.alert(res)
            }
        }, 
        error: function(){
            alertify.error("Ocurrio un error")
        }
    });
}
function obtenerCompania(id){
    token=$('#token').val()
    $.ajax({
        url: 'obComp',
        type: 'get',
        data: {id : id},
        headers:{'X-CSRF-TOKEN': token},
        success: function (com){            
            $("#compania").val(com[0].id_compania).change()
        }
    });
}
function cargarDatosPaciente(id){
    $('#modPaci').attr({'id':'btnRegPac','class':'btn btn-warning btn-sm'})
    token=token=$('#token').val()    
    $.ajax({
        url: 'Paciente/'+id+'/edit',
        type: 'GET',
        headers:{'X-CSRF-TOKEN': token},
        success: function (respuesta){            
            $('#registro').modal('show') 
            $('#nombre').val(respuesta.nombre)
            $('#nuevodni').val(respuesta.dni)
            $('#fecnac').val(respuesta.fecnac)
            $('#sexo').val(respuesta.sexo)
            $('#direccion').val(respuesta.direccion)
            $('#email').val(respuesta.email)
            $('#telefono').val(respuesta.telefono)
            $('#tipoServicio').val(respuesta.tipo_seguro_id)
            if(respuesta.tipo_seguro_id!=1){
                cargarCompanias(respuesta.tipo_seguro_id)
                obtenerCompania(respuesta.id)
                $('#compania').attr('disabled',false)
            }else{
                $('#compania').attr('disabled',true)
            }
            $('#parentesco').val(respuesta.parentesco)
            $('#planmedico').attr('disabled',true)
            $('#idtipo_plan').attr('disabled',true)            
            $('#btnRegPac').attr({'id':'modPaci','class':'btn btn-warning btn-sm','onclick': "modificarPaciente("+id+")"})            
        }, 
        error: function (){
            alertify.error("Ocurrio un error al cargar los datos del paciente")
        }
    });
}
function modificarPaciente(idP){
    token=token=$('#token').val()
    nombre=$('#nombre').val()
    dni=$('#nuevodni').val()
    fecnac=$('#fecnac').val()
    sexo=$('#sexo').val()
    direccion=$('#direccion').val()
    email=$('#email').val()
    telefono=$('#telefono').val()
    tiposer=$('#tipoServicio').val()    
    compania=$('#compania').val()
    parentesco=$('#parentesco').val()    
    $.ajax({
        url: 'Paciente/'+idP,
        type: 'PUT',
        headers:{'X-CSRF-TOKEN': token},
        data: {
            nombre:nombre,
            dni:dni,
            fecnac:fecnac,
            sexo:sexo,
            direccion:direccion,
            email:email,
            telefono:telefono,
            tiposer:tiposer,
            compania:compania,
            parentesco:parentesco,
        },
        success: function(resp){
            if(resp=='Datos Actualizados'){
                $('#registro').modal('hide') 
                alertify.success('Datos del Paciente modificados')
                $('#modPaci').attr({'id':'btnRegPac','class':'btn btn-success btn-sm','onclick':'registroPaciente()'})                
                $('#frmPaciente')[0].reset()
                BuscarPaciente()
            }else if(resp=='No se realizaron cambios'){
                alertify.log('No se encontraron cambios')
            }else{
                alertify.error(resp)
            }
        },
        error: function(){
            alertify.error('Ocurrio un error al Actualizar')
        }
    });
}
function consultasAnno(idP){//Funcion que devuelve la cantidad de consultas del paciente por año
token=token=$('#token').val()
$.ajax({
    url: 'ConAn/'+idP,
    type: 'GET',    
    headers:{'X-CSRF-TOKEN': token},
    success: function (resp){
        $('#AtenAnno').modal('show')
        $('#tblListaAn').empty().html(resp);
        tabla('tblAtenAnno');        
    }, 
    error: function(){
        alertify.error('Ocurrio un error en la consulta')
    }
});

}
//Funcion para agregar una compania en el modal de agregar paciente
function AgregarCompania(){
    var formData = new FormData($("#frmcomp")[0]);
    token=$('#token').val()
    $.ajax({
        url:'compania',
        type:'post',
        headers:{'X-CSRF-TOKEN': token},
        data: formData,
        contentType: false,
        processData: false,        
        success: function(re){
            alertify.success('Compañia Registrada')
            $('#modalCompa').modal('hide')  
            $('#frmcomp')[0].reset()
            $('#compania').find('option').remove();
            $('#compania').append('<option value="Seleccionar">Seleccionar</option>');            
            cargarCompanias(formData.get('Aseguradora'))                        
        }, 
        error: function (){
            alertify.error('Ocurrio un error')
        }
    });
}
function cargarCompanias(idA){

$.ajax({
    url: 'cargaCompania',
    type: 'get',
    data: {
        idA: idA
    },
    dataType: 'json',
    success: function (re){        
        $(re).each(function(i, v){ // indice, valor            
            $('#compania').append('<option value="' + v.id + '">' + v.nombre + '</option>');
        });
    }, 
    error: function(){
        alertify.error('Error al cargar las compañias')
    }
});
}