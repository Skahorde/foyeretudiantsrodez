<section id="animations_section">

	<header class="section-header">
		
		<h2>
			LES ANIMATIONS
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<table id="animations_administration_table" class="administration-table">
			
			<thead>
				<tr>
					<th>
						<a id="create_animation_button"><i class="fa fa-plus"></i></a>
					</th>
					<th>Titre</th>
					<th>Description</th>
					<th>Image</th>
				</tr>
			</thead>

			<tbody>
				<?php if (empty($animations)): ?>
					<tr class="empty-table">
						<td colspan="4">Aucune animation enregistrée.</td>
					</tr>
				<?php endif; ?>
				<?php foreach ($animations as $animation): ?>
					<tr id="animation_<?= $animation->id ?>">
						<td>
							<a class="remove-button">
								<i class="fa fa-times"></i>
							</a>
						</td>
						<td><?= htmlspecialchars($animation->title) ?></td>
						<td><?= htmlspecialchars($animation->description) ?></td>
						<td>
							<img src="<?= $animation->picture_url ?>" alt="<?= $animation->title ?>" width="50">
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/animations.js"></script>