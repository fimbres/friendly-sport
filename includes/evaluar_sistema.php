<?php
    session_start();
    $usuario = $_SESSION['usuario_Id'];

    //CALIFICACION Y COMENTARIOS INGRESADOS POR EL USUARIO
    $calificacion = $_POST['calif'];
    $comentario = $_POST['comment'];

    $caracteres_especiales = array('{','}','[',']','"',"'",'&','OR','or');

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
                $evaluar_sistema = $conexion -> query("INSERT INTO tb_calidad (calificacion,comentario) VALUES ('".$calificacion_limpia."','".$comentario_limpio."')");
                $obtener_evaluaciones = $conexion -> query("SELECT id_calidad FROM tb_calidad");
                $cantidad_evaluacion = $obtener_evaluaciones -> num_rows;
                $evaluar_sistema = $conexion -> query("INSERT INTO tb_relacion_usuarios_calidad (id_usuario,id_calidad) VALUES ('".$usuario."','".$cantidad_evaluacion."')");
               
                $busca_usuario_evaluacion = $conexion -> query("SELECT * FROM tb_relacion_usuarios_calidad WHERE id_usuario='".$usuario."'");
                $evaluaciones_encontradas = $busca_usuario_evaluacion -> num_rows;

                if($evaluaciones_encontradas < 1){
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