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
        echo '<style>h3 {color: green;padding:10px; font-size:1em;}</style><h3>Bonjour '.ucfirst($res[0]['prenom']).' ,redirection en cours...</h3>';
        $_SESSION['user'] = $res[0]['login'];
        header("Refresh: 3; url=index.php");            
}
}
function bienvenu()
{
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT * FROM utilisateurs WHERE login="' . $_SESSION['user'] . '"');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    if (isset($_SESSION['user'])) {
        echo "Bienvenue " . ucfirst($res[0]['prenom']) . " <form action='' method='post'><input type='hidden' name='deconnexion'><input id='deco' type='submit' value='Se deconnecter'></form>";
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
                echo ' Bonjour '.$_POST['prenom'].' ,redirection en cours... ';
                header("Refresh: 3; url=index.php");            
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

function redirect_estconnecte()
{
    if (estconnecte() == true) {
        header('Location: ./profil.php');
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
    $req2 = mysqli_query($db, 'SELECT login FROM utilisateurs WHERE login!="' . $_SESSION['user'] . '"  ');
    $res2 = mysqli_fetch_all($req2, MYSQLI_ASSOC);
    foreach ($res2 as $element) {
        foreach ($element as $key => $element2) {
            if ($element2 == $_POST['login']){
            echo 'Ce compte existe déjà';
            return;
        }
    }
}

    if (isset($_POST['submit'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            echo 'Les mots de passes ne correspondent pas';
        } else {
            if (empty($_POST['submit']) or empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['password1'])) {
                echo 'Un champ est vide';
            } else {
                mysqli_query($db, 'UPDATE utilisateurs SET login ="' . $_POST['login'] . '",nom ="' . $_POST['nom'] . '",prenom ="' . $_POST['prenom'] . '",password ="' . $_POST['password1'] . '" WHERE login="' . $res[0]['login'] . '"');
                $_SESSION['user'] = $_POST['login'];
                echo "L'utilisateur a été modifié avec succès";
                header('refresh:1');
            }
        }
    }
}

function recupinfobase_tableau()
{
    $db = mysqli_connect("localhost", "root", "root", "module-connexion");
    $req = mysqli_query($db, 'SELECT id, nom AS Nom, prenom AS Prénom, login AS Login, password AS "Mot de passe" FROM utilisateurs');
    $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    foreach ($res as $element) {
        echo '<thead><tr>';
        foreach ($element as $key => $element2) {
            echo '<th>' . $key . '</th>';
        }
        echo '</tr></thead>';
        break;
    }
    foreach ($res as $element) {
        echo "<tr>";
        foreach ($element as $key => $element2) {
            echo "<td>" . $element2 . "</td>";
        }
        echo "</tr>";
    }

    // function recup_ligne()
    // {
    //     $db = mysqli_connect("localhost", "root", "root", "jour08");
    //     $req = mysqli_query($db, "SELECT * FROM etudiants");
    //     $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
    //     foreach ($res as $element) {
    //         echo "<tr>";
    //         foreach ($element as $key => $element2) {
    //             echo "<td>" . $element2 . "</td>";
    //         }
    //         echo "</tr>";
    //     }
    // }
}
?>