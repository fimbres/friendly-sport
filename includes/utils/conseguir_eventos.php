<?php 
    require '../funciones_BD.php';

    $conexion = crear_conexion_variable();
    $response = [];
    $res = $conexion->query("SELECT * FROM vw_tarjeta_evento order by id_deporte,fecha,hora");
    if($res){
        $rows = [];
        while($temp = mysqli_fetch_array($res)){
            array_push($rows,$temp);
        }
        $response = array("response" => "Success","tarjeta"=>$rows);
    } else{
        $response = array("response" => "Invalid","message" => "Ya estas inscrito");
    }
    mysqli_close($conexion);
    echo json_encode($response);
    
?>