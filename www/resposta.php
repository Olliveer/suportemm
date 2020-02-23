<?php
require "header.php";
?>
<?php
require 'includes/dbh.inc.php';

session_start();
$nome = $_SESSION['nome'];
$id_ticket = $_GET['id'];
$id_chamado = $_GET['idchamado'];

if ($_SESSION['tipo']=='user') {
  $sql = "SELECT t.idTicket, t.assunto, t.dataCriacao, t.numeroContato, t.resposta, t.idSuporte, u.nome, u.idUsers FROM users AS u INNER JOIN tickets AS t ON(u.idUsers=t.idSuporte) WHERE idTicket=?";
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
      $id_ticket = $row['idTicket'];
      $nome_suporte = $row['nome'];
      $respostaSuporte = $row['resposta'];
    }
    echo '<div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="thumbnail">
    <div class="caption">
    <h3>Ticket: '.$id_ticket.'</h3>
    <p>Responsavel Suporte: '.$nome_suporte.'</p><br>
    <p>Assunto: '.$assunto.'</p><br>
    <p>Número Telefone: '.$contato.'</p><br>
    <p>Data da Criação: '.$data.'</p><br>
    <p>Resposta Suporte: '.$respostaSuporte.'</p><br>
    <p><a href="openticket.php?id='.$id_ticket.'" class="btn btn-primary" role="button">Reabrir</a>
     <a href="index.php" class="btn btn-default" role="button">Voltar</a>
    </p>
    </div>
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
      <div class="thumbnail">
      <div class="caption">';

      while ($dados = mysqli_fetch_array($result)){
        $assunto = $dados['assunto'];
        $texto_usuario = $dados['textoTicket'];
        $suporte_resposta = $dados['resposta'];
        $nome_usuario = $dados['nome'];
        $id_ticket = $dados['idTicket'];
        $id_suporte = $dados['idSuporte'];
        $id_chamado = $dados['idChamado'];

  echo '<div class="panel panel-default">
  <div class="panel-heading">Usúario: '.$nome_usuario.'</div>
  <div class="panel-body">'.$texto_usuario.'</div>
  </div>';



        if(!is_null($suporte_resposta)) {
          echo '<div class="panel panel-primary">
                <div class="panel-heading">Suporte: '.$nome.'</div>
                <div class="panel-body">'.$suporte_resposta.'</div>';
        }

        echo '</div>';


    }




    echo '  <form class="form-horizontal" action="includes/finalizar.inc.php" method="post">
      <input type="hidden" name="id_ticket" value="'.$id_ticket.'"/>
      <input type="hidden" name="id_chamado" value="'.$id_chamado.'"/>
      <input type="hidden" name="texto_usuario" value="'.$texto_usuario.'"/>
      <!-- Menssagem -->
      <div class="form-group">
        <div class="col-md-12">
          <textarea class="form-control" id="msg_form_ticket" name="msg_form_ticket" placeholder="Digite sua menssagem aqui..." rows="5"></textarea>
        </div>
      </div>
      <p><button class="btn btn-primary" name="reabre-chamado-submit" role="button">Responder</button>
          <a href="index.php" class="btn btn-default" role="button">Voltar</a>
      </p>
      </form>

      </p>
      </div>
      </div>
      </div>
      </div>
      </div>';
  }



?>

<?php
  require 'footer.php'
 ?>
