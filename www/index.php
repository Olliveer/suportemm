<?php
require "header.php";

?>


<main>

<?php

  if ($_SESSION['tipo']=='suporte') {
    session_start();
    echo '<div class="container">
  	<div class="row">


          <div class="col-md-12">
          <h4>Bootstrap Snipp for Datatable</h4>
          <div class="table-responsive">


                <table id="mytable" class="table table-bordred table-striped">

                     <thead>

                     <th><input type="checkbox" id="checkall" /></th>
                     <th>First Name</th>
                      <th>Last Name</th>
                       <th>Address</th>
                       <th>Email</th>
                       <th>Contact</th>
                        <th>Edit</th>

                         <th>Delete</th>
                     </thead>
      <tbody>

      <tr>
      <td><input type="checkbox" class="checkthis" /></td>
      <td>Mohsin</td>
      <td>Irshad</td>
      <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
      <td>isometric.mohsin@gmail.com</td>
      <td>+923335586757</td>
      <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
      <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
      </tr>





      </tbody>

  </table>

  <div class="clearfix"></div>
  <ul class="pagination pull-right">
    <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
  </ul>

              </div>

          </div>
  	</div>
  </div>


  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
        </div>
            <div class="modal-body">
            <div class="form-group">
          <input class="form-control " type="text" placeholder="Mohsin">
          </div>
          <div class="form-group">

          <input class="form-control " type="text" placeholder="Irshad">
          </div>
          <div class="form-group">
          <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


          </div>
        </div>
            <div class="modal-footer ">
          <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
        </div>
          </div>
      <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
      </div>



      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
        </div>
            <div class="modal-body">

         <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

        </div>
          <div class="modal-footer ">
          <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
        </div>
          </div>
      <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
      </div>


  </main>';     // ->  CRIAR CADASTRO DE TIPO DE USER PARA SUPORTE
}elseif ($_SESSION['tipo'] == 'user'){
  session_start();
  $nome = $_SESSION['nome'];
  echo '<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
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
}else {
  echo "NINGUÉM LOGADO AQUI";
}
?>


<?php
require "footer.php";

 ?>
