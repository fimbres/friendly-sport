let map
let marcador
let geoLoc
let latitud
let longitude

function init_tarjeta(){
    const closeEvent = document.querySelector("#btnCloseEvent");
            const containerEvent = document.querySelector("#container-show-event");
            
            //SALIR DE LA INFORMACION DEL EVENTO
            closeEvent.addEventListener("click", function(evento){
                $('#info-inscribirse-notificacion').text(" ");
                $('#container-show-event').addClass('d-none');
                $('#page-top').removeClass('overflow-hidden');
                $('#btnRetirarse').addClass('d-none');
                $('#btnInscribirse').removeClass('d-none');
            });
    //MOSTRAR INFORMACION DEL EVENTO
    $('.tarjeta').on('click', function(event) 
    {
        $('#container-show-event').removeClass('d-none');

        window.idEvento = jQuery(this).attr("id");


        if(idEvento != "")
        {
            $.ajax({
                    type:'POST',
                    url:'includes/informacion_evento.php',
                    dataType:'JSON',
                    data: {idEvento: idEvento},
                    beforeSend:function(data){
                        $('#div-info-banner').addClass('d-none');
                        $('#div-info-body').addClass('d-none');
                        $('#div-info-loading').removeClass("d-none");
                        $('#page-top').addClass('overflow-hidden');
                        console.log(idEvento);
                    },  
                    success:function(data){
                        if(data.response == "Success"){     
                            $('#img-info-banner').attr("src","assets/static/"+data.Nombre_deporte+"_banner_info.jpg");
                            $('#span-info-name').text(data.Nombre_evento);
                            $('#span-info-deporte').text(data.Nombre_deporte);
                            $('#span-info-fecha').text(data.Fecha_evento);
                            $('#span-info-hora-inicio').text(data.Hora_inicio);
                            $('#span-info-minutos-inicio').text(data.Minutos_inicio);
                            $('#span-info-segundos-inicio').text(data.Segundos_inicio);
                            $('#span-info-organizador').text(data.Nombre_organizador);
                            $('#span-cantidad-inscritos').text(data.cantidad_inscritos);
                            $('#span-lista-inscritos').text(data.lista_participantes);
                            var direccion_completa = data.direccion_completa;
                            $('#txtDireccion').val(direccion_completa);
                            $('#div-info-loading').addClass("d-none");
                            $('#div-info-banner').removeClass('d-none');
                            $('#div-info-body').removeClass('d-none');
                            mostrarmapa();

                            if(data.status_inscripcion){
                                $('#btnRetirarse').removeClass('d-none');
                                $('#btnInscribirse').addClass('d-none');
                            }else{

                            }

                            console.log(data);
                            console.log(data.direccion_completa)
                        }   
                        else if (data.response == "Invalid") {
                           console.log(data.message);
                        }
                    },
                    error: function (xhr, exception) {
                        console.log(exception);

                    }
            });
        }
        

    });


    //INSCRIBIRSE A UN EVENTO
    $('#btnInscribirse').on('click', function(event) {

            if(idEvento != "")
            {
                $.ajax({
                        type:'POST',
                        url:'includes/inscribirse_evento.php',
                        dataType:'JSON',
                        data: {idEvento: idEvento},
                        beforeSend:function(data){
                            $('#div-info-banner').addClass('d-none');
                            $('#div-info-body').addClass('d-none');
                            $('#div-info-loading').removeClass("d-none");
                            $('#btnInscribirse').attr('disabled');
                            $('#info-inscribirse-notificacion').text(" ");
                        },  
                        success:function(data){
                            if(data.response == "Success"){  

                                $('#div-info-loading').addClass("d-none");
                                $('#info-inscribirse-notificacion').removeClass("d-none");
                                $('#info-inscribirse-notificacion').text(data.message);
                                setTimeout(function() { 
                                    $('#info-inscribirse-notificacion').addClass("d-none");
                                    $('#div-info-banner').removeClass('d-none');
                                    $('#div-info-body').removeClass('d-none');
                                    $('#btnInscribirse').addClass('d-none');
                                    $('#btnRetirarse').removeClass('d-none');
                                    $('#span-lista-inscritos').text(data.lista_participantes);
                                }, 2000);
                                
                                console.log("SUCCESS");
                                console.log(data);
                            }   
                            else{
                                console.log("INVALID DATA");
                                console.log(data);

                                $('#div-info-loading').addClass("d-none");
                                $('#info-inscribirse-notificacion').removeClass("d-none");
                                $('#info-inscribirse-notificacion').text(data.message);

                                setTimeout(function() { 
                                    $('#info-inscribirse-notificacion').addClass("d-none");
                                    $('#div-info-banner').removeClass('d-none');
                                    $('#div-info-body').removeClass('d-none');
                                    delete data;
                                }, 2000);
                            
                                
                            }
                        },
                        error: function (xhr, exception) {
                            console.log(exception);

                        }
                    });
            }
        });


        //RETIRARSE DE UN EVENTO
        $('#btnRetirarse').on('click', function(event) {
            console.log(idEvento);

            if(idEvento != "")
            {
                $.ajax({
                        type:'POST',
                        url:'includes/cancelar_inscripcion_evento.php',
                        dataType:'JSON',
                        data: {idEvento: idEvento},
                        beforeSend:function(data){
                            $('#div-info-banner').addClass('d-none');
                            $('#div-info-body').addClass('d-none');
                            $('#div-info-loading').removeClass("d-none");
                            $('#btnInscribirse').attr('disabled');
                            $('#info-inscribirse-notificacion').text(" ");
                            console.log("BeforeSend");
                            console.log(data);
                        },  
                        success:function(data){
                            if(data.response == "Success"){  

                                $('#div-info-loading').addClass("d-none");
                                $('#info-inscribirse-notificacion').removeClass("d-none");
                                $('#info-inscribirse-notificacion').text(data.message);
                                setTimeout(function() { 
                                    $('#info-inscribirse-notificacion').addClass("d-none");
                                    $('#div-info-banner').removeClass('d-none');
                                    $('#div-info-body').removeClass('d-none');
                                    $('#btnInscribirse').removeClass('d-none');
                                    $('#btnRetirarse').addClass('d-none');
                                    $('#span-lista-inscritos').text(data.lista_participantes);
                                }, 2000);
                                
                                console.log("SUCCESS");
                                console.log(data);
                            }   
                            else{
                                console.log("INVALID DATA");
                                console.log(data);

                                $('#div-info-loading').addClass("d-none");
                                $('#info-inscribirse-notificacion').removeClass("d-none");
                                $('#info-inscribirse-notificacion').text(data.message);

                                setTimeout(function() { 
                                    $('#info-inscribirse-notificacion').addClass("d-none");
                                    $('#div-info-banner').removeClass('d-none');
                                    $('#div-info-body').removeClass('d-none');
                                    delete data;
                                }, 2000);
                            
                                
                            }
                        },
                        error: function (xhr, exception) {
                            console.log(exception);
                        }
                    });
            }
        });
        const contenedorTarjetas = [...document.querySelectorAll(".eventos")];
        const enfrente = [...document.querySelectorAll(".enfrente")];
        const atras = [...document.querySelectorAll(".atras")];

        contenedorTarjetas.forEach((item, i) => {
        //let dimensiones = item.getBoundingClientRect();
        let ancho = 311.85;
        console.log(ancho);

        enfrente[i].addEventListener("click", () => {
            item.scrollLeft += ancho;
        });

        atras[i].addEventListener("click", () => {
            item.scrollLeft -= ancho;
        });
        });

}
function initMapa_edicion_evento() {
    if (navigator.geolocation) {
        let temp = ($('#direccion').val()).split(',')
        latitud = parseFloat(temp[0])
        longitude = parseFloat(temp[1])

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
        google.maps.event.addListener(marcador, 'drag', function (event) {
            let str = `${event.latLng.lat()},${event.latLng.lng()}`;
            $("#direccion").attr('value', str)
        })
        let str = `${latitud},${longitude}`;
        $("#direccion").attr('value', str);
    }
}


