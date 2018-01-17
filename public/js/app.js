// Global functions //

/**
 * Convertit les caractères spéciaux en entités HTML. Permet de lutter contre
 * la faille XSS.
 *
 * @see https://fr.wikipedia.org/wiki/Cross-site_scripting
 * 
 * @param {String} text Texte à convertir.
 * 
 * @return {String} Texte convertit.
 */
function escapeHtml(text)
{
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};

	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// AJAX setup //

$.ajaxSetup({
	url: 'app/controllers/AjaxHandler.php',
	cache: false,
	headers: {
        'X-CSRF-Token': $('meta[name="token"]').attr('content')
    },
	error: function(xhr, status, error)
	{
		console.log({
			'xhr': xhr,
			'status': status,
			'error': error
		});
	}
});

// String extensions //

/**
 * Retourne la chaine de caractères avec la première lettre en minuscule.
 * 
 * @return {String} La chaine de caractères avec la première lettre en minuscule.
 */
String.prototype.lcfirst = function()
{
	var f = this.charAt(0).toLowerCase();

	return f + this.substr(1);
}

/**
 * Retourne la chaine de caractères avec la première lettre en majuscule.
 * 
 * @return {String} La chaine de caractères avec la première lettre en majuscule.
 */
String.prototype.ucfirst = function()
{
	var f = this.charAt(0).toUpperCase();

	return f + this.substr(1);
}

/**
 * Crée et retourne la représentation camelCase (première lettre en minuscule et
 * chaque nouveau mot avec la première lettre en majuscule. Aucun caractère
 * particulier !) de la chaine de caractères.
 * 
 * @return {String} Chaine de caractères convertie en camelCase.
 */
String.prototype.toCamelCase = function()
{
	this.toPascalCase().lcfirst();
};

/**
 * Crée et retourne la représentation PascalCase (chaque nouveau mot avec la
 * première lettre en majuscule. Aucun caractère particulier !) de la chaine de
 * caractères.
 * 
 * @return {String} Chaine de caractères convertie en PascalCase.
 */
String.prototype.toPascalCase = function()
{
	// Si pas d'underscore ...
	if (this.indexOf('_') == -1)
	{
		return this.ucfirst();
	}

	var result = '';

	var aThis = this.split('_');

	for (var key in aThis)
	{
		result += aThis[key].ucfirst();
	}

	return result;
}