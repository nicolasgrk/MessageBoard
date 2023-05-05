<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'functions.php';

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$salon_name = $_GET['salon'] ?? '';

if (!$salon_name || !validate_salon_name($salon_name)) {
    header('Location: index.php');
    exit();
}

// Vérification et envoi du message
$post_error = false;
if (isset($_POST['post_message'])) {
    $content = $_POST['content'];
    if (validate_message_content($content) && isset($_SESSION['username'])) {
        $success = post_message($salon_name, $_SESSION['username'], $content);
        if (!$success) {
            $post_error = true;
        }
    }
}

$messages = get_messages($salon_name);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Salon <?= htmlspecialchars($salon_name) ?></title>
        <script src="main.js" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    </head>
    <body>
        <?php include "header.php"?>
                <h1 class="title"> <?= htmlspecialchars($salon_name) ?></h1>
                <h2 class="subtitle">Messages</h2>
                <?php foreach ($messages as $message) : ?>
                    <article class="message is-link">
                        <div class="message-header">
                            <p><?= htmlspecialchars($message['username']) ?></p>
                        </div>
                        <div class="message-body">
                            <p><?= htmlspecialchars($message['content']) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
                <button id="post-message-trigger" class="button is-info">Envoyer un message</button>
            </div>
        </section>

        <!-- Modal pour ajouter un message -->
        <div id="post-message-modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Envoyer un message</p>
                    <button id="post-message-close" class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <form action="salon.php?salon=<?= urlencode($salon_name) ?>" method="post" onsubmit="return validatePostMessageForm();" id="post-message">
                        <div id="message-error" class="notification is-danger" style="display:none;"></div>
                        <?php if ($post_error) : ?>
                            <div class="notification is-danger">Vous ne pouvez pas poster deux messages consécutifs en moins de 24 heures.</div>
                        <?php endif; ?>
                        <label for="content">Message :</label>
                        <input type="text" id="content" name="content" required>
                    </form>
                    
                </section>
                <footer class="modal-card-foot">
                <button type="submit" class="button is-success" form="post-message" name="post_message">Envoyer</button>
                    <button id="post-message-cancel" class="button">Annuler</button>
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                setupLoginModal();
            });
            function setupLoginModal() {
                const loginTrigger = document.getElementById('login-trigger');
                const loginModal = document.getElementById('login-modal');
                const loginClose = document.getElementById('login-close');
                const loginCancel = document.getElementById('login-cancel');

                loginTrigger.addEventListener('click', function () {
                    loginModal.classList.add('is-active');
                });

                loginClose.addEventListener('click', function () {
                    loginModal.classList.remove('is-active');
                });

                loginCancel.addEventListener('click', function () {
                    loginModal.classList.remove('is-active');
                });
            }
        </script>
    </body>
</html>
