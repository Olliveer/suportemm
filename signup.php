<?php
require "header.php";

?>

<main>
  <div class="">
    <section class="">
      <h1>Cadastro</h1>
      <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyfields") {
          echo '<p>Campos vazios!!</p>';
        } else if ($_GET['error'] == 'invalidmailuid') {
          echo '<p>Email e Username inválidos!!</p>';
        } else if ($_GET['error'] == "invaliduid") {
          echo '<p>Username inválido!!</p>';
        } else if ($_GET['error'] == "passwordcheckuid") {
          echo '<p>Password não são iguais.</p>';
        } else if ($_GET['error'] == "usertake") {
          echo '<p>Usuario já existe!!</p>';
        } else if ($_GET['error'] == "invalidmail") {
          echo '<p>Email inválido!!</p>';
        }
      }
      if (isset($_GET["signup"])) {
        if ($_GET["signup"] == "success") {
          echo '<p>Cadastro feito com sucesso!</p>';
        }
      }

      ?>

      <form action="includes/signup.inc.php" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="user_cadastro">Username</label>
            <input type="text" class="form-control" id="user_cadastro" name="user_cadastro" placeholder="Usuário">
          </div>
          <div class="form-group col-md-6">
            <label for="email_cadastro">Email</label>
            <input type="email" class="form-control" id="email_cadastro" name="email_cadastro" placeholder="Email">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd_cadastro">Password</label>
            <input type="password" class="form-control" id="pwd_cadastro" name="pwd_cadastro" placeholder="Password">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd_cadastro_repeat">Password confirma</label>
            <input type="password" class="form-control" id="pwd_cadastro_repeat" name="pwd_cadastro_repeat" placeholder="Repida seu password">
          </div>
        </div>
        <button type="submit" name="signup-submit" class="btn btn-primary">Cadastrar</button>
      </form>





      <?php
      if (isset($_GET["newpwd"])) {
        if ($_GET["newpwd"] == "passwordupdated") {
          echo '<p>Sua senha foi redefinida!!</p>';
        } else if ($_GET["emailok"] == "success") {
          echo '<p>E-mail verificado!!</p>';
        }
      }



      ?>




    </section>
  </div>
</main>

<?php
require "footer.php";

?>
