$(function()
{
	$('#contacts_administration_form').ajaxify({
		success: function(response)
		{
			$('.success-alert').removeClass('hidden');
		}
	});
});