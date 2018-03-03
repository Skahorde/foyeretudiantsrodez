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

	<ul id="administration_nav" class="nav-stacked">
		<li class="brand">
			Le Foyer St-Pierre <br>
			<small>Page d'administration</small>
		</li>
		<li class="active">
			<a href="view:home">
				<i class="fa fa-home"></i>&nbsp;&nbsp;
				Accueil
			</a>
		</li>
		<li>
			<a href="view:student_home">
				<i class="fa fa-bed"></i>&nbsp;&nbsp;
				Le Foyer
			</a>
		</li>
		<li>
			<a href="view:animations">
				<i class="fa fa-gamepad"></i>&nbsp;&nbsp;
				Les animations
			</a>
		</li>
		<li>
			<a href="view:places">
				<i class="fa fa-street-view"></i>&nbsp;&nbsp;
				Les lieux
			</a>
		</li>
		<li>
			<a href="view:feedbacks">
				<i class="fa fa-comments-o"></i>&nbsp;&nbsp;
				L'avis des étudiants
			</a>
		</li>
		<li>
			<a href="view:prices">
				<i class="fa fa-credit-card"></i>&nbsp;&nbsp;
				Les tarifs
			</a>
		</li>
		<li>
			<a href="view:contacts">
				<i class="fa fa-address-book-o"></i>&nbsp;&nbsp;
				Contacts
			</a>
		</li>
		<li class="sign-out">
			<a title="Se déconnecter">
				<i class="fa fa-power-off"></i>&nbsp;&nbsp;
				Se déconnecter
			</a>
		</li>
	</ul>

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/app.js"></script>
	<script type="text/javascript" src="public/js/administration/administration.js"></script>

	<div id="content"></div>

</body>
</html>
