<section id="animations_section">

	<h2 class="section-title" id="title_animations">LES ANIMATIONS</h2>
	<hr class="separator" id="separator_animations">
	
	<p class="section-subtitle" id="subtitle_animations">
		Tout au long de l'année l'équipe et les étudiants proposent des animations.
	</p>

	<p class="h3-container">
		Le mercredi soir est un temps dédié à la vie en communauté. C'est sur ce temps là que sont organisées toutes les semaines les sorties sur Rodez (cinéma, bowling) ou les activités sportives (basket, badminton etc etc) et autres jeux. Tous les étudiants intéressés sont les bienvenus.<br><br>

		Plusieurs fois dans l'année, le foyer propose des sorties durant le week-end. Ces temps plus long nous permettent de proposer des activités plus éloignées : ski à la station du Lioran, canoë dans les gorges du tarn, vélo-rail sur le Larzac etc etc.<br><br>

		L'équipe d'animation travaille tout au long de l'année en collaboration avec le bureau des étudiants du foyer afin de proposer régulièrement de nouvelles activités.
	</p>

	<div class="fullwidth-slider-container">
		<ul>
			<?php foreach ($animations as $animation): ?>

				<li class="element">

					<p class="slider-title">
						<a class="button" onclick="plusDivs(-1)">&#10094;</a>
  						&nbsp;&nbsp;<?= $animation->title ?>&nbsp;&nbsp;
  						<a class="button" onclick="plusDivs(1)">&#10095;</a>
					</p>

					<div class="background-image" style="background-image: url(<?= $animation->picture_url ?>)">
						<div class="center-image">
							<img class="slider-image" src="<?= $animation->picture_url ?>">
						</div>
					</div>

				</li>

			<?php endforeach; ?>
		</ul>

	</div>

</section>

<script type="text/javascript" src="public/js/website/animations.js"></script>