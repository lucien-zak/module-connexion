<?php
session_start();
require "./fonctions.php";
redirect_estconnecte();
deconnexion();
include './header.php';
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
      <h1>Inscrivez vous !</h1>
      <h2><?php inscription() ?></h2>
      <form action="" method="post">
        <input placeholder="Login" type="text" name="login" id="login">
        <input placeholder="Nom"ype="text" name="nom" id="nom">
        <input placeholder="Prénom" type="text" name="prenom" id="prenom">
        <input placeholder="Mot de passe" type="password" name="password1" id="password1">
        <input placeholder="Confirmer votre mot de passe" type="password" name="password2" id="password2">
        <input name="submit" id="btnsubmit" type="submit" value="Se connecter">
      </form>
    </div>
  </main>
  <?php 
  include './footer.php';
  ?>