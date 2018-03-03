<section id="feedbacks_section">

	<h2 class="section-title" id="title_feedbacks">L'AVIS DES ÉTUDIANTS</h1>
	<hr class="separator" id="separator_feedbacks">
	
	<p class="section-subtitle" id="subtitle_feedbacks">
		Retrouvez les avis laissés sur notre Livre d'Or par d'anciens ou d'actuels étudiants logés au Foyer.<br>
	</p>

	<div id="feedbacks">
		<ul class="container">
			<?php foreach ($feedbacks as $feedback): ?>
				<li class="feedback">				
					<p class="content"><?= $feedback->content ?></p>
					<p class="name">&mdash; <?= $feedback->first_name ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

</section>

<script type="text/javascript" src="public/js/website/feedbacks.js"></script>