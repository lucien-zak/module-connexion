<?php
session_start();
require "./fonctions.php";
deconnexion();
redirect_nonconnecte();
$db = mysqli_connect("localhost", "root", "root", "module-connexion");
$req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE id="' . $_SESSION['modifutilid'] . '"');
$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
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
            <h1>Modifier votre profil</h1>
            <h3><?php modifierprofiladmin() ?></h3>
            <form action="" method="post">
                <h2>Nom d'utilisateur</h2>
                <input type="text" name="login" id="login" value='<?php echo $res[0]['login'] ?>'>
                <h2>Nom</h2>
                <input type="text" name="nom" id="nom" value='<?php echo $res[0]['nom'] ?>'>
                <h2>Prénom</h2>
                <input type="text" name="prenom" id="prenom" value='<?php echo $res[0]['prenom'] ?>'>
                <input placeholder="Mot de passe" type="password" name="password1" id="password1">
                <input type="password" placeholder="Confirmation" name="password2" id="password2">
                <input name="submit" id="btnsubmit" type="submit" value="Modifier votre profil">
            </form>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>