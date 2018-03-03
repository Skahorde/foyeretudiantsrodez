<section id="student_home_section">

	<h2 class="section-title" id="title_foyer">LE FOYER</h2>
	<hr class="separator" id="separator_foyer">
	
	<p class="section-subtitle" id="subtitle_foyer">
		<?= $student_home_description ?>
	</p>

	<div class="block-center container" id="infoboxes">
		
		<div class="infobox">
				<li>
					<i class="circle-icon fa-3x fa fa-bed"></i>
					<p class="p-icon"><?= $student_home_rooms_number ?> places</p>
				</li>
		</div>
		<div class="infobox">
				<li>
					<div>
						<i class="circle-icon fa-3x fa fa-calendar-o"></i>
						<p class="p-icon"><?= date('d M', strtotime($student_home_start_date)) ?></p>
						<i class="arrow-icon fa fa-arrow-down"></i>
						<p class="p-icon"><?= date('d M', strtotime($student_home_end_date)) ?></p>
					</div>
				</li>
		</div>
		<div class="infobox">
				<li>
					<a class="page-scroll" href="#contacts_section">
						<i class="circle-icon fa-3x fa fa-bus"></i>
						<p class="p-icon">À 5 minutes de tout</p>
					</a>
				</li>
		</div>		
	</div>

	<p class="h3-container">
		<?= $student_home_optional_text ?>
	</p>

</section>
