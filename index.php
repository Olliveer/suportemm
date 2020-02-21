<?php
require "header.php";
?>

<main>
    <?php
        if(isset($_SESSION['userId'])){
            echo '<p>Voce esta logado</p>';
        }else{
            echo '<p>Você esta deslogado</p>';
        }

    ?>



</main>

<?php
require "footer.php";

 ?>
