<?php

namespace App\Models;

/**
 * Permet la représentation des lieux sous forme d'objet.
 *
 * @version 0.1
 */
class Place extends Model {

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
		'page_id',
	];
}
