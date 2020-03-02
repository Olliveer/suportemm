<?php
require "header.php";

?>

<?php
require 'includes/dbh.inc.php';

$id_usuario = $_SESSION['userId'];
?>





<?php
  if ($_SESSION['tipo'] == 'suporte') {
    session_start();
    $sql = "SELECT COUNT(idTicket) as total  FROM tickets";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../adminpanel.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);


      }

    echo '';

}else {
  die("Acesso não autorizado!");
}
?>


<?php
require "footer.php";

 ?>
