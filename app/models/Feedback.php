<?php

namespace App\Models;

/**
 * Représente un avis d'étudiant.
 *
 * @version 0.1
 */
class FeedBack extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'content',
		'first_name',
		'page_id',
	];
}
