<?php
require '../lib.inc.php';
require 'header.php';

?>

<div class="container" style="margin-top: 60px;">

    <h1>AJOUTER UNE PHOTO</h1>
    <form action="ajout-valide.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Photo : </label>
            <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">Ajoutez un fichier aux formats suivants : .jpg / .png / .JPEG</div>
        </div>
        <div class="mb-3">
            <select name="format" class="form-select" aria-label="Default select example" required>
                <option value="0">FORMAT</option>
                <option value="0">Portrait (l'image ne sera pas ajoutée à la sélection aléatoire de l'accueil.)</option>
                <option value="1">Paysage (l'image sera ajoutée à la sélection aléatoire de l'accueil.)</option>
                <option value="2">Paysage (l'image ne sera pas ajoutée à la sélection aléatoire de l'accueil.)</option>
            </select>
            <div id="emailHelp" class="form-text">Veuillez indiquer ici si la photo choisie est en format portrait ou paysage. Les photos au format paysage seront ajoutées à la sélection aléatoire de l'en-tête de la page d'accueil du site.</div>
        </div>
        <div class="mb-3">
            <select name="categorie" class="form-select" aria-label="Default select example">
                <option value="0">CATEGORIE</option>
                <?php
                $co = connexionBD();
                filtrageListe($co);
                deconnexionBD($co);
                ?>
            </select>
            <div id="emailHelp" class="form-text">Vous pouvez sélectionner ici une <strong>catégorie</strong>, pour la fonction d'affichage filtré de la galerie principale. Si vous souhaitez ajouter une nouvelle catégorie au filtrage, contactez Shams ! </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Informations : </label>
            <textarea type="file" name="infos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
            <div id="emailHelp" class="form-text">Vous pouvez ajouter ici une description ou des informations diverses. Elles ne seront pas visibles par les visiteur·euses du site.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description : </label>
            <textarea type="file" name="desc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
            <div id="emailHelp" class="form-text">Vous pouvez ajouter ici une description qui sera visible par les visiteur·euses du site lorsqu'iels survoleront la photo avec leur souris.</div>
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
