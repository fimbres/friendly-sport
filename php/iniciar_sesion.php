<?php
    $correo = $_POST['email'];
    $password = $_POST['password'];

    $caracteres_especiales = array("'",'"',"+","-","?","¿","[","]","{","}"," ");
    $correo_validado = str_replace($caracteres_especiales,"",$correo);
    $password_validado = str_replace($caracteres_especiales,"",$password);
   
    if(!empty($correo_validado) && !empty($password_validado))
    {
        include '../includes/funciones_BD.php';

        $conexion = crear_conexion_variable();

        $sql = "SELECT * FROM tb_usuario WHERE email = '".$correo_validado."' AND contrasena = '".$password_validado."' ";
        $res = mysqli_query($conexion,$sql);
        $row = mysqli_num_rows($res);
   
        if($row > 0){
            session_start();
            $info = mysqli_fetch_array($res);
           
            $_SESSION['usuario_Id'] = $info['id_usuario'];
            $_SESSION['usuario_Nombre'] = $info['nombre_usuario'];
            $_SESSION['usuario_Email'] = $info['email'];
            $_SESSION['usuario_Edad'] = $info['edad'];
     
            $response = array("response" => "Success");
        
        }else{
   
                $response = array("response" => "Invalid","message" => "Invalid Password");
        }

        echo json_encode($response);
    }
    
?>