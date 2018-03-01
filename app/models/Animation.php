<?php

namespace App\Models;

/**
 * Représente un avis d'étudiant.
 *
 * @version 0.1
 */
class Animation extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'title',
		'description',
		'picture_url',
	];
}
