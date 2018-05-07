window.addEventListener('load', function(){
    cargarDia()
    //imprime los resultados
    $('#printR').click(function(){
        t=$('#tipo').val()
        if(t=='Seleccionar'){
            window.open('ReporteDiaPDF', '_blank');
        }else{
            fi=$('#fecIni').val()
            ff=$('#fecFin').val()
            window.open('ReporteDiaFechaG/'+fi+'/'+ff+'/'+t,'_blank');
        }
    });
    $('#btnBus').click(function(){
        ts=$('#tipo').val()        
        DiaxFechas(ts)        
    });
    //Para los reportes de diagnostico
    $('#btnBusRD').click(function (){
        reporteGenDg()
        $('#tpR').val('1')
    });
    $('#btnBusRDF').click(function (){
        reporteResFeD()
        $('#tpR').val('2')
    });
    $('#btnBusFre').click(function (){
        reporteFrecuente()
        $('#tpR').val('3')
    });        
    $('#printRD').click(function (){
        t=$('#tpR').val()
        if(t==1){
           fi=$('#fecIniD').val()
           ff=$('#fecFinD').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('printRPD/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }            
        }else if(t==2){
           fi=$('#fecIniDR').val()
           ff=$('#fecFinDR').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('printRPD/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }else if(t==3){
           fi=$('#fecIniDF').val()
           ff=$('#fecFinDF').val()
           if(fi.length>9){
                if(ff.length>9){
                    if(ff<fi){
                        alertify.error('La fecha final no puede ser antes de la inicial')
                    }else{
                        window.open('printRPD/'+fi+'/'+ff,'_blank')
                    }
                }else{
                    alertify.error('Tiene que indicar una fecha de fin')
                }
           }else{
            alertify.error('Tiene que indicar una fecha de Inicio')
           }
        }
    });
}, false);
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
function cargarDia(){
    $.ajax({
        url:'ReporteDia',
        type:'get',
        success: function (info){
            $('#reporte').empty().html(info);
            tabla('reporteD')
        },
        error: function (){
            alertify.error('Ocurrio un error al cargar la lista')
        }
    });
}
//Generar el reporte para un rango de fechas y un tipo de busqueda
function DiaxFechas(t){
    fi=$('#fecIni').val()
    ff=$('#fecFin').val()
    if (fi.length>9) {
        if(ff.length>9){
            if (t=='Seleccionar') {
                alertify.error('Tiene que seleccionar un tipo')        
            }else{
                $.ajax({
                    url: 'ReporteDiaFecha',
                    type: 'GET',
                    data: {
                        fi: fi,
                        ff: ff,
                        t:t
                    },
                    success: function (re){
                        $('#reporte').empty().html(re)
                        tabla('reporteD')
                    }, 
                    error: function(){
                        alertify.error('Ocurrio un error')
                    }
                });
            }
        }else{
            alertify.error('Indique una fecha de fin')    
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }
}
// Funciones para generar reporte de diagnisticos

//Report resumen por fechas
function reporteGenDg(){
fi=$('#fecIniD').val()
ff=$('#fecFinD').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ReporteDiagnosticoF',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('reporteD')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }
}
//Reporte resumen de diagnosticos por fechas
function reporteResFeD(){
    fi=$('#fecIniDR').val()
    ff=$('#fecFinDR').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'ResumenDiag',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('resumenDiag')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }    
}
//reporte con los diagnosticos mas frecuentes
function reporteFrecuente(){
    fi=$('#fecIniDF').val()
    ff=$('#fecFinDF').val()
    if(fi.length>9){
        if(ff.length>9){
            if(ff<fi){
                alertify.error('La fecha final no puede ser antes de la fecha inicial')
            }else{
               $.ajax({
                url: 'DiagnosticoFrecuente',
                type: 'GET',
                data: {
                    fi: fi,
                    ff:ff
                }, 
                success: function (r){
                    $('#reporteDiagnostico').empty().html(r)
                    tabla('DiagFrecuente')
                }, 
                error: function(){
                    alertify.error('Ocurrio un error')
                }
               });
            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }    
}