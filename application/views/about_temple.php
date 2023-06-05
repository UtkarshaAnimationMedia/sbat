<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<main id="main">

	<!-- ======= Temple Services Section ======= -->
	<section id="temple-services" class="temple-services" style="background-image: linear-gradient(var(--page-wrapper-bg-color), white);">
		<div class="container">


			<div class="container-fluid">
				<h2 id="temple-services" class="text-center bottomborder">About <?= GetProjectName(); ?></h2>

				<div class="row">
					<div class="col-md-3" data-aos="fade-left">
						<img src="<?=base_url('assets/img/about-temple/SitaRam-1.jpg');?>" class="w-100 img-fluid">
					</div>
					<div class="col-md-9 mt-5" data-aos="fade-right">
						<h3 style="text-align:left;">Our Mission</h3>
						<p style="text-align:left;">Sri Bhakta Anjaneya Temple's (SBAT) mission is to provide authentic religious service per the sastras to help individuals, families and the community at large. The mission also is to preserve and propagate the learning of the Vedas, Sastras, Puranas, Hindu traditions and to imbibe the Sanatana dharma values, culture and heritage into the future generations.
						</p>
						<h3 style="text-align:left;">Founder</h3>
						<p style="text-align:left;">Our organization was established by some of the most prominent persons in the Hindu world. They were and still are the core people of our organization and the website itself.</p>

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
