<?php

namespace App\Controllers;

use App\Models\Feedback;
use App\Models\File;

/**
 * Gère les actions effectuées sur la page / section des avis.
 * 
 * @version 0.1
 */
class FeedbacksController extends Controller {

	/**
	 * Entrepôt de données contenant l'ensemble des lieux.
	 * 
	 * @var \App\Repositories\FeedbackRepository
	 */
	private $feedbacks;

	/**
	 * Construit une nouvelle instance du contrôleur.
	 * 
	 * @param array $request
	 */
	public function __construct(array $request = [ ])
	{
		parent::__construct($request);

		$this->feedbacks = \App\Repositories\FeedbackRepository::getInstance();
	}

	/**
	 * Affiche à l'écran la section des avis sur le One Page.
	 */
	public function section()
	{
		$feedbacks = $this->feedbacks->latest();

		$this->display('website/feedbacks', [
			'feedbacks' => $feedbacks,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration des avis.
	 */
	public function administration()
	{
		$feedbacks = $this->feedbacks->latest();

		$this->display('administration/feedbacks', [
			'feedbacks' => $feedbacks,
		]);
	}

	/**
	 * Crée un nouvel avis dans la base de données.
	 */
	public function create()
	{
		$this->validate([
			'first_name' => [ 'required' => true ],
			'content'    => [ 'required' => true ],
		]);

		$feedback = new Feedback([
			'first_name' => $this->request['first_name'],
			'content'    => $this->request['content'],
			'page_id'    => 1,
		]);

		$feedback = $this->feedbacks->create($feedback);

		if ($feedback === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la création de l'avis !", 500);
		}

		$this->response($feedback);
	}

	/**
	 * Supprime un avis de la base de données.
	 */
	public function delete()
	{
		$this->validate([
			'id' => [
				'required' => true,
				'in'       => $this->feedbacks,
			],
		]);

		$feedback = $this->feedbacks->find($this->request['id']);

		if ($this->feedbacks->destroy($this->request['id']) === false)
		{
			$this->response("Une erreur innatendue s'est produite lors de la suppression de l'avis !", 500);
		}
	}
}