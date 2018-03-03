<?php

namespace App\Repositories;

use App\Models\User;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur la table des utilisateurs.
 *
 * @version 0.1
 */
class UserRepository extends Repository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\UserRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune instance n'existe.
	 *
	 * @static
	 * @return \App\Repository\UserRepository
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Récupère et retourne l'utilisateur courant.
	 * 
	 * @return \App\Models\User
	 */
	public function getCurrent()
	{
		if (!isset($_SESSION['user']))
		{
			return null;
		}

		return unserialize($_SESSION['user']);
	}
}
