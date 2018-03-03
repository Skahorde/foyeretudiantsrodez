<?php

namespace App\Repositories;

use App\Models\Feedback;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur la table des avis.
 *
 * @version 0.1
 */
class FeedbackRepository extends Repository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\FeedbackRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune instance n'existe.
	 *
	 * @static
	 * @return \App\Repository\FeedbackRepository
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
	 * Récupère les avis de la dernière version du OnePage.
	 * 
	 * @return array
	 */
	public function latest()
	{
		$st = self::$pdo->prepare(
			"SELECT id, content, first_name
			 FROM $this->table
			 WHERE page_id = (
			     SELECT id FROM pages ORDER BY created_the DESC LIMIT 1
			 )"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$feedbacks = $st->fetchAll(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($feedbacks === false)
		{
			return [ ];
		}

		// Transformation de toutes les avis en instances du modèle
		// \App\Models\Feedback.
		foreach ($feedbacks as &$feedback)
		{
			$feedback = new Feedback($feedback);
		}

		return $feedbacks;
	}
}
