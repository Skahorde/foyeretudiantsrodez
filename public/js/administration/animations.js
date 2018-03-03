/**
 * Vide le tableau des animations.
 */
function emptyTable()
{
	$('#animations_administration_table tbody').html(
		'<tr class="empty-table">' +
			'<td colspan="4">' +
				'Aucune animation enregistrée.' +
			'</td>' +
		'</tr>'
	);
}

$(function()
{
	$('#create_animation_button').on('click', function()
	{
		if ($('#animations_administration_table tr.tmp-row').length > 0)
		{
			return;
		}

		if ($('#animations_administration_table tr.empty-table').length > 0)
		{
			$('#animations_administration_table tbody').html('');
		}

		$('#animations_administration_table tbody').prepend(
			'<tr class="tmp-row">' +
				'<td>' +
					'<a class="remove-button"><i class="fa fa-times"></i></a>&nbsp;&nbsp;' +
					'<a class="ok-button"><i class="fa fa-check"></i></a>' +
				'</td>' +
				'<td>' +
					'<input type="text" name="title" placeholder="Titre">' +
				'</td>' +
				'<td>' +
					'<textarea name="description" placeholder="Description"></textarea>' +
				'</td>' +
				'<td>' +
					'<input type="file" name="picture">' +
				'</td>' +
			'</tr>'
		);
	});

	$(document).on('click', '#animations_administration_table .remove-button', function()
	{
		let tr = $(this).closest('tr');

		if (!tr.hasClass('tmp-row'))
		{
			$.ajax({
				type: 'delete',
				data: {
					action: 'animation',
					id: tr.attr('id').replace('animation_', '')
				},
				success: function(response)
				{
					tr.remove();

					if ($('#animations_administration_table tbody tr').length === 0)
					{
						emptyTable();
					}
				}
			});
		}
		else
		{
			tr.remove();

			if ($('#animations_administration_table tbody tr').length === 0)
			{
				emptyTable();
			}
		}
	});

	$(document).on('click', '#animations_administration_table .ok-button', function()
	{
		let tr = $(this).closest('tr');

		let formData = new FormData();
		formData.append('action', 'animation');
		formData.append('title', tr.find('input[name="title"]').val());
		formData.append('description', tr.find('textarea[name="description"]').val());
		formData.append('picture', tr.find('input[name="picture"]')[0].files[0]);

		$.ajax({
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			dataType: 'json',
			success: function(animation)
			{
				tr.closest('tbody').append(
					'<tr id="animation_' + animation.id + '">' +
						'<td>' +
							'<a class="remove-button">' +
								'<i class="fa fa-times"></i>' +
							'</a>' +
						'</td>' +
						'<td>' + escapeHtml(animation.title) + '</td>' +
						'<td>' + escapeHtml(animation.description) + '</td>' +
						'<td>' +
							'<img src="' + animation.picture_url + '" alt="' + animation.title + '" width="50">' +
						'</td>' +
					'</tr>'
				);
				tr.remove();
			}
		});
	});
});