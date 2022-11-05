<?php
require '../lib.inc.php';
require 'header.php';
?>


<?php

$id = $_GET['num'];
$co = connexionBD();
$photo = getBD($co, $id);
deconnexionBD($co);
?>



<div class="container">

    <h1>MODIFIER UNE PHOTO</h1>
    <form action="update-valide.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID : </label>
            <input type="text" name="num" value="<?= $id; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required readonly>
            <div id="emailHelp" class="form-text">Le numéro identifiant la photo dans la base de donnée. Il n'est pas modifiable.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Date de mise en ligne : </label>
            <input type="text" name="date" value="<?= $photo['photo_date']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required readonly>
            <div id="emailHelp" class="form-text">La date à laquelle cette photo a été ajoutée au site.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Date de dernière modification : </label>
            <input type="text" name="modif" value="<?= $photo['photo_modif']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required readonly>
            <div id="emailHelp" class="form-text">La date à laquelle cette photo a été modifée pour la dernière fois.</div>
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
            <div id="emailHelp" class="form-text">Vous pouvez modifier ici la <strong>catégorie</strong> de l'image, pour la fonction d'affichage filtré de la galerie principale.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Informations : </label>
            <textarea type="text" name="infos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><?= $photo['photo_info']; ?></textarea>
            <div id="emailHelp" class="form-text">Vous pouvez modifier/ajouter ici une description ou des informations diverses. Elles ne seront pas visibles par les visiteur·euses du site.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description : </label>
            <textarea type="text" name="desc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><?= $photo['photo_info']; ?></textarea>
            <div id="emailHelp" class="form-text">Vous pouvez modifier/ajouter ici une description qui sera visible par les visiteur·euses du site lorsqu'iels survoleront la photo avec leur souris.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Photo actuelle : </label> <br>
            <img src="../photos/<?= $photo['photo_img']; ?>" class="update-image" name="ancienneImage">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nouvelle photo : </label>
            <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Vous pouvez remplacer la photo actuelle par une autre si vous le souhaitez, aux formats suivants : .jpg, .png, .JPEG</div>
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
