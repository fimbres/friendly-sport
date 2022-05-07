<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Filtro eliminar caracteres introducidos
    $caracteres_especiales = array("'",'"',"+","-","?","¿","[","]","{","}"," ");
    $username_validado = str_replace($caracteres_especiales,"",$username);
    $password_validado = str_replace($caracteres_especiales,"",$password);

    //Verificar que los campos no esten vacios
    if(!empty($username_validado) && !empty($password_validado))
    {
        include '../includes/funciones_BD.php';

        $tamano_username = strlen($username_validado);
        $tamano_pass = strlen($password_validado);

        //Verificacion del tamaño de los datos introducidos
        if($tamano_username <= 15 && $tamano_pass <=  15)
        {

            //Buscar usuario
            $conexion = crear_conexion_variable();
            $sql = "SELECT * FROM tb_usuario WHERE nombre_usuario = '".$username_validado."' AND contrasena = '".$password_validado."' ";
            $res = mysqli_query($conexion,$sql);
            $row = mysqli_num_rows($res);
    
            //Usuario encontrado
            if($row > 0){
                session_start();
                $info = mysqli_fetch_array($res);
            
                $_SESSION['usuario_Id'] = $info['id_usuario'];
                $_SESSION['usuario_Nombre'] = $info['nombre_usuario'];
                $_SESSION['usuario_Email'] = $info['email'];
                $_SESSION['usuario_Edad'] = $info['edad'];
        
                $response = array("response" => "Success");
            }
            else//Usuario no encontrado
            {
                $response = array("response" => "Invalid","message" => "Usuario o Contraseña invalida");
            }
        }
        else//Tamaño maximo de caracteres superado
        {
            $response = array("response" => "Invalid","message" => "Excediste los caracteres permitidos");
        }

        echo json_encode($response);
    }
    
?>