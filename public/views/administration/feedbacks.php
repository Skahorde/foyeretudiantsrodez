<section id="feedbacks_section">

	<header class="section-header">
		
		<h2>
			L'AVIS DES ÉTUDIANTS
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<table id="feedbacks_administration_table" class="administration-table">
			
			<thead>
				<tr>
					<th>
						<a id="create_feedback_button"><i class="fa fa-plus"></i></a>
					</th>
					<th>Titre *</th>
					<th>Description *</th>
				</tr>
			</thead>

			<tbody>
				<?php if (empty($feedbacks)): ?>
					<tr class="empty-table">
						<td colspan="4">Aucun avis enregistré.</td>
					</tr>
				<?php endif; ?>
				<?php foreach ($feedbacks as $feedback): ?>
					<tr id="feedback_<?= $feedback->id ?>">
						<td>
							<a class="remove-button">
								<i class="fa fa-times"></i>
							</a>
						</td>
						<td><?= htmlspecialchars($feedback->first_name) ?></td>
						<td><?= htmlspecialchars($feedback->content) ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/feedbacks.js"></script>