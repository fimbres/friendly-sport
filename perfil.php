<?php    
    session_start();

    if(! isset($_SESSION['usuario_Id'])){
        header("location: welcome.php");
    }
    $id_user = $_SESSION['usuario_Id'];
    header("Access-Control-Allow-Origin: *");

    include("includes/config.php");

    if(isset($_POST['eliminar'])){
        $id_evento = $_POST['id_evento'];
        $nombre_deporte = $_POST['id_deporte'];
        echo "<script>console.log('Consolexd1: $id_evento' );</script>";
        echo "<script>console.log('Consolexd2: $nombre_deporte');</script>";
        $BD = crear_conexion_clase();
                
        $buscar_dep = "CALL sp_buscar_deporte_n('$nombre_deporte')";
        $BD->next_result();
        $id_dep = mysqli_query($BD,$buscar_dep);
        $id_dep2 = mysqli_fetch_array($id_dep);
        $id_deporte = $id_dep2["id_deporte"];
        echo "<script>console.log('Consolexd3: $id_deporte');</script>";

                
        $deletear12 = "CALL sp_eliminar_relacion_usuarios_eventos_e($id_evento)";
        $BD->next_result();
        mysqli_query($BD,$deletear12);

        $deletear22 = "CALL sp_eliminar_relacion_deportes_eventos_e($id_evento, $id_deporte)";
        $BD->next_result();
        mysqli_query($BD,$deletear22);

        $deletear32 = "CALL sp_eliminar_evento($id_evento)";
        $BD->next_result();
        mysqli_query($BD,$deletear32);
                
        $BD->close();
        #header("location: perfil.php");
    }


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
        <link href="dist/css/perfil.css" rel="stylesheet"/>

    </head>
    <body id="page-top" class="">
        <div class="barra">
        <!-- barra de navegacion-->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow py-0" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="index.php"><img src="assets/static/LogoFS.png" height="64px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="boton_perfil" href="index.php">Homepage</a></li>
                            <li class="nav-item"><a class="boton_salir" href="includes/logout.php">Cerrar sesion</a></li>
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
           //(31.870758, -116.619713, 31.861054, -116.585638)

            $BD = crear_conexion_clase();
            echo "<script>console.log('id_usuario: $id_user' );</script>";
            $query_usuario = "SELECT * FROM tb_usuario WHERE id_usuario = $id_user";
            $result = mysqli_query($BD,$query_usuario);
            $usuario = mysqli_fetch_array($result);


            #SELECT * FROM tb_eventos WHERE id_evento =
            $contador = 0;
            $id_eventos_temp = [];
            $query_relacion_eventos = "SELECT id_evento FROM tb_relacion_usuarios_eventos WHERE id_usuario = $id_user AND es_organizador = 1";
            $relacion_eventos_result = mysqli_query($BD,$query_relacion_eventos);
            while($row = mysqli_fetch_array($relacion_eventos_result)) {
                $id_temp = $row['id_evento'];
                echo "<script>console.log($id_temp);</script>"; 
                $id_eventos_temp[] = $row['id_evento'];
                $contador = $contador + 1;
            }
            echo "<script>console.log($contador);</script>"; 

            $eventos = [];
            $deportes = [];
            if($contador == 0){
                echo "<script>console.log('Console: entre al 0');</script>"; 
            }
            else
            {
                foreach($id_eventos_temp as $id){
                    $query_eventos = "SELECT * FROM tb_evento WHERE id_evento = $id";
                    $eventos_result = mysqli_query($BD,$query_eventos);
                    $row = mysqli_fetch_array($eventos_result);
                    $id_temp2 = $row['id_evento'];
                    echo "<script>console.log($id_temp2);</script>"; 
                    $eventos[] = $row;
                }

                foreach($eventos as $fila){
                    $id_evento_temp = $fila['id_evento'];
                    $query_deportes = "CALL sp_buscar_relacion_deportes_eventos_e($id_evento_temp)";
                    $deportes_result = mysqli_query($BD,$query_deportes);
                    $BD->next_result();
                    $row = mysqli_fetch_array($deportes_result);
                    $deportes[$fila['id_evento']] = $row;
                }
            }

            $nombres_deportes = [
                1 => "Futbol soccer",
                2 => "Futbol americano",
                3 => "Baloncesto",
                4 => "Tenis",
                5 => "Beisbol",
                6 => "Petanca",
                7 => "Voleibol",
                8 => "Ciclismo",
                9 => "Senderismo",
            ];

            $nombres_imagenes = [
                1 => "soccer.png",
                2 => "football.png",
                3 => "basketball.png",
                4 => "tenis.png",
                5 => "beisbol.png",
                6 => "petanca.png",
                7 => "voleibol.png",
                8 => "ciclismo.png",
                9 => "senderismo.png",
            ];

            $preferidos = [];
            $query_preferidos = "CALL sp_buscar_relacion_usuarios_deportes_u($id_user)";
            $preferidos_result = mysqli_query($BD,$query_preferidos);
            $BD->next_result();
            while($row = mysqli_fetch_array($preferidos_result)) {
                $preferidos[] = $nombres_deportes[$row['id_deporte']];
            }

        ?>     
        
        <!--Info de usuario-->
        <div class="contenido_perfil">
            <div class="division1_perfil">
                <div class="imagen_perfil">
                    <img src="assets/static/user_icon2.png" alt="">
                </div>
                <div class="textos_perfil">
                    <h1 class="nombre-usuario"><?php echo $usuario['nombre_usuario'];?></h1>
                    <h4>Deportes de interés: 
                    <?php 
                        $cadena = "| ";
                        foreach($preferidos as $preferido){
                            $cadena .= $preferido . " | ";
                        }
                        
                    ?>
                        <span class="fs-6"><?php echo $cadena;?></span>
                    </h4>
                    <h4>Edad:<span class="fs-6"> <?php echo $usuario['edad'];?></span></h4>
                    <h4>Correo Electrónico:<span class="fs-6"> <?php echo $usuario['email'];?></span></h4>
                </div>
            </div>
            <div class="division2_perfil">
                <h4>Tus eventos: </h4>
                <div class="eventos_perfil">
                    <?php foreach($eventos as $fila){?>            
                                
                    <div <?php echo 'id="'.$fila['id_evento'].'"';?> class="tarjeta">
                        <img src="assets/static/<?php echo $nombres_imagenes[$deportes[$fila['id_evento']]['id_deporte']] ?>" styles="max-width: 100%;">
                        <div class="cuerpo">
                            <div class="descripciones">
                                <h5><?php echo $fila['nombre'];?> - <?php echo $fila['id_evento'];?></h5>   
                                <h5 style="color:orange;"><?php echo $nombres_deportes[$deportes[$fila['id_evento']]['id_deporte']] ?></h5>
                                <h5><?php echo $fila['fecha'];?> - <?php echo $fila['hora_inicio'];?></h5>
                                <h6><?php echo $fila['ciudad'];?></h6>
                            </div>
                            <div class="cantidad">
                                <?php  
                                $id_evento2 = $fila['id_evento'];
                                $query2 = "SELECT COUNT(id_usuario) FROM tb_relacion_usuarios_eventos WHERE id_evento = $id_evento2";
                                $res2 = mysqli_query($BD,$query2);
                                $row2 = $res2->fetch_array();
                                $out2 = $row2[0]; 
                                ?>     
                                <img class="icono-mini" src="assets/static/user_icon.png" alt="">
                                <h6><?php echo $out2?></h6>
                            </div>
                        </div>
                    </div>
                    <?php }
                    $BD->close();?>
                </div>
            </div>
        </div>

        <!--MODAL CANCELAR EVENTO-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">AVISO!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal1">
                        <img src="assets/static/Warning.png" height="108px" alt="">
                        <div class="textos">
                            <P>Deseas cancelar el evento?</P>
                            <p>la publicacion dejara de ser publica y todos los miembros dejaran de verla.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form name="FormEliminar" method="post">
                            <input type="hidden" id="id_deporte" name="id_deporte" >
                            <input type="hidden" id="id_evento" name="id_evento" >
                            <input id="eliminar" name="eliminar" type="submit" class="btn btn-primary" value="Aceptar" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL EVENTO CANCELADO-->
        <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">AVISO!</h5>
                    </div>
                    <div class="modal-body modal1">
                        <img src="assets/static/Warning.png" height="108px" alt="">
                        <div class="textos">
                            <p>El evento se ha cancelado/borrado correctamente</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>    

        <!--TARJETA INFORMACION DEL EVENTO-->
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
                                        <img class="rounded-circle p-2" src="assets/static/user_example_image.jpg" width="120px"  height="120px" alt=""/>
                                    </div>
                                    
                                    <div class="container-fluid">
                                        <p class="fw-bold fs-6 text-center">Organizado por</p>
                                        <p class="text-center"><span id="span-info-organizador">Ariel</span></p>
                                    </div>

                                    <div class="container-fluid mt-4">
                                        <input id="btnInscribirse" class="btn btn-custom-primary m-1 text-light w-100" type="button" value="Inscribirte"/>
                                        <input id="btnEditar" class="btn btn-primary m-1 text-light w-100 d-none" type="button" value="Editar"/>
                                        <button id="btnCloseEvent1" type="button" class="btn btn-danger m-1 text-light w-100" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Cancelar evento</button>
                                        <input id="btnCloseEvent2" class="btn btn-warning m-1 w-100" type="button" value="Salir"/>
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
        <script src="dist/js/jquery-3.6.0.min.js"></script>
        <script>
            const closeEvent1 = document.querySelector("#btnCloseEvent1");
            const closeEvent2 = document.querySelector("#btnCloseEvent2");
            const containerEvent = document.querySelector("#container-show-event");
            
            //SALIR DE LA INFORMACION DEL EVENTO
            closeEvent1.addEventListener("click", function(evento){
                $('#info-inscribirse-notificacion').text(" ");
                $('#container-show-event').addClass('d-none');
                $('#page-top').removeClass('overflow-hidden');
                $('#btnEditar').addClass('d-none');
                $('#btnInscribirse').removeClass('d-none');
            });

            closeEvent2.addEventListener("click", function(evento){
                $('#info-inscribirse-notificacion').text(" ");
                $('#container-show-event').addClass('d-none');
                $('#page-top').removeClass('overflow-hidden');
                $('#btnEditar').addClass('d-none');
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
                                        $('#btnEditar').removeClass('d-none');
                                        $('#btnInscribirse').addClass('d-none');
                                    }else{

                                    }
                                    
                                    var Myelement1 = document.forms['FormEliminar']['id_deporte'];
                                    var Myelement2 = document.forms['FormEliminar']['id_evento'];
                                    Myelement1.setAttribute('value',data.Nombre_deporte);
                                    Myelement2.setAttribute('value',idEvento);
                                    

                                    console.log(data);
                                    console.log(data.direccion_completa);
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
                                            $('#btnEditar').removeClass('d-none');
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


                //EDITAR UN EVENTO
                $('#btnEditar').on('click', function(event) {
                    console.log(idEvento);
                    if(idEvento != "")
                    {
                        location.href = 'editar_evento.php?evento='+idEvento;
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
       
    </body>
</html>
