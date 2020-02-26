<?php
require "header.php";
?>
<?php
require 'includes/dbh.inc.php';

session_start();
$nome = $_SESSION['nome'];
$id_ticket = $_GET['id'];
$id_chamado = $_GET['idchamado'];
$visualizar_finalizado = $_GET['status'];

if ($_SESSION['tipo']=='user') {
  $sql = "SELECT u.nome, u.idUsers, t.emailUsuario, t.numeroContato, t.assunto, t.textoTicket, t.idTicket, t.resposta, t.idChamado, t.idSuporte FROM tickets AS t INNER JOIN users as u ON (u.idUsers =t.idSuporte) WHERE idChamado=? ORDER BY dataCriacao ASC";
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

  while ($row = mysqli_fetch_array($result)){
    $id_usuario = $row['idUsuario'];
    $assunto = $row['assunto'];
    $contato = $row['numeroContato'];
    $data = $row['dataCriacao'];
    $id = $row['idTicket'];
    $id_suporte = $row['idSuporte'];
    $nome_suporte = $row['nome'];
    $respostaSuporte = $row['resposta'];
    $id_chamado = $row['idChamado'];
    $email = $row['emailUsuario'];
    $texto_usuario = $row['textoTicket'];

    echo '<div class="panel panel-primary panel1">
    <div class="panel-heading"><strong>Usúario: </strong>'.$nome.'</div>
    <div class="panel-body">'.$texto_usuario.'</div>
    </div>';


    if(is_null($suporte_resposta)) {
      echo '<div class="panel panel-default panel2">
      <div class="panel-heading"><strong>Suporte: </strong>'.$nome_suporte.'</div>
      <div class="panel-body">'.$respostaSuporte.'</div>
      </div>';
    }
    echo '  <form class="form-horizontal" action="includes/reabre-ticket.inc.php" method="post">
    <input type="hidden" name="id_usuario" value="'.$id_usuario.'" />
    <input type="hidden" name="id_ticket" value="'.$id.'" />
    <input type="hidden" name="id_suporte" value="'.$id_suporte.'" />
    <input type="hidden" name="id_chamado" value="'.$id_chamado.'" />
    <input type="hidden" name="email_usuario" value="'.$email.'" />
    <input type="hidden" name="assunto" value="'.$assunto.'" />
    <input type="hidden" name="contato" value="'.$contato.'" />';






  }

  if (isset($_GET["reabrir"])) {
    if ($_GET["reabrir"] == "novo") {
      echo '
      <!-- Menssagem -->
      <div class="form-group">
      <div class="col-md-12 text-panels">
      <textarea class="form-control" id="msg_reabertura_ticket" name="msg_reabertura_ticket" placeholder="Digite sua menssagem aqui..." rows="4"></textarea><br>
      </div>
      </div>
      <button class="btn btn-primary btn-panel" type="submit" name="submit-reabre-ticket" role="button">Responder</button>
      <a href="resposta.php?id='.$id_ticket.'" class="btn btn-default btn-panel" role="button">Voltar</a>';
    }
  }else {
    echo'<a href="resposta.php?id='.$id_ticket.'&reabrir=novo" class="btn btn-danger btn-panel" name="reabre-chamado-submit" id="btn_resposta" role="button">Reabrir Ticket</a>
    <a href="home.php" class="btn btn-default btn-panel" role="button">Voltar</a>';
  }

  echo'
  </form>
  </div>
  </div>
  </div>
  </div>';


}else if ($_SESSION['tipo'] == 'suporte') {
  $sql = "SELECT u.nome, u.idUsers, t.emailUsuario, t.numeroContato, t.assunto, t.textoTicket, t.idTicket, t.resposta, t.idChamado, t.idSuporte FROM tickets AS t INNER JOIN users as u ON (u.idUsers =t.idUsuario ) WHERE idChamado=? ORDER BY dataCriacao";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "i", $id_chamado);
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
  <textarea class="form-control" id="texto_resposta" name="msg_form_ticket" placeholder="Digite sua menssagem aqui..." rows="5"></textarea>
  </div>
  </div>
  <p><button class="btn btn-primary btn-panel" name="reabre-chamado-submit" id="btn_resposta" role="button">Responder</button>
  <a href="index.php" class="btn btn-default btn-panel" role="button">Voltar</a>
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
