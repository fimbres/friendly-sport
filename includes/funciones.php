<?php 
    function signup_verificar_datos($post){
        $errores = [];

        //Ya por el propio html, lo que es el nombre, correo
        // direccion, contraseña, genero y edad estan verificados

        //En esta funcion verificaremos que las dos contraseñas dadas coincidan
        // y que tan siquiera 1 de check haya sido marcado
        if(strcmp($post['contra'],$post['contra_re']) != 0){
            array_push($errores,'Las contraseñas no coinciden');
        }

        if(!signup_obtener_check_inputs($post,true)){
            array_push($errores,'Se necesita selecionar minimo un deporte');
        }
        if(empty($errores)){
            return false;
        }
        return $errores;
    }
    function signup_obtener_check_inputs($post, $confirmar = false){
        $inputs = [];
        if(isset($post['Futbol_soccer']))
            array_push($inputs,$post['Futbol_soccer']);
        if(isset($post['Futbol_americano']))
            array_push($inputs,$post['Futbol_americano']);
        if(isset($post['Baloncesto']))
            array_push($inputs,$post['Baloncesto']);
        if(isset($post['Tenis']))
            array_push($inputs,$post['Tenis']);
        if(isset($post['Beisbol']))
            array_push($inputs,$post['Beisbol']);
        if(isset($post['Petanca']))
            array_push($inputs,$post['Petanca']);
        if(isset($post['Voleibol']))
            array_push($inputs,$post['Voleibol']);
        if(isset($post['Ciclismo']))
            array_push($inputs,$post['Ciclismo']);
        if(isset($post['Senderismo']))
            array_push($inputs,$post['Senderismo']);
        if($confirmar){
            if(!empty($inputs)){
                return true;
            } else{
                return false;
            }
        }
        return $inputs;
    }
    function signup_insertar_datos($datos,$BD){

        $nombre = limpiar_string($datos['nombre_usuario'],$BD);
        $email = limpiar_string($datos['email'],$BD);
        $contra = $datos['contra'];
        $genero = $datos['genero'];
        $deportes = signup_obtener_check_inputs($datos);
        $sql = "";
        if(empty($datos['edad'])){
            $sql = "call sp_insertar_usuario('$email','$nombre','$contra',NULL,NULL,0,$genero)";
            
        } else{
            $edad = $datos['edad'];
            $sql = "call sp_insertar_usuario('$email','$nombre','$contra',$edad,NULL,0,$genero)";
        }
        
        if($BD->query($sql) === TRUE){
            $BD->next_result();
            // Obtenemos el ID del usuario que acabamos de agregar
            $sql = "SELECT MAX(id_usuario) AS id FROM tb_usuario;";
            $id = ($BD->query($sql))->fetch_assoc();
            $id = $id['id'];
            //Llenamos la tabla con las relaciones de los deportes que el usuario selcciono.
            foreach($deportes as $dep){
                $sql = "call sp_insertar_relacion_usuarios_deportes($id,$dep);";
                $BD->query($sql);
                $BD->next_result();
            }
            $BD->close();

            header("location: login.php");
        }
        $error = [];
        $BD->next_result();
        $str = "call sp_buscar_usuario_n('$nombre')";

        if($BD->query($str)){
            $BD->next_result();
            $str = "SELECT * FROM tb_usuario where email = '$email'";
            if($BD->query($str)){
                array_push($error,"El correo que ingresaste, ya ha sido ingresado anteriormente, intenta uno diferente");
            }
            array_push($error,"El nombre de usuario que ingresaste ya esta ocupado, intenta uno diferente");
        } else{
            $BD->next_result();
            $str = "SELECT * FROM tb_usuario where email = '$email'";
            if($BD->query($str)){
                array_push($error,"El correo que ingresaste, ya ha sido ingresado anteriormente, intenta uno diferente");
            } else{
                array_push($error,"Hubo un error inesperado al intentar darte de alta, intentalo de nuevo");
            }
        }
        return $error;
        
        
    }

    function limpiar_string($str , $BD){
        $data = trim($str);
        $data = $BD->real_escape_string($str);
        return $data;
    }

    function evento_formulario_verificar($datos,$BD){
        $res = [];
        $errores = [];
        $res['nombre'] = limpiar_string($datos['nombre'],$BD);
        $res['deporte'] = $datos['deporte'];
        if(comprobar_fecha($datos['fecha_min'],$datos['fecha_max'])){
            $temp = explode("T",$datos['fecha']);
            $res['fecha'] = $temp[0];
            $res['hora_inicio'] = $temp[1];
        } else{
            array_push($errores,"La fecha ingresada es incorrecta, vuelve a ingresar otra");
        }
        $res['descripcion'] = limpiar_string($datos['descripcion'],$BD);
        $res['direccion'] = $datos['direccion'];
        if(empty($errores)){
            return [true,$res];
        } else{
            return [false,$errores];
        }
    }
    
    function comprobar_fecha($fecha_min , $fecha_max){
        $fecha_php = new DateTime('now');
        $fecha_js = explode("T",$fecha_min);
        $str = $fecha_js[0] . " " . $fecha_js[1];
        $minimo = new DateTime($str);

        $fecha_js = explode("T",$fecha_max);
        $str = $fecha_js[0] . " " . $fecha_js[1];
        $maximo = new DateTime($str);

        if($fecha_php < $minimo){
            return false;
        }
        if($fecha_php > $maximo){
            return false;
        }
        return true;
    }

    function agregar_evento($datos,$BD){
        $id = $_SESSION['usuario_Id'];
        $sql = "SELECT * FROM tb_relacion_usuarios_eventos where id_usuario = $id and es_organizador = 1";
        $d = $BD->query($sql);
        echo $d->num_rows;
        if($d->num_rows >= 3){
            return [false,['El usuario cuenta con mas de 3 eventos creados, no puede crear mas']];
        }
        $nombre = $fecha = $hora_inicio = $hora_final = NULL;
        $descripcion = $ciudad = $direccion = NULL;
        $error = [];

        $nombre = $datos['nombre'];
        $fecha = $datos['fecha'];
        $hora_inicio = $datos['hora_inicio'];

        if(!empty($datos['descripcion'])){
            $descripcion = $datos['descripcion'];
        } else{
            $descripcion = 'NULL';
        }
        //LA CIUDAD Y HORA_FINAL NO FUERON PEDIDAS EN EL FORMULARIO
        // POSIBLEMENTE ESO SE AGREGARA DENTRO DE LA EDICION
        $hora_final = $ciudad = 'NULL';
        /*POR EL MOMENTO NO SE AGREGARA LA DIRECCION */
        $direccion = $datos['direccion'];

        $sql = "call sp_insertar_evento('$nombre','$fecha','$hora_inicio',$hora_final,";
        if(!empty($datos['descripcion'])){
            $sql .= "'$descripcion',";
        } else{
            $sql .= "NULL,";
        }
        $sql .= "$ciudad,'$direccion');";

        if($BD->query($sql) === TRUE){
            $BD->next_result();
            $sql = "SELECT MAX(id_evento) AS id FROM tb_evento;";
            $id = ($BD->query($sql))->fetch_assoc();
            $BD->next_result();
            $id = $id['id'];
            $usu_id = $_SESSION['usuario_Id'];
            $sql = "call sp_insertar_relacion_usuarios_eventos($id,$usu_id,1)";
            if($BD->query($sql) === TRUE){
                $BD->next_result();
                $dep_id = $datos['deporte'];
                $sql = "call sp_insertar_relacion_deportes_eventos($id,$dep_id)";
                if($BD->query($sql) === TRUE){
                    return [true];
                } else{
                    array_push($error, 'Hubo un error al intentar crear una relación entre deporte/evento, inténtalo de nuevo!');
                }
            } else{
                array_push($error,'Hubo un error al intentar crear una relación entre usuario/evento, inténtalo de nuevo!');
            }
        } else{
            array_push($error, 'Hubo un error al intentar registrar el evento, inténtalo de nuevo!');
        }

        
        return [false,$error];
    }
    function comprobar_sesion(){
        
        if(!empty($_SESSION['usuario_Id'])){
            return true;
        }
        return false;
    }

    function cerrar_sesion(){
        $_SESSION['usuario_Id'] = '';
        $_SESSION['usuario_Nombre'] = '';
        $_SESSION['usuario_Email'] = '';
        $_SESSION['usuario_Edad'] = '';
    }
?>