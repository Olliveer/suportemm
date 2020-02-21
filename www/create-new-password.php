<?php
require "header.php";

?>

<main>
    <div class="">
        <section class="">
          <?php
          $selector = $_GET["selector"];
          $validator = $_GET["validator"];

          if (empty($selector) || empty($validator)) {
            echo "Não foi possível validar!";
          }else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>

                <form action="includes/reset-password.inc.php" method="post">
                  <input type="hidden" name="selector" value="<?php echo $selector;  ?>">
                  <input type="hidden" name="validator" value="<?php echo $validator;  ?>">
                  <input type="password" name="pwd" placeholder="Digite seu novo password...">
                  <input type="password" name="pwd-repeat" placeholder="Confirme seu novo password...">
                  <button type="submit" name="reset-password-submit">Reset password</button>

                </form>


                <?php


            }
          }
         ?>

        </section>
    </div>
</main>

<?php
require "footer.php";

?>
