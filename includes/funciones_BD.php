<?php 
    function crear_conexion_clase(){
        $BD = new mysqli('baowmnoivuwfypslrhgk-mysql.services.clever-cloud.com','uik8l0gvyto4wyft','OEbaukoiM2VXYQO9dvUy','baowmnoivuwfypslrhgk');
        return $BD;
    }
    function crear_conexion_variable(){
        $BD = mysqli_connect('baowmnoivuwfypslrhgk-mysql.services.clever-cloud.com','uik8l0gvyto4wyft','OEbaukoiM2VXYQO9dvUy','baowmnoivuwfypslrhgk');
        return $BD;
    }
?>