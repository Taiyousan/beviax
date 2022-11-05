<?php
require '../lib.inc.php';
require 'header.php';
?>


<div class="container-admin">
  <div class="tableau-admin">
    <?php

    $testimg = $_FILES["image"];




    $id = $_POST['num'];
    $date = $_POST['date'];
    $infos = trim($_POST['infos']);
    $date_modif = date("d.m.Y");
    $desc = $_POST['desc'];
    $categorie = $_POST['categorie'];


    if (strlen($_FILES["image"]["name"]) == 0) {
      $co = connexionBD();
      $ancienneImage = getBD($co, $id);
      $nouvelleImage = $ancienneImage['photo_img'];
    } else {
      $imageType = $_FILES["image"]["type"];
      if (($imageType != "image/png") &&
        ($imageType != "image/jpg") &&
        ($imageType != "image/jpeg") &&
        ($imageType != "image/JPG") &&
        ($imageType != "image/PNG") &&
        ($imageType != "image/JPEG")
      ) {
        echo '<div class="container">
                <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
          <div class="card-body card-ajout-valide">
            <h5 class="card-title">La sauvegarde de l\'image a échoué. Veuillez vous assurer d\'avoir choisi une image au format jpg, jpeg ou png. </h5>
            <div class="d-grid gap-2">
          <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
          <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
        </div>
          </div>
        </div>
              </div>' . "\n";
        die();
      }

      $nouvelleImage = str_replace(' ', '', $_FILES["image"]["name"]);



      if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
        if (!move_uploaded_file(
          $_FILES["image"]["tmp_name"],
          "../photos/" . $nouvelleImage
        )) {
          echo '<div class="container">
                    <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
              <div class="card-body card-ajout-valide">
                <h5 class="card-title">Erreur lors de la sauvegarde de l\'image. Demande à Shams ! Code d\'erreur : UPDATE2.</h5>
                
                <div class="d-grid gap-2">
              <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
              <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
            </div>
              </div>
            </div>
                  </div>' . "\n";
          die();
        }
      } else {
        echo '<div class="container">
                <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
          <div class="card-body card-ajout-valide">
            <h5 class="card-title">Erreur lors de la sauvegarde de l\'image. Demande à Shams ! Code d\'erreur : UPDATE3.</h5>
            
            <div class="d-grid gap-2">
          <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
          <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
        </div>
          </div>
        </div>
              </div>' . "\n";
        die();
      }
    }

    $co = connexionBD();
    modifierBD(
      $co,
      $id,
      $infos,
      $nouvelleImage,
      $date_modif,
      $desc,
      $categorie
    );
    deconnexionBD($co);
    ?>
  </div>
</div>
<?php

require 'footer.php';
