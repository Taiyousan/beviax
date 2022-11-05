<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require 'secretxyz123.php';
require 'head.php';

//FONCTION DE CONNEXION A LA BDD
function connexionBD()
{
  $mabd = null;
  try {
    $mabd = new PDO('mysql:host=127.0.0.1; port=3306;
        dbname=beviax;charset=UTF8;', USER, PASSWORD);
    $mabd->query('SET NAMES utf8;');
  } catch (PDOException $e) {
    print "Erreur : " . $e->getMessage() . '<br />';
    die();
  }
  return $mabd;
}

function deconnexionBD(&$mabd)
{
  $mabd = null;
}

function afficherPhotos($mabd)
{
  $req = "SELECT * FROM photos";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }


  $lignes_resultat = $resultat->rowCount();

  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      if ($ligne['photo_img'] != "") {
        echo '<div class = "image"> <img  class="img filter ' . $ligne['photo_categorie'] . '" src = "photos/' . $ligne['photo_img'] . '" loading="lazy"> ';
        echo '<div class = "description"><p class="pepe" id="text-desc">' . $ligne['photo_desc'] . '</p></div></div>';
      }
    }
  } else {
    echo '<p> Rien </p>';
  }
}

function afficherPhotosAdmin($mabd)
{
  $req = "SELECT * FROM photos";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }


  $lignes_resultat = $resultat->rowCount();

  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {


      if ($ligne['photo_landing'] == 1) {
        $format = "OUI";
      } else {
        $format = "NON";
      }

      if ($ligne['photo_img'] != "") {
        echo '<div class="card mb-3" style="max-width: 80vw;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="../photos/' . $ligne['photo_img'] . '" class="img-fluid" alt="...">
            </div>
            <div class="col-md-8 list-admin">
              <div class="card-body ">
              <ul class="list-group list-group-flush">
              <li class="list-group-item">ID : ' . $ligne['photo_id'] . '</li>
              <li class="list-group-item">Date de mise en ligne : ' . $ligne['photo_date'] . '</li>
              <li class="list-group-item">Dernière modification : ' . $ligne['photo_modif'] . '</li>
              <li class="list-group-item">Catégorie : ' . $ligne['photo_categorie'] . '</li>
              <li class="list-group-item">Informations : ' . $ligne['photo_info'] . '</li>
              <li class="list-group-item">Description (affichée au survol) : ' . $ligne['photo_desc'] . '</li>
              <li class="list-group-item">Diffusée aléatoirement sur l\'en-tête de la page d\'accueil : ' . $format . '</li>
            </ul>
              </div>
            </div>
          </div>
          <div class="card-body list-admin-options">
    <a href="update-form.php?num= ' . $ligne['photo_id'] . '" class="card-link">MODIFIER</a>
    <a href="delete.php?num=' . $ligne['photo_id'] . '"" class="card-link">SUPPRIMER</a>
  </div>
        </div>';
      }
    }
  } else {
    echo '<div class="container">
        <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Erreur lors de l\'affichage des images. Demande à Shams ! Code d\'erreur : AFFICHAGEADMIN1.</h5>
    
    <div class="d-grid gap-2">
  <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
  <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
</div>
  </div>
</div>
      </div>';
  }
}


function ajouterBD($mabd, $infos, $nouvelleImage, $date, $desc, $format, $categorie)
{
  $req = 'INSERT INTO photos (photo_info, photo_img, photo_date, photo_modif, photo_desc, photo_landing, photo_categorie, photo_bouton) VALUES ("' . $infos . '", "' . $nouvelleImage . '", "' . $date . '", "", "' . $desc . '", "' . $format . '", "' . $categorie . '", "")';

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    die();
  }
  if ($resultat->rowCount() == 1) {
    echo '<div class="container">
        <div class="card" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Photo ajoutée avec succès !</h5>
    <div class="d-grid gap-2">
  <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
  <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
</div>
  </div>
</div>
      </div>' . "\n";
  } else {
    echo '<p>Erreur lors de l\'ajout.</p>' . "\n";
    die();
  }
}

function effacerBD($mabd, $id)
{
  $req = 'DELETE FROM photos WHERE photo_id = ' . $id . '';
  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    // s'il y a une erreur, on l'affiche
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
  }
  if ($resultat->rowCount() == 1) {
    echo '<div class="container">
        <div class="card" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Photo ' . $id . ' supprimée avec succès !</h5>
    <div class="d-grid gap-2">
  <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
  <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
</div>
  </div>
</div>
      </div>' . "\n";
  } else {
    echo '<div class="container">
        <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Erreur lors de la suppression de l\'image. Demande à Shams !</h5>
    
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

function getBD($mabd, $photo_id)
{
  $req = 'SELECT * FROM photos WHERE photo_id=' . $photo_id;
  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    // s'il y a une erreur, on l'affiche
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
  }
  // la fonction retourne le  tableau associatif 
  // contenant les champs et leurs valeurs
  return $resultat->fetch();
}

