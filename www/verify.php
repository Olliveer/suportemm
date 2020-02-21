

          <?php
          require "header.php";

          ?>

          <main>
              <div class="">
                  <section class="">
                      <h1>Email verification</h1>
                      <?php
                      if(isset($_GET["vkey"])){
                        require 'includes/dbh.inc.php';
                         $vkey = $_GET["vkey"];

                         $stmt = mysqli_stmt_init($conn);

                         $sql = "SELECT verified, vkey FROM users WHERE verified=0 AND vkey=? LIMIT 1";
                         if (!mysqli_stmt_prepare($stmt, $sql)) {
                             header("Location: ../signup.php?error=sqlerror");
                             exit();
                           }else {
                             mysqli_stmt_bind_param($stmt, "s", $vkey);
                             mysqli_stmt_execute($stmt);
                             mysqli_stmt_store_result($stmt);
                             $resultCheck = mysqli_stmt_num_rows($stmt);
                             if ($resultCheck == 1) {
                               $sql = "UPDATE users SET verified=1 where vkey=? LIMIT 1";
                               if (!mysqli_stmt_prepare($stmt, $sql)) {
                                   header("Location: ../signup.php?error=sqlerror");
                                   exit();
                                 }else {
                                   mysqli_stmt_bind_param($stmt, "s", $vkey);
                                   mysqli_stmt_execute($stmt);
                                   echo "E-mail verificado";
                             }
                           }else {
                             echo "Conta inválida ou E-mail já verificado...";
                           }


                       }

                     }else {
                         die("Error");
                       }


                      ?>






                  </section>
              </div>
          </main>

          <?php
          require "footer.php";

          ?>
