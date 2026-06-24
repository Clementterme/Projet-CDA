<?php

require_once __DIR__ . "/../Includes/header.php";

// Connexion à la base de données
$bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PWD);

// Récupérer l'id de l'anime depuis l'URL
if (isset($_GET['id'])) {
    $idAnime = intval($_GET['id']);
} else {
    $idAnime = 0;
}


if ($idAnime > 0) {

    // Vérifier si l'anime est déjà dans la liste de l'utilisateur
$estDansListe = false;

if (isset($_SESSION["connecté"])) {
    $requeteListe = $bdd->prepare("
        SELECT *
        FROM enregistre
        WHERE id = :idUtilisateur
        AND id_1 = :idAnime
    ");

    $requeteListe->execute([
        'idUtilisateur' => $_SESSION['id'],
        'idAnime' => $idAnime
    ]);

    $estDansListe = $requeteListe->fetch() !== false;
}

    // Requête pour récupérer les détails de l'anime
    $requete = $bdd->prepare("SELECT * FROM anime WHERE id = :id");
    $requete->execute(['id' => $idAnime]);
    $anime = $requete->fetch();


    // Requête pour récupérer la catégorie de l'anime
    $requete2 = $bdd->prepare("SELECT catégorie.nom FROM catégorie JOIN comporte ON catégorie.id = comporte.id_1 JOIN anime ON anime.id = comporte.id WHERE anime.id = :id;");
    $requete2->execute(['id' => $idAnime]);
    $categorie = $requete2->fetch();

    if ($anime) {
        // Change l'affichage de la date au format JJ-MM-AAAA
        list($annee, $mois, $jour) = explode('-', $anime['date_sortie']);
        $dateSortie = $jour . '-' . $mois . '-' . $annee;
        // Affichage des détails de l'anime
        echo '<h1>' . $anime['nom'] . '</h1>
                <div class="affichageImageAnimeDetail">
                    <img class="imageAnimeDetail" src="' . $anime['image'] . '" alt="Affiche de ' . $anime['nom'] . '">              
                        <div class="affichageSynopsis">
                            <h2>Synopsis :</h2>
                            <p class="synopsis">' . $anime['synopsis'] . '</p>
                            <p class="dateSortie">Date de sortie: ' .  $dateSortie . '</p>
                            <p>Catégorie: ' .  $categorie['nom'] . '</p>';
        if (isset($_SESSION["connecté"])) {
            if (!$estDansListe) { ?>
                    <form method="POST">
                        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter à ma liste</button>
                    </form>

        <?php } else { ?>
                    <form method="POST">
                        <button type="submit" class="btn btn-primary" name="supprimer">Supprimer de ma liste</button>
                    </form> 
        
        <?php }  

        echo '
                        </div>
                </div>';
        }
    } else {

        header('location: ' . HOME_URL . '404.php');
    }
} else {

    header('location: ' . HOME_URL . '404.php');
}

require_once __DIR__ . "/../Includes/footer.php";
