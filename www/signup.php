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

      <div class="col-sm-12 col-md-12">
        <div class="panel panel-default panel0">
      <form class="form-horizontal" action="includes/signup.inc.php" method="post">
        <div class="form-group">
          <label class="control-label col-sm-2" for="user_cadastro">Nome:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="user_cadastro" id="user_cadastro" placeholder="Nome">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="email_cadastro">Email:</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" id="email_cadastro" name="email_cadastro" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password:</label>
          <div class="col-sm-6">
            <input type="password" class="form-control" id="pwd_cadastro" name="pwd_cadastro" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password Confirma:</label>
          <div class="col-sm-6">
            <input type="password" class="form-control" id="pwd_cadastro_repeat" name="pwd_cadastro_repeat" placeholder="Repita seu password">
          </div>
        </div>

        <?php
        if (isset($_GET["admin"])) {
          if ($_GET["admin"] == "true") {?>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label><input type="checkbox" name="check_suporte" value="suporte">Suporte?</label>
                </div>
              </div>
            </div>
          <?php }} ?>






          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="signup-submit" class="btn btn-primary">Cadastrar</button>
              <a href="reset-password.php">Esqueçeu a senha?</a>
            </div>
          </div>
        </form>
      </div>
    </div>




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
