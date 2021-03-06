<?php
require "header.php";

?>

<?php
require 'includes/dbh.inc.php';

$id_usuario = $_SESSION['userId'];
?>

<main>

    <?php
    if ($_SESSION['tipo'] == 'suporte') {
        $sql = "SELECT users.nome, users.idUsers, emailUsuario, numeroContato, assunto, textoTicket, idTicket FROM tickets INNER JOIN users where tickets.idUsuario=2";
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
      <tbody>';
        while ($dados = mysqli_fetch_array($result)) {
            $nome = $dados['nome'];
            $email = $dados['emailUsuario'];
            $telefone = $dados['numeroContato'];
            $assunto = $dados['assunto'];
            $id = $dados['idTicket'];

            echo '<tr>
      <a><td>' . $nome . '</td></a>
      <td>' . $email . '</td>
      <td><a>' . $telefone . '</a></td>
      <td>' . $assunto . '</td>
      <td>' . $id . '</td>
      <td><a href="suporte.php?id=' . $id . '>" method="post" data-placement="top" data-toggle="tooltip" title="Responder"><button class="btn btn-success" data-title="Responder"><span class="glyphicon glyphicon-search"></span></button></p></td>
      <td><a action="" method="post" data-placement="top" data-toggle="tooltip" title="Finalizar"><button class="btn btn-primary" data-title="Finalizar"><span class="glyphicon glyphicon-ok"></span></button></p></td>

      </tr>';
        }
        echo '</tbody>

        </table>



          </div>
  	</div>
  </div>';

    } elseif ($_SESSION['tipo'] == 'user') {
        $sql = "SELECT u.nome, u.idUsers, emailUsuario, numeroContato, assunto, textoTicket, idTicket FROM tickets as t INNER JOIN users as u ON (u.idUsers = t.idUsuario) WHERE t.idUsuario =?";
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
    <tbody>';
        while ($dados = mysqli_fetch_array($result)) {
            $nome = $dados['nome'];
            $email = $dados['emailUsuario'];
            $telefone = $dados['numeroContato'];
            $assunto = $dados['assunto'];
            $id = $dados['idTicket'];

            echo '<tr>
    <a><td>' . $nome . '</td></a>
    <td>' . $email . '</td>
    <td><a>' . $telefone . '</a></td>
    <td>' . $assunto . '</td>
    <td>' . $id . '</td>
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-success" data-title="Responder"><span class="glyphicon glyphicon-search"></span></button></p></td>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary" data-title="Finalizar"><span class="glyphicon glyphicon-ok"></span></button></p></td>

    </tr>';
        }

        echo '</tbody>
</table>
  </div>
  </div>
</div>';
    } else {
        echo "NINGUÉM LOGADO AQUI";
    }
    ?>

</main>
<?php
require "footer.php";

?>
