<?php
require 'header.php';

?>
<?php

if (isset($_GET["signup"])) {
  if ($_GET["signup"] == "success") {
    echo '<p class="aviso">Cadastro feito com sucesso!</p>';
  }
}

if (isset($_GET["error"])) {
  if ($_GET["error"] == "wrongpwd") {
    echo '<p class="aviso">Erro password!</p>';
  }elseif ($_GET['error'] == "nouser") {
    echo '<p class="aviso">Usuário não existe!</p>';
  }
}


session_start();

if(!$_SESSION['tipo'] == 'suporte'){

}
require 'includes/dbh.inc.php';
//-- qtd novos chamados
$sql = "SELECT COUNT(*) AS qtd_chamados FROM tickets  WHERE estadoTicket > 0 AND (estadoTicket < 3)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  $qtd_chamados = 0;
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);
  $qtd_chamados = $row['qtd_chamados'];

}

//-- chamados a mais de um dia sem resposta
$sql = "SELECT  COUNT(*) AS qtd_expirado FROM tickets where estadoTicket > 0  AND(estadoTicket <3 and DATEDIFF(dataCriacao, CURDATE()))";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  $expira = 0;
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);
  $expira = $row['qtd_expirado'];

}

//-- chamados finalizados
$sql = "SELECT COUNT(*) AS qtd_finalizados FROM tickets  WHERE estadoTicket = 3";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  $finalizados = 0;
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);
  $finalizados = $row['qtd_finalizados'];

}

//-- chamados reabertos
$sql = "SELECT COUNT(*) AS qtd_reabertos FROM tickets as t INNER JOIN users as u ON (t.idUsuario=u.idUsers) where t.estadoTicket = 2 AND(u.tipoUsuario = 'user')";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  $reabertos = 0;
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_array($result);
  $reabertos = $row['qtd_reabertos'];

}

$sql = "SELECT u.nome, t.idTicket, t.idChamado, t.estadoTicket, t.assunto, DATEDIFF(t.dataCriacao, CURDATE()) as expira_data FROM users as u INNER JOIN tickets as t ON(t.idUsuario=u.idUsers) ORDER BY t.dataCriacao ASC";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  $expira_date = 0;
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

}
?>

