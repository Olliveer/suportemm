<?php

if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';


    $nome = $_POST['user_cadastro'];
    $email = $_POST['email_cadastro'];
    $password = $_POST['pwd_cadastro'];
    $passwordRepeat = $_POST['pwd_cadastro_repeat'];

    if (empty($nome) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&email=" . $email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $email);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $nome)) {
        header("Location: ../signup.php?error=invaliduid&mail=" . $nome);
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheckuid" . $username . "&email=" . $email);
        exit();
    } else {
        $sql = "SELECT emailUsers FROM users WHERE emailUsers=? ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertake&email=" . $email);
                exit();
            } else {
                $sql = "INSERT INTO users (nome, emailUsers, pwdUsers, vkey) VALUES (?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashPwd =  password_hash($password, PASSWORD_DEFAULT);
                    $vkey = md5(time().$username);
                    mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $hashPwd, $vkey);
                    mysqli_stmt_execute($stmt);
                      // -> Aqui manda email para verificar
                      // $to = $email;
                      // $subject = "Email verification";
                      // $message = "<a href='siteendereço/verify.php?vkey=$vkey'>Resgistro de conta</a>";
                      // $headers = "From: teste@email.com \r\n";
                      // $headers .= "MIME-Version: 1.0" . "\r\n";
                      // $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                      //
                      // mail($to, $subject, $message, $headers);

                      header("Location: ../signup.php?signup=success");
                      exit();

                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}
