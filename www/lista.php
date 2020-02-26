<?php
require "header.php";

?>

<?php
require 'includes/dbh.inc.php';
session_start();

$id_usuario = $_SESSION['userId'];
?>

<main>
  <?php
  if ($_SESSION['tipo']=='suporte') {
    session_start();
    $sql = "SELECT users.nome, users.idUsers, emailUsuario, numeroContato, idChamado, estadoTicket, assunto, textoTicket, idTicket, idSuporte FROM tickets INNER JOIN users ON (users.idUsers =tickets.idUsuario ) where estadoTicket = 3 ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    echo '<div class="container">
    <div class="row">
    <div class="col-md-12">
    <h4>Lista de Tickets</h4>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <div class="table-responsive">
    <table id="mytable" class="table table-bordred table-striped">

    <thead>
    <th>Nome</th>
    <th>E-mail</th>
    <th>Telefone</th>
    <th>Assunto</th>
    <th>ID Ticket</th>
    <th>Visualizar</th>
    <th>Finalizar</th>
    </thead>
    <tbody id="table_admin">';
    while ($dados = mysqli_fetch_array($result)){
      $nome = $dados['nome'];
      $email = $dados['emailUsuario'];
      $telefone = $dados['numeroContato'];
      $assunto = $dados['assunto'];
      $id = $dados['idTicket'];
      $estadoTicket = $dados['estadoTicket'];
      $id_suporte = $dados['idSuporte'];
      $id_chamado = $dados['idChamado'];

      echo '<tr>
      <a><td>'.$nome.'</td></a>
      <td>'.$email.'</td>
      <td>'.$telefone.'</td>
      <td>'.$assunto.'</td>
      <td>'.$id.'</td>';
      if ($estadoTicket == 3) {
        echo '<td><a href="historico.php?id='.$id_chamado.'>" data-placement="left" data-toggle="tooltip" title="Visualizar"><button class="btn btn-success" data-title="Responder"><span class="glyphicon glyphicon-search"></span></button></p></td>';
      }
      if ($estadoTicket == 3) {
        echo '<td><p>FINALIZADO</p></td>

        </tr>';
      }

    }

    echo '</tbody>

    </table>



    </div>
    </div>
    </div>';

  }else if ($_SESSION['tipo'] == 'user') {
    session_start();
    $sql = "SELECT u.nome, u.idUsers, emailUsuario, t.idChamado, numeroContato, assunto, textoTicket, idTicket, estadoTicket FROM tickets as t INNER JOIN users as u ON (u.idUsers = t.idUsuario AND t.estadoTicket = 3) WHERE t.idUsuario =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "i", $id_usuario);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    echo '<div class="container">
    <div class="row">
    <div class="col-md-12">
    <h4>Lista de Tickets</h4>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <div class="table-responsive">
    <table id="mytable" class="table table-bordred table-striped">
    <thead>
    <th>Nome</th>
    <th>E-mail</th>
    <th>Telefone</th>
    <th>Assunto</th>
    <th>ID Ticket</th>
    <th>Visualizar</th>
    <th>Finalizar</th>
    </thead>
    <tbody id="table_admin">';
    while ($dados = mysqli_fetch_array($result)){
      $nome = $dados['nome'];
      $email = $dados['emailUsuario'];
      $telefone = $dados['numeroContato'];
      $assunto = $dados['assunto'];
      $id = $dados['idTicket'];
      $estadoTicket = $dados['estadoTicket'];
      $id_suporte = $dados['idSuporte'];
      $id_chamado = $dados['idChamado'];

      echo '<tr>
      <a><td>'.$nome.'</td></a>
      <td>'.$email.'</td>
      <td>'.$telefone.'</td>
      <td>'.$assunto.'</td>
      <td>'.$id.'</td>';
      if ($estadoTicket == 3) {
        echo '<td><a href="resposta.php?id='.$id_chamado.'>" data-placement="left" data-toggle="tooltip" title="Visualizar"><button class="btn btn-success" data-title="Responder"><span class="glyphicon glyphicon-search"></span></button></p></td>';
      }
      if ($estadoTicket == 3) {
        echo '<td><p>FINALIZADO</p></td>

        </tr>';
      }

    }
    echo '</tbody>

    </table>
    </div>
    </div>
    </div>';

  }else {
    echo "NINGUÉM LOGADO AQUI";
  }
  ?>

</main>
<?php
require "footer.php";

?>
