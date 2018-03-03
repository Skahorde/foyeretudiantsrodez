$(function()
{
	$('.places-links a').on('click', function()
	{
		$('#places_container li').addClass('hidden');
		$('#place_' + $(this).data('place-index')).removeClass('hidden');
		$('.places-links a').removeClass('active-link');
		$(this).addClass('active-link');
	});
});