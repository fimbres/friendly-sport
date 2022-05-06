<?php 

    function crear_base_html($mensaje){
        $res = "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <link rel='stylesheet' href='https://sports.cleverapps.io/css/styles.css'>
            <link rel='stylesheet' href='https://sports.cleverapps.io/css/signup.css'>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Adamina&display=swap' rel='stylesheet'>
        </head>
        
        <body class='bg-light'>
            <div id='layoutAuthentication'>
                <div id='layoutAuthentication_content'>
                    <main>
                        <div class='container'>
                            <div class='row justify-content-center'>
                                <div class='overlay'>
                                    <!-- LOGN IN FORM by Omar Dsoky -->
                                    <div class='carta-blanca'>
                                        <header class='head-form'>
                                            <img src='assets/static/LogoFS-sin-fondo.png' class='img-fluid' style='max-width: 20%; padding-bottom: 30px'>
                                            <h2>Correo enviado</h2>
                                        </header>
                                        <div class='row text-center'>
                                        " . $mensaje."
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <script src='https://use.fontawesome.com/releases/v6.1.0/js/all.js' crossorigin='anonymous'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' crossorigin='anonymous'></script>
        
        </body>
        
        </html>";
        return $res;
    }


?>