<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'functions.php';

// Vérification et création du salon
if (isset($_POST['create_salon'])) {
    $salon_name = $_POST['salon_name'];
    if (validate_salon_name($salon_name)) {
        create_salon($salon_name);
    }
}

// Vérification et connexion de l'utilisateur
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    if (validate_username($username)) {
        $_SESSION['username'] = $username;
    }
}
if (isset($_POST['delete_all_salons'])) {
    delete_all_salons();
}

$salons = get_salons();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Message Board</title>
        <script src="main.js" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    </head>
    <body>

        <?php include "header.php"?>
                <h2 class="subtitle">Liste des salons: </h2>
                <div class="columns is-multiline">
                    <?php if (count($salons) > 0) : ?>
                        <?php foreach ($salons as $salon) : ?>
                            <div class="column is-one-quarter">
                                <div class="box">
                                    <a href="salon.php?salon=<?= urlencode($salon) ?>"><?= htmlspecialchars($salon) ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="column">
                            <p class="notification is-warning">Il n'y a pas encore de salon. Vous pouvez en ajouter en cliquant sur le bouton "Nouveau salon".</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="columns">
                    <div class="column is-one-quarter">
                        <button class="button is-info" id="create-salon-trigger">Nouveau salon</button>
                    </div>
                    <div class="column is-one-quarter">
                        <form action="index.php" method="post">
                            <button class="button is-danger" type="submit" name="delete_all_salons">Supprimer tous les salons</button>
                        </form>            
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal ajout de salon -->
        <div class="modal" id="create-salon-modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Créer un nouveau salon</p>
                    <button class="delete" id="create-salon-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form action="index.php" method="post" onsubmit="return validateCreateSalonForm();" id="create-salon-form">
                        <label for="salon_name">Nom du salon :</label>
                        <input type="text" id="salon_name" name="salon_name" required>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" type="submit" form="create-salon-form" name="create_salon">Créer</button>
                    <button class="button" id="create-salon-cancel">Annuler</button>
                </footer>
            </div>
        </div>
        <!-- Modal connexion -->
        <div class="modal" id="login-modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Connexion</p>
                    <button class="delete" id="login-close" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form action="index.php" method="post" onsubmit="return validateLoginForm();" id="login-form">
                        <label for="username">Nom d'utilisateur :</label>
                        <input type="text" id="username" name="username" required>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" type="submit" form="login-form" name="login">Se connecter</button>
                    <button class="button" id="login-cancel">Annuler</button>
                </footer>
            </div>
        </div>
           
    </body>
</html>
