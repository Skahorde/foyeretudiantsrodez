<?php

namespace App\Models;

/**
 * Représente un fichier à stocker sur le serveur.
 *
 * @version 0.1
 */
class File extends Model {

	/**
	 * Liste des attributs disponibles en écriture lors de l'instancation du     
	 * modèle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'filename',
		'filepath',
	];

	/**
	 * Construit une nouvelle instance de \App\Models\File.
	 *
	 * @see \App\Models\Model::__construct()
	 * 
	 * @param string $filepath
	 * @param string $filename
	 */
	public function __construct($filepath, $filename = null)
	{
		parent::__construct([
			'filename' => isset($filename) ? $filename : basename($filepath),
			'filepath' => $filepath,
		]);
	}

	/**
	 * Détermine et retourne l'URL du fichier.
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace("\\", '/', $this->filepath));
	}
}
