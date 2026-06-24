<?php

require_once __DIR__ . "/../Includes/header.php";

?>

<h1>Ma liste</h1>

        <div class="cartesAnimes">

            <?php
            // Afficher les animes existants
            $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PWD);

            $requete = $bdd->prepare("SELECT anime.id AS anime_id, anime.nom, anime.image 
            FROM anime 
            JOIN enregistre 
            ON anime.id = enregistre.id_1 
            JOIN utilisateur 
            ON utilisateur.id = enregistre.id 
            WHERE utilisateur.id = :id");
            $requete->execute(['id' => $_SESSION['id']]);
            
            while ($ligne = $requete->fetch()) {
                echo '
                <a href="details?id=' . $ligne['anime_id'] . '">
                <div class="carteAnime">
                    <img class="imageAnime" src=' . $ligne['image'] . '>
                    <p class="nomAnime">' . $ligne['nom'] . '</p>
                </div>
                </a>';
                
            } ?>

        </div>

<?php

require_once __DIR__ . "/../Includes/footer.php";