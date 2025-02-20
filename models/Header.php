<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="livre-or.php">Livre d'or</a></li>
        <?php
            if(isset($_SESSION['login'])) // Vérifie seulement si l'utilisateur est connecté
            {
                echo '<li><a href="profil.php">Mon compte</a></li>';
                echo '<li><a href="logout.php">Déconnexion</a></li>';
            }
            else
            {
                echo '<li><a href="login.php">Profil</a></li>';
            }
        ?>
    </ul>
</nav>