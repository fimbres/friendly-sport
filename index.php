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
        <link href="dist/css/index.css" rel="stylesheet"/>
        <link href="dist/css/styles.css" rel="stylesheet"/>
        <link href="dist/css/index.css" rel="stylesheet"/>
    </head>
    <body id="page-top">
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
            
            $query_soccer = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =1";
            $soccer = mysqli_query($BD,$query_soccer);
            $query_americano = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =2";
            $americano = mysqli_query($BD,$query_americano);
            $query_baloncesto = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =3";
            $baloncesto = mysqli_query($BD,$query_baloncesto);
            $query_tenis = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =4";
            $tenis = mysqli_query($BD,$query_tenis);
            $query_beisbol = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =5";
            $beisbol = mysqli_query($BD,$query_beisbol);
            $query_petanca = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =6";
            $petanca = mysqli_query($BD,$query_petanca);
            $query_voleibol = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =7";
            $voleibol = mysqli_query($BD,$query_voleibol);
            $query_ciclismo = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =8";
            $ciclismo = mysqli_query($BD,$query_ciclismo);
            $query_senderismo = "SELECT tb_evento.id_evento, nombre, fecha, hora_inicio, hora_final, descripcion, ciudad, direccion FROM tb_evento LEFT JOIN tb_relacion_deportes_eventos ON tb_evento.id_evento = tb_relacion_deportes_eventos.id_evento WHERE tb_relacion_deportes_eventos.id_deporte =9";
            $senderismo = mysqli_query($BD,$query_senderismo);


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
                        <button class="swiper atras">
                            <div class="triangulo"></div>
                        </button>
                        <div class="eventos">
                            <?php while($fila = mysqli_fetch_array($soccer)){?>
                            <div class="tarjeta">
                                <img src="assets/static/soccer.png" styles="max-width: 100%;">
                                <div class="cuerpo">
                                    <div class="descripciones">
                                        <h5><?php echo $fila['nombre'];?></h5>
                                        <?php  
                                            $id_evento1 = $fila['id_evento'];
                                            $query1 = "SELECT nombre FROM tb_deporte WHERE id_deporte = (SELECT id_deporte AS tid_deporte FROM tb_relacion_deportes_eventos WHERE id_evento = $id_evento1)";
                                            $res1 = mysqli_query($BD,$query1);
                                            $row = $res1->fetch_array();
                                            $out = $row[0];                                 
                                        ?>     
                                        <h5 style="color:orange;"><?php echo $out?></h5>
                                        <h5><?php echo $fila['fecha'];?></h5>
                                        <h6><?php echo $fila['direccion'];?></h6>
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
                            <?php }?>
                        </div>
                        <button class="swiper enfrente">
                            <div class="triangulo"></div>
                        </button>
                    </div>

                <?php else: ?>

                    <div class="vacio">
                        <img class="imagen" src="assets/static/lupa.png" alt="">
                        <p>Vaya!, no pudimos encontrar eventos en tu zona 😢, ¿Te gustaría crear uno?</p>
                    </div>

                <?php endif ?>
                <?php $BD->close(); ?>
                
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

        <script src="dist/js/index.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
