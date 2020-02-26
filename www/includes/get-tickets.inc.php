<?php
require 'dbh.inc.php';
session_start();

$id_usuario = $_SESSION['idUsers'];


$sql = "SELECT users.nome, emailUsuario, numeroContato, assunto, textoTicket, idTicket FROM tickets INNER JOIN users ON  tickets.idUsuario = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "i", $id_usuario);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $tickets = mysqli_fetch_array($result);


  while($tickets = mysqli_fetch_array($resultado)){
    $nome = $dados['nome'];
    $email = $dados['emailUsuario'];
    $telefone = $dados['numeroContato'];
    $assunto = $dados['asunto'];
    $id = $dados['idTicket'];


    var_dump( $tickets);





    ?>
