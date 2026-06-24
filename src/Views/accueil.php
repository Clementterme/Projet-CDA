<?php

require_once __DIR__ . "/../Includes/header.php";

?>

<div class="accueil">
    <h1>Bienvenue sur TrouvAnime !</h1>

    <p>Tu ne trouves pas d’anime à regarder ? Ce site est fait pour toi !</p>

    <p>Sur TrouvAnime, tu trouveras ce que tu cherches en consultant notre bibliothèque d’animes !</p>

    <p>Tu peux aussi créer un compte pour pouvoir ajouter un anime à ta propre liste d’animes à regarder</p>
</div>

<div class="boutons-accueil">
    <?php if (!isset($_SESSION['connecté'])) { ?>
    <button>
        <a href="/connexion">Se connecter</a>
    </button>
    <button>
        <a href="/inscription">Créer un compte</a>
    </button>
    <?php } ?>
    <button>
        <a href="/bibliotheque">Voir la bibliothèque</a>
    </button>
</div>

<?php

require_once __DIR__ . "/../Includes/footer.php";
