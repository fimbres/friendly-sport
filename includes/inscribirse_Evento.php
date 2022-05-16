<?php
    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $idEvento = $_POST['idEvento'];

    $conexion = crear_conexion_variable();

    if($idEvento != "")
    {
        session_start();
        $idUsuario = $_SESSION['usuario_Id'];

        $sql_comprobar = 'SELECT * FROM tb_relacion_usuarios_eventos WHERE id_evento='.$idEvento.' AND  id_usuario='.$idUsuario.'';
        $relSqlComprobar = mysqli_query($conexion,$sql_comprobar);
        $row_cnt = $relSqlComprobar->num_rows;

        if($row_cnt <= 0)
        {
            $sql = "INSERT INTO tb_relacion_usuarios_eventos (id_evento,id_usuario,es_organizador) VALUES ('".$idEvento."','".$_SESSION['usuario_Id']."','0')";
            $relSql = mysqli_query($conexion,$sql);

            if($relSql)
            {
                $response = array("response" => "Success","message" => "Te has inscrito correctamente");
                echo json_encode($response);
                exit();
            }
            else
            {
                $response = array("response" => "Invalid","message" => "Ha ocurrido un error");
            }
        }
        else
        {
            $response = array("response" => "Invalid","message" => "Ya estas inscrito");
        }
    }
    else
    {
        $response = array("response" => "Invalid","message" => "Invalido");
    }

    echo json_encode($response);
?>