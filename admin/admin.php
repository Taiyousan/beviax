<?php
require '../lib.inc.php';
require 'header.php';
?>

<div class="container">
    <a href="ajout-form.php" class="btn">AJOUTER UNE PHOTO A LA GALERIE</a>
    <br>
    <a href="ajout-categorie-form.php" class="btn">AJOUTER UNE CATEGORIE POUR LE FILTRAGE DE LA GALERIE</a>
    <h1> PHOTOS </h1>

    <div class="image-container-admin">
        <?php
        $co = connexionBD();
        afficherPhotosAdmin($co);
        deconnexionBD($co);
        ?>
    </div>
</div>

<?php

require 'footer.php';
