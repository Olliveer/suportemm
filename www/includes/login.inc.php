<?php

if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $email_user = $_POST['login_email'];
    $password = $_POST['login_pwd'];

    if (empty($email_user) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email_user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                $tipo_usuario = $row['tipoUsuario'];
              //  $verifyCheck = $row['verified']; --> Verifica se o email foi verificado na hora do cadastro.



                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                 }
                 //elseif ($verifyCheck == 0) {
                //   header("Location: ../index.php?error=emailverify");
                //   exit();
                //   //&& $verifyCheck == 1
                //}
                else if ($pwdCheck == true) {
                  if ($tipo_usuario == "suporte") {
                    session_start();
                    $_SESSION['email'] = $row['emailUsers'];
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['tipo'] = $row['tipoUsuario'];
                    header("Location: ../home.php?login=success");
                    exit();
                  }elseif($tipo_usuario == "user"){
                    session_start();
                    $_SESSION['email'] = $row['emailUsers'];
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['tipo'] = $row['tipoUsuario'];
                    header("Location: ../home.php?login=success");
                    exit();

                  }
                }  else {
                    header("Location: ../index.php?error=nouser");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
