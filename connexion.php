<?php
session_start();
require "./fonctions.php";
deconnexion();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="./CSS/styles.css">
    <title>Inscription</title>
</head>

<body>
    <header>
        <nav>
            <ul id="barnav">
                <span><?php bienvenu() ?></span>
                <?php if (estconnecte()) {?>
                <li><a href="./index.php">Page acceuil</a></li>
                <li><a href="./profil.php">Profil</a></li>
                <li><a href="./admin.php">Admin</a></li>
                <?php } ?> <?php if (estconnecte() == false) { ?>
                <li><a href="./connexion.php">Connexion</a></li>
                <li><a href="./inscription.php">Inscription</a></li>
                <?php }?>
            </ul>
        </nav>
    </header>
    <main>
        <div id="blcconnexion">
            <h1>Veuillez entrer vos identifiants</h1>
            <form action="" method="post">
                <h2> Nom d'utilisateur </h2>
                <input type="text" name="username" id="username">
                <h2> Mot de passe </h2>
                <input type="password" name="password" id="password">
                <input id="btnsubmit" type="submit" value="Se connecter">
                <?php verif_connexion() ?>
            </form>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>




