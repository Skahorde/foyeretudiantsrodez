<?php

namespace App\Repositories;

use App\Models\Page;
use Core\Singleton;

/**
 * Représente un entrepôt de données sur la table des versions du One Page.
 *
 * @version 0.1
 */
class PageRepository extends Repository implements Singleton
{
	/**
	 * Instance Singleton.
	 * 
	 * @var \App\Repository\PageRepository
	 */
	private static $instance;

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune einstance n'existe.
	 *
	 * @static
	 * @return \App\Repository\PageRepository
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
	 * Récupère la dernière version de l'accueil à afficher.
	 * 
	 * @return \App\Models\Page
	 */
	public function latestHome()
	{
		$st = self::$pdo->prepare(
			"SELECT home_description
			 FROM $this->table ORDER BY created_the DESC LIMIT 1"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$latest = $st->fetch(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($latest === false)
		{
			return null;
		}

		return new Page($latest);
	}

	/**
	 * Récupère la dernière version de la section "Le Foyer" à afficher.
	 * 
	 * @return \App\Models\Page
	 */
	public function latestStudentHome()
	{
		$st = self::$pdo->prepare(
			"SELECT student_home_description, student_home_rooms_number, student_home_start_date, student_home_end_date, student_home_optional_text
			 FROM $this->table ORDER BY created_the DESC LIMIT 1"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$latest = $st->fetch(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($latest === false)
		{
			return null;
		}

		return new Page($latest);
	}

	/**
	 * Récupère la dernière version des tarifs à afficher.
	 * 
	 * @return \App\Models\Page
	 */
	public function latestPrices()
	{
		$st = self::$pdo->prepare(
			"SELECT cost_per_week, fees, guarantee
			 FROM $this->table ORDER BY created_the DESC LIMIT 1"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$latest = $st->fetch(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($latest === false)
		{
			return null;
		}

		return new Page($latest);
	}

	/**
	 * Récupère la dernière version des contacts à afficher.
	 * 
	 * @return \App\Models\Page
	 */
	public function latestContacts()
	{
		$st = self::$pdo->prepare(
			"SELECT contact_phone_number, contact_facebook, contact_email 
			 FROM $this->table ORDER BY created_the DESC LIMIT 1"
		);
		$st->execute() || print_r(self::$pdo->errorInfo());
		$latest = $st->fetch(\PDO::FETCH_ASSOC);
		$st->closeCursor();

		if ($latest === false)
		{
			return null;
		}

		return new Page($latest);
	}
}
