<?php
$header_data = $this->mongo_db2->where(['aspectType'=> 'headerSettings'])->get('wesiteSettings');
?>

<!-- Sidebar-->
<div class="border-end" id="sidebar-wrapper">
	<a href="<?=base_url();?>" class="text-decoration-none">
		<div class="sidebar-heading border-bottom bg-light header-footer-bg" style="padding:0!important">
			<div class="row py-0 my-0">
				<div class="col-md-12 my-0 py-0 px-0 d-flex">
					<div class="row m-0 py-3">
						<div class="col-md-4 m-0 p-0">
							<img src="<?= $header_data[0]['leftImage'] ? ApiBaseUrl()['url'].$header_data[0]['leftImage'] : base_url('assets/img/logo-1.png')?>" style="width: 71px; background-repeat: no-repeat; margin: 0px 17px; background-position: left;">
							
						</div>
						<div class="col-md-8 m-0 p-0">
							
							<p class="px-2" style="font-size: 14px; margin-bottom: 0rem; white-space: nowrap;">Welcome!<br> <?=$this->session->userdata('refDataName');?>, <?= camelCase(@getUserDetails()->data[0]->designation); ?><br><?= camelCase(@getUserDetails()->data[0]->managementCategory); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</a>


	

	<div class="list-group list-group-flush">

		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MEMBER DIRECTORY') { ?> active  <?php } ?>" href="<?=base_url('managements/member-directory')?>"><img src="<?=base_url('admin_assets/img/icons/donation-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Directory</span></a>

		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'Meeting Calendar') { ?> active  <?php } ?>" href="<?=base_url('managements/meeting-calendar')?>"><img src="<?=base_url('admin_assets/img/icons/calendar.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Calendar</span></a>


		<a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=base_url('logout')?>"><img src="<?=base_url('admin_assets/img/icons/logout-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Logout</span></a>

	</div>
</div>

<!-- loader -->
<div class="ldld full" style="    z-index: 999;"></div>
<!-- loader -->

<!-- ==========Language Translator Code============= -->
<div class="gtranslate_wrapper"></div>


<div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"languages":["en","hi","ta","pa","ml","te","gu","kn"],"wrapper_selector":".gtranslate_wrapper","alt_flags":{"en":"usa"}}</script>
<script src="<?=base_url('assets/js/translator-float.js')?>" defer></script>
<!-- ==========Language Translator Scripts============= -->




<script type="text/javascript">
 // Create a new ldLoader object
	var loader = new ldLoader({root: ".ldld.full"});


	if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
  // Show the loader if the page is being loaded from the cache
		loader.on();
	}



// Add a click event listener to the document object
	document.addEventListener("click", function(event) {


  // Check if the clicked element matches a specific selector
		if (event.target.matches(".list-group-item, .loader")) {
    // Show the loader
			loader.on();
		}
	});

// Wait for the page to finish loading
	window.onload = function() {
  // Hide the loader
		loader.off();
	};

</script>




<!-- Page content wrapper-->
<div id="page-content-wrapper" style="background-color: var(--page-wrapper-bg-color)!important">
			<!-- Top navigation-->