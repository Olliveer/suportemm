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

    }
    echo '<div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="panel panel-default panel0">';

    while ($dados = mysqli_fetch_array($result)){
      $assunto = $dados['assunto'];
      $texto_usuario = $dados['textoTicket'];
      $suporte_resposta = $dados['resposta'];
      $nome_usuario = $dados['nome'];
      $id_ticket = $dados['idTicket'];
      $id_suporte = $dados['idSuporte'];
      $id_chamado = $dados['idChamado'];

    echo '<div class="panel panel-default panel1">
    <div class="panel-heading"><strong>Usúario:</strong> '.$nome_usuario.'</div>
    <div class="panel-body">'.$texto_usuario.'</div>
    </div>';



      if(!is_null($suporte_resposta)) {
        echo '<div class="panel panel-primary panel2">
              <div class="panel-heading"><strong>Suporte:</strong> '.$nome.'</div>
              <div class="panel-body">'.$suporte_resposta.'</div>
              </div>';
      }

    }


    echo '<form class="form-horizontal" action="includes/finalizar.inc.php" method="post">
    <input type="hidden" name="id_ticket" value="'.$id_ticket.'"/>
    <input type="hidden" name="id_chamado" value="'.$id_chamado.'"/>
    <input type="hidden" name="texto_usuario" value="'.$texto_usuario.'"/>
    <!-- Menssagem -->
    <div class="form-group">
      <div class="col-md-12 text-panels">
        <textarea class="form-control" id="texto_resposta" name="msg_form_ticket" placeholder="Digite sua menssagem aqui..." rows="4"></textarea>
      </div>
    </div>
    <p><button class="btn btn-primary btn-panel" type="submit" name="reposta-ticket-submit" id="btn_resposta" role="button">Responder</button>
        <a href="index.php" class="btn btn-default" role="button">Voltar</a>
    </p>
    </form>

    </p>
    </div>
    </div>
    </div>
    </div>';





  }




?>

<?php
  require 'footer.php'
 ?>
