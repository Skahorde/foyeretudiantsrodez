/**
 * Vide le tableau des lieux.
 */
function emptyTable()
{
	$('#feedbacks_administration_table tbody').html(
		'<tr class="empty-table">' +
			'<td colspan="3">' +
				'Aucun avis enregistré.' +
			'</td>' +
		'</tr>'
	);
}

$(function()
{
	$('#create_feedback_button').on('click', function()
	{
		if ($('#feedbacks_administration_table tr.tmp-row').length > 0)
		{
			return;
		}

		if ($('#feedbacks_administration_table tr.empty-table').length > 0)
		{
			$('#feedbacks_administration_table tbody').html('');
		}

		$('#feedbacks_administration_table tbody').prepend(
			'<tr class="tmp-row">' +
				'<td>' +
					'<a class="remove-button"><i class="fa fa-times"></i></a>&nbsp;&nbsp;' +
					'<a class="ok-button"><i class="fa fa-check"></i></a>' +
				'</td>' +
				'<td>' +
					'<input type="text" name="first_name" placeholder="Prénom">' +
				'</td>' +
				'<td>' +
					'<textarea name="content" placeholder="Contenu"></textarea>' +
				'</td>' +
			'</tr>'
		);
	});

	$(document).on('click', '#feedbacks_administration_table .remove-button', function()
	{
		let tr = $(this).closest('tr');

		if (!tr.hasClass('tmp-row'))
		{
			$.ajax({
				type: 'delete',
				data: {
					action: 'feedback',
					id: tr.attr('id').replace('feedback_', '')
				},
				success: function(response)
				{
					tr.remove();

					if ($('#feedbacks_administration_table tbody tr').length === 0)
					{
						emptyTable();
					}
				}
			});
		}
		else
		{
			tr.remove();

			if ($('#feedbacks_administration_table tbody tr').length === 0)
			{
				emptyTable();
			}
		}
	});

	$(document).on('click', '#feedbacks_administration_table .ok-button', function()
	{
		let tr = $(this).closest('tr');

		let formData = new FormData();
		formData.append('action', 'feedback');
		formData.append('first_name', tr.find('input[name="first_name"]').val());
		formData.append('content', tr.find('textarea[name="content"]').val());

		$.ajax({
			type: 'post',
			processData: false,
			contentType: false,
			data: formData,
			dataType: 'json',
			success: function(feedback)
			{
				tr.closest('tbody').append(
					'<tr id="feedback_' + feedback.id + '">' +
						'<td>' +
							'<a class="remove-button">' +
								'<i class="fa fa-times"></i>' +
							'</a>' +
						'</td>' +
						'<td>' + escapeHtml(feedback.first_name) + '</td>' +
						'<td>' + escapeHtml(feedback.content) + '</td>' +
					'</tr>'
				);
				tr.remove();
			}
		});
	});
});