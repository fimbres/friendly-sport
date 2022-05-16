<?php
    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $idEvento = $_POST['idEvento'];

    $conexion = crear_conexion_variable();

    if($idEvento != "")
    {
        session_start();
        $idUsuario = $_SESSION['usuario_Id'];

        //VALIDAR SI EL USUARIO YA ESTA INSCRITO AL EVENTO
        $statusInscripcionEvento = $conexion->query("SELECT * FROM tb_relacion_usuarios_eventos WHERE id_evento=".$idEvento." AND  id_usuario=".$idUsuario."");
        $statusInscripcionEncontrados = $statusInscripcionEvento->num_rows;

        if($statusInscripcionEncontrados <= 0){
            //INSCRIBIR USUARIO
            if($inscribirUsuario = $conexion->query("INSERT INTO tb_relacion_usuarios_eventos (id_evento,id_usuario,es_organizador) VALUES ('".$idEvento."','".$idUsuario."','0')")){
                $response = array("response" => "Success","message" => "Te has inscrito correctamente");
                echo json_encode($response);
                exit();

            }else{
                $response = array("response" => "Invalid","message" => "Ha ocurrido un error");
            }
        }else{
            $response = array("response" => "Invalid","message" => "Ya estas inscrito");
        }
    }


    echo json_encode($response);

    mysqli_close($conexion);
?>