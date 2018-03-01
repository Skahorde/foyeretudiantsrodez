<section id="student_home_section">

	<header class="section-header">
		
		<h2>
			LE FOYER
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<form id="student_home_administration_form" class="horizontal-form" method="put">

			<div class="form-group">
				<label>Description *</label>
				<textarea name="student_home_description" placeholder="Description"><?= $student_home_description ?></textarea>
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Nombre de chambres *</label>
				<input type="number" name="student_home_rooms_number" placeholder="Nombre de chambres" value="<?= $student_home_rooms_number ?>">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Date de début *</label>
				<input type="text" name="student_home_start_date" placeholder="AAAA-MM-JJ" value="<?= $student_home_start_date ?>">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Date de fin *</label>
				<input type="text" name="student_home_end_date" placeholder="AAAA-MM-JJ" value="<?= $student_home_end_date ?>">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Informations supplémentaires</label>
				<textarea name="student_home_optional_text" placeholder="Informations supplémentaires"><?= $student_home_optional_text ?></textarea>
				<div class="error-alert hidden"></div>
			</div>

			<input type="hidden" name="action" value="student_home">

			<button id="update_student_home_button" type="submit" class="rounded-button update-button">MODIFIER</button>

		</form>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/student_home.js"></script>