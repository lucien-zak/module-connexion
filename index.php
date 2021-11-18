<?php
session_start();
require "./fonctions.php";
deconnexion();
redirect_nonconnecte();
include './header.php';
?>
<body>
    <header>
    <nav>
            <ul id="barnav">
                <span><?php bienvenu() ?></span>
                <?php if (estconnecte()) {?>
                <li><a href="./index.php">Page acceuil</a></li>
                <li><a href="./profil.php">Profil</a></li>
                <?php } ?> <?php if (estconnecte() == false) { ?>
                <li><a href="./connexion.php">Connexion</a></li>
                <li><a href="./inscription.php">Inscription</a></li>
                <?php }?><?php if (estadmin()) {?>
                <li><a href="./admin.php">Admin</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Page Principale</h1>
    </main>
<?php 
include 'footer.php';
?>