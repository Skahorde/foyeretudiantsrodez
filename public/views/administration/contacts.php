<section id="contacts_section">

	<header class="section-header">
		
		<h2>
			CONTACTS
			<small>Tous les champs marqués d'une astérisque (*) sont obligatoires.</small>
		</h2>

	</header>

	<div class="form-container">
		
		<div class="success-alert hidden">L'opération s'est parfaitement déroulée !</div>

		<form id="contacts_administration_form" class="horizontal-form" method="put">

			<div class="form-group">
				<label>*&nbsp;&nbsp;<i class="fa fa-2x fa-phone"></i></label>
				<input type="text" name="phone_number" value="<?= htmlspecialchars($phone_number) ?>" placeholder="N° de téléphone">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>*&nbsp;&nbsp;<i class="fa fa-2x fa-facebook"></i></label>
				<input type="text" name="facebook_link" value="<?= htmlspecialchars($facebook_link) ?>" placeholder="Facebook">
				<div class="error-alert hidden"></div>
			</div>

			<div class="form-group">
				<label>*&nbsp;&nbsp;<i class="fa fa-2x fa-envelope-o"></i></label>
				<input type="text" name="email_address" value="<?= htmlspecialchars($email_address) ?>" placeholder="Email">
				<div class="error-alert hidden"></div>
			</div>

			<input type="hidden" name="action" value="contacts">

			<button id="update_contacts_button" type="submit" class="rounded-button update-button">MODIFIER</button>

		</form>

	</div>

</section>

<script type="text/javascript" src="public/js/administration/contacts.js"></script>