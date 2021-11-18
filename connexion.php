<?php
session_start();
require "./fonctions.php";
redirect_estconnecte();
deconnexion();
?>
<?php 
require("header.php");
?>
<body>
    <header>
        <nav>
            <ul id="barnav">
                <span><?php bienvenu() ?></span>
                <?php if (estconnecte()) { ?>
                    <li><a href="./index.php">Page acceuil</a></li>
                    <li><a href="./profil.php">Profil</a></li>
                <?php } ?> <?php if (estconnecte() == false) { ?>
                    <li><a href="./connexion.php">Connexion</a></li>
                    <li><a href="./inscription.php">Inscription</a></li>
                    <?php } ?><?php if (estadmin()) { ?>
                    <li><a href="./admin.php">Admin</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
        <div id="blcconnexion">
            <h1>Connectez-vous !</h1>
            <form action="" method="post">
                <input placeholder="Login"type="text" name="username" id="username">
                <input placeholder="Password" type="password" name="password" id="password">
                <input id="btnsubmit" type="submit" value="Se connecter">
                <?php verif_connexion() ?>
            </form>
        </div>
    </main>
<?php require './footer.php'; ?>