function initMapa_info_evento() {
    if (navigator.geolocation) {
        let temp = ($('#txtDireccion').val()).split(',')
        latitud = parseFloat(temp[0])
        longitude = parseFloat(temp[1])

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
            draggable: false
        })
        google.maps.event.addListener(marcador, 'drag', function (event) {
            let str = `${event.latLng.lat()},${event.latLng.lng()}`;
            $("#direccion").attr('value', str)
        })
        let str = `${latitud},${longitude}`;
        $("#direccion").attr('value', str);
    }
}


function initMapa() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            
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
            google.maps.event.addListener(marcador, 'drag', function (event) {
                let str = `${event.latLng.lat()},${event.latLng.lng()}`;
                $("#direccion").attr('value', str)
            })
            let str = `${latitud},${longitude}`;
            $("#direccion").attr('value', str);
        }, function () {
            latitud = 0;
            longitude = 0;
            const myLating = new google.maps.LatLng(latitud, longitude);
            map = new google.maps.Map(document.getElementById("mapa"), {
                center: myLating,
                mapTypeControl: true,
                zoom: 1,
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
            google.maps.event.addListener(marcador, 'drag', function (event) {
                let str = `${event.latLng.lat()},${event.latLng.lng()}`;
                $("#direccion").attr('value', str)
            })
            let str = `${latitud},${longitude}`;
            $("#direccion").attr('value', str);
        })
    }
}

