<?php
    $correo = $_POST['email'];
    $password = $_POST['password'];

    $caracteres_especiales = array("'",'"',"+","-","?","¿","[","]","{","}"," ");
    $correo_validado = str_replace($caracteres_especiales,"",$correo);
    $password_validado = str_replace($caracteres_especiales,"",$password);
   
    if(!empty($correo_validado) && !empty($password_validado))
    {
        include 'conexion.php';

        $sql = "SELECT * FROM tb_usuario WHERE email = '".$correo_validado."' AND contrasena = '".$password_validado."' ";
        $res = mysqli_query($conexion,$sql);
        $row = mysqli_num_rows($res);
   
        if($row > 0){
            session_start();

            $_SESSION['user'] = array(
                'usuario_Id' => $row['id_usuario'],
                'usuario_Nombre' => $row['nombre_usuario'],
                'usuario_Email' => $row['email'],
                'usuario_Edad' => $row['edad'],
            );
                /*$_SESSION['user'] = array(
                                        'userLevel' => $row['userType'],
                                      'fullname' => $row['userName'],
                                      'IsLoggeD' => true 
                                        );*/
     
            $response = array("response" => "Success");
        
        }else{
   
                $response = array("response" => "Invalid","message" => "Invalid Password");
        }

        echo json_encode($response);
    }
    
?>