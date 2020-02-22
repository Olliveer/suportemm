<?php
require "header.php";
?>
<?php
require 'includes/dbh.inc.php';

session_start();
$nome = $_SESSION['nome'];
$id_ticket = $_GET['id'];


if ($_SESSION['tipo']=='suporte') {
  $sql = "SELECT * FROM tickets where idTicket =?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
  } else {
    mysqli_stmt_bind_param($stmt, "i", $id_ticket);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $assunto = $row['assunto'];
      $contato = $row['numeroContato'];
      $data = $row['dataCriacao'];
      $_SESSION['id'] = $row['idTicket'];
    }
  }


echo '<div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
              <form class="form-horizontal" action="includes/finalizar.inc.php" method="post">
              <fieldset>
              <legend class="text-center">Abrir Ticket de Suporte</legend>

              <!-- ID Ticket -->
              <div class="form-group">
                <label class="col-md-3 control-label" type="hidden" name="id_form_ticket" for="id_form_ticket">'.$id.'</label>

              </div>


          <!-- Nome Usuário -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="assunto_form_ticket">Usúario</label>
            <div class="col-md-9">
                <h4>'.$nome.'</h4>
            </div>
          </div>

          <!-- Assunto -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="assunto_form_ticket">Assunto</label>
            <div class="col-md-9">
            <h4>'.$assunto.'</h4>
            </div>
          </div>

          <!-- Telefone -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="telefone_form_ticket">Número Telefone</label>
            <div class="col-md-9">
              <h4>'.$contato.'</h4>
            </div>
          </div>

          <!-- Data -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="telefone_form_ticket">Data</label>
            <div class="col-md-9">
              <h4>'.$data.'</h4>
            </div>
          </div>

          <!-- Menssagem -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="msg_form_ticket">Menssagem</label>
            <div class="col-md-9">
              <textarea class="form-control" id="msg_form_ticket" name="msg_form_ticket" placeholder="Digite sua menssagem aqui..." rows="10"></textarea>
            </div>
          </div>


          <div class="form-group">
            <div class="col-md-12 text-right">
              <button type="submit"  name="reposta-ticket-submit" class="btn btn-primary btn-lg">Enviar</button>
            </div>
          </div>
        </fieldset>
        </form>
      </div>
    </div>
</div>
</div>';

?>

<?php
  require 'footer.php'
 ?>
