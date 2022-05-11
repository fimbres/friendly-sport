<?php
    session_start();
    
    if(isset($_SESSION['usuario_Id'])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/FS-icono.ico" />
    <link rel="stylesheet" href="dist/vendor/bootstrap-4.5.3/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="dist/icons/material-design-icons/css/mdi.min.css" type="text/css">
    <link rel="stylesheet" href="dist/css/login_styles.css" type="text/css">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <!-- Latform styles -->
    <link rel="stylesheet" href="dist/css/latform-style-1.min.css" type="text/css">
    <title>Friendly Sport - Iniciar sesion</title>
</head>
<body>
    <div class="form-wrapper">
        <div class="container">
            <div id="cardLogin" class="card">
                <div class="card-body">
                    <div class="logo">
                        <img src="assets/static/LogoFS-sin-fondo.png" alt="logo" width="130px">
                    </div>
                    <div class="my-3 text-center">
                        <h1 class="font-weight-bold mb-3 fs-1">Login</h1>
                    </div>
                    <form id="loginForm">
                        <div class="form-group">
                            <div class="form-icon-wrapper">
                                <input type="text" class="form-control border border-dark" id="username" maxlength="15" placeholder="Usuario" autofocus
                                    required>
                                <i class="form-icon-left mdi mdi-face-profile"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-icon-wrapper">
                                <input type="password" class="form-control border border-dark" id="password" maxlength="15" placeholder="Contraseña"
                                    required>
                                <i class="form-icon-left mdi mdi-lock"></i>
                                <a href="#" class="form-icon-right password-show-hide" title="Hide or show password">
                                    <i class="mdi mdi-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-center">
                                <a class="d-none text-danger font-weight-bold" id="notificacion">Mensaje</a>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button id="btnLogin" class="btn ml-3 mr-3" type="submit">Iniciar sesion</button>
                            <button id="btnCancelar" class="btn ml-3 mr-3">Cancelar</button>
                        </div>
                        <p class="text-center">
                            <a href="recuperar_contra.php">¿Olvidaste tu contraseña?</a>.
                        </p>
                        <div class="text-divider">o</div>
                        <p class="text-center">
                            ¿No tienes una cuenta?
                            <a href="signup.php">Crea una aqui</a>.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="dist/vendor/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="dist/vendor/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <!-- Latform scripts -->
    <script src="dist/js/latform.min.js"></script>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();

            if(username!="" && password!="" )
            {
                $.ajax({
                        type:'POST',
                        url:'includes/iniciar_sesion.php',
                        dataType:'JSON',
                        data: {username: username,password:password},
                        beforeSend:function(data){
                            $('#notificacion').addClass('d-none');
                    
                        },  
                        success:function(data){
                            if(data.response == "Success"){     
                                window.location="index.php";
                            }   
                            else if (data.response == "Invalid") {
                                $('#notificacion').text(data.message);
                                $('#notificacion').removeClass('d-none');
                            }
                        },
                        error: function (xhr, exception) {
                            console.log("error");
                        }
                    });
            }
            else
            {
                $('#notificacion').text('Debes llenar los campos');
                $('#notificacion').removeClass('d-none');
            }
            });


            $('#btnCancelar').on('click', function() {
                window.location="welcome.php";
            });
    </script>
</body>
</html>