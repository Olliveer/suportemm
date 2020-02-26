<?php

if (isset($_POST['submit-reabre-ticket'])) {
  require 'dbh.inc.php';
  session_start();
  // 1 para novo
  // 2 para reaberto
  //3 para resolvido
  // 0 para desativado pelo usuario
  $estado = 2;
  $estado_ticket_novo = 3;
  $id_usuario = $_SESSION['userId'];
  $id_ticket = $_POST['id_ticket'];
  $id_suporte = $_POST['id_suporte'];
  $msg_reabertura = $_POST['msg_reabertura_ticket'];
  $id_chamado = $_POST['id_chamado'];
  $email = $_POST['email_usuario'];
  $assunto = $_POST['assunto'];
  $contato = $_POST['contato'];


  $sql = "SELECT * FROM tickets WHERE idTicket =?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../home.php?error=sqlselecterror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "i", $id_ticket);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck == 0) {
      header("Location: ../home.php?error=naoexiste=" . $id_ticket);
      exit();
    } else {
      $sqlUpdate = "UPDATE tickets set estadoTicket=? where idTicket=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
        header("Location: ../index.php?error=sqlupdateterror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "ii", $estado_ticket_novo, $id_ticket);
        mysqli_stmt_execute($stmt);
        $sql = "INSERT INTO tickets (idChamado, idUsuario, emailUsuario, assunto, numeroContato, textoTicket, estadoTicket) VALUES (?, ?, ?, ?, ?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../home.php?error=sqlinserterror");
          exit();
        }else {
          mysqli_stmt_bind_param($stmt, "iissssi", $id_chamado, $id_usuario, $email, $assunto, $contato, $msg_reabertura, $estado);
          mysqli_stmt_execute($stmt);
          header("Location: ../home.php?novo=success");
          exit();
        }
      }
    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
} else {
  header("Location: ../index.php?erro=acesso");
  exit();
}
