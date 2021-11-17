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
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE login="' . $_SESSION['user'] . '"');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    if (isset($_SESSION['user'])) {
        echo "Bienvenue " . $res[0]['prenom'] . " <form action='' method='post'><input type='hidden' name='deconnexion'><input id='deco' type='submit' value='Se deconnecter'></form>";
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

function estadmin()
{
    if ($_SESSION['user'] == 'admin') {
        $adm = true;
        return $adm;
    }
}

function redirect_nonadmin()
{
    if (estadmin() == false) {
        header('Location: ./connexion.php');
    }
}

function modifierprofil()
{
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE login="' . $_SESSION['user'] . '"');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    if (isset($_POST['submit'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            echo 'Les mots de passes ne correspondent pas';
        } else {
            if (empty($_POST['submit']) or empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['password1'])) {
                echo 'Un champ est vide';
            } else {
                mysqli_query($db, 'UPDATE utilisateurs SET nom ="' . $_POST['nom'] . '",prenom ="' . $_POST['prenom'] . '",password ="' . $_POST['password1'] . '" WHERE login="' . $_POST['login'] . '"');
                echo "L'utilisateur a été modifié avec succès";
            }
        }
    }
}
