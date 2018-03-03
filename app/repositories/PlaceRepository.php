<?php

namespace App\Repositories;

use App\Models\Place;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur la table des lieux.
 *
 * @version 0.1
 */
class PlaceRepository extends Repository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\PlaceRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune instance n'existe.
	 *
	 * @static
	 * @return \App\Repository\PlaceRepository
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
	 * Récupère les lieux de la dernière version du OnePage.
	 * 
	 * @return array
	 */
	public function latest()
	{
		$st = self::$pdo->prepare(
			"SELECT id, title, description, picture_url
			 FROM $this->table
			 WHERE page_id = (
			     SELECT id FROM pages ORDER BY created_the DESC LIMIT 1
			 )"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$places = $st->fetchAll(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($places === false)
		{
			return [ ];
		}

		// Transformation de toutes les lieux en instances du modèle
		// \App\Models\Place.
		foreach ($places as &$place)
		{
			$place = new Place($place);
		}

		return $places;
	}
}
