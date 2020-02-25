<?php
require "header.php";
?>
<?php
session_start();
$nome = $_SESSION['nome'];
echo '<div class="container">
<div class="row">
<div class="col-md-12 ">
<div class="well well-sm">
<form class="form-horizontal" action="includes/ticket.inc.php" method="post">
<fieldset>
<legend class="text-center">Abrir Ticket de Suporte</legend>

<!-- Nome Usuário -->
<div class="form-group">
<label class="col-md-3 control-label" for="assunto_form_ticket">Usúario</label>
<div class="col-md-9">
<h4>'.$nome.'</h4>
</div>
</div>

<!-- Assunto -->
<div class="form-group">
<label class="col-md-3 control-label" for="assunto_form_ticket">Assunto</label>
<div class="col-md-9">
<input id="assunto_form_ticket" name="assunto_form_ticket" type="text" placeholder="Assunto..." class="form-control">
</div>
</div>

<!-- Telefone -->
<div class="form-group">
<label class="col-md-3 control-label" for="telefone_form_ticket">Número Telefone</label>
<div class="col-md-9">
<input id="telefone_form_ticket" name="telefone_form_ticket" type="text" placeholder="Seu número de telefone..." class="form-control">
</div>
</div>

<!-- Menssagem -->
<div class="form-group">
<label class="col-md-3 control-label" for="msg_form_ticket">Menssagem</label>
<div class="col-md-9">
<textarea class="form-control" id="msg_form_ticket" name="msg_form_ticket" placeholder="Digite sua menssagem aqui..." rows="10"></textarea>
</div>
</div>


<div class="form-group">
<div class="col-md-12 text-right">
<button type="submit" name="new-tickt-submit" class="btn btn-primary btn-lg">Enviar</button>
</div>
</div>
</fieldset>
</form>
</div>
</div>
</div>
</div>';

?>

<?php
require 'footer.php'
?>
