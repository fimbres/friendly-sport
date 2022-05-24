<?php
session_start();
if(isset($_SESSION['usuario_Id'])){
                include 'includes/funciones_BD.php';
                $conexion = crear_conexion_variable();

                $usuario = $_SESSION['usuario_Id'];
                $busca_usuario_evaluacion = $conexion -> query("SELECT * FROM tb_evaluacion WHERE id_usuario='".$usuario."'");
                $evaluaciones_encontradas = $busca_usuario_evaluacion -> num_rows;

                if($evaluaciones_encontradas < 1){
                    
                }else{
                    header("location: index.php");
                }
}else{
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendly Sport - Calificanos</title>
    <link rel="icon" type="image/x-icon" href="assets/FS-icono.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="dist/css/styles.css" rel="stylesheet"/>
    <link href="dist/css/calificanos.css" rel="stylesheet"/>
</head>
<body>
    <div id="principal" class="container-fluid d-flex position-relative h-100 align-items-center justify-content-center">
        
        <div id="container-messages" class="container d-none align-items-center justify-content-center mt-5 bg-white">
            <div id="div-info-loading" class="container-fluid bg-white d-flex align-items-center justify-content-center d-none">
                <div class="loadingio-spinner-spinner-2cyqt1abmyf"><div class="ldio-z7v55d2fuwm">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                </div></div>
            </div>
            <div class="container w-100 d-flex align-items-center justify-content-center">
                <h1 id="info-inscribirse-notificacion" class="text-dark p-4 text-center d-none w-100"></h1>
            </div>
            <div class="container w-100 d-flex align-items-center justify-content-center">
                <input type="button" class="btn btn-custom-primary pt-2 pb-2 ps-4 pe-4 d-none btnClose" value="volver">
            </div>
        </div>
       

        <div id="custom-container-items" class="card-body mt-5">
            <div class="form-group mt-3">
                <h1 class="text-center">¿Qué calificación nos darías?</h1>
            </div>

            <div class="form-group mt-3 mb-3 d-flex align-items-center justify-content-center">
                <p class="clasificacion fs-1">
                    <input class="calif-option" id="radio1" type="radio" name="estrellas" value="5"><!--
                    --><label for="radio1">★</label><!--
                    --><input class="calif-option" id="radio2" type="radio" name="estrellas" value="4"><!--
                    --><label for="radio2">★</label><!--
                    --><input class="calif-option" id="radio3" type="radio" name="estrellas" value="3"><!--
                    --><label for="radio3">★</label><!--
                    --><input class="calif-option" id="radio4" type="radio" name="estrellas" value="2"><!--
                    --><label for="radio4">★</label><!--
                    --><input class="calif-option" id="radio5" type="radio" name="estrellas" value="1"><!--
                    --><label for="radio5">★</label>
                </p>
            </div>

            <div class="form-group mt-5">
                <h4 class="text-center">¿Tienes comentarios o sugerencias?</h4>
                <h5 class="text-center">escríbelo a continuación</h5>
            </div>

            <div class="form-group mt-3 d-flex align-items-center justify-content-center">
                <div class="custom-form-comments form-floating">
                    <textarea id="autoresizing" class="form-control" placeholder="escribe aquí" id="floatingTextarea" maxlength="1000"></textarea>
                    <label for="floatingTextarea">escribe aquí...</label>
                </div>
            </div>

            <div class="form-group mt-5 d-flex align-items-center justify-content-center">
                <input id="btnEvaluar" type="button" class="btn btn-custom-primary pt-2 pb-2 ps-5 pe-5" value="Evaluar"/>
            </div>

        </div>    
    </div>

    <script src="dist/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#autoresizing').on('input', function () {
            this.style.height = 'auto';
              
            this.style.height = 
                    (this.scrollHeight) + 'px';
        });
    </script>

    <script>
        $('.btnClose').on('click', function(event){
            window.location.href="index.php";
        });
        
    </script>

    <script>
        window.calif = -1;

        //MOSTRAR INFORMACION DEL EVENTO
        $('.calif-option').on('click', function(event) 
        {
            window.calif = jQuery(this).val();
            console.log(window.calif);
        });


        //RETIRARSE DE UN EVENTO
        $('#btnEvaluar').on('click', function(event) {

            let comentario = $('#autoresizing').val();

            if(calif != -1)
            {
                $.ajax({
                    type:'POST',
                    url:'includes/evaluar_sistema.php',
                    dataType:'JSON',
                    data: {calif: window.calif, comment: comentario},
                    beforeSend:function(data){
                        //FORMULARIO
                        $('#custom-container-items').addClass('d-none');
                        
                        //CAJA DE MENSAJES
                        $('#container-messages').removeClass('d-none');
                        $('#div-info-loading').removeClass('d-none');
                        
                    },  
                    success:function(data){
                        if(data.response == "Success"){  
                            //OCULTAR ANIMACION
                            $('#div-info-loading').addClass('d-none');

                            //MOSTRAR MENSAJE
                            $('#info-inscribirse-notificacion').text(data.message);
                            $('#info-inscribirse-notificacion').removeClass('d-none');
                            $('.btnClose').removeClass('d-none');
                        }   
                        else{
                            //OCULTAR ANIMACION
                            $('#div-info-loading').addClass('d-none');

                            //MOSTRAR MENSAJE
                            $('#info-inscribirse-notificacion').text(data.message);
                            $('#info-inscribirse-notificacion').removeClass('d-none');
                            $('#container-messages').removeClass('d-none');

                            setTimeout(function() { 
                                delete data;

                                //VOLVER AL FORMULARIO
                                $('#custom-container-items').removeClass('d-none');


                                //OCULTAR CAJA DE MENSAJES Y ANIMACION
                                $('#div-info-loading').addClass('d-none');
                                $('#info-inscribirse-notificacion').addClass('d-none');
                                $('#container-messages').addClass('d-none');
                            }, 2000); 
                        }
                    },
                        error: function (xhr, exception) {
                        
                        }
                });
            }
            else
            {
                //FORMULARIO
                $('#custom-container-items').addClass('d-none');

                //CAJA DE MENSAJES
                $('#info-inscribirse-notificacion').text("No has ingresado una calificación");
                $('#container-messages').removeClass('d-none');
                $('#info-inscribirse-notificacion').removeClass('d-none');

                setTimeout(function (){
                    //CAJA DE MENSAJES
                    $('#container-messages').addClass('d-none');
                    $('#info-inscribirse-notificacion').addClass('d-none');

                    //FORMULARIO
                    $('#custom-container-items').removeClass('d-none');
                },2000);
                console.log("estan vacios los campos");
            }
        });
    </script>
</body>
</html>