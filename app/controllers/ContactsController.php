<?php

namespace App\Controllers;

/**
 * Gère les actions effectuées sur la page / section de contacts.
 * 
 * @version 0.1
 */
class ContactsController extends Controller {

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
	 * Affiche à l'écran la section des contacts sur le One Page.
	 */
	public function section()
	{
		$page = $this->pages->latestContacts();

		$this->display('website/contacts', [
			'phone_number'  => $page->contact_phone_number,
			'facebook_link' => $page->contact_facebook,
			'email_address' => $page->contact_email,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration des contacts.
	 */
	public function administration()
	{
		$page = $this->pages->latestContacts();

		$this->display('administration/contacts', [
			'phone_number'  => $page->contact_phone_number,
			'facebook_link' => $page->contact_facebook,
			'email_address' => $page->contact_email,
		]);
	}

	/**
	 * Modifie les informations de contact dans la base de données.
	 */
	public function update()
	{
		$this->validate([
			'phone_number' => [ 'required' => true ],
			'facebook_link' => [ 'required' => true ],
			'email_address' => [
				'required' => true,
				'format'   => 'email',
			],
		]);

		$this->pages->update(1, [
			'contact_phone_number' => $this->request['phone_number'],
			'contact_facebook'     => $this->request['facebook_link'],
			'contact_email'        => $this->request['email_address'],
		]);
	}
}