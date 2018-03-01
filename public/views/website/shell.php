<!DOCTYPE html>
<html>
<head>
	<title>Le Foyer St-Pierre</title>
	<meta charset="utf-8">
	<meta name="token" content="<?= $_SESSION['token'] ?>">
	<link rel="stylesheet" type="text/css" href="public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/website/website.css">
</head>
<body>

  	<?php include __DIR__ . '/home.php' ?>
	<?php include __DIR__ . '/contacts.php' ?>
	<?php include __DIR__ . '/footer.php' ?>

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/app.js"></script>
	<script type="text/javascript" src="public/js/website/page-scroll.js"></script>
	<script type="text/javascript" src="public/js/website/contacts.js"></script>

</body>
</html>
