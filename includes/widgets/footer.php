<div class="container px-5">
    <div class="text-white-50 small">
        <p>© FriendlySport, 2022. Todos los derechos reservados.</p>
        <p>Tel: 1234567890 | Email: ayuda@metafusions.com</p>
        <a href="#!">Privacidad</a>
        <span class="mx-1">&middot;</span>
        <a href="#!">Terminos</a>
        <span class="mx-1">&middot;</span>
        <a href="#!">Condiciones</a>

        <?php
            if(isset($_SESSION['usuario_Id'])){
                echo '<span class="mx-1">&middot;</span>
                      <a href="calificanos.php">Calificanos</a>';
            }
            else{

            }
        ?>
    </div>
</div>