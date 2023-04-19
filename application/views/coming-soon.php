<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>

<main id="main">

	<!-- ======= Coming Soon ======= -->
	<section id="temple-services" class="temple-services" style="background-image: linear-gradient(var(--page-wrapper-bg-color), white);">
	<div id="intro" class="p-5 text-center bg-image shadow-1-strong" >
      <div>
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="text-white px-4">
            <h2 class="mb-3">Coming Soon!</h2>

            <p>We're working hard to finish the development of this site.</p>

            <p>Until then have a look at our Services.</p>

            <a class="btn btn-outline-warning btn-lg m-2" href="<?=base_url('Services')?>" style="    color: #ffffff;background: #530a3a;border: 1px solid #530a3a;" role="button"
              rel="nofollow" target="_blank">Services</a>
          </div>
        </div>
      </div>
    </div>
	</section>
	<!-- End Coming Soon -->


</main><!-- End #main -->


<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
