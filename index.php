<?php    
    session_start();

    if(! isset($_SESSION['usuario_Id'])){
        header("location: welcome.php");
    }

    $usuario = $_SESSION['usuario_Id'];
    header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Friendly Sport - inicio</title>
        <link rel="icon" type="image/x-icon" href="assets/FS-icono.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="dist/css/styles.css" rel="stylesheet"/>
        <link href="dist/css/index.css" rel="stylesheet"/>
    </head>
    <body id="page-top" class="">
        <div class="barra">
        <!-- barra de navegacion-->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow py-0" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="#page-top"><img src="assets/static/LogoFS.png" height="64px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="boton_salir" href="includes/logout.php">Salir de la Sesion</a></li>
                            <li class="nav-item"><a class="boton_perfil" href="perfil.php">Mostrar Perfil</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
        </div>
        <!-- contenido de la pagina-->   
        <?php
            date_default_timezone_set('America/Tijuana');
            $date = date('Y-m-d');
            $time = date('H:i:s');          
            include("includes/config.php");
            $BD = crear_conexion_clase();   
        ?>     
        <div class="container-fluid" id="index_div">
            <div class="row">
                <div class="mt-3 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 d-flex align-items-center container-user-image">
                    <div class="icono">
                        <img src="assets/static/user_icon.png" alt="">
                    </div>
                    
                </div>
                <div class="mt-3 col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex align-items-center container-user-buttons">
                    <a class="boton_crear pt-2 pb-2 ps-4 pe-4" href="crear_evento.php">
                        Organizar un evento
                    </a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12" id="contenido_col_index">
                </div>
            </div>
        </div>

        <div id="container-show-event" class="z-index-bg bg-transparence position-fixed top-0 bottom-0 start-0 end-0 d-flex justify-content-center align-items-center align-self-center d-none">
            

            <div class="z-index-form form-wrapper">

                <div class="card card-max-h-custom scroll">

                    <div id="div-info-loading" class="container-fluid bg-light d-flex align-items-center justify-content-center d-none">
                        <div class="loadingio-spinner-spinner-2cyqt1abmyf"><div class="ldio-z7v55d2fuwm">
                        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                        </div></div>

                        
                    </div>

                    <h1 id="info-inscribirse-notificacion" class="text-dark d-none p-4"></h1>

                    <div id="div-info-banner" class=" banner-event text-center d-none">
                        <img id="img-info-banner" class="img-banner" src="" alt="">
                    </div>
                    <div id="div-info-body" class="card-body d-none">
                            <div class="row">
                                <div class="col-md-9 col-lg-9 col-xl-9 col-xs-12 col-sm-12 d-block scroll">
                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Nombre del evento:</span></div><div class="container ins-bg-info rounded-3"><span id="span-info-name" class=""></span></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Categoria:</span></div><div class="container ins-bg-info rounded-3"><span id="span-info-deporte" class=""></span></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center align-items-center"><div class="container"><span class="fw-bold py-2">Fecha y hora:</span></div><div class="container d-flex justify-content-center align-content-center fs-pz"><span id="span-info-fecha" class="ins-bg-info py-2 ms-1 px-1 rounded-3"></span><span id="span-info-hora-inicio" class="ins-bg-info py-2 ms-1 px-1 rounded-3"></span>:<span id="span-info-minutos-inicio" class="ins-bg-info py-2 ms-1 px-1 rounded-3"></span>:<span id="span-info-segundos-inicio" class="ins-bg-info ms-1 py-2 px-1 rounded-3"></span></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Lugar del evento:</span></div><div class="container ins-bg-info rounded-3"><input id="txtDireccion" type="hidden" type="text" value=""><input id="txtLongitud" class="d-none" type="text"><div class="text-center col-12"  id="mapa" style="width: 100%; height: 200px;" ></div></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Participantes:</span></div><div class="container ins-bg-info rounded-3"><span id="span-lista-inscritos" class=""></span></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Usuarios inscritos:</span></div><div class="container ins-bg-info rounded-3"><span id="span-cantidad-inscritos" class=""></span></div></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mt-3">
                                        <div class="d-flex justify-content-center">
                                            <a class="d-none text-danger font-weight-bold" id="notificacion">Mensaje</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-12 col-lg-3 col-xl-3 col-sm-12">
                                    <div class="container-fluid d-flex justify-content-center align-items-center">
                                        <img class="rounded-circle p-2" src="assets/static/user_icon2.png" width="120px"  height="120px" alt=""/>
                                    </div>
                                    
                                    <div class="container-fluid">
                                        <p class="fw-bold fs-6 text-center">Organizado por</p>
                                        <p class="text-center"><span id="span-info-organizador">Ariel</span></p>
                                    </div>

                                    <div class="container-fluid mt-4">
                                        <input id="btnInscribirse" class="btn btn-custom-primary m-1 text-light w-100" type="button" value="Inscribirte"/>
                                        <input id="btnRetirarse" class="btn btn-warning m-1 text-light w-100 d-none" type="button" value="Retirarse"/>
                                        <input id="btnCloseEvent" class="btn btn-danger m-1 w-100" type="button" value="Salir"/>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer-->
        <footer class="bg-black text-center  mt-5 py-3">
            <?php
            include 'includes/widgets/footer.php';
            ?>
        </footer>
        <?php $BD->close(); ?>
        <script src="dist/js/index.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="dist/js/jquery-3.6.0.min.js"></script>
        <script>
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
        </script>
        <script>
            
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

        </script>
        <script>
            function mostrarmapa(){
                let script = document.createElement('script');
                script.src = 'https://maps.googleapis.com/maps/api/js?key=&callback=initMapa_info_evento';
                document.body.append(script);
            }
        </script>
        
        <script src="dist/js/script_jquery.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=quarterly&libraries=geometry&key=&callback=configurar_radio"></script>
       
    </body>
</html>
