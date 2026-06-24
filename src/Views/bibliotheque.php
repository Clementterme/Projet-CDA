<?php

require_once __DIR__ . "/../Includes/header.php";

?>

<h1>Trouve l'anime de tes rêves !</h1>

        <div class="cartesAnimes">

            <?php
            // Afficher les animes existants
            $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PWD);

            $requete = "SELECT * FROM anime;";
            $resultat = $bdd->query($requete);
            while ($ligne = $resultat->fetch()) {
                echo '
                <a href="details?id=' . $ligne['id'] . '">
                <div class="carteAnime">
                    <img class="imageAnime" src=' . $ligne['image'] . '>
                    <p class="nomAnime">' . $ligne['nom'] . '</p>
                </div>
                </a>';
                
            } ?>

        </div>

<?php

require_once __DIR__ . "/../Includes/footer.php";