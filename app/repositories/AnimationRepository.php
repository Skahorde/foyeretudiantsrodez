<?php

namespace App\Repositories;

use App\Models\Animation;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur la table des animations.
 *
 * @version 0.1
 */
class AnimationRepository extends Repository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\AnimationRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune instance n'existe.
	 *
	 * @static
	 * @return \App\Repository\AnimationRepository
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
	 * Récupère les animations de la dernière version du OnePage.
	 * 
	 * @return array
	 */
	public function latest()
	{
		$st = self::$pdo->prepare(
			"SELECT id, title, picture_url
			 FROM $this->table
			 WHERE page_id = (
			     SELECT id FROM pages ORDER BY created_the DESC LIMIT 1
			 )"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$animations = $st->fetchAll(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($animations === false)
		{
			return [ ];
		}

		// Transformation de toutes les animations en instances du modèle
		// \App\Models\Animation.
		foreach ($animations as &$animation)
		{
			$animation = new Animation($animation);
		}

		return $animations;
	}
}