<main>
  <?php
  if($_SESSION['tipo'] == 'suporte'){
    echo'
    <main>
    <div class="container-fluid">
    <!-- Info box-->
    <div class="row">
    <div class="col-12 col-sm-3 col-md-3">
    <div class="info-box">
    <span class="info-box-icon info-new elevation-1"><i class="glyphicon glyphicon-plus"></i></span>

    <div class="info-box-content">
    <span class="info-box-text">Novos Chamados</span>
    <span class="info-box-number">
    '.$qtd_chamados.'
    </span>
    </div>
    </div>
    </div>
    <!-- Info box-->
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon info-danger  elevation-1"><i class="glyphicon glyphicon-warning-sign"></i></span>
    <div class="info-box-content ">
    <span class="info-box-text">Em Espera</span>
    <span class="info-box-number">'.$expira.'</span>
    </div>
    </div>
    </div>
    <!-- Info box-->
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon info-users elevation-1"><i class="glyphicon glyphicon-refresh"></i></span>

    <div class="info-box-content">
    <span class="info-box-text">Chamados Reabertos</span>
    <span class="info-box-number">'.$reabertos.'</span>
    </div>
    </div>
    </div>
    <!-- Info box-->
    <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
    <span class="info-box-icon info-ok elevation-1"><i class="glyphicon glyphicon-ok"></i></span>

    <div class="info-box-content">
    <span class="info-box-text">Total Finalizados</span>
    <span class="info-box-number">'.$finalizados.'</span>
    </div>
    </div>
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
    </div>
    <div class="row">
    <!-- TABLE  -->
    <div class="panel panel-default">
    <div class="table-responsive">
    <table class="table m-0">
    <thead>
    <tr>
    <th>Ticket ID</th>
    <th>Assunto</th>
    <th>Status</th>
    <th>Nome Usúario</th>
    <th>Visualizar</th>
    </tr>
    </thead>
    <tbody>';

    while ($dados = mysqli_fetch_array($result)) {
      $id = $dados['idTicket'];
      $assunto = $dados['assunto'];
      $nome_usuario = $dados['nome'];
      $expira_date = $dados['expira_data'];
      $estadoTicket = $dados['estadoTicket'];
      $id_chamado = $dados['idChamado'];
      $expira_date *=-1;

      echo '<tr>
      <td>'.$id.'</td>
      <td>'.$assunto.'</td>';
      if ($expira_date == 1 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-warning">Há um dia</span></td>';
      }elseif ($expira_date == 3 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há três dias</span></td>';
      }elseif ($expira_date == 4 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há quatro dias</span></td>';
      }elseif ($expira_date == 5 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há cinco dias</span></td>';
      }elseif ($expira_date == 6 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há seis dias</span></td>';
      }elseif ($expira_date == 7 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há sete dias</span></td>';
      }elseif ($expira_date == 0 && $estadoTicket == 1) {
        echo'<td><span class="badge badge-info">Novo Ticket</span></td>';
      }elseif ($expira_date == 2 && $estadoTicket == 1 ) {
        echo '<td><span class="badge badge-danger">Há dois dias</span></td>';
      }elseif ($expira_date >= 0 && $estadoTicket == 2) {
        echo'<td><span class="badge badge-warning">Reaberto</span></td>';
      }else {
        echo'<td><span class="badge badge-success">Finalizado</span></td>';
      }

      echo'<td>'.$nome_usuario.'</td>';
      if ($estadoTicket != 1 && $estadoTicket != 2) {
        echo'<td><a href="historico.php?id='.$id_chamado.'" class="btn btn-primary btn-cadastro"> <span class="glyphicon glyphicon-ok"></span></a></td>';
      }elseif ($estadoTicket == 2) {
        echo'<td>REABERTO</td>';
      }
      else {
        echo'<td>AGUARDANDO</td>';
      }
      echo '</tr>';
    }
    echo' </tbody>
    </table>
    </div>
    <!-- /.table-responsive -->
    </div>
    </div>
    </div>
    </main>';

  } else if($_SESSION['tipo'] == 'user'){
    session_start();
    $id_usuario = $_SESSION['userId'];
    $sql = "SELECT u.nome, t.idTicket, DATE_FORMAT(t.dataCriacao, '%d %b %Y %T') AS Data, t.estadoTicket, t.assunto, DATEDIFF(t.dataCriacao, CURDATE()) as expira_data FROM users as u INNER JOIN tickets as t ON(t.idSuporte=u.idUsers AND(u.tipoUsuario= 'suporte')) WHERE t.idUsuario=?  ORDER BY t.dataCriacao ASC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      $expira_date = 0;
      mysqli_stmt_bind_param($stmt, "i", $id_usuario);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    echo'
    <main>
    <!-- TABLE  -->
    <div class="panel panel-default">
    <div class="table-responsive">
    <table class="table m-0">
    <thead>
    <tr>
    <th>Ticket ID</th>
    <th>Assunto</th>
    <th>Status</th>
    <th>Data</th>
    </tr>
    </thead>
    <tbody>';

    while ($dados = mysqli_fetch_array($result)) {
      $id = $dados['idTicket'];
      $assunto = $dados['assunto'];
      $nome_usuario = $dados['nome'];
      $expira_date = $dados['expira_data'];
      $estadoTicket = $dados['estadoTicket'];
      $data = $dados['Data'];
      $expira_date *=-1;

      echo '<tr>
      <td>'.$id.'</td>';
      if ($estadoTicket == 3) {
        echo'<td><a href="historico.php?id='.$id.'">'.$assunto.'</a></td>';
      }else {
        echo'  <td><a href="suporte.php?id='.$id.'">'.$assunto.'</a></td>';
      }
      if ($expira_date == 1 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-warning">Há um dia</span></td>';
      }elseif ($expira_date == 3 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há três dias</span></td>';
      }elseif ($expira_date == 4 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há quatro dias</span></td>';
      }elseif ($expira_date == 5 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há cinco dias</span></td>';
      }elseif ($expira_date == 6 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há seis dias</span></td>';
      }elseif ($expira_date == 7 && $estadoTicket == 1) {
        echo '<td><span class="badge badge-danger">Há sete dias</span></td>';
      }elseif ($expira_date == 0 && $estadoTicket == 1) {
        echo'<td><span class="badge badge-info">Novo Ticket</span></td>';
      }elseif ($expira_date == 2 && $estadoTicket == 1 ) {
        echo '<td><span class="badge badge-danger">Há dois dias</span></td>';
      }elseif ($expira_date == 0 && $estadoTicket == 2) {
        echo'<td><span class="badge badge-warning">Reaberto</span></td>';
      }else {
        echo'<td><span class="badge badge-success">Finalizado</span></td>';
      }

      echo'<td>'.$data.'</td>
      </tr>';
    }

    echo' </tbody>
    </table>
    </div>
    <!-- /.table-responsive -->
    </div>

    </div>';

  }else {
    echo'
    <div class="header" id="header">
    <!--header-start-->
    <div class="container">
    <figure class="logo animated fadeInDown delay-07s">
    <a href="#"><img src="assets/img/logo.png" alt=""></a>
    </figure>
    <h1 class="animated fadeInDown delay-07s">Bem Vindo ao Suporte</h1>
    <ul class="we-create animated fadeInUp delay-1s">
    <li>Cadastra-se para começar a usar.</li>
    </ul>
    <a class="btn btn-login link animated fadeInUp delay-1s servicelink" href="signup.php">Começar</a>
    </div>
    </div>';
  }
  ?>
</main>
<?php
require 'footer.php';

?>
