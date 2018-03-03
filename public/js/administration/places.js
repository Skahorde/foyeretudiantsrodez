/**
 * Vide le tableau des lieux.
 */
function emptyTable()
{
	$('#places_administration_table tbody').html(
		'<tr class="empty-table">' +
			'<td colspan="4">' +
				'Aucun lieu enregistré.' +
			'</td>' +
		'</tr>'
	);
}

$(function()
{
	$('#create_place_button').on('click', function()
	{
		if ($('#places_administration_table tr.tmp-row').length > 0)
		{
			return;
		}

		if ($('#places_administration_table tr.empty-table').length > 0)
		{
			$('#places_administration_table tbody').html('');
		}

		$('#places_administration_table tbody').prepend(
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

	$(document).on('click', '#places_administration_table .remove-button', function()
	{
		let tr = $(this).closest('tr');

		if (!tr.hasClass('tmp-row'))
		{
			$.ajax({
				type: 'delete',
				data: {
					action: 'place',
					id: tr.attr('id').replace('place_', '')
				},
				success: function(response)
				{
					tr.remove();

					if ($('#places_administration_table tbody tr').length === 0)
					{
						emptyTable();
					}
				}
			});
		}
		else
		{
			tr.remove();

			if ($('#places_administration_table tbody tr').length === 0)
			{
				emptyTable();
			}
		}
	});

	$(document).on('click', '#places_administration_table .ok-button', function()
	{
		let tr = $(this).closest('tr');

		let formData = new FormData();
		formData.append('action', 'place');
		formData.append('title', tr.find('input[name="title"]').val());
		formData.append('description', tr.find('textarea[name="description"]').val());
		formData.append('picture', tr.find('input[name="picture"]')[0].files[0]);

		$.ajax({
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			dataType: 'json',
			success: function(place)
			{
				tr.closest('tbody').append(
					'<tr id="place_' + place.id + '">' +
						'<td>' +
							'<a class="remove-button">' +
								'<i class="fa fa-times"></i>' +
							'</a>' +
						'</td>' +
						'<td>' + escapeHtml(place.title) + '</td>' +
						'<td>' + escapeHtml(place.description) + '</td>' +
						'<td>' +
							'<img src="' + place.picture_url + '" alt="' + place.title + '" width="50">' +
						'</td>' +
					'</tr>'
				);
				tr.remove();
			}
		});
	});
});