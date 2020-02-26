<?php

if (isset($_POST['desativa-user'])) {
  require 'dbh.inc.php';
  session_start();
  // 3 para finalizado
  $id = $_POST['id_user'];
  $tipo_user = null;

  $sql = "SELECT tipoUsuario FROM users WHERE idUsers=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../listar-users.php?error=sqlselecterror");
    exit();
  } else {
    $sqlUpdate = "UPDATE users SET tipoUsuario=? WHERE idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
      header("Location: ../listar-users.php?error=sqlupdateterror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "si", $tipo_user, $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../listar-users.php?desativado=success");
      exit();

    }
  }
} if (isset($_POST['ativa-user'])) {
  require 'dbh.inc.php';
  session_start();
  // 3 para finalizado
  $id = $_POST['id_user'];
  $tipo_user = 'user';

  $sql = "SELECT tipoUsuario FROM users WHERE idUsers=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../listar-users.php?error=sqlselecterror");
    exit();
  } else {
    $sqlUpdate = "UPDATE users SET tipoUsuario=? WHERE idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
      header("Location: ../listar-users.php?error=sqlupdateterror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "si", $tipo_user, $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../listar-users.php?desativado=success");
      exit();

    }
  }
} else if (isset($_POST['admin-submit'])) {
  require 'dbh.inc.php';
  session_start();
  // 3 para finalizado
  $id = $_POST['id_user'];
  $tipo_user = 'suporte';

  $sql = "SELECT tipoUsuario from users where idUsers=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../listar-users.php?error=sqlselecterror");
    exit();
  } else {
    $sqlUpdate = "UPDATE users set tipoUsuario=? where idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
      header("Location: ../listar-users.php?error=sqlupdateterror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "si", $tipo_user, $id);
      mysqli_stmt_execute($stmt);

      header("Location: ../listar-users.php?admin=success");
      exit();

    }
  }

}else if (isset($_POST['user-submit'])) {
  require 'dbh.inc.php';
  session_start();
  // 3 para finalizado
  $id = $_POST['id_user'];
  $tipo_user = 'user';

  $sql = "SELECT tipoUsuario from users where idUsers=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../listar-users.php?error=sqlselecterror");
    exit();
  } else {
    $sqlUpdate = "UPDATE users set tipoUsuario=? where idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlUpdate)) {
      header("Location: ../listar-users.php?error=sqlupdateterror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "si", $tipo_user, $id);
      mysqli_stmt_execute($stmt);

      header("Location: ../listar-users.php?admin=success");
      exit();

    }

  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}else {
  header("Location: ../index.php");
  exit();
}
