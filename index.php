<?php

if (session_id() == '')
{
	session_start();
}

// Permet de contrôler la faille CSRF.
$_SESSION['token'] = md5(uniqid(rand(), true));

// Récupère la configuration de base de l'application.
$app = parse_ini_file(__DIR__ . '/config/app.ini');

// Permet l'auto-chargement des classes.
include __DIR__ . '/core/autoload.php';

if (isset($_GET['page']) && $_GET['page'] == 'administration')
{
	$user = \App\Repositories\UserRepository::getInstance()->getCurrent();

	// Si un utilisateur est connecté.
	if (isset($user))
	{
		include __DIR__ . '/public/views/administration/shell.php';
	}
	else
	{
		include __DIR__ . '/public/views/administration/sign_in.php';
	}
}
else
{
	include __DIR__ . '/public/views/website/shell.php';
}