<?php
require "header.php";
?>
<?php
require 'includes/dbh.inc.php';

session_start();
$nome = $_SESSION['nome'];
$id_ticket = $_GET['id'];

if ($_SESSION['tipo']=='user') {
  $sql = "SELECT t.idTicket, t.assunto, t.dataCriacao, t.numeroContato, t.reposta, t.idSuporte, u.nome, u.idUsers FROM users AS u INNER JOIN tickets AS t ON(u.idUsers=t.idSuporte) WHERE idTicket=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
  } else {
      mysqli_stmt_bind_param($stmt, "i", $id_ticket);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $id_usuario = $row['idUsuario'];
      $assunto = $row['assunto'];
      $contato = $row['numeroContato'];
      $data = $row['dataCriacao'];
      $id = $row['idTicket'];
      $id_suporte = $row['idSuporte'];
      $nome_suporte = $row['nome'];
      $respostaSuporte = $row['reposta'];
    }
  }


echo '<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="thumbnail">
<div class="caption">
      <h3>Ticket: '.$id.'</h3><br>
      <p>Responsavel Suporte: '.$nome_suporte.'</p><br>
      <p>Assunto: '.$assunto.'</p><br>
      <p>Número Telefone: '.$contato.'</p><br>
      <p>Data da Criação: '.$data.'</p><br>
      <p>Resposta Suporte: '.$respostaSuporte.'</p><br>

  <form action="includes/reabre-ticket.inc.php" method="post">
            <input type="hidden" name="id_usuario" value="'.$id_usuario.'" />
            <input type="hidden" name="id_ticket" value="'.$id.'" />
            <input type="hidden" name="id_resposta_suporte" value="'.$respostaSuporte.'" />
            <input type="hidden" name="id_suporte" value="'.$id_suporte.'" />

      <!-- Menssagem -->
          <textarea class="form-control" id="msg_reabertura_ticket" name="msg_reabertura_ticket" placeholder="Digite sua menssagem aqui..." rows="10"></textarea><br><p>
                <button class="btn btn-primary" type="submit" name="submit-reabre-ticket" role="button">Enviar</button>
                <a href="index.php" class="btn btn-default" role="button">Cancelar</a></p>
</form>


</div>
</div>
</div>
</div>
      </div>';

?>

<?php
  require 'footer.php'
 ?>
