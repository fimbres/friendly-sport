<?php 
    $idEvento = $_POST['idEvento'];

    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL
    $conexion = crear_conexion_variable();

    if ($resultado = $conexion->query("SELECT nombre,fecha,hora_inicio,direccion FROM tb_evento WHERE id_evento='".$idEvento."'")){
        //COMIENZO DE SESION PARA VARIABLES DE USUARIO
        session_start();
        $idUsuario = $_SESSION['usuario_Id'];

        //OBTENER ARREGLO DE LA CONSULTA A LA TABLA EVENTOS
        $info_evento = mysqli_fetch_array($resultado);

        //FECHA, HORA, MINUTOS Y SEGUNDOS DEL EVENTO
        $hora_inicio = new DateTime($info_evento['hora_inicio']);
        $h_hora_inicio = $hora_inicio ->format('H');
        $minutos_hora_inicio  = $hora_inicio -> format('i');
        $segundos_hora_inicio =  $hora_inicio -> format('s');

        //DIRECCION, DIVIDIDA LATITUD Y LONGITUD
        $direccion = $info_evento['direccion'];
        $direccion_dividida = explode(",",$direccion);
        $latitud = $direccion_dividida[0]; //LATITUD
        $longitud = $direccion_dividida[1]; //LONGITUD

        //LIBERAR ESPACIO
        mysqli_free_result($resultado);

        //OBTENER ORGANIZADOR DEL EVENTO
        if ($organizadorNombre = $conexion->query("SELECT nombre_usuario FROM tb_usuario WHERE id_usuario IN (SELECT id_usuario FROM tb_relacion_usuarios_eventos WHERE id_evento = ".$idEvento." AND es_organizador='1')")){
            $filaOrganizador = $organizadorNombre->fetch_assoc();
            $organizador_evento = $filaOrganizador['nombre_usuario'];

            //LIBERAR ESPACIO
            mysqli_free_result($organizadorNombre);

            //VALIDAR SI EL USUARIO YA ESTA INSCRITO AL EVENTO
            $statusInscripcionEvento = $conexion->query("SELECT * FROM tb_relacion_usuarios_eventos WHERE id_evento=".$idEvento." AND  id_usuario=".$idUsuario."");
            $statusInscripcionEncontrados = $statusInscripcionEvento->num_rows;

            if($statusInscripcionEncontrados > 0){
                $inscrito = true;
            }else{
                $inscrito = false;
            }

            //OBTENER CANTIDAD DE USUARIOS INSCRITOS AL EVENTO
            $cantidadInscritosQuery = $conexion->query("SELECT id_evento FROM tb_relacion_usuarios_eventos WHERE id_evento=".$idEvento."");
            $cantidadInscritos = $cantidadInscritosQuery->num_rows;
               

            //OBTENER PARTICIPANTES DEL EVENTO
            $participantesQuery = $conexion->query("SELECT nombre_usuario FROM tb_usuario WHERE id_usuario IN (SELECT id_usuario FROM tb_relacion_usuarios_eventos WHERE id_evento = ".$idEvento.")");
            $participantes = array();
            while($filaParticipante = mysqli_fetch_array($participantesQuery))
            {
                array_push($participantes,$filaParticipante['nombre_usuario']);
            }
            
            $stringParticipantes = implode(",",$participantes);

            //LIBERAR ESPACIO
            mysqli_free_result($participantesQuery);

            //OBTENER NOMBRE CATEGORIA DEPORTE
            if($nombreDeporteRes = $conexion->query('CALL sp_nombre_deporte("'.$idEvento.'")')){
                $filaDeportes = $nombreDeporteRes->fetch_assoc();
                $nombre_deporte = $filaDeportes['nombre'];

                $response = array("response" => "Success","Nombre_deporte" => $nombre_deporte,"Nombre_evento" => $info_evento['nombre'], "Fecha_evento" => $info_evento['fecha'], "Hora_inicio" => $h_hora_inicio, "Minutos_inicio" => $minutos_hora_inicio, "Segundos_inicio" => $segundos_hora_inicio,"Direccion_latitud" => $latitud,"Nombre_organizador" => $organizador_evento,"status_inscripcion" => $inscrito,"cantidad_inscritos"=>$cantidadInscritos,"lista_participantes"=>$stringParticipantes,"direccion_completa"=>$direccion);
            }

        }else{
            $response = array("response" => "Invalid","message" => "Error al buscar organizador");
        }

    }else{
        $response = array("response" => "Invalid","message" => "Evento no encontrado");
    }

    //DEVOLVER RESPUESTA
    echo json_encode($response);

    mysqli_close($conexion);

?>