function modifierBD(
  $mabd,
  $id,
  $infos,
  $nouvelleImage,
  $date_modif,
  $desc,
  $categorie
) {
  $req = 'UPDATE photos 
                SET 
                photo_info = "' . $infos . '",
    photo_img = "' . $nouvelleImage . '", photo_modif = "' . $date_modif . '", photo_desc = "' . $desc . '", photo_categorie = "' . $categorie . '" WHERE photo_id=' . $id;



  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    // s'il y a une erreur, on l'affiche
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
  }
  if ($resultat->rowCount() == 1) {
    echo '<div class="container">
        <div class="card" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Photo ' . $id . ' modifiée avec succès !</h5>
    <div class="d-grid gap-2">
  <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
  <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
</div>
  </div>
</div>
      </div>' . "\n";
  } else {
    echo '<div class="container">
        <div class="card border border-danger border-3" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Erreur lors de la modification des informations. Demande à Shams ! Code d\'erreur : UPDATE1.</h5>
    
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

function landing($mabd)
{
  $req = "SELECT photo_img FROM photos WHERE photo_landing = 1 ORDER BY RAND() LIMIT 1;";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }

  $lignes_resultat = $resultat->rowCount();


  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      echo '<a href="#boutons-filtrage" class="ancre-bg">
      <div class="bg" style = " background-image: url(photos/' . $ligne["photo_img"] . ')">
          <div id="cursor"></div>
      </div></a>';
    }
  } else {
    echo '<p> Rien </p>';
  }
}

function filtrage($mabd)
{
  $req = "SELECT photo_categorie, photo_bouton FROM photos GROUP BY photo_categorie;";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }

  $lignes_resultat = $resultat->rowCount();


  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      if ($ligne['photo_categorie'] != "0") {
        echo '<button type="button" class="btn nav-link" onclick=" filterSelection(\'' . $ligne['photo_categorie'] . '\')">' . $ligne['photo_bouton'] . '</button>';
      }
    }
  } else {
    echo '<p> Rien </p>';
  }
}
function filtrageListe($mabd)
{
  $req = "SELECT photo_categorie, photo_bouton FROM photos GROUP BY photo_categorie;";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }

  $lignes_resultat = $resultat->rowCount();


  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . $ligne['photo_categorie'] . '">' . $ligne['photo_bouton'] . '</option>';
    }
  } else {
    echo '<p> Rien </p>';
  }
}

function ajouterCategorie(
  $mabd,
  $nom_bouton,
  $nom_bd
) {
  $req = 'INSERT INTO photos (photo_info, photo_img, photo_date, photo_modif, photo_desc, photo_landing, photo_categorie, photo_bouton) VALUES ("", "", "", "", "", "0", "' . $nom_bd . '", "' . $nom_bouton . '")';

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    die();
  }
  if ($resultat->rowCount() == 1) {
    echo '<div class="container">
        <div class="card" style="margin-top : 150px; width: 70vw; margin-right : auto; margin-left : auto;">
  <div class="card-body card-ajout-valide">
    <h5 class="card-title">Catégorie ajoutée avec succès !</h5>
    <p>L\'ajout d\'une catégorie génère la création d\'une image vide. N\'hésitez pas à aller la supprimer.</p>
    <div class="d-grid gap-2">
  <a href="../index.php" class="btn btn-light" type="button">Retour à l\'accueil</a>
  <a href="admin.php" class="btn btn-secondary" type="button">Retour à la gestion des photos</a>
</div>
  </div>
</div>
      </div>' . "\n";
  } else {
    echo '<p>Erreur lors de l\'ajout.</p>' . "\n";
    die();
  }
}

function easterEgg($mabd)
{
  $req = "SELECT easter_img FROM easter ORDER BY RAND() LIMIT 1;";

  try {
    $resultat = $mabd->query($req);
  } catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    die();
    die();
  }

  $lignes_resultat = $resultat->rowCount();


  if ($lignes_resultat > 0) {
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      echo '<img src = "easter/' . $ligne['easter_img'] . '">';
      var_dump($ligne['easter_img']);
    }
  } else {
    echo '<p> Rien </p>';
  }
}
