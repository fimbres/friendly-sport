<?php
    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $idEvento = $_POST['idEvento'];

    $conexion = crear_conexion_variable();

    if($idEvento != "")
    {
        session_start();
        $idUsuario = $_SESSION['usuario_Id'];

        //BUSCAR SI EL USUARIO ESTA INSCRITO EN EL EVENTO
        $statusInscripcionEvento = $conexion->query("SELECT * FROM tb_relacion_usuarios_eventos WHERE id_evento=".$idEvento." AND  id_usuario=".$idUsuario."");
        $statusInscripcionEncontrados = $statusInscripcionEvento->num_rows;

        //BUSCAR SI EL USUARIO ES EL ORGANIZADOR DEL EVENTO
        $filaOrganizador = $statusInscripcionEvento->fetch_assoc();
        $statusInscripcionEvento = $filaOrganizador['es_organizador'];

        //VALIDAR SI EL USUARIO YA ESTA INSCRITO AL EVENTO
        if($statusInscripcionEncontrados > 0){

            //VALIDAR SI EL USUARIO ES EL ORGANIZADOR DEL EVENTO
            if($statusInscripcionEvento != "1"){

                if($CancelarInscripcionEvento = $conexion->query("DELETE FROM tb_relacion_usuarios_eventos WHERE id_evento=".$idEvento." AND  id_usuario=".$idUsuario."")){
                    
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
                    
                    $response = array("response" => "Success","message" => "Has cancelado tu subscripcion al evento","lista_participantes"=>$stringParticipantes);
                }
                else{
                    $response = array("response" => "Invalid","message" => "Error al desinscribirse");
                }
            }
            else{
                $response = array("response" => "Invalid","message" => "Eres el organizador del evento");
            }
        }else{
            $response = array("response" => "Invalid","message" => "Aun no estas inscrito a este evento");
        }
    }

    echo json_encode($response);
    mysqli_close($conexion);
?>