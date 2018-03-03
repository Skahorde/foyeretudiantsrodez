<?php

namespace App\Controllers;

use App\Models\Animation;
use App\Models\File;

/**
 * Gère la déconnexion de l'utilisateur courant..
 * 
 * @version 0.1
 */
class SignOutController extends Controller {

	/**
	 * Déconnecte l'utilisateur courant.
	 */
	public function signOut()
	{
		unset($_SESSION['user']);
		session_destroy();
	}
}