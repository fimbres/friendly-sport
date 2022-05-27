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
                //OBTENER PARTICIPANTES DEL EVENTO  -> esto podria hacerse en una funcion para no repetir en CANCELAR, INSCRIBIRSE, Y MOSTRAR INFO
                $participantesQuery = $conexion->query("SELECT nombre_usuario FROM tb_usuario WHERE id_usuario IN (SELECT id_usuario FROM tb_relacion_usuarios_eventos WHERE id_evento = ".$idEvento.")");
                $participantes = array();
                while($filaParticipante = mysqli_fetch_array($participantesQuery))
                {
                    array_push($participantes,$filaParticipante['nombre_usuario']);
                }
                
                $stringParticipantes = implode(",",$participantes);

                //LIBERAR ESPACIO
                mysqli_free_result($participantesQuery);
                
                $response = array("response" => "Success","message" => "Te has inscrito correctamente","lista_participantes"=>$stringParticipantes);
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
