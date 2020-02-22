<?php

if (isset($_POST['submit-reabre-ticket'])) {
    require 'dbh.inc.php';
    session_start();
    // 1 para novo
    // 2 para resolvido
    //3 para reaberto
    // 0 para desativado pelo usuario
    $estado = 1;
    $id_usuario = $_SESSION['userId'];
    $id_ticket = $_POST['id_ticket'];
    $id_suporte = $_POST['id_suporte'];
    $msg_resposta_suporte = $_POST['id_resposta_suporte'];
    $msg_reabertura = $_POST['msg_reabertura_ticket'];


        $sql = "SELECT * FROM tickets WHERE idTicket =?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../suporte.php?error=sqlselecterror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $id_ticket);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck === 0) {
                header("Location: ../index.php?error=naoexiste=" . $id_ticket);
                exit();
            } else {
                $sqlUpdate = "UPDATE tickets set estadoTicket=? where idTicket=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
                    header("Location: ../index.php?error=sqlupdateterror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ii", $estado, $id_ticket);
                    mysqli_stmt_execute($stmt);
                    $sql = "INSERT INTO ticketsResposta(idTicket,idUsers,idSuporte,suporteResposta,textoTicket) VALUES(?, ?, ?, ?, ?);";
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../index.php?error=sqlinserterror");
                        exit();
                    }else {
                    mysqli_stmt_bind_param($stmt, "iiiss", $id_ticket, $id_usuario, $id_suporte, $msg_resposta_suporte, $msg_reabertura);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?reativado=success");
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
