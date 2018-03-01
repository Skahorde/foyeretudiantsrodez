<?php

namespace App\Controllers;

/**
 * Gère les actions effectuées sur la page de connexion.
 * 
 * @version 0.1
 */
class SignInController extends Controller {

	/**
	 * Entrepôt de données contenant l'ensemble des utilisateurs.
	 * 
	 * @var \App\Repositories\UserRepository
	 */
	private $users;

	/**
	 * Construit une nouvelle instance du contrôleur.
	 * 
	 * @param array $request
	 */
	public function __construct(array $request = [])
	{
		parent::__construct($request);

		$this->users = \App\Repositories\UserRepository::getInstance();
	}

	/**
	 * Connecte et renvoie l'utilisateur si le login et le mot de passe
	 * correspondent.
	 */
	public function signIn()
	{
		$user = $this->users->find($this->request['id']);

		if (isset($user) && $user->password == sha1($this->request['password']))
		{
			$_SESSION['user'] = serialize($user);
			$this->response($user);
		}
		else
		{
			$this->response("L'identifiant et le mot de passe ne correspondent pas !", 400);
		}
	}
}