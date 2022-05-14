<?php 
    //require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $conexion = crear_conexion_variable();

    $consulta = "SELECT * FROM tb_evento WHERE id_evento='1'";
    $res = mysqli_query($conexion,$consulta);
    //$encontrados = mysqli_num_rows($res);
    

    if($res){
        $info_evento = mysqli_fetch_array($res);
        
        $id_evento = $info_evento['id_evento'];
        //INTENTANDO RELACIONAR TABLAS CON INNERJOIN, LEFT JOIN, RIGHT JOIN
        $consultar_categoria = "SELECT id_deporte FROM tb_relacion_deportes_eventos WHERE id_evento=".$id_evento."";
        $resp = mysqli_query($conexion,$consultar_categoria);
        if($resp)
        {
            $info_categoria = mysqli_fetch_array($resp);
            $id_rel_d_cat = $info_categoria['id_deporte'];
            
            $consultar_nombre = "SELECT nombre FROM deporte WHERE id_deporte=".$id_rel_d_cat."";
            $rel_cons = mysqli_query($conexion,$consultar_nombre);

            if($rel_cons)
            {
                $nombre_cat = mysqli_fetch_array($rel_cons);
                $nombre_categoria = $nombre_cat['nombre'];
                echo '<script>alert('.$nombre_categoria.');</script>';
            }

            echo '<script>alert('.$id_rel_d_cat.');</script>';
        }
        else
        {
            echo '<script>alert("NO SE PUDO BRO");</script>';
        }
    }
    else
    {
        echo '<script>alert("No se encontro nada");</script>';
    }
    

    //echo "Se encontraron:" . $encontrados;*/
?>

<div class="card">
    <div class=" banner-event text-center">
        <img class="img-banner" src="assets/static/soccer.jpg" alt="">
    </div>
    <div class="card-body">
            <div class="row scroll">
                <div class="col-md-9 col-lg-9 col-xl-9 col-xs-12 col-sm-12">
                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Nombre del evento:</span></div><div class="container ins-bg-info rounded-3"><span class=""><?php echo $info_evento['nombre'];?></span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Categoria:</span></div><div class="container ins-bg-info rounded-3"><span class=""><?echo $info_categoria['nombre']?></span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center align-items-center"><div class="container"><span class="fw-bold py-2">Fecha y hora:</span></div><div class="container"><span class="ins-bg-info py-2 px-1 ms-1 rounded-3">10/05/2022</span><span class="ins-bg-info py-2 ms-1 px-1 rounded-3">15</span>:<span class="ins-bg-info py-2 px-1 ms-1 rounded-3">00</span>:<span class="ins-bg-info py-2 ms-1 px-1 rounded-3">00</span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Lugar del evento:</span></div><div class="container ins-bg-info rounded-3"><span class="">Playa hermosa</span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Participantes:</span></div><div class="container ins-bg-info rounded-3"><span class="">1. Ariel</span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Usuarios inscritos:</span></div></div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-center">
                            <a class="d-none text-danger font-weight-bold" id="notificacion">Mensaje</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xs-12 col-lg-3 col-xl-3 col-sm-12">
                    <div class="container-fluid d-flex justify-content-center align-items-center">
                        <img class="rounded-circle p-2" src="assets/static/user_example_image.jpg" width="120px"  height="120px" alt=""/>
                    </div>
                    <div class="container-fluid">
                        <p class="fw-bold fs-6 text-center">Organizado por</p>
                        <p class="text-center"> Ariel</p>
                    </div>
                    <div class="container-fluid mt-4">
                        <input class="btn btn-custom-primary m-1 text-light w-100" type="button" value="Inscribirte"/>
                        <input id="btnCloseEvent" class="btn btn-danger m-1 w-100" type="button" value="Salir"/>
                    </div>
                </div>
            </div>
    </div>
</div>