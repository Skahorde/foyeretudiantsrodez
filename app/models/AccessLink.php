<?php

namespace App\Models;

/**
 * Permet la représentation d'un lien d'accès en tant qu'objet.
 *
 * @version 0.1
 */
class AccessLink extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'destination',
	];
}
