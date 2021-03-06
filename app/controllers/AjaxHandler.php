<?php

namespace App\Controllers;

use App\Converters\StringConverter;

if (session_id() === '')
{
	session_start();
}

// Inclusion de l'autoloader (auto-chargement des classes).
require __DIR__ . '/../../core/autoload.php';

/**
 * S'occupe de la gestion des requêtes AJAX.
 * 
 * @author Thomas SAYER <thomas.sayer@edf.fr>
 */
class AjaxHandler {

	/**
	 * Paramètres de la requête HTTP.
	 * 
	 * @var array
	 */
	private $request;

	/**
	 * Méthode de la requête HTTP (POST, GET).
	 * 
	 * @var string
	 */
	private $method;

	/**
	 * Construit un manager capable de traiter les requêtes AJAX (XHR).
	 * 
	 * @param array  $request Paramètres de la requête HTTP.
	 * @param string $method  Méthode de la requête HTTP (POST, GET, ...).
	 */
	public function __construct(array $request, $method)
	{
		$this->request = $request;
		$this->method  = $method;
	}

	/**
	 * Détermine si la requête à traiter est une requête AJAX.
	 * 
	 * @return boolean Vrai si la requête est une requête AJAX; faux sinon.
	 */
	private function isAjax()
	{
		return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	/**
	 * Détermine si le token contre la faille CSRF de la requête à traiter est
	 * valide.
	 *
	 * @see https://fr.wikipedia.org/wiki/Cross-Site_Request_Forgery
	 *
	 * @return boolean Vrai si le token est valide; faux sinon.
	 */
	private function validToken()
	{
		$headers = apache_request_headers();

		if (!isset($headers['X-CSRF-Token']))
		{
			return false;
		}

		return $_SESSION['token'] == $headers['X-CSRF-Token'];
	}

	/**
	 * Traite la requête AJAX en appelant la méthode adéquate.
	 */
	public function handle()
	{
		if (!$this->isAjax())
		{
			http_response_code(405);
			die;
		}

		if (!$this->validToken())
		{
			http_response_code(403);
			die;
		}

		$action = strtolower($this->method) . StringConverter::snakeToPascal($this->request['action']);

		unset($this->request['action']);

		$this->$action();
	}

	/**
	 * Effectue l'opération de connexion d'un utilisateur à la page d'admin.
	 */
	private function getAdminSignIn()
	{
		(new SignInController($this->request))->signIn();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration des contacts.
	 */
	private function getAdminContactsPage()
	{
		(new ContactsController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de l'accueil.
	 */
	private function getAdminHomePage()
	{
		(new HomeController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de la
	 * section "Le Foyer".
	 */
	private function getAdminStudentHomePage()
	{
		(new StudentHomeController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de la
	 * section "Les animations".
	 */
	private function getAdminAnimationsPage()
	{
		(new AnimationsController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de la
	 * section "Les lieux".
	 */
	private function getAdminPlacesPage()
	{
		(new PlacesController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de la
	 * section "L'avis des étudiants".
	 */
	private function getAdminFeedbacksPage()
	{
		(new FeedbacksController($this->request))->administration();
	}

	/**
	 * Effectue l'opération d'affichage de la page d'administration de la
	 * section des tarifs.
	 */
	private function getAdminPricesPage()
	{
		(new PricesController($this->request))->administration();
	}

	/**
	 * Effectue l'opération de modification des informations de contact.
	 */
	private function putContacts()
	{
		(new ContactsController($this->request))->update();
	}

	/**
	 * Effectue l'opération de modification des informations affichées sur la
	 * section d'accueil.
	 */
	private function putHome()
	{
		(new HomeController($this->request))->update();
	}

	/**
	 * Effectue l'opération de modification des informations affichées sur la
	 * section "Le Foyer".
	 */
	private function putStudentHome()
	{
		(new StudentHomeController($this->request))->update();
	}

	/**
	 * Effectue l'opération de création d'une animation.
	 */
	private function postAnimation()
	{
		(new AnimationsController($this->request, $_FILES))->create();
	}

	/**
	 * Effectue l'opération de suppression d'une animation.
	 */
	private function deleteAnimation()
	{
		(new AnimationsController($this->request, $_FILES))->delete();
	}

	/**
	 * Effectue l'opération de création d'un lieu.
	 */
	private function postPlace()
	{
		(new PlacesController($this->request, $_FILES))->create();
	}

	/**
	 * Effectue l'opération de suppression d'un lieu.
	 */
	private function deletePlace()
	{
		(new PlacesController($this->request, $_FILES))->delete();
	}

	/**
	 * Effectue l'opération de création d'un avis.
	 */
	private function postFeedback()
	{
		(new FeedbacksController($this->request))->create();
	}

	/**
	 * Effectue l'opération de suppression d'un avis.
	 */
	private function deleteFeedback()
	{
		(new FeedbacksController($this->request))->delete();
	}

	/**
	 * Effectue l'opération de modification des informations affichées sur la
	 * section des tarifs.
	 */
	private function putPrices()
	{
		(new PricesController($this->request))->update();
	}

	/**
	 * Effectue l'opération de déconnexion de l'utilisateur courant.
	 */
	private function putSignOut()
	{
		(new SignOutController($this->request))->signOut();
	}
}

$request = [ ];

switch ($_SERVER['REQUEST_METHOD'])
{
	case 'POST':
	case 'GET':
		$request = $_REQUEST;
		break;
	case 'PUT':
	case 'DELETE':
		parse_str(file_get_contents('php://input'), $request);
		break;
}

$handler = new AjaxHandler($request, $_SERVER['REQUEST_METHOD']);
$handler->handle();
