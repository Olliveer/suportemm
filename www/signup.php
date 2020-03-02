<?php
require "header.php";

?>

<main>
  <div class="">
    <section class="">
      <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyfields") {
          echo '<p>Campos vazios!!</p>';
        } else if ($_GET['error'] == 'invalidmailuid') {
          echo '<p>Email e Username inválidos!!</p>';
        } else if ($_GET['error'] == "invaliduid") {
          echo '<p>Nome inválido!!</p>';
        } else if ($_GET['error'] == "passwordcheck") {
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

      <form class="form-horizontal" action="includes/signup.inc.php" method="post">
        <fieldset>

          <!-- Form Name -->
          <legend>Cadastro</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="user_cadastro">Nome</label>
            <div class="col-md-6">
              <input name="user_cadastro" class="form-control input-md" id="user_cadastro" required="" type="text" placeholder="Nome">

            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="email_cadastro">E-mail</label>
            <div class="col-md-6">
              <input name="email_cadastro" class="form-control input-md" id="email_cadastro" required="" type="text" placeholder="E-mail">

            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="pwd_cadastro">Password</label>
            <div class="col-md-6">
              <input name="pwd_cadastro" class="form-control input-md" id="pwd_cadastro" required="" type="password" placeholder="Password">

            </div>
          </div>

          <!-- Password input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="pwd_cadastro_repeat">Confirma Password</label>
            <div class="col-md-6">
              <input name="pwd_cadastro_repeat" class="form-control input-md" id="pwd_cadastro_repeat" required="" type="password" placeholder="Repita seu password">

            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="signup-submit"></label>
            <div class="col-md-4">
              <?php
              if (isset($_GET["admin"])) {
                if ($_GET["admin"] == "true") {?>
                  <div class="form-group">
                    <div class="col-md-4 col-sm-10">
                      <div class="checkbox">
                        <label><input type="checkbox" name="check_suporte" value="suporte">Suporte?</label>
                      </div>
                    </div>
                  </div>
                <?php }} ?>
                <button name="signup-submit" class="btn btn-primary" id="signup-submit">Cadastrar</button>
                <a href="reset-password.php">Esqueçeu a senha?</a>
              </div>
            </div>
          </fieldset>
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
