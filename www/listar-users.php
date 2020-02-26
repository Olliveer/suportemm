<?php
  require 'header.php';
 ?>

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
   if ($_SESSION['tipo'] == 'suporte') {
     session_start();
     $sql = "SELECT nome, emailUsers, tipoUsuario, idUsers FROM users";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("Location: ../index.php?error=sqlerror");
         exit();
     } else {
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);


       }
     echo '

     <div class="container">
     <div class"panel panel-default">
   	<div class="row">


           <div class="col-md-12">
           <h4>Usuários</h4>
           <div class="table-responsive">
                 <table id="mytable" class="table table-bordred table-striped">

                      <thead>
                       <th>Nome</th>
                       <th>E-mail</th>
                       <th>ID Usúario</th>
                        <th>Desativar</th>
                       <th>Usuário</th>
                      </thead>
       <tbody>';
       while ($dados = mysqli_fetch_array($result)){
         $nome_usuario = $dados['nome'];
         $email_user = $dados['emailUsers'];
         $id_user = $dados['idUsers'];
         $tipo_user = $dados['tipoUsuario'];


       echo '<tr>
       <a><td>'.$nome_usuario.'</td></a>
       <td>'.$email_user.'</td>
       <td>'.$id_user.'</td>';
       if ($tipo_user == null) {
         echo ' <td><form action="includes/lista-users-admin.inc.php" method="post">
                       <a title="Finalizar">
                         <input type="hidden" name="id_user" value="'.$id_user.'>" />
                       </a>
                       <button class="btn btn-info" type="submit" name="ativa-user" data-title="Desativar">
                            Ativar
                       </button>
                     </form>

               </td>';
       }else {
         echo ' <td><form action="includes/lista-users-admin.inc.php" method="post">
                       <a title="Finalizar">
                         <input type="hidden" name="id_user" value="'.$id_user.'>" />
                       </a>
                       <button class="btn btn-primary" type="submit" name="desativa-user" data-title="Desativar">
                             <span class="glyphicon glyphicon-ok"></span>
                       </button>
                     </form>

               </td>';
       }

               if ($tipo_user == 'user') {
                 echo'<td><form action="includes/lista-users-admin.inc.php" method="post">
                              <a title="Finalizar">
                                <input type="hidden" name="id_user" value="'.$id_user.'"/>
                              </a>
                              <button class="btn btn-info" type="submit" name="admin-submit" data-title="Finalizar">
                                   Suporte?
                              </button>
                            </form>';
               }else if($tipo_user == 'suporte'){
                 echo'<td><form action="includes/lista-users-admin.inc.php" method="post">
                              <a title="Finalizar">
                                <input type="hidden" name="id_user" value="'.$id_user.'"/>
                              </a>
                              <button class="btn btn-primary" type="submit" name="user-submit" data-title="Finalizar">
                                   Usuário?
                              </button>
                            </form>

                      </td>';
               }else if($tipo_user == null){
                 echo'<td>DESATIVADO</td>';
               }







     }





       echo '</tbody>

   </table>

 </div>

           </div>
   	</div>
   </div>';
 }else {
   header("Location: index.php?erro=acessonaoautorizado");
   exit();
 }
 ?>

 </main>
 <?php
 require "footer.php";

  ?>


 <?php
 require 'footer.php';
  ?>
