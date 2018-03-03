$(function()
{
	$('a.page-scroll').on('click', function(e)
	{
		let navbarHeight = $('#navbar').height();

		if ($(this).attr('href') == '#navbar' || $(this).attr('href') == '#student_home_section')
		{
			navbarHeight = 0;
		}

		$('html,body').animate({
			scrollTop: $($(this).attr('href')).offset().top - navbarHeight
		}, 500);

		e.preventDefault();
	});
});