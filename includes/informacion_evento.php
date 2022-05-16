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

        //OBTENER NOMBRE CATEGORIA DEPORTE
        if($nombreDeporteRes = $conexion->query('CALL sp_nombre_deporte("'.$idEvento.'")')){
            $fila = $nombreDeporteRes->fetch_assoc();
            $nombre_deporte = $fila['nombre'];

            //LIBERAR ESPACIO
            mysqli_free_result($nombreDeporteRes);
            mysqli_free_result($resultado);
            
            $response = array("response" => "Success","Nombre_deporte" => $nombre_deporte,"Nombre_evento" => $info_evento['nombre'], "Fecha_evento" => $info_evento['fecha'], "Hora_inicio" => $h_hora_inicio, "Minutos_inicio" => $minutos_hora_inicio, "Segundos_inicio" => $segundos_hora_inicio,"Direccion_latitud" => $latitud,"Nombre_organizador" => '');
            
        }

    }else{
        $response = array("response" => "Invalid","message" => "Evento no encontrado");
    }

    //DEVOLVER RESPUESTA
    echo json_encode($response);

    mysqli_close($conexion);

?>
