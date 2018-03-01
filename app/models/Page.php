<?php

namespace App\Models;

/**
 * Permet la représentation des versions du One Page.
 *
 * @version 0.1
 */
class Page extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'home_description',
		'home_alert',
		'student_home_description',
		'student_home_rooms_number',
		'student_home_start_date',
		'student_home_end_date',
		'student_home_optional_text',
		'animations_description',
		'cost_per_week',
		'fees',
		'guarantee',
		'contact_phone_number',
		'contact_facebook',
		'contact_email',
		'created_the',
		'user_id',
	];
}
