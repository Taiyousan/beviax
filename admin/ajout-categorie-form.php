<?php
require '../lib.inc.php';
require 'header.php';

?>

<div class="container" style="margin-top: 60px;">

    <h1>AJOUTER UNE CATEGORIE</h1>
    <form action="ajout-categorie-valide.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom de la catégorie : </label>
            <input type="text" name="nom_bouton" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">C'est le nom qui sera affiché sur les boutons de filtrage. <strong>Exemple : Saint-Cyr</strong></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom de la catégorie pour la base de données : </label>
            <textarea type="text" name="nom_bd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required></textarea>
            <div id="emailHelp" class="form-text">C'est le nom qui sera donné aux catégories dans la base de données. Pas de majuscule, pas de caractères spéciaux, pas d'accents, et remplacez les espaces par des "_". Le modèle à suivre est le suivant : <strong>2021_saint-cyr</strong>.</div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Êtes-vous sûr·e de continuer ? Cochez pour confirmer.</label>
        </div>
        <?php
        $co = connexionBD();
        deconnexionBD($co);
        ?>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>



<?php

require 'footer.php';
