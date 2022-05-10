$(document).ready(function(){
    if($('.form-dia-hora').length){
        let fecha = new Date();
            let anio = fecha.getFullYear();
            let mes = fecha.getMonth() + 1;
            let dia = fecha.getDate();
            let hora = fecha.getHours();
            let minutos = fecha.getMinutes();
            let segundos = fecha.getSeconds();

            let hora_min = hora+3;
            let dia_max = dia+5;
            if(mes < 10){
                mes = "0" + mes;
            }
            if(dia < 10){
                dia = "0" + dia;
            }
            if(hora < 10){
                hora = "0"+hora;
            }
            if(minutos < 10){
                minutos = "0"+minutos;
            }
            if(segundos < 10){
                segundos = "0"+segundos;
            }
            if(hora_min < 10){
                hora_min = "0"+hora_min;
            }
            if(dia_max < 10){
                dia_max = "0"+dia_max;
            }

            
            

            let fecha_min = anio + '-' + mes + '-' + dia + 'T' + hora_min + ':' + minutos;
            let fecha_max = anio + '-' + mes + '-' + dia_max + 'T' + hora + ':' + minutos;
            $('.form-dia-hora').attr('min',fecha_min);
            $('.form-dia-hora').attr('max',fecha_max);
    }
});