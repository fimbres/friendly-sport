<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendly Sport - Calificanos</title>
    <link rel="icon" type="image/x-icon" href="assets/FS-icono.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="dist/css/styles.css" rel="stylesheet"/>
    <link href="dist/css/calificanos.css" rel="stylesheet"/>
</head>
<body>
    <div id="principal" class="container-fluid d-flex position-relative h-100 align-items-center justify-content-center">
        <div class="card-body mt-5">
            <div class="form-group mt-3">
                <h1 class="text-center">¿Qué calificación nos darías?</h1>
            </div>

            <div class="form-group mt-3 mb-3 d-flex align-items-center justify-content-center">
                <p class="clasificacion fs-1">
                    <input id="radio1" type="radio" name="estrellas" value="5"><!--
                    --><label for="radio1">★</label><!--
                    --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                    --><label for="radio2">★</label><!--
                    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                    --><label for="radio3">★</label><!--
                    --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                    --><label for="radio4">★</label><!--
                    --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                    --><label for="radio5">★</label>
                </p>
            </div>

            <div class="form-group mt-5">
                <h4 class="text-center">¿Tienes comentarios o sugerencias?</h4>
                <h5 class="text-center">escríbelo a continuación</h5>
            </div>

            <div class="form-group mt-3 d-flex align-items-center justify-content-center">
                <div class="custom-form-comments form-floating">
                    <textarea id="autoresizing" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">escribe aquí...</label>
                </div>
            </div>

            <div class="form-group mt-5 d-flex align-items-center justify-content-center">
                <input type="button" class="btn btn-custom-primary pt-2 pb-2 ps-5 pe-5" value="Evaluar"/>
            </div>

        </div>    
    </div>

    <script src="dist/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#autoresizing').on('input', function () {
            this.style.height = 'auto';
              
            this.style.height = 
                    (this.scrollHeight) + 'px';
        });
    </script>
</body>
</html>