<?php 
    function crear_conexion_clase(){
        $BD = new mysqli('baowmnoivuwfypslrhgk-mysql.services.clever-cloud.com','uik8l0gvyto4wyft','OEbaukoiM2VXYQO9dvUy','baowmnoivuwfypslrhgk');
        return $BD;
    }
    function crear_conexion_variable(){
        $BD = mysqli_connect('baowmnoivuwfypslrhgk-mysql.services.clever-cloud.com','uik8l0gvyto4wyft','OEbaukoiM2VXYQO9dvUy','baowmnoivuwfypslrhgk');
        return $BD;
    }

    function crear_conexion(){
        $BD = mysqli_connect('baowmnoivuwfypslrhgk-mysql.services.clever-cloud.com','uik8l0gvyto4wyft','OEbaukoiM2VXYQO9dvUy','baowmnoivuwfypslrhgk');
    }

    function signup_obtener_deportes($BD){
        $deportes = [];
        $deportes['Futbol soccer'] = ($BD->query("call sp_buscar_deporte_n('Futbol soccer');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Futbol americano'] = ($BD->query("call sp_buscar_deporte_n('Futbol americano');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Baloncesto'] = ($BD->query("call sp_buscar_deporte_n('Baloncesto');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Tenis'] = ($BD->query("call sp_buscar_deporte_n('Tenis');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Beisbol'] = ($BD->query("call sp_buscar_deporte_n('Beisbol');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Petanca'] = ($BD->query("call sp_buscar_deporte_n('Petanca');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Voleibol'] = ($BD->query("call sp_buscar_deporte_n('Voleibol');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Ciclismo'] = ($BD->query("call sp_buscar_deporte_n('Ciclismo');"))->fetch_assoc();
        $BD->next_result();
        $deportes['Senderismo'] = ($BD->query("call sp_buscar_deporte_n('Senderismo');"))->fetch_assoc();
        $BD->next_result();
        return $deportes;
    }
?>