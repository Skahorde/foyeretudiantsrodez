<section id="prices_section">

	<p class="section-title" id="title_foyer">TARIFS</p>
	<hr class="separator" id="separator_foyer">
	
	<p class="section-subtitle" id="subtitle_foyer">
		Voici les tarifs en vigueur pour l'année 2018/2019.<br>
		Des frais de dossier et d'inscription à hauteur de <?= $fees ?>€ sont demandés.<br>
		Enfin, un dépôt de garantie d'un montant de <?= $guarantee ?>€ est requis.
	</p>

	<div class="block-center container" id="prices_infoboxes">
		
		<div class="infobox">
				<li>					
					<i class="circle-icon fa-3x fa fa-users"></i>
					<p class="p-icon">Aides au logement (APL)</p>
				</li>					
		</div>
		<div class="infobox">
				<li>
					<i class="circle-icon fa-3x fa fa-eur"></i><br>
					<p class="p-icon"><?= $cost_per_week ?>€ / semaine</p>
				</li>					
		</div>
		<div class="infobox">
				<li>
					<div>

						<i class="circle-icon fa-3x fa fa-user"></i><br>
						<p class="p-icon">Tarifs spéciaux pour les apprentis</p>
					</div>
				</li>
		</div>		
	</div>

	<p>
		<u>Dans le prix sont compris :</u><br><br>
		Les repas du soir et petits-déjeuners (du lundi au vendredi matin)<br>
		Les charges (chauffage, eau, électricité)<br>
		L'accès internet dans chaque chambre<br>
		La taxe d'habitation<br>
		L'accès à toutes les salles du foyer ( musique, jeux, équipements sportifs...)<br>
		L'accès à la machine à laver (lessive non fournie)<br>
		L'accès à toutes les animations et tous les projets du foyer<br>
	</p>

</section>
