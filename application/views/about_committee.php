<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<style type="text/css">

	.staff-wrapper {
		display:grid;
		grid-auto-flow: dense;
		grid-template-columns:repeat(auto-fill, minmax( min(250px,100%),1fr));
		padding:2px 10px;
		gap:2px 14px;
		justify-items:center;
	}

	.purpleAliens {border:solid purple;}
	.supercool {box-shadow:0 0 9px 2px #911; }

	.staff-box {
		border:solid 2px #E3B40E;
/*	background:radial-gradient( circle at 50% 0% , #fff 25%, #E3B40E );*/
background: #F9A520;
padding:50px 0px;
padding-top:0;
text-align:center;
width:100%;
max-width:280px;
margin-top:50px;
box-shadow:inset 0 10px #BB0505, 0 1px 10px #0343;
}
.staff-box img {
	margin-top:-60px;
	margin-bottom:24px;
	border-radius:50%; 
	border:solid 3px #BB0505;
	width:100%;
	max-width:128px; 
	aspect-ratio:1/1;
}
.staff-box header {
	font-size:1.2em;
	line-height:1;
	font-weight:bold;
	color: #44233B;
}
.staff-box p , .staff-box a {
	display:block;
	font-size:16px; 
	margin:0.5em 0;
	line-height:1.05;
}
.profileBtn{
	color: #AA1F32; border-radius: 20px; padding: 9px 16px; border-color: white; background: transparent !important; box-shadow: 1px 1px 10px #7e455561;border: 2px solid #bb0505;
}
</style>
<main id="main">

	<!-- ======= About Committee Section ======= -->
	<section  style="background-color:var(--page-wrapper-bg-color)!important">
		
		<!-- ==========================Our Priest============================ -->

		<div class="container">
			<center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Our Beloved Priests</h2> </center>
			<div class="row staff-wrapper py-5"> 

				<div class="col-md-4 staff-box my-5"> 
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Sri Srimannarayana Puranam" />
					<header>Sri Srimannarayana Puranam</header><br>
					<span>Head Priest</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 460-4395"><i class="fa fa-phone"></i>: +1 (570) 460-4395</a> -->
					
				</div>

				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Sri Samavendam Laxman Singarayakonda" />
					<header>Sri Samavendam Laxman Singarayakonda</header><br>
					<span>Priest</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8347"><i class="fa fa-phone"></i>: +1 (570) 369-8347</a> -->
					
				</div>

				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Sri Sudheer Shastri Sanganabhatla" />
					<header>Sri Sudheer Shastri Sanganabhatla</header><br>
					<span>Priest</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 460-4755"><i class="fa fa-phone"></i>: +1 (570) 460-4755</a> -->
					
				</div>

				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Sri Murthy Swamy Trichukachi" />
					<header>Sri Murthy Swamy Trichukachi</header><br>
					<span>Priest</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>

				<div class="col-md-4 staff-box mt-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Sri Rama Vireswara Sarma Kuchibhtla" />
					<header>Sri Rama Vireswara Sarma Kuchibhtla</header><br>
					<span>Priest</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>

			</div>

		</div>

		<!-- ======================Board of Directors========================= -->

		<div class="container">
			<center> <h2 class="bottomborder" style="font-weight:bold!important;font-size: 35px!important;">Board of Directors</h2> </center>
			<div class="row staff-wrapper py-5"> 

				<div class="col-md-4 staff-box my-5"> 
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Ramu Arunachalam" />
					<header>Mr. Ramu Arunachalam</header><br>
					<span>Chairman</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 460-4395"><i class="fa fa-phone"></i>: +1 (570) 460-4395</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Akshaya Kumar (AK) Dash" />
					<header>Mr. Akshaya Kumar (AK) Dash</header><br>
					<span>Chief Finance Officer</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8347"><i class="fa fa-phone"></i>: +1 (570) 369-8347</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Rakesh Garg" />
					<header>Mr. Rakesh Garg</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 460-4755"><i class="fa fa-phone"></i>: +1 (570) 460-4755</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Murali Kattela" />
					<header>Mr. Murali Kattela</header><br>
					<span>General Secretary</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Satyanarayana Kancharala" />
					<header>Mr. Satyanarayana Kancharala</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Ms. Smita S Panda" />
					<header>Ms. Smita S Panda</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Sachi Pati" />
					<header>Mr. Sachi Pati</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
				<div class="col-md-4 staff-box my-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Venkateswara R. Bollimuntha" />
					<header>Mr. Venkateswara R. Bollimuntha</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
				<div class="col-md-4 staff-box mt-5">
					<img src="<?=base_url('assets/img/user-no-image.png')?>" alt="Mr. Murthy Chimalapati" />
					<header>Mr. Murthy Chimalapati</header><br>
					<span>Board Member</span>
					<!-- <a class="mt-3" href="tel:+1 (570) 369-8532"><i class="fa fa-phone"></i>: +1 (570) 369-8532</a> -->
					
				</div>
			</div>
		</div>
	</section><!-- End About Committee Section -->


</main><!-- End #main -->
<script type="text/javascript">
	$(document).ready(function() {
    window.scrollTo({ top: 225, behavior: 'smooth'});
});
</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>
