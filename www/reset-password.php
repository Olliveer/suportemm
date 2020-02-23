<?php
require "header.php";

?>

<main>
  <div class="">
    <section class="">
      <h1>Resete sua senha</h1>
      <p>Um E-mail será enviado com instruções</p>
      <form class="form-inline" action="includes/reset-request.inc.php" method="post">

        <div class="form-group mx-sm-3 mb-2">
          <input type="email" class="form-control" id="email_reset" placeholder="Digite seu E-mail...">
        </div>
        <button type="submit" name="reset-request-submit" class="btn btn-primary mb-2">Receber novo password por
          email</button>
        </form>
        <?php
        if (isset($_GET["reset"])) {
          if ($_GET["reset"] == "success") {
            echo "Cheque seu e-mail!";
          }
        }






        ?>

      </section>
    </div>
  </main>

  <?php
  require "footer.php";

  ?>
