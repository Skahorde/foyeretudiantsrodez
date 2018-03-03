<?php

namespace App\Models;

/**
 * Permet la représentation d'un utilisateur de la page d'administration.
 *
 * @version 0.1
 */
class User extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'first_name',
		'last_name',
		'password',
	];
}
