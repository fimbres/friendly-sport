<?php 
    require 'funciones_BD.php';               //VERIFICAR QUE NO ESTEN IMPORTADAS EN EL ARCHIVO PRINCIPAL

    $conexion = crear_conexion_variable();

    /*$consulta = "SELECT * FROM tb_evento";
    $res = mysqli_query($conexion,$consulta);
    $encontrados = mysqli_num_rows($res);
    
    echo "Se encontraron:" . $encontrados;*/
?>

<div class="card">
    <div class=" banner-event text-center">
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Nombre del evento:</span></div><div class="container ins-bg-info rounded-3"><span class="">Retas de basquet</span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Categoria:</span></div><div class="container ins-bg-info rounded-3"><span class="">Basketball</span></div></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="form-icon-wrapper">
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Fecha y hora:</span></div><div class="container"><span class="ins-bg-info py-2 px-1 ms-1 rounded-3">10/05/2022</span><span class="ins-bg-info py-2 ms-1 px-1 rounded-3">15</span>:<span class="ins-bg-info py-2 px-1 ms-1 rounded-3">00</span>:<span class="ins-bg-info py-2 ms-1 px-1 rounded-3">00</span></div></div>
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
                            <div class="container-fluid d-flex justify-content-center"><div class="container"><span class="fw-bold py-2">Usuarios inscritos:</span></div><div class="container ins-bg-info rounded-3"><span class="">10</span></div></div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-center">
                            <a class="d-none text-danger font-weight-bold" id="notificacion">Mensaje</a>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="container-fluid d-flex justify-content-center align-items-center">
                        <img class="rounded-circle p-3" src="assets/static/user_example_image.jpg" width="120px"  height="120px" alt=""/>
                    </div>
                    <div class="container-fluid">
                        <p class="fw-bold fs-6 text-center">Organizado por</p>
                        <p class="text-center"> Ariel</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>