<?php
require "header.php";

?>

<?php
require 'includes/dbh.inc.php';
session_start();

$id_usuario = $_SESSION['userId'];
?>



<main>

  <?php
  if ($_SESSION['tipo']=='suporte') {
    session_start();
    $sql = "SELECT COUNT(idTicket) as total  FROM tickets";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $total = $row['total'];
      echo $total;

    }
