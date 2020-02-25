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
  if ($_SESSION['tipo'] == 'suporte') {
    session_start();
    $sql = "SELECT users.nome, users.idUsers, emailUsuario, numeroContato, idChamado, assunto, textoTicket, idTicket, estadoTicket FROM tickets INNER JOIN users ON(users.idUsers =tickets.idUsuario) where estadoTicket < 3 AND (estadoTicket > 0)";
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
      while ($dados = mysqli_fetch_array($result)){
        $nome = $dados['nome'];
        $email = $dados['emailUsuario'];
        $telefone = $dados['numeroContato'];
        $assunto = $dados['assunto'];
        $id = $dados['idTicket'];
        $estadoTicket = $dados['estadoTicket'];
        $id_chamado = $dados['idChamado'];


      echo '<tr>
      <a><td>'.$nome.'</td></a>
      <td>'.$email.'</td>
      <td>'.$telefone.'</td>
      <td>'.$assunto.'</td>
      <td>'.$id.'</td>';

      if ($estadoTicket == 1) {
        echo '<td><a href="suporte.php?id='.$id.'>" method="post" data-placement="left" data-toggle="tooltip" title="Responder"><button class="btn btn-success" data-title="Responder"><span class="glyphicon glyphicon-search"></span></button></p></td>';
      }else if ($estadoTicket == 2) {
        echo '<td><a href="resposta.php?idchamado='.$id_chamado.'&id='.$id.'>" method="post" data-placement="left" data-toggle="tooltip" title="Reaberto"><button class="btn btn-danger" data-title="Reaberto"><span class="glyphicon glyphicon-refresh"></span></button></p></td>';
      }
      if ($estadoTicket == 1) {
        echo ' <td><form action="includes/desativa.inc.php" method="post">
                      <a title="Finalizar">
                        <input type="hidden" name="id_ticket" value="'.$id.'>" />
                      </a>
                      <button class="btn btn-primary" type="submit" name="desativa-submit" data-title="Finalizar">
                            <span class="glyphicon glyphicon-ok"></span>
                      </button>
                    </form>

              </td>';
      }elseif ($estadoTicket == 2) {
        echo ' <td><form action="includes/desativa.inc.php" method="post">
                      <a title="Finalizar">
                        <input type="hidden" name="id_ticket" value="'.$id.'"/>
                      </a>
                      <button class="btn btn-primary" type="submit" name="desativa-submit" data-title="Finalizar">
                            <span class="glyphicon glyphicon-ok"></span>
                      </button>
                    </form>

              </td>';
      }




    }





      echo '</tbody>

  </table>



          </div>
  	</div>
  </div>';
}elseif ($_SESSION['tipo'] == 'user'){
  session_start();
  $sql = "SELECT u.nome, u.idUsers, emailUsuario, t.idChamado, numeroContato, assunto, textoTicket, idTicket, estadoTicket FROM tickets as t INNER JOIN users as u ON (u.idUsers = t.idUsuario) WHERE estadoTicket < 3 AND (estadoTicket >= 0)";
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
                    <th>Finalizar</th>
                    <th>Visualizar</th>
                   </thead>
    <tbody>';
    while ($dados = mysqli_fetch_array($result)){
      $nome = $dados['nome'];
      $email = $dados['emailUsuario'];
      $telefone = $dados['numeroContato'];
      $assunto = $dados['assunto'];
      $id = $dados['idTicket'];
      $estadoTicket = $dados['estadoTicket'];
      $id_chamado = $dados['idChamado'];


    echo '<tr>
    <a><td>'.$nome.'</td></a>
    <td>'.$email.'</td>
    <td>'.$telefone.'</td>';
    if ($id_chamado == null) {
      echo'<td>'.$assunto.'</td>';
    }else {
      echo'<td><a href="historico.php?id='.$id_chamado.'">'.$assunto.'</a></td>';
    }
echo '<td>'.$id.'</td>';
    if ($estadoTicket == 3) {
      echo '<td><p data-placement="" data-toggle="tooltip" title="">FINALIZADO</p></td>';
    }else if($estadoTicket == 1) {
      echo ' <td><form action="includes/desativa.inc.php" method="post">
                    <a title="Finalizar">
                      <input type="hidden" name="id_ticket" value="'.$id.'>" />
                    </a>
                    <button class="btn btn-primary" type="submit" name="desativa-submit" data-title="Finalizar">
                          <span class="glyphicon glyphicon-ok"></span>
                    </button>
                  </form>

            </td>';

    }elseif ($estadoTicket == 2) {
      echo ' <td><form action="includes/desativa.inc.php" method="post">
                    <a title="Finalizar">
                      <input type="hidden" name="id_ticket" value="'.$id.'>" />
                    </a>
                    <button class="btn btn-primary" type="submit" name="desativa-submit" data-title="Finalizar">
                          <span class="glyphicon glyphicon-ok"></span>
                    </button>
                  </form>

            </td>';
    }


    else if ($estadoTicket == 0) {
        echo '<td><p data-placement="left" data-toggle="tooltip" title="">FINALIZADO</p></td>';
    }
    if ($estadoTicket == 3) {
      echo '<td> <a href="resposta.php?id='. $id_chamado .'" data-placement="left" data-toggle="tooltip" title="Visualizar"><button class="btn btn-success" data-title="Visualizar"><span class="glyphicon glyphicon-search"></span></button></a></td>

      </tr>';
    }else if ($estadoTicket == 0) {
      echo ' <td><form action="includes/reativa.inc.php" method="post">
                    <a title="Reativar">
                      <input type="hidden" name="id_ticket" value="'.$id.'>" />
                    </a>
                    <button class="btn btn-info" type="submit" name="reativa-submit" data-title="Finalizar">
                          <span class="glyphicon glyphicon-refresh"></span>
                    </button>
                  </form>

            </td>';
    }else {
      echo '<td><p data-placement="left" data-toggle="tooltip" title="">EM ESPERA</p></td>';
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
