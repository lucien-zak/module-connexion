<?php

function verif_connexion()
{
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE login="' . $_POST['username'] . '"');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    if ($_POST['username'] != $res[0]['login']) {
        echo '<style>h3 {color: red}</style><h3>' . $_POST['username'] . " n'existe pas</h3>";
        exit();
    }
    if ($_POST['username'] == $res[0]['login'] && $_POST['password'] != $res[0]['password']) {
        echo '<style>h3 {color: red}</style><h3>Mot de passe faux</h3>';
    }
    if ($_POST['username'] == $res[0]['login'] && $_POST['password'] == $res[0]['password'] && isset($_POST['username'])) {
        echo '<style>h3 {color: green}</style><h3>Connexion Réussie</h3>';
        $_SESSION['user'] = $res[0]['login'];
        header('Location: ./index.php');
    }
}
function bienvenu()
{
    if (isset($_SESSION['user'])) {
        echo "Bienvenue " . $_SESSION['user'] . " <form action='' method='post'><input type='hidden' name='deconnexion'><input type='submit' value='Se deconnecter'></form>";
    } else {
        echo "Vous n'etes pas connecté";
    }
}

function deconnexion()
{
    if (isset($_POST['deconnexion'])) {
        session_destroy();
        header('Location: ./connexion.php');
    }
}

function estconnecte()
{
    if (isset($_SESSION['user'])) {
        $connect = true;
        return $connect;
    }
}

function inscription()
{
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE login="' . $_POST['login'] . '"');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    if ($_POST['login'] == $res[0]['login'] && isset($_POST['login'])) {
        echo 'Ce compte existe déjà';
        return;
    }
    if ($_POST['password1'] != $_POST['password2']) {
        echo 'Les mots de passes ne correspondent pas';
    } else {
        // if (!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password1'])) {
        //   mysqli_query($db, 'INSERT INTO utilisateurs(login, prenom, nom, password) VALUES ("' . $_POST['login'] . '","' . $_POST['prenom'] . '","' . $_POST['nom'] . '","' . $_POST['password1'] . '")');
        //   $_SESSION['user'] = $_POST['login'];
        //   header('Location: ./index.php');
        // }
        // if ((!isset($_POST['submit']) or empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['password1']))){
        //   echo 'Un champ est vide';
        // }
        if (isset($_POST['submit'])) {
            if (empty($_POST['submit']) or empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['password1'])) {
                echo 'Un champ est vide';
            } else {
                mysqli_query($db, 'INSERT INTO utilisateurs(login, prenom, nom, password) VALUES ("' . $_POST['login'] . '","' . $_POST['prenom'] . '","' . $_POST['nom'] . '","' . $_POST['password1'] . '")');
                $_SESSION['user'] = $_POST['login'];
                header('Location: ./index.php');
            }
        }
    }
}

function redirect_nonconnecte()
{
    if (estconnecte() == false) {
        header('Location: ./connexion.php');
    }
}
