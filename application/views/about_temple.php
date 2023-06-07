<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<main id="main">

	<!-- ======= Temple Services Section ======= -->
	<section id="temple-services" class="temple-services">

		<div class="container-fluid">
			<div  style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
			<h2 id="temple-services" class="text-center bottomborder">About <?= GetProjectName(); ?></h2>

			<div class="container">
				<div class="row">
					<div class="col-md-8" data-aos="fade-right">
						<h3 style="text-align:left;font-family: 'Tienne',Sans-serif !important;font-weight: 700; text-transform: capitalize; line-height: 51px;">Sri Rama Jaya Rama Jaya Jaya Rama</h3>
						<p style="text-align:left;">Sri Bhakta Anjaneya Temple’s (SBAT) mission is to provide authentic religious service per the sastras to help individuals, families and the community at large. The mission also is to preserve and propagate the learning of the Vedas, Sastras, Puranas, Hindu traditions and to imbibe the Sanatana dharma values, culture and heritage into the future generations.
						</p><br>
						<p style="text-align:left;">Our organization was established by some of the most prominent persons in the Hindu world. They were and still are the core people of our organization and the website itself..</p>

					</div>
					<div class="col-md-4" data-aos="fade-left">
						<img src="https://sbat.vaaptech.com/wp-content/uploads/elementor/thumbs/Sri-Bhaktha-Anjaneya-phjtdfvhrdcc3550p0gdmtzvavogo3lkryhpkposn4.jpg" class="rounded shadow img-fluid" style="width:76%">
					</div>
					
				</div>
			</div>
		</div>
		<div class="container-fluid bg-white">
			<div class="mt-3" style="padding: 40px 0px;background-image: url('<?=base_url('assets/img/botdownloader.com-1686119799.482487.jpg');?>'); background-size: 25%; background-repeat: repeat-x;"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-12" data-aos="fade-right">
						<h3 style="text-align:center;font-family: 'Tienne',Sans-serif !important;font-weight: 700; text-transform: capitalize; line-height: 51px;">SBAT Mission</h3>
						<h4 style="text-align:center;font-family: 'Tienne',Sans-serif !important;font-weight: 700; text-transform: capitalize; line-height: 51px;">The Panchasheel (Mission) Of SBA Temple Are</h4>
						
						<ul style="font-weight: normal;line-height: 2rem;">
							<li>Provide authentic religious service to help individuals and the community at large to perform various karmas.</li>
							<li>Support the community as a whole by actively participating in various social causes.</li>
							<li>Preserve and propagate the learning of the Vedas, Sastras and Puranas for generations to come.</li>
							<li>Promote Hindu traditions, values, culture and heritage including music, dance, slokas and sanskrit among the current and future generations.</li>
							<li>Protect the environment by implementing and supporting afforestation both within the temple property and across the world.</li>
						</ul>

						<p>Our organization was established by some of the most prominent persons in the Hindu world. They were and still are the core people of our organization and the website itself.</p>

					</div>
				</div>
			</div>
		</div>
	</section><!-- End Temple Services Section -->


</main><!-- End #main -->

<script type="text/javascript">
	$(document).ready(function() {
		window.scrollTo({ top: 225, behavior: 'smooth'});
	});
</script>
<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
