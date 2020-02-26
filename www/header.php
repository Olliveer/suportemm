<?php
session_start();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"  crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">



</head>

<body>
	<!--[if lt IE 7]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Madeira Madeira</a>
				</div>


				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">

						<?php
						if ($_SESSION['tipo']=='suporte') {
							echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Panel <span class="caret"></span></a>
							<ul class="dropdown-menu">
							<li><a href="signup.php?admin=true">Cadastrar Suporte</a></li>
							<li><a href="listar-users.php">Listar Usuario</a></li>
							</ul>
							</li>
							<li><a href="home.php">Tickets</a></li>
							<li><a href="lista.php">Tickets Finalizado</a></li>
							<li><a class="disabled"> Bem vindo: <strong>'.$_SESSION['nome'].'</strong></a></li>';
						}elseif ($_SESSION['tipo'] == 'user') {
							echo '<li><a href="newticket.php">Abrir Ticket</a></li>
							<li><a href="home.php">Tickets</a></li>
							<li><a href="lista.php">Tickets Finalizado</a></li>
							<li><a class="disabled"> Bem vindo: <strong>'.$_SESSION['nome'].'</strong></a></li>';
						}else {
							echo '';
						}

						?>
					</ul>



					<?php

					if (isset($_SESSION['userId'])) {
						echo '<form action="includes/logout.inc.php" method="post" class="navbar-form navbar-right" role="form">
						<button class="btn btn-primary" type="submit" name="logout-submit">Logout</button>
						</form>';
					} else {
						echo '<form action="includes/login.inc.php" method="post" class="navbar-form navbar-right" role="form">
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="email" type="email" class="form-control" name="login_email" value="" placeholder="Email Address">
						</div>
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="login_pwd" class="form-control" placeholder="Password...">
						</div>

						<button class="btn btn-login" type="submit" name="login-submit">Login</button>
						<a href="signup.php" class="btn btn-primary" type="submit" name="">Cadastrar</a>
						</form>
						';
					}


					?>



				</div>
			</div>

		</nav>

	</header>
