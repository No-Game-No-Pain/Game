<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="description" content="Jeu de combat tour par tour - Eden Attack" />
        <meta name="keywords" content="Eden Attack, Turn by turn base game" />
        <meta name="author" content="No-Game-No-Pain" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <link rel="stylesheet" href="../CSS/Acceuil.css">
        <link rel="stylesheet" href="../CSS/select.css">
        <link rel="stylesheet" href="../CSS/game.css">
        <link rel="stylesheet" type="text/css" href="./CSS/add.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="../script/script.js"></script>
        <title>Eden Attack</title>
    </head>
    <body>
        <section>
            <?php
                if(isset($_GET['add'])){
                    include "./includes/add.php";
                }
                elseif(isset($_GET['select'])){
                    include "./includes/select.php";
                }
                elseif(isset($_GET['game'])){
                    include "./includes/game.php";
                }
                else{
                    include "./includes/acceuil.html";
                }
            ?>
        </section>
    </body>
</html>