<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Iniciar sesion</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="row w-25 mt-5  d-flex justify-content-center rounded-3">
            <div class="col-12 d-flex justify-content-center">
                <img src="assets/static/LogoFS.png" width="165px" alt=""/>
            </div>
            <div class="col-12">
                <h1 class="text-center">Login</h1>
            </div>
            <div class="col-12 text-center">
                <input class="w-100 mr-3 ml-3 mt-1 mb-2 p-2  form-control rounded-3" type="text" placeholder="Correo"/>
                <input class="w-100 mr-3 ml-3 mt-2 mb-1 p-2 form-control rounded-3" type="text" placeholder="Contraseña"/>
            </div>
            <div class="col-12">
                <p class="mt-2 text-danger text-center">Etiqueta de notificación</p>
                <div class="container-fluid d-flex justify-content-evenly">
                    <input class="btn btn-primary ml-2 mr-2" type="button" value="Iniciar sesion"/>
                    <input class="btn btn-danger ml-2 mr-2" type="button" value="Cancelar"/>
                </div>
                <div class="container-fluid d-flex justify-content-center">
                    <a class=" m-2 text-center text-decoration-none" href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            <div class="col-12 container-fluid d-flex justify-content-center m-2">
                <span>No tienes una cuenta?, <a class="text-decoration-none" href="#">Crea una aquí</a></span>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>