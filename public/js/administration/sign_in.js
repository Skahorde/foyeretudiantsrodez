$(function()
{
	// Action lors de la soumission du formulaire de connexion.
	$('#sign_in_form').on('submit', function(e)
	{
		$.ajax({
			data: $(this).serialize(),
			success: function(response)
			{
				window.location.reload();
			},
			error: function(xhr, status, error)
			{
				console.log(xhr.status);

				if (xhr.status == 400)
				{
					$('#error_alert').text(xhr.responseText).removeClass('hidden');
					$('#sign_in_form input').addClass('has-error');
				}
			}
		});

		e.preventDefault();
	});
});