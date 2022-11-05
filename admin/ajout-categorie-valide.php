<?php
require '../lib.inc.php';
require 'header.php';
?>





<div class="container-admin">
    <div class="tableau-admin">
        <?php


        $nom_bouton = $_POST['nom_bouton'];
        $nom_bd = $_POST['nom_bd'];

        $co = connexionBD();
        ajouterCategorie(
            $co,
            $nom_bouton,
            $nom_bd
        );
        deconnexionBD($co);
        ?>
    </div>
</div>

<?php
require 'footer.php';
