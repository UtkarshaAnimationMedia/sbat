

<!-- Sidebar-->
<div class="border-end" id="sidebar-wrapper">
	<a href="<?=base_url()?>">
		<div class="sidebar-heading border-bottom bg-light mx-auto d-block header-footer-bg" style="background-image:url('<?=base_url('assets/img/logo-1.png')?>');background-size: 68px;background-repeat:no-repeat; background-position: center;border-right: 1px solid rgba(0, 0, 0, 0.125);">
			<div class="mt-5"></div>
		</div>
	</a>
	<div class="list-group list-group-flush">
		<a style="border-top: 1px solid rgba(0, 0, 0, 0.125);" class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'Service-Request') { ?> active  <?php } ?>" href="<?=base_url('admin/ServiceRequest')?>"><img src="<?=base_url('admin_assets/img/icons/request-a-service-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Request&nbspA&nbspService</span></a>



		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-BOOKINGS') { ?> active  <?php } ?>" href="<?=base_url('admin/in-temple-bookings')?>">
			<img src="<?=base_url('admin_assets/img/icons/book-a-service-icon.png')?>" height="30px" style="vertical-align: middle!important;"> <span style="padding-left: 9px;font-size: 18px;">My&nbspBookings</span>
		</a>

		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-SERVICE-REQUEST') { ?> active  <?php } ?>" href="<?=base_url('admin/my-service-request')?>" ><img src="<?=base_url('admin_assets/img/icons/service-request-icon.png')?>" height="30px" style="vertical-align: middle!important;"> <span style="padding-left: 9px;font-size: 18px;">My&nbspService&nbspRequests</span></a>

		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-ORDERS') { ?> active  <?php } ?>" href="<?=base_url('admin/my-orders')?>" ><img src="<?=base_url('admin_assets/img/icons/orders-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">My&nbspOrders</span></a>


		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-DONATIONS') { ?> active  <?php } ?>" href="<?=base_url('admin/my-donations')?>"><img src="<?=base_url('admin_assets/img/icons/donation-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">My&nbspDonations</span></a>



		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-PAYMENTS') { ?> active  <?php } ?>" href="<?=base_url('admin/my-payments')?>"><img src="<?=base_url('admin_assets/img/icons/payments-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">My&nbspPayments</span></a>

		<!-- <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'MY-PROFILE') { ?> active  <?php } ?>" href="<?=base_url('admin/my-profile')?>"><img src="<?=base_url('admin_assets/img/icons/profile-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">My Profile</span></a> -->

		<a class="list-group-item list-group-item-action list-group-item-light p-3 <?php if($page == 'YEARLY-TAX-LETTER') { ?> active  <?php } ?>" href="<?=base_url('admin/yearly/Tax-Letter')?>"><img src="<?=base_url('admin_assets/img/icons/tax-letter-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Yearly&nbspTax&nbspLetter</span></a></a>

		<!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=base_url('logout')?>" href="#"><img src="<?=base_url('admin_assets/img/icons/logout-icon.png')?>" height="30px" style="vertical-align: middle!important;">  <span style="padding-left: 9px;font-size: 18px;">Logout</span></a> -->
	</div>
</div>

<!-- loader -->
<div class="ldld full" style="    z-index: 999;"></div>
<!-- loader -->

<!-- ==========Language Translator Code============= -->
<div class="gtranslate_wrapper"></div>


<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","hi","ta","pa","ml","te","gu","kn"],"wrapper_selector":".gtranslate_wrapper","flag_size":24,"switcher_open_direction":"top"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/dwf.js" defer></script>
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