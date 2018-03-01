<?php

namespace App\Controllers;

/**
 * Gère les actions effectuées sur la page / section d'accueil.
 * 
 * @version 0.1
 */
class HomeController extends Controller {

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
	 * Affiche à l'écran la section d'accueil sur le One Page.
	 */
	public function section()
	{
		$page = $this->pages->latestHome();

		$this->display('website/home', [
			'home_description' => $page->home_description,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration de l'accueil.
	 */
	public function administration()
	{
		$page = $this->pages->latestHome();

		$this->display('administration/home', [
			'home_description' => $page->home_description,
		]);
	}

	/**
	 * Modifie les informations de la section d'accueil dans la base de données.
	 */
	public function update()
	{
		$this->validate([
			'home_description' => [ 'required' => true ],
		]);

		$this->pages->update(1, [
			'home_description' => $this->request['home_description'],
		]);
	}
}