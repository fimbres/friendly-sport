<?php 
    include("includes/config.php");

    $error_post = true;
    $errores = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nom = $_POST['nombre_usuario'];
        $email = $_POST['email'];
        $BD = crear_conexion_clase();
        $str ="call sp_buscar_usuario_n('$nom')";
        $row = $BD->query($str);
        $BD->close();
        if($row->num_rows > 0){
            
            $res = $row->fetch_assoc();
            if(strcmp($res['email'],$email) == 0){
                $error_post = false;
                $contra = $res['contrasena'];
                //$cuerpo = crear_base_html("<h4>Tu contraseña olvidada es:<br> ".$contra ."</h4>");
                $cuerpo = $contra;
                mail($res['email'],"Contraseña olvidada - Friendly Sport",$cuerpo);
                include("includes/widgets/correo_enviado.php");
            } else{
                array_push($errores, "El email no coincide, vuelva a intentarlo");
            }
            
        } else{
            array_push($errores, "El nombre de usuario no existe");
        }
    } 
    
    if($error_post) {

    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Crear tu cuenta en la nueva red social Friendly Sport, donde podras encontrar personas para jugar tus deportes favoritos." />
    <meta name="author" content="472 UABC Group" />
    <title>Crear cuenta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Adamina&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/FS-icono.ico" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/signup.css">
    
</head>

<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="overlay">
                            <!-- LOGN IN FORM by Omar Dsoky -->
                            <form method="POST" class="col-md-8 needs-validation" novalidate>
                                <header class="head-form">
                                    <a href="index.php">
                                    <img src="assets/static/LogoFS-sin-fondo.png" class="img-fluid" style="max-width: 20%; padding-bottom: 30px">
                                    </a>
                                    <h2>Restablecer contraseña</h2>
                                    <?php if($errores){?>
                                    <div class="alert alert-danger fade show" role="alert">
                                        <strong>Existieron los siguientes errores:</strong> 
                                        <?php foreach($errores as $error){?>
                                        <br>
                                        
                                        <?php echo $error;
                                        }?>
                                    </div>
                                <?php }?>
                                </header>
                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Nombre de usuario</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa fa-user-circle"></i>
                                                </div>
                                            </div>
                                            <input  class="form-control" 
                                                    type="text" 
                                                    placeholder="Persona55" 
                                                    maxlength="15" 
                                                    name="nombre_usuario"
                                                    required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Correo electrónico</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input  class="form-input form-control"
                                                    placeholder="persona@ejemplo.com.mx" 
                                                    type="email" 
                                                    maxlength="100" 
                                                    name="email"
                                                    required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row p-5 align-content-center align-items-center align-self-center">
                                    <div class="col-6 text-center">
                                        <button type="submit" class="btn-primary btn col-11" style="height: 50px">Cambiar contraseña</button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <a href="welcome.php">
                                            <button type="button" class="btn-secondary btn col-11" style="height: 50px">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <p style="font-size: 1.2rem;">¿Ya tienes cuenta? <a href="login.php">Inicia sesion aqui</a></p>
                                </div>
                                <!-- End Form -->
                            </form>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
<?php }?>