/**
 * Utilisateur courant.
 *
 * @type {Object}
 */
var user;

$(function()
{
	// Si la page affichée n'est pas la page de connexion, on affiche la page
	// d'accueil de la page d'administration dans la div adéquate.
	if ($('#administration_nav').length > 0)
	{
		display('admin_' + $('#administration_nav li.active > a').attr('href').replace('view:', ''));
	}

	$('a[href^="view:"]').on('click', function(e)
	{
		$(this).closest('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');

		display('admin_' + $(this).attr('href').replace('view:', ''));

		e.preventDefault();
	});
});