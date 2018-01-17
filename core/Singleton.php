<?php

namespace Core;

/**
 * Définit le comportement (l'ensemble des méthodes publiques) d'une classe
 * Singleton.
 *
 * @author Thomas SAYER & Emmanuel PEREZ
 * @version 0.1
 */
interface Singleton {

	/**
	 * Retourne l'instance Singleton de la classe ou en crée une nouvelle si
	 * aucune einstance n'existe.
	 * 
	 * @return mixed
	 */
	public function getInstance();

}