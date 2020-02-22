<?php

if (isset($_POST['reposta-ticket-submit'])) {
    require 'dbh.inc.php';
    session_start();
    // 2 para resolvido
    $estado = 2;
    $msg = $_POST['msg_form_ticket'];
    $id_ticket = $_SESSION['id'];

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
            mysqli_stmt_bind_param($stmt, "ii", $estado, $id_ticket);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ../suporte.php?error=ticketrespondido=" . $estado);
                exit();
            } else {
                $sql = "UPDATE tickets set reposta=?, estadoTicket=? where idTicket=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../suporte.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sii", $msg, $estado, $id_ticket);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../ticketsok.php?finalizado=success=". $id_ticket);
                    exit();

                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}
