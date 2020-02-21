<?php
require "header.php";
?>
<?php
require 'includes/dbh.inc.php';
session_start();

$id_usuario = $_SESSION['userId'];
var_dump($id_usuario);


$sql = "SELECT users.nome, users.idUsers, emailUsuario, numeroContato, assunto, textoTicket, idTicket FROM tickets INNER JOIN users ON  users.idUsers =?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($result);

  }

?>




<main>

  <h1>Lista</h1>
  <table id="mytable" class="table table-bordred table-striped">

                   <thead>
                   <th>Nome</th>
                    <th>E-mail</th>
                     <th>Telefone</th>
                     <th>Assunto</th>
                     <th>ID Ticket</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>



<?php
  while ($dados = mysqli_fetch_array($result)){
    $nome = $dados['nome'];
    $email = $dados['emailUsuario'];
    $telefone = $dados['numeroContato'];
    $assunto = $dados['assunto'];
    $id = $dados['idTicket'];

 ?>
<tbody>
  <tr>
     <td><?= $nome ?></td>
     <td><?= $email ?></td>
     <td><?= $telefone ?></td>
     <td><?= $assunto ?></td>
     <td><?= $id ?></td>
     <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
     <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
  </tr>
  <?php
  }
   ?>
</tbody>

</table>




</main>


<?php
require "footer.php";
?>
