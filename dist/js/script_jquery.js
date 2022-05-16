let map
let marcador
let geoLoc
let latitud
let longitude
function initMapa(){
    if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition( function(position){
            latitud = position.coords.latitude;
            longitude = position.coords.longitude;
            
            const myLating = new google.maps.LatLng(latitud, longitude);
            map = new google.maps.Map(document.getElementById("mapa"), {
                center: myLating,
                mapTypeControl: true,
                zoom: 13,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marcador = new google.maps.Marker({
                position: myLating,
                map: map,
                title: "Mi seleccion",
                draggable: true
            })
            google.maps.event.addListener(marcador,'drag', function(event){
                let str = `${event.latLng.lat()},${event.latLng.lng()}`;
                $("#direccion").attr('value',str)
            })
            let str = `${latitud},${longitude}`;
            $("#direccion").attr('value',str);
        }, function(){
            alert("No se pudo obtener las cordenadas")
        })
    }
}
function showLocationOnMap(position){
    const myLating = {lat: latitud, lng: longitude};
    marcador.setPosition(myLating);
    mapa.setCenter(myLating);
}

//window.iniciar_mapa = iniciar_mapa;
$(document).ready(function(){
    if(navigator.geolocation){
        //initMapa()
    }
    if($('.form-dia-hora').length){
        let fecha = new Date();
            let anio = fecha.getFullYear();
            let mes = fecha.getMonth() + 1;
            let dia = fecha.getDate();
            let hora = fecha.getHours();
            let minutos = fecha.getMinutes();
            let segundos = fecha.getSeconds();

            let hora_min;
            if(hora > 21){
                hora_min = (hora - 24) + 3;
            } else{
                hora_min = hora+3;
            }
            let dia_max;
            switch(mes){
                //31
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    if(dia >= 27){
                        dia_max = (dia - 31 ) + 5;
                    } else{
                        dia_max = dia+5;
                    }
                    break;
                case 3:
                case 4:
                case 6:
                case 9:
                case 11:
                    if(dia >= 26){
                        dia_max = (dia - 30 ) + 5;
                    } else{
                        dia_max = dia + 5;
                    }
                    break;
                case 2:
                    if((anio%4) == 0){
                        if(dia >= 25){
                            dia_max = (dia - 29 ) + 5;
                        } else{
                            dia_max = dia + 5;
                        }
                    } else{
                        if(dia >= 24){
                            dia_max = (dia - 28 ) + 5;
                        } else{
                            dia_max = dia + 5;
                        }
                    }

            }
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
            $('#fecha_min').attr('value',fecha_min);
            $('#fecha_max').attr('value',fecha_max);

            $(window).on('resize',function(){
                let tam = $('body').width();
                if(tam <=1200 ){
                    $("#formulario-izq").attr('style','text-align: left');
                    $("#formulario-der").attr('style','text-align: center; float: center; width: 100% ; height: 200px');
                    $("#formulario-der").addClass('col-12')
                    $("#formulario-der").addClass('pt-5')
                    $("#formulario-izq").addClass('col-12')
                    $("footer").css("position"," auto");
                    $("footer").css("bottom","auto");

                } else {
                    $("#formulario-izq").attr('style','float: left; width: 65%; text-align: left; padding-left: 50px;');
                    $("#formulario-der").attr('style','float: left; width: 35%');
                    $("#formulario-der").removeClass('col-12')
                    $("#formulario-der").removeClass('pt-5')
                    $("#formulario-izq").removeClass('col-12')

                }
            })
            if($('body').width() <= 1200){
                $("#formulario-izq").attr('style','text-align: left');
                $("#formulario-der").attr('style','text-align: center; float: center; width: 100% ; height: 200px');
                $("#formulario-der").addClass('col-12')
                $("#formulario-der").addClass('pt-5')
                $("#formulario-izq").addClass('col-12')
                $("footer").css("position","auto");
                $("footer").css("bottom","auto");
            } else {
                $("#formulario-izq").attr('style','float: left; width: 65%; text-align: left; padding-left: 50px;');
                $("#formulario-der").attr('style','float: left; width: 35%');
                $("#formulario-der").removeClass('col-12')
                $("#formulario-der").removeClass('pt-5')
                $("#formulario-izq").removeClass('col-12')
                
            }
    }
});