function showLocationOnMap(position) {
    const myLating = { lat: latitud, lng: longitude };
    marcador.setPosition(myLating);
    mapa.setCenter(myLating);
}

function configurar_radio(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position){
            let latitud = position.coords.latitude;
            let longitude = position.coords.longitude;
            let myLating = new google.maps.LatLng(latitud, longitude)
            $.ajax({
                type:'POST',
                url:'includes/utils/conseguir_eventos.php',
                dataType:'JSON',  
                success:function(data){
                    if(data.response == "Success"){
                        if(data.tarjeta){
                            let eventos = [];
                            $.each(data.tarjeta,function (){
                                let la_le = this.coordenadas.split(',')
                                let coor = new google.maps.LatLng(la_le[0], la_le[1])
                                let metros = google.maps.geometry.spherical.computeDistanceBetween(myLating,coor)
                                if(metros <= 15000){
                                    let array_fecha = this.fecha.split('-')
                                    let array_hora = this.hora.split(':')
                                    let fecha_act = new Date()
                                    let fecha_tarj = new Date(array_fecha[0],array_fecha[1]-1,array_fecha[2]);
                                    fecha_tarj.setHours(array_hora[0],array_hora[1],array_hora[2])
                                    if(fecha_tarj > fecha_act)
                                        eventos.push(this);
                                }
                            })
                            if(eventos){
                                $.each(eventos,function(){
                                    let nom_dep = this.deporte.replace(/\s+/g, '_');
                                    let row = $('#contenido_col_index').find('.'+ nom_dep );
                                    if(row.length > 0){
                                        row.find('.eventos').append(`
                                        <div id="${this.id_evento}" class="tarjeta">
                                            <img src="assets/static/${nom_dep}.png" styles="max-width: 100%;">
                                            <div class="cuerpo">
                                                <div class="descripciones">
                                                    <h5 class="pt-3 ps-2 pe-2">${this.titulo}</h5>   
                                                    <h5 class="pt-1 ps-2 pe-2" style="color:orange;">${this.deporte}</h5>
                                                    <h5 class="pt-1 ps-2 pe-2 fs-6">${this.fecha} - ${this.hora}</h5>
                                                    
                                                </div>
                                                <div class="cantidad">    
                                                    <img class="icono-mini ms-3" src="assets/static/user_icon.png" alt="">
                                                    <h6 class="pt-1 ps-2 pe-2">${this.num_usuarios}</h6>
                                                </div>
                                            </div>
                                        </div>`)
                                    } else{
                                        $('#contenido_col_index').append(`
                                        <div class="${nom_dep} soccer">
                                            <h5 class="pt-3 ps-3">${this.deporte}</h5>
                                            <div class="contenedor contenedor-principal-tarjeta">
                                                <button class="swiper atras">
                                                    <div class="triangulo"></div>
                                                </button>
                                                <div class="eventos">
                                                    
                                                    <div id="${this.id_evento}" class="tarjeta">
                                                        <img src="assets/static/${nom_dep}.png" styles="max-width: 100%;">
                                                        <div class="cuerpo">
                                                            <div class="descripciones">
                                                                <h5 class="pt-3 ps-2 pe-2">${this.titulo}</h5>   
                                                                <h5 class="pt-1 ps-2 pe-2" style="color:orange;">${this.deporte}</h5>
                                                                <h5 class="pt-1 ps-2 pe-2 fs-6">${this.fecha} - ${this.hora}</h5>
                                                                
                                                            </div>
                                                            <div class="cantidad">    
                                                                <img class="icono-mini ms-3" src="assets/static/user_icon.png" alt="">
                                                                <h6 class="pt-1 ps-2 pe-2">${this.num_usuarios}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <button class="swiper enfrente">
                                                    <div class="triangulo"></div>
                                                </button>
                                            </div>
                                    </div>`)
                                    }
                                })
                            } else{
                                $('#contenido_col_index').html(`<div class="vacio">
                                    <img class="imagen" src="assets/static/lupa.png" alt="">
                                    <p>Vaya!, no pudimos encontrar eventos en tu zona 😢, ¿Te gustaría crear uno?</p>
                                </div>`);
                            }
                            
                        }
                        init_tarjeta()
                        
                    } else{
                        $('#contenido_col_index').html(`<div class="vacio">
                        <img class="imagen" src="assets/static/lupa.png" alt="">
                        <p>Vaya!, no pudimos encontrar eventos en tu zona 😢, ¿Te gustaría crear uno?</p>
                    </div>`);
                    }
                }
            });

        }, function(){
            alert("NECESITAS PERMITIR EL USO DE TU UBICACIÓN")
            location.reload();
        })
    } else{
        alert("NECESITAS PERMITIR EL USO DE TU UBICACIÓN")
        location.reload();
    }
}

