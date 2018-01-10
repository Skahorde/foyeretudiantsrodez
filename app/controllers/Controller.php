<?php

namespace App\controllers;

/**
 * Classe mère de tous les contrôleurs.
 * 
 * @author Thomas SAYER & Emmanuel PEREZ
 * @version 0.1
 */
abstract class Controller {

	/**
	* Paramètres de la requête HHTP
	* 
	* @var array
	*/
	protected $request;

	/**
	* Construit une nouvelle instance de la classe Controller.
	* 
	* @param array $request
	*/
	public function __construct(array $request)
	{
		$this->request = $request;
	}

}