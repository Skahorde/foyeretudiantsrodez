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
	let map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};

	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

/**
 * Récupère le contenu d'une page et l'affiche dans la section de droite.
 * 
 * @param {String} view
 */
function display(view)
{
	$.ajax({
		type: 'GET',
		data: {
			action: view + '_page'
		},
		success: function(response)
		{
			$('#content').html(response);
		}
	});
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
	let f = this.charAt(0).toLowerCase();

	return f + this.substr(1);
};

/**
 * Retourne la chaine de caractères avec la première lettre en majuscule.
 * 
 * @return {String} La chaine de caractères avec la première lettre en majuscule.
 */
String.prototype.ucfirst = function()
{
	let f = this.charAt(0).toUpperCase();

	return f + this.substr(1);
};

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

	let result = '';

	let aThis = this.split('_');

	for (let key in aThis)
	{
		result += aThis[key].ucfirst();
	}

	return result;
};

$(function()
{

	/**
	 * Fonction qui aide à la soumission de formulaire via AJAX.
	 * Permet la gestion des erreurs de saisie.
	 * 
	 * @param {Object} options Paramètres de la fonction :
	 *                         - selector :
	 *                           Permet de restreindre l'ensemble des champs
	 *                           à sérialiser.
	 *                         - beforeSubmit :
	 *                           Appelée avant la soumission du formulaire.
	 *                         - success :
	 *                           Appelée si aucune erreur ne survient.
	 *                         - error :
	 *                           Appelée si une erreur survient.
	 */
	$.fn.ajaxify = function(options)
	{
    	if (typeof options == 'undefined')
    	{
    		options = { };
    	}

    	let form = this;

    	form.find('input, textarea').on('change keyup keypress', function()
    	{
    		$('.success-alert').addClass('hidden');

    		$(this).removeClass('has-error');

    		$(this).closest('.form-group').find('.error-alert').hide();

    		// Si tous les champs invalides ont été modifiés ...
    		if (form.find('.form-group .has-error').length === 0)
    		{
    			form.find('[type="submit"]').prop('disabled', false);
    		}
    	});

    	form.on('submit', function(e)
    	{
			options.beforeSubmit = $.proxy(options.beforeSubmit, this);
			options.success      = $.proxy(options.success, this);
			options.error        = $.proxy(options.error, this);

			form.find('[type="submit"]').prop('disabled', true);

			if (typeof options.beforeSubmit != 'undefined')
			{
				options.beforeSubmit();
			}

    	    $.ajax({
    	        method: form.attr('method') || 'get',
    	        data: (typeof options.selector == 'undefined' ? $(form).serialize() : $(form).find(options.selector).serialize()),
    	        success: options.success,
    	        dataType: options.dataType,
    	        complete: function(xhr, status)
    	        {
    	        	form.find('[type="submit"]').prop('disabled', false);
    	        },
    	        error: function(xhr, status, error)
    	        {
    	        	// S'il y a des erreurs de saisie ...
    	        	if (xhr.status == 422)
    	        	{
    	        		let errors = $.parseJSON(xhr.responseText);

    	        		for (let field in errors)
    	        		{
    	        			let input = form.find('[name="' + field + '"]');

    	        			let content = '<ul>';

    	        			for (let i in errors[field])
    	        			{
    	        				input.addClass('has-error');
    	        				content += '<li>' + errors[field][i] + '</li>';
    	        			}

    	        			content += '</ul>';

    	        			input.closest('.form-group').find('.error-alert').html(content).show();
    	        		}

    	        		form.find('[type="submit"]').prop('disabled', true);
    	        	}

    	        	if (typeof options.error !== 'undefined')
    	        	{
    	        		options.error(xhr, status, error);
    	        	}
    	        }
    	    });

    	    e.preventDefault();
    	});

    	return form;
	};
});