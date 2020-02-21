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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
		<nav class="navbar navbar-default">

			<div class="container-fluid">

			    <div class="navbar-header">
			      <a class="navbar-brand" href="index.php">Madeira Madeira</a>
			    </div>


			    <div class="collapse navbar-collapse">
			      <ul class="nav navbar-nav">
			        <li><a href="signup.php">Cadastrar</a></li>
							<li><a href="reset-password.php">Esqueçeu a senha?</a></li>

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

				<button class="btn btn-primary" type="submit" name="login-submit">Login</button>
			</form>';
				}


				?>



			</div>
			</div>

		</nav>

	</header>
