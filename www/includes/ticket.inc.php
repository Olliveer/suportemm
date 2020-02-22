<?php
if (isset($_POST['new-tickt-submit'])) {
    require 'dbh.inc.php';
    session_start();

    $email = $_SESSION['email'];
    $id_usuario = $_SESSION['userId'];
    $nome = $_SESSION['nome'];
    $assunto = $_POST['assunto_form_ticket'];
    $telefone = $_POST['telefone_form_ticket'];
    $msg = $_POST['msg_form_ticket'];

    if (empty($telefone) || empty($assunto) || empty($msg)) {
        header("Location: ../index.php?error=Camposvazios");
        exit();
    } else {
        $sql = "SELECT t.idUsuario,u.idUsers, u.nome,t.assunto from tickets as t inner join users as u on(t.idUsuario=u.idUsers) where t.assunto=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
          }else{
            mysqli_stmt_bind_param($stmt, "s", $assunto);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../index.php?error=assuntorepetido" . $assunto);
                exit();
              }else {
                $sql = "INSERT INTO tickets (idUsuario, emailUsuario, assunto, textoTicket, numeroContato, estadoTicket) VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
              }else {
                // 1 para novo ---  2 para resolvido
                $estado = 1;
                mysqli_stmt_bind_param($stmt, "ssssss", $id_usuario, $email, $assunto, $msg, $telefone, $estado);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?nonvoticket=success");
                exit();
              }

            }
}
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}else {
      header("Location: ../signup.php");
      exit();
  }
