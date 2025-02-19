
<?php
    session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/livre-or/css/global.css"/>
        <title>Accueil - Livre d'or</title>
    </head>
   
    <body>
        <div class="body">
            <header>
                <?php
                include($_SERVER['DOCUMENT_ROOT'] . "/livre-or/models/Header.php");

                ?>
            </header>
       
       
            <div id="accueil">
                <?php
                    if(isset($_SESSION['login']) || isset($_SESSION['password']))
                    {
                        echo "<h2>Livre d'or de Anne et Brad ".$_SESSION['login']."</h2>";
                    }
                    else{
                        echo "<h2>Livre d'or de Anne et Brad</h2>";
                    }
                ?>
            </div>
       
        
        </div>
    </body>
</html>