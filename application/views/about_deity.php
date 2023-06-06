<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<main id="main">

	<!-- ======= About Committee Section ======= -->
	<section  style="background-color: var(--page-wrapper-bg-color)!important">
		<div class="container">
			<center> <h2 class="bottomborder"  style="font-weight:bold!important;font-size: 35px!important;">About Deities</h2> </center>
			<div class="mt-4">

				<ol style="font-weight:normal;line-height: 2rem;">
					<li class="mb-2">
						There shall be <b>no cost-based system</b>. Be it a simple archana or big Pooja at the Temple or even a private religious event, neither the Temple nor the priests shall demand money. Any monetary contribution for religious event is purely a donation to the Temple and is totally voluntary.
					</li>
					<li class="mb-2">
						<b>Strict Adherence to all religious ceremonies</b>. Moola Vigraha Abhishekam (religious bathing) is performed in the morning, every day. The Deities are presented with special Nadaswaram Seva (Instrumentals) during Morning and Evening Poojas.
					</li>
					<li class="mb-2">
						<b>DAIRY PRODUCTS a</b>. Temple will use only the dairy products (milk, yogurt, etc) from OUR GOSHAALA for all abhishekams, neivedhyam (food offering) and prasaadams. NO OUTSIDE DAIRY PRODUCTS will be used. <b>b</b>. If the devotees desire, they may sponsor the milk from our Goshaala for abhishekams. Devotees can bring flowers, fruits, or dry items for the Poojas. <b>c</b>. Food served in the premises will not use any dairy products from outside. Our menu will reflect changes in the sweets and other items to reflect this.
					</li>
					<li class="mb-2">
						<b>Only the food cooked within the Temple’s madapalli (holy kitchen) shall be offered to the Lord</b>. The Temple shall have a religious cook who shall prepare prasaadams and neivedyams as per the religious guidelines. Devotees who wish to bring prasaadam to the Temple shall order the same from the Temple.
					</li>
					<li class="mb-2">
						<b>Temple Timings</b> -The Temple shall be open to all from 7:30 AM – 12:30 PM and from 6:00 PM – 9:00 PM during the weekdays and from 7:30 AM – 9:00 PM during weekends and special days. There shall be an Abhijit Viramam (Temple closed) from 12:30 PM – 1:00 PM during weekends and special days.
					</li>
					<li class="mb-2">
						<b>Vahana (Vehicle) Pooja</b> – Devotees should assemble atleast 30 minutes before for Vahana Pooja to be performed. Vahana Pooja. Vahana Pooja shall not be performed during extremely cold conditions, snow, rain due to unfavorable external weather.
					</li>
					<li class="mb-2">
						There shall be <b>Annadaanam</b> (Free food) in the Temple <b>at all times</b> when the Temple is open. Devotees may offer donation for Annadaanam to the Temple or offer materials for Special food might be available on somedays for purchase.
					</li>
					<li class="mb-2">
						<b>Dress Code</b>: All Devotees are requested to appropriately dress for their visit. Traditional/Cultural attire is highly encouraged! Short, revealing, knee-high attire (for adults) are strictly discouraged. Any visitor to the Temple must adhere to the Temple policies at all times while at the Temple premises.
					</li>
					<li class="mb-2">
						For any additional questions, please contact the Temple manager.
					</li>
				</ol>

			</div>
		</div>

		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3 style="text-align:center;font-family: 'Tienne',Sans-serif !important;font-weight: 700; text-transform: capitalize; line-height: 51px;">SBAT Founders</h3>
						<p>Our organization was established by some of the most prominent persons in the Hindu world. They were and still are the core people of our organization and the website itself.</p>

					</div>
				</div>
			</div>
		</div>
	</section><!-- End About Committee Section -->
</main><!-- End #main -->
<script type="text/javascript">
	// Get all Accordion and Panel

	$(function() {
		let accHeading = document.querySelectorAll(".accordion");
		let accPanel = document.querySelectorAll(".accordion-panel");

// alert('dd');
for (let i = 0; i < accHeading.length; i++) {
    // Execute whenever an accordion is clicked 
    accHeading[i].onclick = function() {
    	if (this.nextElementSibling.style.maxHeight) {
           hidePanels();     // Hide All open Panels 
       } else {
           showPanel(this);  // Show the panel
       } 
   };
}



// Function to Show a Panel
function showPanel(elem) {
	hidePanels();
	elem.classList.add("active");
	elem.classList.add("minus-sign");
	elem.nextElementSibling.style.maxHeight = elem.nextElementSibling.scrollHeight + "px";
}

// Function to Hide all shown Panels
function hidePanels() {
	for (let i = 0; i < accPanel.length; i++) {
		accPanel[i].style.maxHeight = null;
		accHeading[i].classList.remove("active");
		accHeading[i].classList.remove("minus-sign");
	}
}
});


	$(document).ready(function(){
		$(".accordionFirst").click();

		window.scrollTo({ top: 225, behavior: 'smooth'});

	})



</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
