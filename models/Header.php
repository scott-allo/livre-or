<nav>
   
    <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="livre-or.php">Livre d'or</a></li>
        <?php
            if(!isset($_SESSION['login']) || !isset($_SESSION['password']))
            {
                echo '
                    <li><a href="register.php">Connexion</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                ';
            }
            else
            {
                echo '<li><a href="profil.php">Mon compte</a></li>';
                echo '<li><a href="deconnection.php">Déconnexion</a></li>';
            }
        ?>
    </ul>
</nav>