<?php
    include "./includes/head.html";
?>
<body>
<header>
</header>
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