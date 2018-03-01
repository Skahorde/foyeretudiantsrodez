<section id="home_section">

	<header class="section-header">
		
		<h2>
			ACCUEIL
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<form id="home_administration_form" class="horizontal-form" method="put">

			<div class="form-group">
				<label>* Description</label>
				<textarea name="home_description" placeholder="Description"><?= htmlspecialchars($home_description) ?></textarea>
				<div class="error-alert hidden"></div>
			</div>

			<input type="hidden" name="action" value="home">

			<button id="update_home_button" type="submit" class="rounded-button update-button">MODIFIER</button>

		</form>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/home.js"></script>