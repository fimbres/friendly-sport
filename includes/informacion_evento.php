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

/*
    $consulta = "SELECT * FROM tb_evento WHERE id_evento='".$idEvento."'";
    $respuesta = mysqli_query($conexion,$consulta);
    //$encontrados = mysqli_num_rows($res);
    

    if($respuesta){
        session_start();
        $idUsuario = $_SESSION['usuario_Id'];

        $info_evento = mysqli_fetch_array($respuesta);
        
        $id_evento = $info_evento['id_evento'];
        $hora_inicio = new DateTime($info_evento['hora_inicio']);
        $h_hora_inicio = $hora_inicio ->format('H');
        $minutos_hora_inicio  = $hora_inicio -> format('i');
        $segundos_hora_inicio =  $hora_inicio -> format('s');

        $direccion = $info_evento['direccion'];

        $direccion_dividida = explode(",",$direccion);
        $latitud = $direccion_dividida[0];
        $longitud = $direccion_dividida[1];

        $query_nombre_deporte=mysqli_query($conexion,'CALL sp_nombre_deporte("'.$id_evento.'")');


        if($query_nombre_deporte)
        {
            $fila = $query_nombre_deporte->fetch_assoc();
            $nombre_deporte = $fila['nombre'];
            //$response = array("response" => "Success","Nombre_deporte" => $nombre_deporte,"Nombre_evento" => $info_evento['nombre'], "Fecha_evento" => $info_evento['fecha'], "Hora_inicio" => $h_hora_inicio, "Minutos_inicio" => $minutos_hora_inicio, "Segundos_inicio" => $segundos_hora_inicio,"Direccion_latitud" => $latitud,"Direccion_longitud" => $longitud);
            
            //$organizador_nombre=mysqli_query($conexion,'CALL sp_nombre_organizador("'.$id_evento.'")');
            $response = array("response" => "Success","Nombre_deporte" => $nombre_deporte,"Nombre_evento" => $info_evento['nombre'], "Fecha_evento" => $info_evento['fecha'], "Hora_inicio" => $h_hora_inicio, "Minutos_inicio" => $minutos_hora_inicio, "Segundos_inicio" => $segundos_hora_inicio,"Direccion_latitud" => $latitud,"Nombre_organizador" => '');
        }


    

        //$consulta_organizador = "SELECT nombre_usuario FROM tb_usuario WHERE id_usuario = (SELECT id_usuario FROM tb_relacion_usuarios_eventos WHERE id_evento = '".$idEvento."' AND es_organizador = 1)";
        //$realizar_organizador = mysqli_query($conexion,$consulta_organizador);

        
        
        
    }
    else
    {
        $response = array("response" => "Invalid","message" => "Excediste los caracteres permitidos");
    }

   
    
    echo json_encode($response);
    

    //echo "Se encontraron:" . $encontrados;

    */
?>
