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
            <div class="panel-heading"><strong>Usúario:</strong> '.$nome.'</div>
            <div class="panel-body">'.$texto_usuario.'</div>
            </div>';


            if(is_null($suporte_resposta)) {
              echo '<div class="panel panel-default panel2">
              <div class="panel-heading"><strong>Suporte:</strong> '.$nome_suporte.'</div>
              <div class="panel-body">'.$respostaSuporte.'</div>
              </div>';
            }

      }


      echo'
        <a href="home.php" class="btn btn-default btn-panel" role="button">Voltar</a>


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
            $nome_usuario = $row['nome'];
            $respostaSuporte = $row['resposta'];
            $id_chamado = $row['idChamado'];
            $email = $row['emailUsuario'];
            $texto_usuario = $row['textoTicket'];

        echo '<div class="panel panel-primary panel1">
              <div class="panel-heading"><strong>Usúario:</strong> '.$nome_usuario.'</div>
              <div class="panel-body">'.$texto_usuario.'</div>
              </div>';


              if(empty($suporte_resposta)) {
                echo '<div class="panel panel-default panel2">
                <div class="panel-heading"><strong>Suporte:</strong> '.$nome.'</div>
                <div class="panel-body">'.$respostaSuporte.'</div>
                </div>';
              }

        }


        echo'
          <a href="lista.php" class="btn btn-default btn-panel" role="button">Voltar</a>


              </div>

              </div>
              </div>
              </div>';


    }else {
    header("Location: index.php?acesso=naoautorizado");
  exit();
    }



?>

<?php
  require 'footer.php'
 ?>
