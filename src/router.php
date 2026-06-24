<?php

// require_once __DIR__.'/Repositories/UsersRepository.php';
require_once __DIR__ . '/Controllers/HomeController.php';
require_once __DIR__ . '/Controllers/ConnexionController.php';
require_once __DIR__ . '/Controllers/BibliothequeController.php';
require_once __DIR__ . '/Controllers/DetailsController.php';

$methode = $_SERVER['REQUEST_METHOD'];

$homeController = new HomeController();
$connexionController = new ConnexionController();
$bibliothequeController = new BibliothequeController();
$detailsController = new DetailsController();
// $simplonController = new SimplonController();

$uri = $_SERVER['REQUEST_URI'];

// Extraire le chemin et les paramètres de l'URL
$parsedUri = parse_url($uri, PHP_URL_PATH);

// Vérifier si l'URI contient le mot "details" suivi d'un paramètre id
if (strpos($parsedUri, HOME_URL . "details") !== false) {
    if ($methode == 'GET') {
        // Extraire l'id depuis l'URL
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
        } else {
            $id = null;
        }
        
        if ($id) {
            $detailsController->homepage();
        } else {
            $homeController->pageNotFound();
        }

    } else if ($methode == 'POST') {
        if (isset($_POST["ajouter"])) {
            $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PWD);

            $ajouterAnime = $bdd->prepare("INSERT INTO `enregistre` (`id`, `id_1`) VALUES(?, ?)");
            $ajouterAnime->execute(array($_SESSION['id'], $_GET['id']));

            header("location: " . HOME_URL . "liste");
        } else if (isset($_POST["supprimer"])) {
            $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;", DB_USER, DB_PWD);

            $supprimerAnime = $bdd->prepare("DELETE FROM enregistre
        WHERE id = :idUtilisateur
        AND id_1 = :idAnime");
            $supprimerAnime->execute([
        'idUtilisateur' => $_SESSION['id'],
        'idAnime' => $_GET['id']
    ]);

            header("location: " . HOME_URL . "liste");
        }
    }
} else {
    switch ($parsedUri) {
        case HOME_URL . "":
            $homeController->homepage();
            break;
        case HOME_URL . "connexion":
            if ($methode == 'GET') {
                if (!isset($_SESSION['connecté'])) {
                    $connexionController->homepage();
                } else {
                    $homeController->pageNotFound();
                }
            } else if ($methode == 'POST') {
                $connexionController->connexion();
            }
            break;
        case HOME_URL . "inscription":
            if ($methode == 'GET') {
                if (!isset($_SESSION['connecté'])) {
                    $connexionController->homepageInscription();
                } else {
                    $homeController->pageNotFound();
                }
            } else if ($methode == 'POST') {
                $connexionController->inscription();
            }
            break;
        case HOME_URL . "bibliotheque":
            $bibliothequeController->homepage();
            break;
        case HOME_URL . "liste":
            if (isset($_SESSION['connecté'])) {
                $bibliothequeController->afficherListe();
            } else {
                $homeController->pageNotFound();
            }
            break;
            // case HOME_URL . "details":
            //     if ($methode == 'POST') {
            //         $detailsController->ajouterListe();
            //     } else {
            //         $homeController->pageNotFound();
            //     }
            break;
        case HOME_URL . 'deconnexion':
            $homeController->quit();
            break;
        default:
            $homeController->pageNotFound();
            break;
    }
}
