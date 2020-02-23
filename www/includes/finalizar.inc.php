<?php

if (isset($_POST['reposta-ticket-submit'])) {
    require 'dbh.inc.php';
    session_start();
    // 3 para finalizado
    $estado = 3;
    $msg = $_POST['msg_form_ticket'];
    $id = $_POST['id_ticket'];
    $id_suporte = $_SESSION['userId'];
    $texto_usuario = $_POST['texto_usuario'];


    if (empty($msg)) {
        header("Location: ../suporte.php?error=emptyfields=" . $msg);
        exit();
    } else {
        $sql = "SELECT estadoTicket FROM tickets WHERE estadoTicket=? AND idTicket =?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../suporte.php?error=sqlselecterror");
            exit();
        } else {
            $sqlUpdate = "UPDATE tickets set idChamado=?, estadoTicket=?, idSuporte=?, resposta=? where idTicket=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
                header("Location: ../index.php?error=sqlupdateterror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iiisi",$id, $estado, $id_suporte, $msg, $id);
                mysqli_stmt_execute($stmt);

                header("Location: ../lista.php?resposta=success");
                exit();

            }
        }
}
} else if (isset($_POST['reabre-chamado-submit'])) {
    require 'dbh.inc.php';
  session_start();
  // 3 para finalizado
  $estado = 3;
  $msg = $_POST['msg_form_ticket'];
  $id = $_POST['id_ticket'];
  $id_suporte = $_SESSION['userId'];
  $texto_usuario = $_POST['texto_usuario'];

  if (empty($msg)) {
      header("Location: ../suporte.php?error=emptyfields=" . $msg);
      exit();
  } else {
      $sql = "SELECT estadoTicket FROM tickets WHERE estadoTicket=? AND idTicket =?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../suporte.php?error=sqlselecterror");
          exit();
      } else {
          $sqlUpdate = "UPDATE tickets set estadoTicket=?, idSuporte=?, resposta=? where idTicket=?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
              header("Location: ../index.php?error=sqlupdateterror");
              exit();
          } else {
              mysqli_stmt_bind_param($stmt, "iisi", $estado, $id_suporte, $msg, $id);
              mysqli_stmt_execute($stmt);

              header("Location: ../lista.php?resposta=success");
              exit();

          }
      }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  } else {
    header("Location: ../index.php");
    exit();
}
