<?php
include("includes/config.php");

$BD = crear_conexion_clase();

$genero = [];
array_push($genero, ($BD->query("call sp_buscar_genero_g('Masculino');"))->fetch_assoc());
$BD->next_result();
array_push($genero, ($BD->query("call sp_buscar_genero_g('Femenino');"))->fetch_assoc());
$BD->next_result();
array_push($genero, ($BD->query("call sp_buscar_genero_g('Otro');"))->fetch_assoc());


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errores = signup_verificar_datos($_POST);
    if(!$errores){
        $BD->next_result();
        signup_insertar_datos($_POST,$BD);
    }
}
$BD->close();
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
                                    <img src="assets/static/LogoFS-sin-fondo.png" class="img-fluid" style="max-width: 20%; padding-bottom: 30px">
                                    <h2>Registro</h2>
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
                                <div class="form-row row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Dirección</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                            </div>
                                            <input  class="form-input form-control" 
                                                    placeholder="Reforma #237, Colonia los pinos" 
                                                    type="text"
                                                    name="direccion" 
                                                    required>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Contraseña</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa-solid fa-lock"></i>
                                                </div>
                                            </div>
                                            <input  class="form-input form-control" 
                                                    maxlength="10" 
                                                    type="password" 
                                                    name="contra"
                                                    required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Repetir contraseña</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa fa-solid fa-lock"></i>
                                                </div>
                                            </div>
                                            <input  class="form-input form-control" 
                                                    maxlength="10" 
                                                    type="password" 
                                                    name="contra_re"
                                                    required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Genero</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa-solid fa-venus-mars"></i>
                                                </div>
                                            </div>
                                            <select class="fomr-input form-control" name="genero" required>
                                                <?php
                                                foreach ($genero as $row) {
                                                ?>
                                                    <option value="<?php echo $row['id_genero']; ?>">
                                                        <?php echo $row['genero']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Edad</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="display: block;">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                            </div>
                                            <input  class="form-input form-control"
                                                    name="edad"
                                                    type="number">
                                        </div>
                                    </div>
                                </div>
                                <h3 class="text-center pt-4" style="font-family: 'Abel', sans-serif;">
                                    Selecciona mínimo un deporte de tu interés
                                </h3>
                                <div class="form-row row check-deportes pt-4">

                                    <div class="form-check col-3  text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" 
                                            type="checkbox" name="Futbol soccer">
                                            Futbol soccer
                                        </label>
                                    </div>
                                    <div class="form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Futbol americano">
                                            Futbol Americano
                                        </label>
                                    </div>
                                    <div class="form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Baloncesto">
                                            Baloncesto
                                        </label>
                                    </div>
                                    <div class=" form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Tenis">
                                            Tenis
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row row pt-2">
                                    <div class="form-check col-3  text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Beisbol">
                                            Beisbol
                                        </label>
                                    </div>
                                    <div class="form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Petanca">
                                            Petanca
                                        </label>
                                    </div>
                                    <div class="form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Voleibol">
                                            Voleibol
                                        </label>
                                    </div>
                                    <div class=" form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Ciclismo">
                                            Ciclismo
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row row text-center p-2">
                                    <div class=" form-check col-3 text-center">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Senderismo">
                                            Senderismo
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row row p-5 align-content-center align-items-center align-self-center">
                                    <div class="col-6 text-center">
                                        <button type="submit" class="btn-primary btn col-11" style="height: 50px">Registrarme</button>
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