$(function()
{
	$('#prices_administration_form').ajaxify({
		success: function(response)
		{
			$('.success-alert').removeClass('hidden');
		}
	});
});