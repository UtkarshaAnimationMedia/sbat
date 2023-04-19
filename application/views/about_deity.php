<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">
/* Style the Headings that are used to open and close the accordion panel */
.accordion {
	background-color: #621A1D;
	color: #fff;;
	cursor: pointer;
	padding: 10px;
	margin: 0;
	font-weight: 500;
	border: 0.01rem solid lightgray;

}


/* Add "plus" sign (+) after Accordion */
.plus-sign::after {
	content: '\002B';
	color: #fff;
	font-weight: bold;
	float: right;
}

/* Add "minus" sign (-) after Accordion (when accordion is active) */
.minus-sign::after {
	content: "\2212";
	color: #fff;
}

/* Style the accordion panel */
.accordion-panel {
	padding: 0 10px;
	overflow: hidden;
	background-color: white;
	max-height: 0;
	transition: max-height 0.5s ease-out;
}
.list-style li {
	background: url(<?=base_url('assets/img/flower.png')?>) left 8px no-repeat;
	padding-left: 36px;
	padding-bottom: 40px;
	background-size: 15px;
	width: auto;
	color: #ee1543;
}
.list-pn {
	list-style-type: none;
}
.l-h18 {
	line-height: 33px;
}

.font13 {
	font-size: 16px;
}
.font16 {
	font-size: 16px;
}
.m0 {
	margin: 0px;
}
.poppinsregular {
	font-family: 'poppinsregular';
}
ul {
	padding-left: 0rem;
}
</style>
<main id="main">

	<!-- ======= About Committee Section ======= -->
	<section  style="background-color: var(--page-wrapper-bg-color)!important">
		<div class="container">
			<center> <h2 class="bottomborder"  style="font-weight:bold!important;font-size: 35px!important;">About Deities</h2> </center>
			<div class="mt-4">

				<?php foreach ($deities_data as $key => $val) { ?>

					<h5 class="accordion plus-sign <?= ($key==0)?'accordionFirst':''; ?>  "><b><?=$val['refDataName']?></b></h5>
					<div class="accordion-panel">
						<div class="row my-4">
							<div class="col-md-3">
								<img src="<?=ApiBaseUrl()['url'].$val['image']?>" class="img-fluid" style="height:400px; width:auto;" alt="...">
							</div>
							<div class="col-md-9 px-5">
								<p class=""><?=$val['Description']?></p>
								<div class="row">
									<div class="col-md-6">
										<?php if($val['impFestival']){ ?><h4 class="poppinsmedium font16 l-h16 dk-t"><b>IMPORTANT FESTIVALS:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li ><?=$val['impFestival']?></li>
										</ul>
									<?php } ?>
									<?php if($val['auspiciousDays']){ ?>
										<h4 class="poppinsmedium font16 l-h16 dk-t"><b>AUSPICIOUS DAYS:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li><?=$val['auspiciousDays']?></li>
										</ul>
									<?php } ?>
									<?php if($val['vahana']){ ?>
										<h4 class="poppinsmedium font16 l-h16 dk-t"><b>VAHANA:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li><?=$val['vahana']?></li>
										</ul>
									<?php } ?>
								</div>
								<div class="col-md-6">
									<?php if($val['favouriteOfferings']){ ?>
										<h4 class="poppinsmedium font16 l-h16 dk-t"><b>FAVORITE OFFERINGS:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li><?=$val['favouriteOfferings']?></li>
										</ul>
									<?php } ?>
									<?php if($val['slokas']){ ?>
										<h4 class="poppinsmedium font16 l-h16 dk-t"><b>SLOKAS:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li style="background-image:none!important;padding-left: 0;"><i>"<?=$val['slokas']?>"</i></li>
										</ul>
									<?php } ?>
									<?php if($val['otherRecitals']){ ?>
										<h4 class="poppinsmedium font16 l-h16 dk-t"><b>OTHER RECITALS:</b></h4>
										<ul class="list-pn m0 list-style poppinsregular font13 l-h18 tabhorizontal-b-p0">
											<li><?=$val['otherRecitals']?></li>
										</ul>
									<?php  } ?>
								</div>
							</div>

						</div>
					</div>
				</div>

			<?php } ?>

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
