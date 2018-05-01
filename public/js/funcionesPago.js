window.addEventListener('DOMContentLoaded', function(){    
    //Acciones a realizar al hacer click 
    //Funcion Pendiente para actualizar la tabla con la funcionalidad de datatable y todas sus funciones
    //tabla('tblListaPago')
 }, false);
function tabla(tabla){//Proporciona estilos a las tablas
        tb=$('#'+tabla).dataTable({
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
function MostrarProcedimiento(idc){    
        $('#i').val(idc)          
        id=$('#i').val()
        $('#fo').show()
        $('#tonometria').show()
        $('#extraCE').show()
        $('#exo').show()
        $('#blefaratomia').show()
        $('#refraccion').show()
        $('#schirmer').show()
        $.ajax({
            url: 'MostrarProcedimiento/'+id,
            type: 'get',        
            success: function (r){                   
                for (var i = 0; i < r.length; i++) {                    
                        switch(r[i].procedimiento){
                            case 'Fondo de Ojo':                            
                                $('#fo').hide()
                                break;
                            case 'Tonometria':
                                $('#tonometria').hide()
                                break;
                            case 'Extraccion CE':
                                $('#extraCE').hide()
                                break;
                            case 'Examen Externo del Ojo':
                                $('#exo').hide()
                                break;
                            case 'Blefaratomia':
                                $('#blefaratomia').hide()
                                break;
                            case 'Refraccion':
                                $('#refraccion').hide()
                                break;
                            case 'Test de Schirmer':
                                $('#schirmer').hide()
                                break;
                        }
                    }            
            }, 
            error: function (){
                console.log('Error al cargar los procedimientos')
            }
        });                
}
function CargarListaPagos(){
    token=$('#token').val();        
    $.ajax({
        url: 'listaPago',
        type: 'get',
        headers: {'X-CSRF-TOKEN': token},
        success: function(dato){
            $('.Pagos').empty().html(dato);                            
        }, 
        error: function (){
            alertify.error('No se cargo la lista')
        }
    });
}
function quitarProcedimiento(idp){
    token=$('#token').val()
    $.ajax({
        url:'quitarProce/'+idp,
        type: 'delete',
        headers:{'X-CSRF-TOKEN': token},
        success: function (qp){
            if (qp=='Eliminado') {}
            alertify.log('Procedimiento Eliminado')              
            CargarListaPagos()
        },
        error: function (){
            console.log('No se puede quitar el procedimiento')
        }
    });
}
function AgregarProcedimiento(pro){    
    token=$('#token').val()
    id=$('#i').val()
    ht=$('#tblListaPago').html()
    $.ajax({
        url: 'AgregarProcedimiento',
        type: 'post',
        headers:{'X-CSRF-TOKEN': token},
        data: {
            idc:id,
            pro:pro
        },
        success: function (res){
            if(res=='Agregado'){
                alertify.success('Procedimiento Agregado')
                CargarListaPagos()
            }else{
                alertify.Error('Ocurrio un error')
            }
            
        },
        error: function (){
            alertify.error('Error al agregar el procedimiento')
        }
    });
}
function RegistroPago(tipo,compania,plan, total, fecha, consultaid){            
    token=$('#token').val()
    $.ajax({
        url: 'Pagos',
        type:'post',
        headers:{'X-CSRF-TOKEN': token},
        data: {
            tipo: tipo,
            compania: compania,
            plan: plan, 
            total: total,
            fecha: fecha, 
            consultaid: consultaid
        },
        success: function (rep){
            if(rep.mensaje=='Registrado'){
                alertify.success('Pago Registrado')
                CargarListaPagos()
                //tabla('tblListaPago')
                if(rep.cantidadP!=0){
                    RegistroPagoProcedimiento(consultaid, compania)
                }                                
            }else{
                alertify.error('No se Registro')
                console.log(rep)
            }
        }, 
        error: function(){
            alertify.error('Ocurrio un error al registrar el pago')
        }
    });
}
function RegistroPagoProcedimiento(idc, compania){
    $.ajax({
        url: 'pagoProcedimiento',
        type: 'get',
        data: {
            idc:idc,
            compania: compania
        },
        dataType: 'json',
        success: function (re){
            console.log('registrado')
        },
        error: function (){
            console.log('error')
        }
    });
}