//window.iniciar_mapa = iniciar_mapa;
$(document).ready(function () {
    if ($('.form-dia-hora').length) {
        let fecha = new Date();
        let anio = fecha.getFullYear();
        let mes = fecha.getMonth() + 1;
        let dia = fecha.getDate();
        let hora = fecha.getHours();
        let minutos = fecha.getMinutes();
        let segundos = fecha.getSeconds();

        let hora_min;
        let mes_max = mes;
        let anio_max = anio;
        if (hora > 21) {
            hora_min = (hora - 24) + 3;
        } else {
            hora_min = hora + 3;
        }
        let dia_max;
        
        switch (mes) {
            //31
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                
                if (dia >= 27) {
                    mes_max = 1 + mes;
                    if(mes == 12){
                        anio_max = anio + 1;
                    }
                    dia_max = (dia - 31) + 5;
                } else {
                    dia_max = dia + 5;
                }
                break;
            case 3:
            case 4:
            case 6:
            case 9:
            case 11:
                if (dia >= 26) {
                    mes_max = 1 + mes;
                    dia_max = (dia - 30) + 5;
                } else {
                    dia_max = dia + 5;
                }
                break;
            case 2:
                
                if ((anio % 4) == 0) {
                    if (dia >= 25) {
                        mes_max = 1 + mes;
                        dia_max = (dia - 29) + 5;
                    } else {
                        dia_max = dia + 5;
                    }
                } else {
                    if (dia >= 24) {
                        mes_max = 1 + mes;
                        dia_max = (dia - 28) + 5;
                    } else {
                        dia_max = dia + 5;
                    }
                }

        }
        if (mes < 10) {
            mes = "0" + mes;
        }
        if(mes_max < 10){
            mes_max = "0"+mes_max;
        }
        if (dia < 10) {
            dia = "0" + dia;
        }
        if (hora < 10) {
            hora = "0" + hora;
        }
        if (minutos < 10) {
            minutos = "0" + minutos;
        }
        if (segundos < 10) {
            segundos = "0" + segundos;
        }
        if (hora_min < 10) {
            hora_min = "0" + hora_min;
        }
        if (dia_max < 10) {
            dia_max = "0" + dia_max;
        }
        let fecha_min = anio + '-' + mes + '-' + dia + 'T' + hora_min + ':' + minutos;
        let fecha_max = anio_max + '-' + mes_max + '-' + dia_max + 'T' + hora + ':' + minutos;
        
        $('.form-dia-hora').attr('min', fecha_min);
        $('.form-dia-hora').attr('max', fecha_max);
        $('#fecha_min').attr('value', fecha_min);
        $('#fecha_max').attr('value', fecha_max);

        $(window).on('resize', function () {
            let tam = $('body').width();
            if (tam <= 1200) {
                $("#formulario-izq").attr('style', 'text-align: left');
                $("#formulario-der").attr('style', 'text-align: center; float: center; width: 100% ; height: 200px');
                $("#formulario-der").addClass('col-12')
                $("#formulario-der").addClass('pt-5')
                $("#formulario-izq").addClass('col-12')
                //$("footer").css("position", " auto");
                //$("footer").css("bottom", "auto");

            } else {
                $("#formulario-izq").attr('style', 'float: left; width: 65%; text-align: left; padding-left: 50px;');
                $("#formulario-der").attr('style', 'float: left; width: 35%');
                $("#formulario-der").removeClass('col-12')
                $("#formulario-der").removeClass('pt-5')
                $("#formulario-izq").removeClass('col-12')
                //$("footer").css("bottom", "-127");
                //$("footer").css("position", "absolute");
            }
        })
        if ($('body').width() <= 1200) {
            $("#formulario-izq").attr('style', 'text-align: left');
            $("#formulario-der").attr('style', 'text-align: center; float: center; width: 100% ; height: 200px');
            $("#formulario-der").addClass('col-12')
            $("#formulario-der").addClass('pt-5')
            $("#formulario-izq").addClass('col-12')
            //$("footer").css("position", "auto");
            //$("footer").css("bottom", "auto");
        } else {
            $("#formulario-izq").attr('style', 'float: left; width: 65%; text-align: left; padding-left: 50px;');
            $("#formulario-der").attr('style', 'float: left; width: 35%');
            $("#formulario-der").removeClass('col-12')
            $("#formulario-der").removeClass('pt-5')
            $("#formulario-izq").removeClass('col-12')
            //$("footer").css("bottom", "-127");
            //$("footer").css("position", "absolute");
        }
    }
});


