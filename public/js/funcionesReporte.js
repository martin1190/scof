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
    $('#printRD').click(function (){
        reporteGenDg()
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
function reporteGenDg(){
fi=$('#fecIniD').val()
ff=$('#fecFinD').val()
di=$('diagnostico').val()
    if(fi!='Seleccionar'){
        if(ff.length>9){
            if(di.length>1){

            }else{

            }
        }else{
            alertify.error('Indique una fecha de fin')
        }
    }else{
        alertify.error('Indique una fecha de inicio')
    }
}

