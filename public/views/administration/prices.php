<section id="prices_section">

	<header class="section-header">
		
		<h2>
			LES TARIFS
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<form id="prices_administration_form" class="horizontal-form" method="put">

			<div class="form-group">
				<label>Tarif / sem. *</label>
				<input type="number" name="cost_per_week" placeholder="Tarif par semaine" value="<?= $cost_per_week ?>">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Frais d'inscription *</label>
				<input type="number" name="fees" placeholder="Frais d'inscription" value="<?= $fees ?>">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>Dépôt de garantie *</label>
				<input type="number" name="guarantee" placeholder="Dépôt de garantie" value="<?= $guarantee ?>">
				<div class="error-alert hidden"></div>
			</div>

			<input type="hidden" name="action" value="prices">

			<button id="update_prices_button" type="submit" class="rounded-button update-button">MODIFIER</button>

		</form>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/prices.js"></script>