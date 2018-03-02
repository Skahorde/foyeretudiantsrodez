<?php

namespace App\Controllers;

use App\Models\Animation;
use App\Models\File;

/**
 * Gère les actions effectuées sur la page / section des animations.
 * 
 * @version 0.1
 */
class AnimationsController extends Controller {

	/**
	 * Entrepôt de données contenant l'ensemble des animations.
	 * 
	 * @var \App\Repositories\AnimationRepository
	 */
	private $animations;

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

		$this->animations = \App\Repositories\AnimationRepository::getInstance();
		$this->storage    = \App\Repositories\StorageRepository::getInstance();
	}

	/**
	 * Affiche à l'écran la section des animations sur le One Page.
	 */
	public function section()
	{
		$animations = $this->animations->latest();

		$this->display('website/animations', [
			'animations' => $animations,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration des animations.
	 */
	public function administration()
	{
		$animations = $this->animations->latest();

		$this->display('administration/animations', [
			'animations' => $animations,
		]);
	}

	/**
	 * Crée une nouvelle animation dans la base de données.
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

		$animation = new Animation([
			'title'       => $this->request['title'],
			'description' => $this->request['description'],
			'picture_url' => $picture->url,
			'page_id'     => 1,
		]);

		$animation = $this->animations->create($animation);

		if ($animation === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la création de l'animation !", 500);
		}

		$this->response($animation);
	}

	/**
	 * Supprime une animation de la base de données.
	 */
	public function delete()
	{
		$this->validate([
			'id' => [
				'required' => true,
				'in'       => $this->animations,
			],
		]);

		$animation = $this->animations->find($this->request['id']);

		if ($this->animations->destroy($this->request['id']) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la suppression de l'animation !", 500);
		}

		$picture = new File(
			str_replace(
				'http://' . $_SERVER['SERVER_NAME'],
				$_SERVER['DOCUMENT_ROOT'],
				$animation->picture_url
			)
		);

		if ($this->storage->destroy($picture->filepath) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la suppression de l'image sur le serveur !", 500);
		}
	}
}