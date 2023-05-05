<section class="section">
    <div class="container"> 
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <hp class="title">Message Board</p>

            </div>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                <a class="navbar-item" href="index.php">Liste des salons</a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <p><?= $_SESSION['username']?></p>
                    </div>
                    <div class="navbar-item">
                        <button class="button is-primary" id="login-trigger">Se connecter</button>
                    </div>
                </div>
            </div>
        </nav>
