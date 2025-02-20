<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/livre-or/css/global.css"/>
    <link rel="stylesheet" href="/livre-or/css/accueil.css"/>
    <title>Accueil - Livre d'or</title>

</head>
<body>
    
        <div class="content-wrapper">
            <header>
                <?php include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php"); ?>
            </header>
       
            <section id="accueil">
                <?php
                 
                        echo "<h2>Livre d'or d'Anne & Brad</h2>";
                    
                ?>
            </section>
        </div>
    </body>
</html>