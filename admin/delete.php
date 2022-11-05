<?php
require '../lib.inc.php';
require 'header.php';
?>

<head>
    <title>TABLE 1 - Suppression</title>
</head>

<body style="font-family:sans-serif;">
    <section class="index-admin">


        <div class="container-admin">
            <div class="tableau-admin">
                <?php

                $id = $_GET['num'];

                $co = connexionBD();
                effacerBD($co, $id);
                deconnexionBD($co);
                ?>

                <a href="admin.php">Retour au tableau de gestion</a>
            </div>
        </div>
    </section>
</body>

</html>

<?php
require 'footer.php';
