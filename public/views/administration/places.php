<section id="places_section">

	<header class="section-header">
		
		<h2>
			LES LIEUX
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<table id="places_administration_table" class="administration-table">
			
			<thead>
				<tr>
					<th>
						<a id="create_place_button"><i class="fa fa-plus"></i></a>
					</th>
					<th>Titre *</th>
					<th>Description *</th>
					<th>Image (1) *</th>
					<th>Image (2)</th>
					<th>Image (3)</th>
				</tr>
			</thead>

			<tbody>
				<?php if (empty($places)): ?>
					<tr class="empty-table">
						<td colspan="6">Aucun lieu enregistré.</td>
					</tr>
				<?php endif; ?>
				<?php foreach ($places as $place): ?>
					<tr id="place_<?= $place->id ?>">
						<td>
							<a class="remove-button">
								<i class="fa fa-times"></i>
							</a>
						</td>
						<td><?= htmlspecialchars($place->title) ?></td>
						<td><?= htmlspecialchars($place->description) ?></td>
						<td>
							<img src="<?= $place->picture_1_url ?>" alt="<?= $place->title ?> (1)" width="50">
						</td>
						<td>
							<img src="<?= $place->picture_2_url ?>" alt="<?= $place->title ?> (2)" width="50">
						</td>
						<td>
							<img src="<?= $place->picture_3_url ?>" alt="<?= $place->title ?> (3)" width="50">
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/places.js"></script>