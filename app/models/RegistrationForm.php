<?php

namespace App\Models;

/**
 * Représente un formulaire d'inscription.
 *
 * @version 0.1
 */
class RegistrationForm extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'filename',
		'url',
	];
}
