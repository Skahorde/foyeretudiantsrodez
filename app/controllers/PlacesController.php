<?php

namespace App\Controllers;

use App\Models\Place;
use App\Models\File;

/**
 * Gère les actions effectuées sur la page / section des lieux.
 * 
 * @version 0.1
 */
class PlacesController extends Controller {

	/**
	 * Entrepôt de données contenant l'ensemble des lieux.
	 * 
	 * @var \App\Repositories\PlaceRepository
	 */
	private $places;

	/**
	 * Entrepôt de données contenant l'ensemble des fichiers stockés.
	 * 
	 * @var \App\Repositories\StorageRepository
	 */
	private $storage;

	/**
	 * Construit une nouvelle instance du contrôleur.
	 * 
	 * @param array $request
	 */
	public function __construct(array $request = [ ], array $files = [ ])
	{
		parent::__construct($request, $files);

		$this->places = \App\Repositories\PlaceRepository::getInstance();
		$this->storage    = \App\Repositories\StorageRepository::getInstance();
	}

	/**
	 * Affiche à l'écran la section des lieux sur le One Page.
	 */
	public function section()
	{
		$places = $this->places->latest();

		$this->display('website/places', [
			'places' => $places,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration des lieux.
	 */
	public function administration()
	{
		$places = $this->places->latest();

		$this->display('administration/places', [
			'places' => $places,
		]);
	}

	/**
	 * Crée un nouveau lieu dans la base de données.
	 */
	public function create()
	{
		$this->validate([
			'title'       => [ 'required' => true ],
			'description' => [ 'required' => true ],
			'picture'     => [ 'file' => true ],
		]);

		$file = $this->storage->incomingFiles($this->files)[0];

		$picture = new File($file['tmp_name'], $file['name']);

		// Si l'image n'a pas correctement été envoyée.
		if ($file['error'] != UPLOAD_ERR_OK)
		{
			$this->response("Une erreur innatendue s'est produite lors du téléchargement de l'image !", 500);
		}

		if ($this->storage->move($picture, realpath(__DIR__ . '/../../storage')) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors du déplacement de l'image !", 500);
		}

		$place = new Place([
			'title'       => $this->request['title'],
			'description' => $this->request['description'],
			'picture_url' => $picture->url,
			'page_id'     => 1,
		]);

		$place = $this->places->create($place);

		if ($place === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la création du lieu !", 500);
		}

		$this->response($place);
	}

	/**
	 * Supprime un lieu de la base de données.
	 */
	public function delete()
	{
		$this->validate([
			'id' => [
				'required' => true,
				'in'       => $this->places,
			],
		]);

		$place = $this->places->find($this->request['id']);

		if ($this->places->destroy($this->request['id']) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la suppression du lieu !", 500);
		}

		$picture = new File(
			str_replace(
				'http://' . $_SERVER['SERVER_NAME'],
				$_SERVER['DOCUMENT_ROOT'],
				$place->picture_url
			)
		);

		if ($this->storage->destroy($picture->filepath) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la suppression de l'image sur le serveur !", 500);
		}
	}
}