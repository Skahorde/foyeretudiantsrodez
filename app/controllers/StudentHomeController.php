<?php

namespace App\Controllers;

/**
 * Gère les actions effectuées sur la page / section "Le Foyer".
 * 
 * @version 0.1
 */
class StudentHomeController extends Controller {

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
	 * Affiche à l'écran la section "Le Foyer" sur le One Page.
	 */
	public function section()
	{
		$page = $this->pages->latestStudentHome();

		$this->display('website/student_home', [
			'student_home_description'   => $page->student_home_description,
			'student_home_rooms_number'  => $page->student_home_rooms_number,
			'student_home_start_date'    => $page->student_home_start_date,
			'student_home_end_date'      => $page->student_home_end_date,
			'student_home_optional_text' => $page->student_home_optional_text,
		]);
	}

	/**
	 * Affiche à l'écran la page d'administration de la section "Le Foyer".
	 */
	public function administration()
	{
		$page = $this->pages->latestStudentHome();

		$this->display('administration/student_home', [
			'student_home_description'   => $page->student_home_description,
			'student_home_rooms_number'  => $page->student_home_rooms_number,
			'student_home_start_date'    => $page->student_home_start_date,
			'student_home_end_date'      => $page->student_home_end_date,
			'student_home_optional_text' => $page->student_home_optional_text,
		]);
	}

	/**
	 * Modifie les informations de la section "Le Foyer" dans la base de données.
	 */
	public function update()
	{
		$this->validate([
			'student_home_description'   => [ 'required' => true ],
			'student_home_rooms_number'  => [ 'required' => true ],
			'student_home_start_date'    => [
				'required' => true,
				'format'   => 'Y-m-d',
			],
			'student_home_end_date'    => [
				'required' => true,
				'format'   => 'Y-m-d',
			],
			'student_home_optional_text' => [ 'required' => true ],
		]);

		$this->pages->update(1, [
			'student_home_description'   => $this->request['student_home_description'],
			'student_home_rooms_number'  => $this->request['student_home_rooms_number'],
			'student_home_start_date'    => $this->request['student_home_start_date'],
			'student_home_end_date'      => $this->request['student_home_end_date'],
			'student_home_optional_text' => $this->request['student_home_optional_text'],
		]);
	}
}