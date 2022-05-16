<?php    
    session_start();

    if(! isset($_SESSION['usuario_Id'])){
        header("location: welcome.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Friendly Sport</title>
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
                            <li class="nav-item"><a class="boton_salir" href="#">Salir de la Sesion</a></li>
                            <li class="nav-item"><a class="boton_perfil" href="#">Mostrar Perfil</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
        </div>
        <!-- contenido de la pagina-->   
        <?php  
            include("includes/config.php");
            $BD = crear_conexion_clase();

            $query = "SELECT * FROM tb_evento";
            $res = mysqli_query($BD,$query);
            
            $BD->close();

        ?>     
        <div class="contenido">
            <div class="division1">
                <div class="rectangulo">
                    <div class="icono">
                        <img src="assets/static/user_icon.png" alt="">
                    </div>
                    <a class="boton_crear" href="#">
                        Organizar un evento
                    </a>
                </div>
            </div>
            <div class="division2">
                <?php if ($res):?>
                    <div class="contenedor soccer">
                        <div class="swiper atras">
                            <div class="triangulo"></div>
                        </div>
                        <div class="eventos">
                            <?php while($fila = mysqli_fetch_array($res)){?>
                            <div <?php echo 'id="'.$fila['id_evento'].'"';?> class="tarjeta">
                                <img src="assets/static/soccer.png">
                                <div class="Cuerpo">
                                    <h5>Nombre del evento</h5>
                                    <h5>Categoria</h5>
                                    <h5>Fecha y hora del evento</h5>
                                    <h5>Lugar del evento</h5>
                                    <div class="cantidad">
                                        <img  id="botonSubs" class="icono-mini" src="assets/static/user_icon.png" alt="">
                                        <h5>cantidad</h5>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="swiper enfrente">
                            <div class="triangulo"></div>
                        </div>
                    </div>

                <?php else: ?>

                    <div class="vacio">
                        <img class="imagen" src="assets/static/lupa.png" alt="">
                        <p>Vaya!, no pudimos encontrar eventos en tu zona 😢, ¿Te gustaría crear uno?</p>
                    </div>

                <?php endif ?>
                
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

                    <h1 id="info-inscribirse-notificacion" class="text-dark d-none p-4">Mensaje</h1>

                    <div id="div-info-banner" class=" banner-event text-center d-none">
                        <?php 
                            //$ruta_imagen = 'assets/static/'.$nombre_deporte.'_banner_info.jpg';
                            //echo '<img class="img-banner" src="'.$ruta_imagen.'" alt="">';
                        ?>
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
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Lugar del evento:</span></div><div class="container ins-bg-info rounded-3"><input id="txtLatitud" class="d-none" type="text"><input id="txtLongitud" class="d-none" type="text"><div class="text-center col-12"  id="mapa" style="width: 100%; height: 200px;" ></div></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Participantes:</span></div><div class="container ins-bg-info rounded-3"><span class=""></span></div></div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-icon-wrapper">
                                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Usuarios inscritos:</span></div></div>
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
                                        <img class="rounded-circle p-2" src="assets/static/user_example_image.jpg" width="120px"  height="120px" alt=""/>
                                    </div>
                                    
                                    <div class="container-fluid">
                                        <p class="fw-bold fs-6 text-center">Organizado por</p>
                                        <p class="text-center"> Ariel</p>
                                    </div>

                                    <div class="container-fluid mt-4">
                                        <input id="btnInscribirse" class="btn btn-custom-primary m-1 text-light w-100" type="button" value="Inscribirte"/>
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
            <div class="container px-5">
                <div class="text-white-50 small">
                    <p>© FriendlySport, 2022. Todos los derechos reservados.</p>
                    <p>Tel: 1234567890 | Email: ayuda@metafusions.com</p>
                    <a href="#!">Privacidad</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terminos</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Condiciones</a>
                </div>
            </div>
        </footer>
                
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMapa"></script>
        <script src="dist/js/script_jquery.js"></script>
        <script src="dist/js/jquery-3.6.0.min.js"></script>
        <script>
            const closeEvent = document.querySelector("#btnCloseEvent");
            const containerEvent = document.querySelector("#container-show-event");
            
            closeEvent.addEventListener("click", function(evento){
                containerEvent.classList.add('d-none');
                $('#page-top').removeClass('overflow-hidden');
            });
        </script>
        <script>
            $('.tarjeta').on('click', function(event) {
                $('#container-show-event').removeClass('d-none');

                var idEvento = jQuery(this).attr("id");


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
                                    $('#div-info-loading').addClass("d-none");
                                    $('#div-info-banner').removeClass('d-none');
                                    $('#div-info-body').removeClass('d-none');
                                    console.log(data);
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
                else
                {
                    
                }


                $('#btnInscribirse').on('click', function(event) {
                console.log(idEvento);

                if(idEvento != "")
                {
                    $.ajax({
                            type:'POST',
                            url:'includes/inscribirse_Evento.php',
                            dataType:'JSON',
                            data: {idEvento: idEvento},
                            beforeSend:function(data){
                                $('#div-info-banner').addClass('d-none');
                                $('#div-info-body').addClass('d-none');
                                $('#div-info-loading').removeClass("d-none");
                                
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
                                    }, 2000);
                                    
                                }   
                                else if (data.response == "Invalid") {
                                    $('#div-info-loading').addClass("d-none");
                                    $('#info-inscribirse-notificacion').removeClass("d-none");
                                    $('#info-inscribirse-notificacion').text(data.message);

                                    setTimeout(function() { 
                                        $('#info-inscribirse-notificacion').addClass("d-none");
                                        $('#div-info-banner').removeClass('d-none');
                                        $('#div-info-body').removeClass('d-none');
                                    }, 2000);
                                   
                                }
                            },
                            error: function (xhr, exception) {
                               

                            }
                        });
                }
                else
                {
                    
                }

            });



            });


        </script>

        <script>
        
        </script>
    </body>
</html>
