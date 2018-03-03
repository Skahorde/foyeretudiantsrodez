<section id="places_section">

	<h2 class="section-title">LES LIEUX</h2>
	<hr class="separator">
	<p class="section-subtitle">
		Retrouvez les différents lieux de vie du Foyer St-Pierre.
	</p>
	<div id="places_links_container">
		<ul class="places-links">
			<?php foreach ($places as $i => $place): ?>
				<li>
					<a data-place-index="<?= $i ?>" class="<?= $i == 0 ? 'active-link' : '' ?>"><?= $place->title ?></a>
					<?php if ($i < (count($places) - 1)): ?>
						<span class="separator">&nbsp;|&nbsp;</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<div id="places_container">
			<ul>
				<?php foreach ($places as $i => $place): ?>
					<li id="place_<?= $i ?>" class="<?= $i > 0 ? 'hidden' : '' ?>">
						<p><?= $place->description ?></p>

						<?php for ($j = 0; $j < 3; $j++): ?>
							<?php $field = 'picture_' . ($j + 1) . '_url'; ?>
							<?php $url = $place->$field; ?>
							<?php if (!empty($url)): ?>
								<img src="<?= $url ?>">
							<?php endif; ?>
						<?php endfor; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

</section>

<script type="text/javascript" src="public/js/website/places.js"></script>
