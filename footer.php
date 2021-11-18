<footer>
    <nav>
            <ul id="barnav">
                <span>Mon Github : https://github.com/lucien-zak/</span>
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
    </footer>
</body>
</html>