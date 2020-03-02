<?php
require "header.php";
?>
<?php

$nome = $_SESSION['nome'];
if (isset($_GET["error"])) {
  if ($_GET["error"] == "assuntorepetido") {
    echo '<p class="aviso">Já existe um ticket com esse assunto aberto.</p>';
  }else if ($_GET["error"] == "sqlerror") {
    echo '<p class="aviso">Sql Error</p>';
  }
}



echo '
<form class="form-horizontal" action="includes/ticket.inc.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Novo Ticket</legend>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="nome_user">Nome</label>
<div class="col-md-6">
<h4>'.$nome.'</h4>

</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" for="assunto_form_ticket">Assunto</label>
<div class="col-md-6">
<input name="assunto_form_ticket" class="form-control input-md" id="assunto_form_ticket" required="" type="text" placeholder="Assunto">

</div>
</div>

<!-- Password input-->
<div class="form-group">
<label class="col-md-4 control-label" for="telefone_form_ticket">Telefone</label>
<div class="col-md-6">
<input name="telefone_form_ticket" class="form-control input-md" id="telefone_form_ticket" required="" type="text" placeholder="Número Contato">

</div>
</div>

<!-- Textarea -->
<div class="form-group">
<label class="col-md-4 control-label" for="msg_form_ticket">Menssagem</label>
<div class="col-md-6">
<textarea name="msg_form_ticket" class="form-control" id="msg_form_ticket" rows="6">Digite sua menssagem aqui...</textarea>
</div>
</div>

<!-- Button -->
<div class="form-group">
<label class="col-md-4 control-label" for="new-tickt-submit"></label>
<div class="col-md-4">
<button name="new-tickt-submit" class="btn btn-primary" id="new-tickt-submit">Enviar</button>
</div>
</div>

</fieldset>
</form>';

?>

<?php
require 'footer.php'
?>
