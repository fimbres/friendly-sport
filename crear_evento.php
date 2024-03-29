<?php 
    include("includes/config.php");
    session_start();
    if(!comprobar_sesion()){
        header("location: welcome.php");
    }
    
    
    $error = [];
    $exito = false;
    $BD = crear_conexion_clase();
    $BD->next_result();
    $deportes = ($BD->query("SELECT * FROM tb_deporte;"));
    $BD->next_result();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $resultado = evento_formulario_verificar($_POST,$BD);
        if($resultado[0]){
            $res = agregar_evento($resultado[1],$BD);
            if($res[0]){
                $exito = true;
            } else{
                $error = $res[1];
            }
        } else{
            $error = $resultado[1];
        }

    }
    $BD->close();

?>
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
         <!-- Core theme CSS (includes Bootstrap)-->
        <link href="dist/css/styles.css" rel="stylesheet" />
        <link href="dist/css/welcome_styles.css" rel="stylesheet" />
        <link href="dist/css/evento_agregar.css" rel="stylesheet" />

        
    </head>
    <body id="page-top">
        <!-- barra de navegacion-->
        <aside>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow my-0 py-0" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="index.php"><img src="assets/static/LogoFS.png" height="64px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="boton_sesion" href="perfil.php">Mi cuenta</a></li>
                            <li class="nav-item"><a class="boton_salir" href="includes/logout.php">Cerrar sesion</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </aside>
        <!-- contenido de la pagina-->        
        <div class="contenido row justify-content-center" style="--bs-gutter-x: none; font-family: 'Open Sans', sans-serif !important; ">
            <div class="card col-10">
                <div class="card-header text-center">
                    <h2>Crear evento</h2>
                </div>
                <div class="card-body text-center">
                    <?php if(!empty($error)){ ?>
                            <div class="p-4">
                                <div class="alert alert-danger">
                                    <h4 style="font-weight: bold;">Se encontraron los siguientes errores:</h4>
                                    <?php 
                                        foreach($error as $er){
                                    
                                    ?>
                                        <br>
                                        <p><?php echo $er;?></p>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>
                    <?php 
                        if($exito){
                    ?>
                    <div class="p-4">
                        <div class="col-12 alert alert-success text-center">
                            <h3>Se agrego el evento de manera exitosa</h3>
                        </div>
                    </div>
                    
                    <?php }?>
                    <form method="POST" class="needs-validation mb-5" novalidate>
                        <div class="row">
                            <!-- 
                            <div style="float: left; width: 20%">
                                <?php 
                                    //if($usuario['foto']){
                                ?>
                                <img src="<?php //echo $usuario['foto']; ?>">
                                <?php //} else{ ?>
                                    <i class="fa-solid fa-user" style="font-size: 10rem;"></i>
                                <?php //}?>
                            </div>
                            -->
                            
                            <div id="formulario-izq" style="float: left; width: 65%; text-align: left; padding-left: 50px;">
                                <div class="form-group">
                                    <label>Titulo del evento</label>
                                    <input type="text" class="form-control" name="nombre" required maxlength="45">
                                </div>
                                <div class="row pt-4">
                                    <div class="form-group col-6 ">
                                        <label class="">Categoría</label>
                                        <select name="deporte" class="form-input form-control" required>
                                            <?php while($dep = mysqli_fetch_array($deportes)){?>
                                                <option value="<?php echo $dep['id_deporte'];?>">
                                                    <?php echo $dep['nombre'];?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="">Dia y hora</label>
                                        <input class="form-control form-dia-hora" type="datetime-local" name="fecha" required>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea name="descripcion" class="form-control" rows="4"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div  id="formulario-der" style="float: center; width: 35%" class="pl-4 pr-4">
                                <div class="text-center col-12"  id="mapa" style="width: 100%; height: 100%;" >

                                </div>
                                <!-- 
                                <div>
                                    <img src="assets/img/google_maps.jpg" style="width: 80%;">
                                </div>
                                -->
                            </div>
                        </div>
                        
                        <div class="pt-4 ">
                            <input type="hidden" id="direccion" name="direccion">
                            <input type="hidden" id="fecha_min" name="fecha_min">
                            <input type="hidden" id="fecha_max" name="fecha_max">
                            <button type="submit" class="btn btn-primary">Crear evento</button>
                            <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- Footer-->
        <footer class="bg-black text-center py-3">
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
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMapa"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="dist/js/jquery-3.6.0.min.js"></script>

        <script src="dist/js/script_jquery.js"></script>
        
        
        <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    </body>
</html>
