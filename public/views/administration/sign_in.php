<!DOCTYPE html>
<html>
<head>
	<title>Le Foyer St-Pierre - Administration</title>
	<meta charset="utf-8">
	<meta name="token" content="<?= $_SESSION['token'] ?>">
	<link rel="stylesheet" type="text/css" href="public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/administration/administration.css">
</head>
<body>

	<section id="sign_in_section">
		
		<div id="sign_in_panel">
			
			<h1>Administration</h1>

			<form id="sign_in_form">

				<div id="error_alert" class="error-alert hidden"></div>
				
				<div class="form-group">
					<input type="text" name="id" placeholder="Identifiant">
				</div>

				<div class="form-group">
					<input type="password" name="password" placeholder="Mot de passe">
				</div>

				<input type="hidden" name="action" value="admin_sign_in">

				<button id="sign_in_button" class="rounded-button">SE CONNECTER</button>

			</form>

			<a id="go_back_button" href="<?= $app['base_url'] ?>"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Retourner sur la page</a>

		</div>

	</section>

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/app.js"></script>
	<script type="text/javascript" src="public/js/administration/administration.js"></script>
	<script type="text/javascript" src="public/js/administration/sign_in.js"></script>

</body>
</html>