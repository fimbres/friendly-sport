<?php 
    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $idEvento = $_POST['idEvento'];

    $conexion = crear_conexion_variable();

    $consulta = "SELECT * FROM tb_evento WHERE id_evento='".$idEvento."'";
    $respuesta = mysqli_query($conexion,$consulta);
    //$encontrados = mysqli_num_rows($res);
    

    if($respuesta){
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


       
        $query=mysqli_query($conexion,'CALL sp_nombre_deporte("'.$id_evento.'")');

      
        if($query)
        {
            $fila = $query->fetch_assoc();
            $nombre_deporte = $fila['nombre'];
            //$response = array("response" => "Success","Nombre_deporte" => $nombre_deporte,"Nombre_evento" => $info_evento['nombre'], "Fecha_evento" => $info_evento['fecha'], "Hora_inicio" => $h_hora_inicio, "Minutos_inicio" => $minutos_hora_inicio, "Segundos_inicio" => $segundos_hora_inicio,"Direccion_latitud" => $latitud,"Direccion_longitud" => $longitud);
        }
      
        
    }
    else
    {
        $response = array("response" => "Invalid","message" => "Excediste los caracteres permitidos");
    }

   
    
    echo json_encode($response);
    

    //echo "Se encontraron:" . $encontrados;*/
?>