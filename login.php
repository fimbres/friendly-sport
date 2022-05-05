<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login_styles.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <title>Friendly Sport - Iniciar sesion</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <form id="loginForm" class="row w-25 mt-5  d-flex justify-content-center rounded-3">
            <div class="col-12 d-flex justify-content-center">
                <img class="mt-3" src="assets/static/LogoFS.png" width="165px" alt=""/>
            </div>
            <div class="col-12">
                <h1 class="text-center">Login</h1>
            </div>
            <div class="col-12 text-center">
                <input id="txtCorreo" class="w-100 mr-3 ml-3 mt-1 mb-2 p-2  form-control rounded-3" name="correo"  autocomplete="off" type="text" placeholder="Correo"/>
                <input id="txtPassword" class="w-100 mr-3 ml-3 mt-2 mb-1 p-2 form-control rounded-3" name="password"  autocomplete="off" type="password" placeholder="Contraseña"/>
            </div>
            <div class="col-12">
                <p id="notificacion" class="mt-2 text-danger text-center d-none">Etiqueta de notificación</p>
                <div class="container-fluid d-flex justify-content-evenly mt-2">
                    <input id="btnLogin" class="btn ml-2 mr-2" type="submit" value="Iniciar sesion"/>
                    <input id="btnCancelar" class="btn btn-danger ml-2 mr-2" type="button" value="Cancelar"/>
                </div>
                <div class="container-fluid d-flex justify-content-center">
                    <a id="lblRecuperar" class=" m-2 text-center text-decoration-none" href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            <div class="col-12 container-fluid d-flex justify-content-center m-2 mb-4 pb-2">
                <span>No tienes una cuenta?, <a id="lblCrear" class="text-decoration-none" href="signup.php">Crea una aquí</a></span>
            </div>
        </form>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var email = $('#txtCorreo').val();
            var password = $('#txtPassword').val();

            if(email!="" && password!="" )
            {
                $.ajax({
                        type:'POST',
                        url:'php/iniciar_sesion.php',
                        dataType:'JSON',
                        data: {email: email,password:password},
                        beforeSend:function(data){
                    
                        },  
                        success:function(data){
                            if(data.response == "Success"){     
                                window.location="welcome.php";
                            }   
                            else if (data.response == "Invalid") {
                                $('#notificacion').text('Correo o contraseña incorrectos');
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
                $('#txtCorreo').val('');
                $('#txtPassword').val('');
                $('#notificacion').addClass('d-none');
            });
    </script>
    <script src="js/scripts.js"></script>
</body>
</html>