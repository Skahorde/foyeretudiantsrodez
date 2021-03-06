<section id="contacts_section">

	<h2 class="section-title">CONTACTEZ-NOUS</h2>
	<hr class="separator">
	<p class="section-subtitle">
		Il est possible de nous contacter par email, Facebook ou par téléphone pour toute demande de renseignement et/ou d'inscription.
	</p>
	<div id="access_plan">
		<ul class="access-links">
			<li>
				<a data-destination="Lycée+Charles+Carnus+Rodez">Lycée Charles Carnus</a>
				<span class="separator">&nbsp;|&nbsp;</span>
			</li>
			<li>
				<a data-destination="Centre+universitaire+Jean-François+Champollion+Rodez">Fac Champollion</a>
				<span class="separator">&nbsp;|&nbsp;</span>
			</li>
			<li>
				<a data-destination="IUT+Rodez">IUT</a>
				<span class="separator">&nbsp;|&nbsp;</span>
			</li>
			<li>
				<a data-destination="IFSI+Rodez">IFSI</a>
				<span class="separator">&nbsp;|&nbsp;</span>
			</li>
			<li>
				<a data-destination="5+Rue+de+Bruxelles+Rodez">CCI</a>
			</li>
		</ul>
		<div class="google-maps">
			<iframe id="map_frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2852.717609310241!2d2.551154315171009!3d44.35685197910346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b27de8d0ab9255%3A0x92b588b5603f7746!2sMaison+Saint+Pierre!5e0!3m2!1sfr!2sfr!4v1516730108930" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	<div id="contact_links" class="block-center container">
		
		<div class="contact-link">
			<a href="tel:<?= str_replace(' ', '', $phone_number) ?>">
				<i class="fa fa-2x fa-phone"></i><br>
				<?= $phone_number ?>
			</a>
		</div>

		<div class="contact-link">
			<a href="<?= $facebook_link ?>" target="_blank">
				<i class="fa fa-2x fa-facebook-official"></i><br>
				Foyer Etudiants Saint Pierre
			</a>
		</div>

		<div class="contact-link">
			<a href="mailto:<?= $email_address ?>">
				<i class="fa fa-2x fa-envelope-o"></i><br>
				<?= $email_address ?>
			</a>
		</div>

	</div>

</section>

<script type="text/javascript" src="public/js/website/contacts.js"></script>