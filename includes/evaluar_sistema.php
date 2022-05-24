<?php
    session_start();
    $usuario = $_SESSION['usuario_Id'];

    //CALIFICACION Y COMENTARIOS INGRESADOS POR EL USUARIO
    $calificacion = $_POST['calif'];
    $comentario = $_POST['comment'];

    //ARREGLO CON CARACTERES QUE NO SE PERMITEN
    $caracteres_especiales = array('{','}','[',']','"',"'",'&');

    //LIMPIAMOS LAS VARIABLES PARA EVITAR INYECCION SQL
    $calificacion_limpia = str_replace($caracteres_especiales,' ',$calificacion);
    $comentario_limpio = str_replace($caracteres_especiales,' ',$comentario);

    //VERIFICAMOS SI EL USUARIO INICIO SESION
    if(isset($usuario)){
        if($calificacion_limpia != ""){

            //AGREGAMOS LAS VARIABLES DE CONEXION
            include '../includes/funciones_BD.php';
            $conexion = crear_conexion_variable();

            //VERIFICAMOS SI EL USUARIO NO INGRESO MAS DE LOS CARACTERES PERMITIDOS
            $cantidad_caracteres = strlen($comentario_limpio);

            if($cantidad_caracteres <= 1000){

                //BUSCAMOS SI EL USUARIO YA LLENO LA EVALUACION PREVIAMENTE
                $busca_usuario_evaluacion = $conexion -> query("SELECT * FROM tb_evaluacion WHERE id_usuario='".$usuario."'");
                $evaluaciones_encontradas = $busca_usuario_evaluacion -> num_rows;

                if($evaluaciones_encontradas < 1){
                    //REGISTRAMOS LA EVALUACION DEL USUARIO
                    $evaluar_sistema = $conexion -> query("INSERT INTO tb_evaluacion (id_usuario,calificacion,comentario) VALUES ('".$usuario."','".$calificacion_limpia."','".$comentario_limpio."')");
                    $response = array("response" => "Success","message" => "Gracias por enviarnos tu opinion");
                }else{
                    $response = array("response" => "Invalid","message" => "Ya has enviado la evaluación anteriormente");
                }
            }else{
                $response = array("response" => "Invalid","message" => "Excediste el limite de caracteres");
            }
            
        }
        else{
            $response = array("response" => "Invalid","message" => "No has ingresado una calificacion");
        }
    }
    else{
        $response = array("response" => "Invalid","message" => "Debes iniciar sesion");
        header("locaion: ../welcome.php");
    }

    echo json_encode($response);
?>