<?php 
    function signup_verificar_datos($post){
        $errores = [];

        //Ya por el propio html, lo que es el nombre, correo
        // direccion, contraseña, genero y edad estan verificados

        //En esta funcion verificaremos que las dos contraseñas dadas coincidan
        // y que tan siquiera 1 de check haya sido marcado
        if(strcmp($post['contra'],$post['contra_rep']) != 0){
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
        if(isset($post['Futbol soccer']))
            array_push($inputs,$post['Futbol soccer']);
        if(isset($post['Futbol americano']))
            array_push($inputs,$post['Futbol americano']);
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
            if(isset($inputs)){
                return true;
            } else{
                return false;
            }
        }
        return $inputs;
    }
    function signup_insertar_datos($datos,$BD){

        //AQUI SE INSERTARAN LOS DATOS
    }

    function limpiar_string($str , $BD){
        $data = trim($str);
        $data = $BD->real_escape_string($str);
        return $data;
    }
?>