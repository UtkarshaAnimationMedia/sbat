<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/topbar') ?>
<?php $this->load->view('includes/header') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style type="text/css">
	.custom-form-control{
		padding: 1rem 0.75rem;
		border: 1px solid #758085;
		margin: 5px;
	}
	.contact-icons{
		color: white;
		border-radius: 50%;
		background-color: var(--headerFooter);
		font-size: 19px;
		text-align: center;
		padding: 11px 11px;
		height: 41px;
		width: 41px;
	}
	.custom-form-select {
		height: 59px!important;
		color: #758085!important;
	}

	#g-recaptcha-response {
		display: block !important;
		position: absolute;
		margin: -78px 0 0 0 !important;
		width: 302px !important;
		height: 76px !important;
		z-index: -999999;
		opacity: 0
	}
	.clearbtn:hover{
		box-shadow: 1px 1px 10px red!important;
	}
	.submitbtn:hover{
		box-shadow: 1px 1px 10px #8AB4F8!important;
	}
</style>
<!--Section: Contact v.2-->
<?php
$conatctus_data = $this->mongo_db2->where(['aspectType'=> 'contactusSettings'])->get('wesiteSettings');
?>
<main id="main" style="background-color:var(--page-wrapper-bg-color)!important">
	<section class="">

		<div class="container">
			<!--Section heading-->

			<div class="row m-0 p-0">

				<!--Grid column-->
				<div class="col-md-4 m-0 p-0">
					<div class="row m-0 p-0" id="service-data">
						<center> <h2 id="temple-services" class="text-center bottomborder">Get In Touch</h2> </center><br>
						<div class="col-md-12 py-2">
							<div class="row">
								<div class="col-md-12">
									<div class="row mx-4">
										<div class="col-md-12"><h4><b><?= GetProjectName(); ?></b></h4></div>
									</div>
									<div class="row m-4">
										<div class="col-md-3"><i class="contact-icons fa fa-map-marker"></i></div>
										<div class="col-md-9"><?= (isset($conatctus_data[0]['refDataName']) && $conatctus_data[0]['refDataName']) != '' ? $conatctus_data[0]['refDataName'] : '390 Cumming Street Suite B, Alpharetta, GA 30004'?></div>
									</div>
									<div class="row m-4">
										<div class="col-md-3"><i class="contact-icons fa fa-phone"></i></div>
										<div class="col-md-9"><?= (isset($conatctus_data[0]['templePhone']) && $conatctus_data[0]['templePhone']) != '' ? '+1 '.$conatctus_data[0]['templePhone'] : '+1 (770) 475-7701'?></div>
									</div>
									<div class="row m-4">
										<div class="col-md-3"><i class="contact-icons fa fa-envelope"></i></div>
										<div class="col-md-9"><?= (isset($conatctus_data[0]['templeEmail']) && $conatctus_data[0]['templeEmail']) != '' ? $conatctus_data[0]['templeEmail'] : 'manager@srihanuman.org'?></div>
									</div>
									<div class="row m-4">
										

										<?php  if (isset($conatctus_data[0]['priestName1']) && $conatctus_data[0]['priestName1']) {?>
											<div class="row m-4">
												<div class="col-md-12"><h4><b>For Priest Services</b></h4></div>
											</div>


											<div class="col-md-3 my-2"><i class="contact-icons fa fa-phone"></i></div>
											<div class="col-md-9"><span class="fw-bold"><?= (isset($conatctus_data[0]['priestName1']) && $conatctus_data[0]['priestName1']) != '' ? $conatctus_data[0]['priestName1'] : ''?></span><br> 
												<a href="tel:<?= (isset($conatctus_data[0]['priestPhone1']) && $conatctus_data[0]['priestPhone1']) != '' ? '+1 '.$conatctus_data[0]['priestPhone1'] : ''?>"><?= (isset($conatctus_data[0]['priestPhone1']) && $conatctus_data[0]['priestPhone1']) != '' ? '+1 '.$conatctus_data[0]['priestPhone1'] : ''?></a>
											</div>
										<?php } ?>


										<?php  if (isset($conatctus_data[0]['priestName2']) && $conatctus_data[0]['priestName2']) {?>
											<div class="col-md-3 my-3"><i class="contact-icons fa fa-phone"></i></div>
											<div class="col-md-9"><span class="fw-bold"><?= (isset($conatctus_data[0]['priestName2']) && $conatctus_data[0]['priestName2']) != '' ? $conatctus_data[0]['priestName2'] : ''?></span><br> 
												<a href="tel:<?= (isset($conatctus_data[0]['templePhone']) && $conatctus_data[0]['priestPhone2']) != '' ? '+1 '.$conatctus_data[0]['priestPhone2'] : ''?>"><?= (isset($conatctus_data[0]['priestPhone2']) && $conatctus_data[0]['priestPhone2']) != '' ? '+1 '.$conatctus_data[0]['priestPhone2'] : ''?></a>
											</div>
										<?php } ?>


										<?php  if (isset($conatctus_data[0]['priestName3']) && $conatctus_data[0]['priestName3']) {?>
											<div class="col-md-3 my-2"><i class="contact-icons fa fa-phone"></i></div>
											<div class="col-md-9"><span class="fw-bold"><?= (isset($conatctus_data[0]['priestName3']) && $conatctus_data[0]['priestName3']) != '' ? $conatctus_data[0]['priestName3'] : ''?></span><br> 
												<a href="tel:<?= (isset($conatctus_data[0]['priestPhone3']) && $conatctus_data[0]['priestPhone3']) != '' ? '+1 '.$conatctus_data[0]['priestPhone3'] : ''?>"><?= (isset($conatctus_data[0]['priestPhone3']) && $conatctus_data[0]['priestPhone3']) != '' ? '+1 '.$conatctus_data[0]['priestPhone3'] : ''?></a>
											</div>
										<?php } ?>

									</div>
								</div>

							</div>
						</div>
						<div class="col-md-12 mx-2">
							<h4><b>Follow Us</b></h4>
							<span class="" style="position:absolute!important;    margin-top: -12px!important; width: 50px!important;"></span>
							<a href="<?= (isset($conatctus_data[0]['facebookLink']) && $conatctus_data[0]['facebookLink']) != '' ? $conatctus_data[0]['facebookLink'] : 'javascript:void(0)'?>"><i class="contact-icons fa fa-facebook"></i></a>
							<a href="<?= (isset($conatctus_data[0]['instaLink']) && $conatctus_data[0]['instaLink']) != '' ? $conatctus_data[0]['instaLink'] : 'javascript:void(0)'?>"><i class="contact-icons fa fa-instagram"></i></a>
							<a href="<?= (isset($conatctus_data[0]['youtubeLink']) && $conatctus_data[0]['youtubeLink']) != '' ? $conatctus_data[0]['youtubeLink'] : 'javascript:void(0)'?>"><i class="contact-icons fa fa-youtube"></i></a>

							<a href="<?= (isset($conatctus_data[0]['twitterLink']) && $conatctus_data[0]['twitterLink']) != '' ? $conatctus_data[0]['twitterLink'] : 'javascript:void(0)'?>"><i class="contact-icons fa fa-twitter"></i></a>

						</div>
					</div>

				</div>

				<!--Grid column-->
				<div class="col-md-4 mb-0 p-0">
					<h2 id="temple-services" class="text-center bottomborder">	Contact Us</h2>
					<form id="contact-form" name="contact-form" action="<?=base_url('send/your-query')?>" method="POST">
						<?php 
						if ($this->session->flashdata('failure')) {
							echo "<div class='alert alert-danger alert-dismissible fade show text-center'><strong>Failed!</strong>".$this->session->flashdata('failure')."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
						}
						if ($this->session->flashdata('success')) {
							echo "<div class='alert alert-success alert-dismissible fade show text-center'><strong>Success!</strong>".$this->session->flashdata('success')."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
						}
						?>
						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-md-12">
								<div class="md-form mb-0">
									<input type="text" id="fname" name="fname" class="custom-form-control form-control" placeholder="First Name*" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="md-form mb-0">
									<input type="text" id="lname" name="lname" class="custom-form-control form-control" placeholder="Last Name*">
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="md-form mb-0">
									<input type="email" id="email" name="email" class="custom-form-control form-control" placeholder="Email*" required>
								</div>
							</div>

							<div class="col-md-12">
								<div class="md-form mb-0">
									<input id="phone" type="text" name="phone" class="custom-form-control form-control" placeholder="Phone Number*" required />
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-12">

								<div class="md-form mb-0">
									<select class="form-select custom-form-select custom-form-control form-control" name="purpose" required>
										<option value=" " selected disabled>Please Select Purpose*</option>
										<option value="services">Services</option>
										<option value="others">Others</option>
									</select>
								</div>

							</div>

							<div class="col-md-12">

								<div class="md-form">
									<textarea type="text" id="message" name="message" rows="2" class="custom-form-control form-control md-textarea" placeholder="Message" required></textarea>
								</div>

							</div>

							<div class="col-md-12">
								<div class="md-form">
									<div class="g-recaptcha" data-sitekey="6LeiQqkjAAAAACbqWhEGU9f-ub5s8I5RHcNtwHyC"></div>
								</div>
							</div>
						</div>

						<center class="my-3">

							<button class="btn btn-primary text-white clearbtn" type="reset" style="color: black; border-radius: 20px;  border-color: white; background: #B02135; !important; box-shadow: 1px 1px 10px #7e455561;padding: 5px 30px;">CLEAR</button>
							<button class="btn text-white  submitbtn" type="submit" style="color: #635C81; border-radius: 20px;  border-color: white; background: #008080 !important; box-shadow: 1px 1px 10px #7e455561;padding: 5px 30px;" onclick="ldldSample.full.toggle();">SUBMIT</button>

						</center>
					</form>
					<div class="status"></div>
				</div>
				<!--Grid column-->

				<div class="col-md-4 mt-5">

					<?php 
					if (isset($conatctus_data[0]['googleMapLink']) && $conatctus_data[0]['googleMapLink'] != '') {


					}else{

					}
					 ?>
					<iframe src="<?= (isset($conatctus_data[0]['googleMapLink']) && $conatctus_data[0]['googleMapLink'] != '') ? $conatctus_data[0]['googleMapLink'] : 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d394936.350944126!2d-77.289153!3d39.346266!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c9d6a13368cda5%3A0xb2bb39abb3026ab2!2sSri%20Bhaktha%20Anjaneya%20Temple!5e0!3m2!1sen!2sus!4v1681890055074!5m2!1sen!2sus' ?>" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

				</div>
			</div>
		</div>

	</section>
