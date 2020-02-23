<?php

if (isset($_POST['reativa-submit'])) {
    require 'dbh.inc.php';
    session_start();
    // 2 para reaberto
    // 0 para desativado pelo usuario
    $estado = 1;
    $id_ticket = $_POST['id_ticket'];


        $sql = "SELECT estadoTicket FROM tickets WHERE estadoTicket=? AND idTicket =?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../home.php?error=sqlselecterror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $estado, $id_ticket);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../home.php?error=ticketdesativado=" . $estado);
                exit();
            } else {
                $sql = "UPDATE tickets set estadoTicket=? where idTicket=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../home.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ii", $estado, $id_ticket);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../home.php?reativado=success");
                    exit();
                }
            }
        }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../home.php?erro=acesso");
    exit();
}
