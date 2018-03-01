<?php

namespace App\Controllers;

/**
 * Gère les actions effectuées sur la page / section des tarifs.
 * 
 * @version 0.1
 */
class PricesController extends Controller {

	/**
	 * Entrepôt de données contenant l'ensemble des versions du One Page.
	 * 
	 * @var \App\Repositories\PageRepository
	 */
	private $pages;

	/**
	 * Construit une nouvelle instance du contrôleur.
	 * 
	 * @param array $request
	 */
	public function __construct(array $request = [])
	{
		parent::__construct($request);

		$this->pages = \App\Repositories\PageRepository::getInstance();
	}

	/**
	 * Affiche à l'écran la section des tarifs sur le One Page.
	 */
	public function section()
	{
		$page = $this->pages->latestPrices();

		$this->display('website/prices', [
			'cost_per_week' => $page->cost_per_week,
			'fees'          => $page->fees,
			'guarantee'     => $page->guarantee,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration des tarifs.
	 */
	public function administration()
	{
		$page = $this->pages->latestPrices();

		$this->display('administration/prices', [
			'cost_per_week' => $page->cost_per_week,
			'fees'          => $page->fees,
			'guarantee'     => $page->guarantee,
		]);
	}

	/**
	 * Modifie les informations de la section d'accueil dans la base de données.
	 */
	public function update()
	{
		$this->validate([
			'cost_per_week' => [ 'required' => true ],
			'fees'          => [ 'required' => true ],
			'guarantee'     => [ 'required' => true ],
		]);

		$this->pages->update(1, [
			'cost_per_week' => $this->request['cost_per_week'],
			'fees'          => $this->request['fees'],
			'guarantee'     => $this->request['guarantee'],
		]);
	}
}