</main>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
async defer>
</script>

<script type="text/javascript">
	function phone_formatting(ele,restore) {
		var new_number,
		selection_start = ele.selectionStart,
		selection_end = ele.selectionEnd,
		number = ele.value.replace(/\D/g,'');
		if (number.length > 2) {
			new_number = number.substring(0,3) + '-';
			if (number.length === 4 || number.length === 5) {
				new_number += number.substr(3);
			}
			else if (number.length > 5) {
				new_number += number.substring(3,6) + '-';
			}
			if (number.length > 6) {
				new_number += number.substring(6);
			}
		}
		else {
			new_number = number;
		}


		ele.value =  (new_number.length > 12) ? new_number.substring(12,0) : new_number;

		document.getElementById('msg').innerHTML='<p>Selection is: ' + selection_end + ' and length is: ' + new_number.length + '</p>';

		if (new_number.slice(-1) === '-' && restore === false
			&& (new_number.length === 8 && selection_end === 7)
			|| (new_number.length === 4 && selection_end === 3)) {
			selection_start = new_number.length;
		selection_end = new_number.length;
	}
	else if (restore === 'revert') {
		selection_start--;
		selection_end--;
	}
	ele.setSelectionRange(selection_start, selection_end);

}

function phone_number_check(field,e) {
	var key_code = e.keyCode,
	key_string = String.fromCharCode(key_code),
	press_delete = false,
	dash_key = 189,
	delete_key = [8,46],
	direction_key = [33,34,35,36,37,38,39,40],
	selection_end = field.selectionEnd;

  // delete key was pressed
	if (delete_key.indexOf(key_code) > -1) {
		press_delete = true;
	}
	if (key_string.match(/^\d+$/) || press_delete) {
		phone_formatting(field,press_delete);
	}
	else if(direction_key.indexOf(key_code) > -1) {
    // do nothing
	}
	else if(dash_key === key_code) {
		if (selection_end === field.value.length) {
			field.value = field.value.slice(0,-1)
		}
		else {
			field.value = field.value.substring(0,(selection_end - 1)) + field.value.substr(selection_end)
			field.selectionEnd = selection_end - 1;
		}
	}
	else {
		e.preventDefault();
		phone_formatting(field,'revert');
	}
}

document.getElementById('phone').onkeyup = function(e) {
	phone_number_check(this,e);
}

window.addEventListener('load', () => {
	const $recaptcha = document.querySelector('#g-recaptcha-response');
	if ($recaptcha) {
		$recaptcha.setAttribute('required', 'required');
	}
})

$(document).ready(function() {
	window.scrollTo({ top: 250, behavior: 'smooth'});
});
</script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/script') ?>