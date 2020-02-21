<?php

if (isset($_POST["reset-request-submit"])) {

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);


  $url = "https://testereset.000webhostapp.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);


  $expires = date("U") + 1800;

  require 'dbh.inc.php';

  $userEmail = $_POST["email"];

  $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "EROO SQL user email";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "EROO SQL INSERT";
    exit();
  } else {
    $hashToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  $to = $userEmail;

  $subject = 'Reset seu password';

  $message = '<p>Recebemos seu pedido de reset de password, se não foi você quem requisitou é só ignorar!</p>';
  $message .= '<p>Aqui está seu password link: </br>';
  $message .= '<a href="' . $url . '">' . $url . '</a></p>';

  $headers = "From: siteexemplo <site@email.com>\r\n";
  $headers .= "Responder para: email@exemplo.com\r\n";
  $headers .= "Content-type: text/html\r\n";

  mail($to, $subject, $message, $headers);

  header("Location: ../reset-password.php?reset=success");
} else {
  header("Location: ../index.php");
}