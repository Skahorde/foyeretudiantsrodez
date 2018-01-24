/**
 * Clé d'API Google permettant de créer des itinéraires dans la carte.
 * 
 * @type {String}
 */
var GOOGLE_API_KEY = 'AIzaSyDLVJmjI4svCHwvQgjs228pqp3vo5Ou7Ic';

/**
 * Définit l'adresse de base des itinéraires.
 * 
 * @type {String}
 */
var DIRECTIONS_BASE_URL = 'https://www.google.com/maps/embed/v1/directions?key=' + GOOGLE_API_KEY + '&origin=Maison+St+Pierre+Rodez';

$(function()
{
	$('.access-links a').on('click', function(e)
	{
		if ($(this).parent().hasClass('active'))
		{
			$(this).parent().removeClass('active');
			$('#map_frame').attr('src', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2852.717609310241!2d2.551154315171009!3d44.35685197910346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b27de8d0ab9255%3A0x92b588b5603f7746!2sMaison+Saint+Pierre!5e0!3m2!1sfr!2sfr!4v1516730108930');
		}
		else
		{
			$(this).closest('ul').find('li').removeClass('active');
			$(this).parent().addClass('active');
			$('#map_frame').attr('src', DIRECTIONS_BASE_URL + '&destination=' + $(this).data('destination'));
		}

		e.preventDefault();
	});
});