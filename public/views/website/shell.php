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

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/app.js"></script>
	<script type="text/javascript" src="public/js/website/page-scroll.js"></script>

  	<?php (new \App\Controllers\HomeController())->section() ?>
  	<?php include __DIR__ . '/navbar.php' ?>
  	<?php (new \App\Controllers\StudentHomeController())->section() ?>
  	<?php (new \App\Controllers\AnimationsController())->section() ?>
  	<?php (new \App\Controllers\PlacesController())->section() ?>
  	<?php (new \App\Controllers\FeedbacksController())->section() ?>
  	<?php (new \App\Controllers\PricesController())->section() ?>
  	<?php include __DIR__ . '/registration.php' ?>
  	<?php (new \App\Controllers\ContactsController())->section() ?>
	<?php include __DIR__ . '/footer.php' ?>

</body>
</html>
